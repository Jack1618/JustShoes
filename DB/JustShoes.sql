CREATE TABLE Carta_Di_Credito (
 id_carta INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 numero_carta CHAR(16),
 scadenza DATE
);



CREATE TABLE Categoria (
 id_categoria INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 nome VARCHAR(50)
);



CREATE TABLE Gruppo_Applicativo (
 id_gruppo_applicativo INT(10) NOT NULL PRIMARY KEY,
 nome VARCHAR(50)
);



CREATE TABLE Marca (
 id_marca INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 nome VARCHAR(50)
);



CREATE TABLE Scarpa (
 id_scarpa INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 sesso CHAR(1),
 prezzo INT(10),
 id_marca INT(10),
 foto CHAR(10)
);



CREATE TABLE Scarpa_Categoria (
 id_scarpa INT(10),
 id_categoria INT(10)
);


CREATE TABLE Taglia (
 id_taglia INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 taglia_uk FLOAT(10),
 taglia_eu FLOAT(10),
 taglia_us FLOAT(10),
 taglia_jp FLOAT(10)
);



CREATE TABLE Utente (
 id_utente INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 email VARCHAR(50),
 password VARCHAR(50),
 id_gruppo_applicativo INT(10),
 id_carta INT(10)
);



CREATE TABLE Wishlist (
 id_scarpa INT(10),
 id_utente INT(10)
);


CREATE TABLE Indirizzo (
 id_indirizzo INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 id_utente INT(10),
 nome VARCHAR(100),
 citta VARCHAR(50),
 via VARCHAR(50),
 CAP CHAR(5),
 altro VARCHAR(100)
);



CREATE TABLE Stock_Scarpe (
 quantita INT(10),
 id_scarpa INT(10),
 id_taglia INT(10)
);


CREATE TABLE Acquisto (
 id_acquisto INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 data DATE,
 totale FLOAT(10),
 id_indirizzo INT(10),
 id_utente INT(10)
);



CREATE TABLE Dettagli_Acquisto (
 id_scarpa INT(10),
 id_acquisto INT(10)
);


ALTER TABLE Scarpa ADD CONSTRAINT FK_Scarpa_0 FOREIGN KEY (id_marca) REFERENCES Marca (id_marca);


ALTER TABLE Scarpa_Categoria ADD CONSTRAINT FK_Scarpa_Categoria_0 FOREIGN KEY (id_scarpa) REFERENCES Scarpa (id_scarpa);
ALTER TABLE Scarpa_Categoria ADD CONSTRAINT FK_Scarpa_Categoria_1 FOREIGN KEY (id_categoria) REFERENCES Categoria (id_categoria);


ALTER TABLE Utente ADD CONSTRAINT FK_Utente_0 FOREIGN KEY (id_gruppo_applicativo) REFERENCES Gruppo_Applicativo (id_gruppo_applicativo);
ALTER TABLE Utente ADD CONSTRAINT FK_Utente_1 FOREIGN KEY (id_carta) REFERENCES Carta_Di_Credito (id_carta);


ALTER TABLE Wishlist ADD CONSTRAINT FK_Wishlist_0 FOREIGN KEY (id_scarpa) REFERENCES Scarpa (id_scarpa);
ALTER TABLE Wishlist ADD CONSTRAINT FK_Wishlist_1 FOREIGN KEY (id_utente) REFERENCES Utente (id_utente);


ALTER TABLE Indirizzo ADD CONSTRAINT FK_Indirizzo_0 FOREIGN KEY (id_utente) REFERENCES Utente (id_utente);


ALTER TABLE Stock_Scarpe ADD CONSTRAINT FK_Stock_Scarpe_0 FOREIGN KEY (id_scarpa) REFERENCES Scarpa (id_scarpa);
ALTER TABLE Stock_Scarpe ADD CONSTRAINT FK_Stock_Scarpe_1 FOREIGN KEY (id_taglia) REFERENCES Taglia (id_taglia);


ALTER TABLE Acquisto ADD CONSTRAINT FK_Acquisto_0 FOREIGN KEY (id_indirizzo) REFERENCES Indirizzo (id_indirizzo);
ALTER TABLE Acquisto ADD CONSTRAINT FK_Acquisto_1 FOREIGN KEY (id_utente) REFERENCES Utente (id_utente);


ALTER TABLE Dettagli_Acquisto ADD CONSTRAINT FK_Dettagli_Acquisto_0 FOREIGN KEY (id_scarpa) REFERENCES Scarpa (id_scarpa);
ALTER TABLE Dettagli_Acquisto ADD CONSTRAINT FK_Dettagli_Acquisto_1 FOREIGN KEY (id_acquisto) REFERENCES Acquisto (id_acquisto);
