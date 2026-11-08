const fs = require('fs');
const mysql = require('mysql2/promise');
const { execSync } = require('child_process');
const path = require('path');

const delay = ms => new Promise(resolve => setTimeout(resolve, ms));

async function run() {
  const connection = await mysql.createConnection({ host: 'localhost', user: 'root', database: 'dealer_mobil_db' });
  const [rows] = await connection.query('SELECT id, brand, model, gambar_utama FROM mobil');
  
  for (let car of rows) {
    if (car.gambar_utama && car.gambar_utama.startsWith('http')) {
      const ext = path.extname(new URL(car.gambar_utama).pathname) || '.jpg';
      const cleanName = `${car.brand.toLowerCase().replace(/[^a-z0-9]/g, '_')}_${car.model.toLowerCase().replace(/[^a-z0-9]/g, '_')}`;
      const filename = `${cleanName}${ext}`;
      const localPath = path.join(__dirname, 'assets', 'images', 'cars', filename);
      const dbPath = `assets/images/cars/${filename}`;
      
      if (!fs.existsSync(localPath) || fs.statSync(localPath).size < 1000) {
          console.log(`Downloading ${car.brand} ${car.model}...`);
          try {
              const response = await fetch(car.gambar_utama, {
                  headers: {
                      'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/100.0.4896.127 Safari/537.36'
                  }
              });
              if (!response.ok) throw new Error(`HTTP ${response.status}`);
              const buffer = await response.arrayBuffer();
              fs.writeFileSync(localPath, Buffer.from(buffer));
              await connection.query('UPDATE mobil SET gambar_utama = ? WHERE id = ?', [dbPath, car.id]);
              console.log(`Saved to ${dbPath}`);
          } catch (err) {
              console.error(`Failed to download for ${car.brand}: ${err.message}`);
          }
          await delay(2000); // 2 second delay
      } else {
          // If already downloaded, just update DB
          await connection.query('UPDATE mobil SET gambar_utama = ? WHERE id = ?', [dbPath, car.id]);
      }
    }
  }
  await connection.end();
  console.log('Done!');
}
run().catch(console.error);
