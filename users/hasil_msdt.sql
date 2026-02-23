CREATE TABLE hasil_msdt (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(30) NOT NULL UNIQUE,

    Ds INT,
    Mi INT,
    Au INT,
    Co INT,
    Bu INT,
    Dv INT,
    Ba INT,
    E_dim INT,

    TO_score INT,
    RO_score INT,
    E_score INT,
    O_score INT,

    dominant_model VARCHAR(5),

    tanggal_tes DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (nip) REFERENCES users(nip)
);
