CREATE DATABASE IF NOT EXISTS gestion_etudiants;
USE gestion_etudiants;

CREATE TABLE IF NOT EXISTS filieres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    filiere_id INT,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id)
);

INSERT INTO filieres (nom) VALUES 
('Systèmes Industriel'),
('Energie Renouvelable'),
('Réseaux Informatique et Télécom'),
('Systèmes Informatique et Logiciel');
