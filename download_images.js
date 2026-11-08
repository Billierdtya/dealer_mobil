const fs = require('fs');
const path = require('path');
const mysql = require('mysql2/promise');

const imageDir = path.join(__dirname, 'assets', 'images', 'cars');

if (!fs.existsSync(imageDir)) {
  fs.mkdirSync(imageDir, { recursive: true });
}

async function downloadImage(url, filename) {
  const response = await fetch(url, {
    headers: {
      'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
    }
  });
  if (!response.ok) throw new Error(`unexpected response ${response.statusText}`);
  const buffer = await response.arrayBuffer();
  fs.writeFileSync(filename, Buffer.from(buffer));
}

async function run() {
  const connection = await mysql.createConnection({
    host: 'localhost',
    user: 'root',
    database: 'dealer_mobil_db'
  });

  // First, update McLaren 750S Spider URL
  await connection.query(
    "UPDATE mobil SET gambar_utama = 'https://upload.wikimedia.org/wikipedia/commons/8/88/2019_McLaren_720S_Spider_Blue.jpg' WHERE kategori_id = 8"
  );
  
  // Also fix the local app.js for McLaren
  let appJsContent = fs.readFileSync('assets/js/app.js', 'utf8');
  appJsContent = appJsContent.replace(
    /'https:\/\/upload\.wikimedia\.org\/wikipedia\/commons\/thumb\/6\/69\/McLaren_720S_%2848386348467%29\.jpg\/800px-McLaren_720S_%2848386348467%29\.jpg'/g,
    "'assets/images/cars/mclaren_750s_spider.jpg'"
  );

  const [rows] = await connection.query('SELECT id, brand, model, gambar_utama FROM mobil');
  
  for (let car of rows) {
    if (car.gambar_utama && car.gambar_utama.startsWith('http')) {
      const ext = path.extname(new URL(car.gambar_utama).pathname) || '.jpg';
      const cleanName = `${car.brand.toLowerCase().replace(/[^a-z0-9]/g, '_')}_${car.model.toLowerCase().replace(/[^a-z0-9]/g, '_')}`;
      const filename = `${cleanName}${ext}`;
      const localPath = path.join(imageDir, filename);
      const dbPath = `assets/images/cars/${filename}`;
      
      console.log(`Downloading ${car.brand} ${car.model}...`);
      
      try {
        await downloadImage(car.gambar_utama, localPath);
        await connection.query('UPDATE mobil SET gambar_utama = ? WHERE id = ?', [dbPath, car.id]);
        
        console.log(`Saved to ${dbPath}`);
      } catch (err) {
        console.error(`Failed to download for ${car.brand}: ${err.message}`);
      }
    }
  }

  // Update app.js for all others
  for (let car of rows) {
      if(car.gambar_utama && car.gambar_utama.startsWith('http')) {
          const escapedUrl = car.gambar_utama.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
          const ext = path.extname(new URL(car.gambar_utama).pathname) || '.jpg';
          const cleanName = `${car.brand.toLowerCase().replace(/[^a-z0-9]/g, '_')}_${car.model.toLowerCase().replace(/[^a-z0-9]/g, '_')}`;
          const dbPath = `assets/images/cars/${cleanName}${ext}`;
          
          appJsContent = appJsContent.replace(new RegExp(`'${escapedUrl}'`, 'g'), `'${dbPath}'`);
      }
  }

  fs.writeFileSync('assets/js/app.js', appJsContent);
  console.log("Updated app.js fallbacks");
  
  await connection.end();
  console.log("All done!");
}

run().catch(console.error);
