CREATE TABLE Artiste(
    idArtiste INT PRIMARY KEY AUTO_INCREMENT,
    pseudoArtiste VARCHAR(40) NOT NULL,
    description VARCHAR(1000),
    ajouterPar VARCHAR(40) /*pseudo user*/
);

CREATE TABLE Album(
    idAlbum INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(40) NOT NULL,
    dateSortie DATE NOT NULL,    
    genre VARCHAR(20),
    note INT DEFAULT 0,
    artiste VARCHAR(40) NOT NULL
);

CREATE TABLE Utilisateur(
    pseudo VARCHAR(40) PRIMARY KEY,
    mdp VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    nom VARCHAR(20) NOT NULL
);

CREATE TABLE Administrateur(
    idAdmin INT PRIMARY KEY AUTO_INCREMENT
    pseudo VARCHAR(40) NOT NULL
);

CREATE TABLE Note(
    valeur INT NOT NULL,
    dateNote date NOT NULL,
    album INT NOT NULL,
    pseudo VARCHAR(40) NOT NULL,
);

CREATE TABLE Commentaire(
    idCommentaire INT PRIMARY KEY AUTO_INCREMENT,
    texte VARCHAR(500) NOT NULL,
    dateCom DATE NOT NULL,
    visible BOOLEAN DEFAULT FALSE
    album INT NOT NULL,
    pseudo VARCHAR(40) NOT NULL,
);
