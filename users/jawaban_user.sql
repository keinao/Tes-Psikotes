CREATE TABLE jawaban_msdt (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(30),
    nomor_soal INT,
    jawaban ENUM('A','B'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nip) REFERENCES users(nip) ON DELETE CASCADE
);