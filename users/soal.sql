CREATE TABLE soal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_tes ENUM('KEPRIBADIAN','IQ') NOT NULL,
    nomor_soal INT NOT NULL,
    pertanyaan_a TEXT NOT NULL, -- Pernyataan A pada MSDT
    pertanyaan_b TEXT NOT NULL, -- Pernyataan B pada MSDT
    dimensi_a VARCHAR(5),      
    dimensi_b VARCHAR(5),       
    status ENUM('aktif','nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Hapus kolom dimensi_a dan dimensi_b karena penilaian berdasarkan posisi matriks
ALTER TABLE soal DROP COLUMN dimensi_a, DROP COLUMN dimensi_b;