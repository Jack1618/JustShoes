CREATE TABLE Acquisto (
 id_acquisto NUMERIC(10) NOT NULL,
 data DATE,
 totale NUMERIC(10),
 id_indirizzo NUMERIC(10),
 id_utente NUMERIC(10)
);

ALTER TABLE Acquisto ADD CONSTRAINT PK_Acquisto PRIMARY KEY (id_acquisto);


CREATE TABLE Carta_Di_Credito (
 id_carta NUMERIC(10) NOT NULL,
 numero_carta CHAR(16),
 scadenza DATE
);

ALTER TABLE Carta_Di_Credito ADD CONSTRAINT PK_Carta_Di_Credito PRIMARY KEY (id_carta);


CREATE TABLE Categoria (
 id_categoria NUMERIC(10) NOT NULL,
 nome VARCHAR(50)
);

ALTER TABLE Categoria ADD CONSTRAINT PK_Categoria PRIMARY KEY (id_categoria);


CREATE TABLE Gruppo_Applicativo (
 id_gruppo_applicativo NUMERIC(10) NOT NULL,
 nome VARCHAR(50)
);

ALTER TABLE Gruppo_Applicativo ADD CONSTRAINT PK_Gruppo_Applicativo PRIMARY KEY (id_gruppo_applicativo);


CREATE TABLE Indirizzo (
 id_indirizzo NUMERIC(10) NOT NULL,
 id_utente NUMERIC(10),
 citta VARCHAR(50),
 via VARCHAR(50),
 CAP CHAR(5),
 altro VARCHAR(100)
);

ALTER TABLE Indirizzo ADD CONSTRAINT PK_Indirizzo PRIMARY KEY (id_indirizzo);


CREATE TABLE Marca (
 id_marca NUMERIC(10) NOT NULL,
 nome VARCHAR(50)
);

ALTER TABLE Marca ADD CONSTRAINT PK_Marca PRIMARY KEY (id_marca);


CREATE TABLE Scarpa (
 id_scarpa NUMERIC(10) NOT NULL,
 sesso CHAR(1),
 prezzo NUMERIC(10),
 id_marca NUMERIC(10),
 foto CHAR(10)
);

ALTER TABLE Scarpa ADD CONSTRAINT PK_Scarpa PRIMARY KEY (id_scarpa);


CREATE TABLE Scarpa_Categoria (
 id_scarpa NUMERIC(10),
 id_categoria NUMERIC(10)
);


CREATE TABLE Spedizione (
 id_acquisto NUMERIC(10)
);


CREATE TABLE Taglia (
 id_taglia NUMERIC(10) NOT NULL,
 taglia_uk NUMERIC(10),
 taglia_eu NUMERIC(10),
 taglia_us NUMERIC(10),
 taglia_jp NUMERIC(10)
);

ALTER TABLE Taglia ADD CONSTRAINT PK_Taglia PRIMARY KEY (id_taglia);


CREATE TABLE Utente (
 id_utente NUMERIC(10) NOT NULL,
 email VARCHAR(50),
 password VARCHAR(50),
 id_gruppo_applicativo NUMERIC(10),
 id_carta NUMERIC(10)
);

ALTER TABLE Utente ADD CONSTRAINT PK_Utente PRIMARY KEY (id_utente);


CREATE TABLE Wishlist (
 id_scarpa NUMERIC(10),
 id_utente NUMERIC(10)
);


CREATE TABLE Dettagli_Acquisto (
 id_scarpa NUMERIC(10),
 id_acquisto NUMERIC(10)
);


CREATE TABLE Stock_Scarpe (
 quantita NUMERIC(10),
 id_scarpa NUMERIC(10),
 id_taglia NUMERIC(10)
);


ALTER TABLE Acquisto ADD CONSTRAINT FK_Acquisto_0 FOREIGN KEY (id_indirizzo) REFERENCES Indirizzo (id_indirizzo);
ALTER TABLE Acquisto ADD CONSTRAINT FK_Acquisto_1 FOREIGN KEY (id_utente) REFERENCES Utente (id_utente);


ALTER TABLE Indirizzo ADD CONSTRAINT FK_Indirizzo_0 FOREIGN KEY (id_utente) REFERENCES Utente (id_utente);


ALTER TABLE Scarpa ADD CONSTRAINT FK_Scarpa_0 FOREIGN KEY (id_marca) REFERENCES Marca (id_marca);


ALTER TABLE Scarpa_Categoria ADD CONSTRAINT FK_Scarpa_Categoria_0 FOREIGN KEY (id_scarpa) REFERENCES Scarpa (id_scarpa);
ALTER TABLE Scarpa_Categoria ADD CONSTRAINT FK_Scarpa_Categoria_1 FOREIGN KEY (id_categoria) REFERENCES Categoria (id_categoria);


ALTER TABLE Spedizione ADD CONSTRAINT FK_Spedizione_0 FOREIGN KEY (id_acquisto) REFERENCES Acquisto (id_acquisto);


ALTER TABLE Utente ADD CONSTRAINT FK_Utente_0 FOREIGN KEY (id_gruppo_applicativo) REFERENCES Gruppo_Applicativo (id_gruppo_applicativo);
ALTER TABLE Utente ADD CONSTRAINT FK_Utente_1 FOREIGN KEY (id_carta) REFERENCES Carta_Di_Credito (id_carta);


ALTER TABLE Wishlist ADD CONSTRAINT FK_Wishlist_0 FOREIGN KEY (id_scarpa) REFERENCES Scarpa (id_scarpa);
ALTER TABLE Wishlist ADD CONSTRAINT FK_Wishlist_1 FOREIGN KEY (id_utente) REFERENCES Utente (id_utente);


ALTER TABLE Dettagli_Acquisto ADD CONSTRAINT FK_Dettagli_Acquisto_0 FOREIGN KEY (id_scarpa) REFERENCES Scarpa (id_scarpa);
ALTER TABLE Dettagli_Acquisto ADD CONSTRAINT FK_Dettagli_Acquisto_1 FOREIGN KEY (id_acquisto) REFERENCES Acquisto (id_acquisto);


ALTER TABLE Stock_Scarpe ADD CONSTRAINT FK_Stock_Scarpe_0 FOREIGN KEY (id_scarpa) REFERENCES Scarpa (id_scarpa);
ALTER TABLE Stock_Scarpe ADD CONSTRAINT FK_Stock_Scarpe_1 FOREIGN KEY (id_taglia) REFERENCES Taglia (id_taglia);


