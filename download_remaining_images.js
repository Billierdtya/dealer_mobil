const fs = require('fs');
const mysql = require('mysql2/promise');
const { execSync } = require('child_process');
const path = require('path');

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
      
      if (!fs.existsSync(localPath)) {
          console.log(`Downloading (PowerShell) ${car.brand} ${car.model}...`);
          try {
              execSync(`powershell -Command "Invoke-WebRequest -Uri '${car.gambar_utama}' -OutFile '${localPath}' -UserAgent 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'"`);
              await connection.query('UPDATE mobil SET gambar_utama = ? WHERE id = ?', [dbPath, car.id]);
              console.log(`Saved to ${dbPath}`);
          } catch (err) {
              console.error(`Failed to download for ${car.brand}: ${err.message}`);
          }
      }
    }
  }
  await connection.end();
  console.log('Done!');
}
run().catch(console.error);
