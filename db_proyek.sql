DROP DATABASE IF EXISTS db_proyek;
CREATE DATABASE db_proyek;
USE db_proyek;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);


CREATE TABLE proyek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nama_proyek VARCHAR(100) NOT NULL,
    deskripsi TEXT NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


INSERT INTO users (username, password) 
VALUES ('admin', '$2y$10$i25866j0JzN35L3jI0f6j.WbK38fU56e8u.pL2w5E8A9r2M4R6S.G');

USE db_proyek;

DELETE FROM users WHERE username = 'admin';

INSERT INTO users (username, password) 
VALUES ('admin', '112789');