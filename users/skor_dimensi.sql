CREATE TABLE skor_dimensi_msdt (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(30),
    dimensi VARCHAR(5), -- Ds, Mi, Au, Co, Bu, Dv, Ba, E
    skor INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nip) REFERENCES users(nip) ON DELETE CASCADE
);

ALTER TABLE skor_dimensi_msdt
ADD UNIQUE (nip, dimensi);