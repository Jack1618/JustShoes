                    LISTA QUERIES

-------------- ADMIN -------------------------------

gestione-categorie.php

//INSERIMENTO CATEGORIA
INSERT INTO Categoria (id_categoria, nome)
VALUES                (NULL, '$nome')

//ELIMINAZIONE CATEGORIA
DELETE FROM Categoria
WHERE Categoria.id_categoria = $id

//TUTTE LE CATEGORIE
SELECT *
FROM Categoria

/////////////////////////////////////////////////

gestione-marche.php

//INSERIMENTO MARCA
INSERT INTO Marca (id_marca, nome)
VALUES            (NULL, '$nome')

//ELIMINAZIONE MARCA
DELETE FROM Marca
WHERE Marca.id_marca = $id

//TUTTE LE MARCHE
SELECT *
FROM Marca

///////////////////////////////////////////////////

gestione-scarpe.php

//INSERIMENTO SCARPA
INSERT INTO Scarpa (id_scarpa, codice, nome, prezzo, sconto, id_marca, foto, descrizione)
VALUES             (NULL, '$codice','$nome','$prezzo', '$sconto', '$marca','$foto', '$descrizione')

//INSERIMENTO CATEGORIA PER SCARPA
INSERT INTO Scarpa_Categoria (id_scarpa, id_categoria)
VALUES                       ('$id_scarpa', '$categoria')

//ESCLUSIONE/INCLUSIONE SCARPA IN CATALOGO
UPDATE Scarpa
SET attivo=$attivo
WHERE Scarpa.id_scarpa = $id

//RICERCA SCARPA PER CODICE
SELECT *
FROM Scarpa
WHERE Scarpa.codice
LIKE '%$codice%'

//TUTTE LE scarpe
SELECT *
FROM Scarpa

//SELEZIONE NOME MARCA A PARTIRE DA ID_MARCA
SELECT nome
FROM Marca
WHERE id_marca=$value

//SELEZIONE CATEGORIA A PARTIRE DA ID_SCARPA
SELECT nome
FROM Scarpa_Categoria
JOIN Categoria
ON Scarpa_Categoria.id_categoria = Categoria.id_categoria
WHERE id_scarpa = $scarpa[id_scarpa]

///////////////////////////////////////////////////////////

gestione-utenti.php

//ATTIVA/DISATTIVA UTENTE
UPDATE Utente
SET attivo = $attivo
WHERE id_utente=$id_utente

//RICERCA UTENTE PER EMAIL
SELECT *
FROM Utente
WHERE id_gruppo_applicativo = 2
AND email LIKE '%$nome%'

//SELEZIONE TUTTI UTENTI LIMITATA AI CLIENTI
SELECT *
FROM Utente
WHERE id_gruppo_applicativo = 2

/////////////////////////////////////////////////////////

inserimento-scarpe.php

//RIMOZIONE VECCHIE QUANTITA SCARPE DA STOCK
DELETE FROM Stock_Scarpe
WHERE id_scarpa = $id_scarpa

//INSERIMENTO QUANTITA SCARPE IN STOCK
INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa)
VALUES                   ('$_POST[num1]','1','$id_scarpa')

//SELEZIONA TUTTE LE TAGLIE
SELECT *
FROM Taglia

//SELEZIONE QUANTITA PER ID_SCARPA E ID_TAGLIA
SELECT quantita
FROM Stock_Scarpe
JOIN Scarpa ON Scarpa.id_scarpa = Stock_Scarpe.id_scarpa
WHERE id_taglia = $taglie[id_taglia]
AND Stock_Scarpe.id_scarpa = $id_scarpa

///////////////////////////////////////////////////////////

modifica-scarpe.php

//AGGIORNAMENTO VALORI SCARPA
UPDATE Scarpa
SET id_scarpa = '$id_scarpa',
    codice = '$codice',
    nome = '$nome',
    prezzo = '$prezzo',
    sconto = '$sconto',
    id_marca = '$marca',
    foto = '$foto',
    descrizione = '$descrizione'
WHERE id_scarpa = $id_scarpa

//ELIMINAZIONE CATEGORIE SCARPA
DELETE FROM Scarpa_Categoria
WHERE id_scarpa = $id_scarpa

//INSERIMENTO CATEGORIE SCARPA
INSERT INTO Scarpa_Categoria (id_scarpa, id_categoria)
VALUES                       ('$id_scarpa', '$value')

//SELEZIONE SCARPA PER ID
SELECT *
FROM Scarpa
WHERE id_scarpa = $id_scarpa

//SELEZIONE DI TUTTE LE marche
SELECT *
FROM Marca

//SELEZIONE CATEGORIE COLLEGATE A UNA SPECIFICA SCARPA
SELECT Categoria.id_categoria, nome
FROM Scarpa_Categoria
JOIN Categoria ON Scarpa_Categoria.id_categoria = Categoria.id_categoria
WHERE id_scarpa = $scarpa[id_scarpa]

//SELEZIONE CATEGORIE NON COLLEGATE A UNA SPECIFICA SCARPA
SELECT id_categoria, nome
FROM Categoria
WHERE id_categoria
NOT IN (SELECT id_categoria
       FROM Scarpa_Categoria
       WHERE id_scarpa =$scarpa[id_scarpa])

----------- CLIENTE ------------------------------------

carta-add.php
