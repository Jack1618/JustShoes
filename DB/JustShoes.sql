-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Giu 24, 2017 alle 19:06
-- Versione del server: 10.1.21-MariaDB
-- Versione PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `JustShoes`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Acquisto`
--

CREATE TABLE `Acquisto` (
  `id_acquisto` int(10) NOT NULL,
  `data` date DEFAULT NULL,
  `totale` float DEFAULT NULL,
  `id_indirizzo` int(10) DEFAULT NULL,
  `id_utente` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Acquisto`
--

INSERT INTO `Acquisto` (`id_acquisto`, `data`, `totale`, `id_indirizzo`, `id_utente`) VALUES
(16, '2017-06-24', 274.6, 14, 42),
(17, '2017-06-24', 280, 15, 42),
(18, '2017-06-24', 541.6, 16, 45),
(19, '2017-06-24', 120, 16, 45);

-- --------------------------------------------------------

--
-- Struttura della tabella `Carta_Di_Credito`
--

CREATE TABLE `Carta_Di_Credito` (
  `id_carta` int(10) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `numero_carta` char(16) DEFAULT NULL,
  `scadenza` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Carta_Di_Credito`
--

INSERT INTO `Carta_Di_Credito` (`id_carta`, `id_utente`, `numero_carta`, `scadenza`) VALUES
(32, 42, '1234567891234567', '2024-06-30'),
(33, 45, '1234123412341234', '2025-07-31');

-- --------------------------------------------------------

--
-- Struttura della tabella `Categoria`
--

CREATE TABLE `Categoria` (
  `id_categoria` int(10) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Categoria`
--

INSERT INTO `Categoria` (`id_categoria`, `nome`) VALUES
(8, 'Uomo '),
(9, 'Donna '),
(10, 'Sneakers '),
(11, 'Sportive '),
(12, 'Passeggio '),
(13, 'Aperte '),
(14, 'Ballerine '),
(15, 'Stivaletti '),
(16, 'Mocassini'),
(17, 'Tacco ');

-- --------------------------------------------------------

--
-- Struttura della tabella `Dettagli_Acquisto`
--

CREATE TABLE `Dettagli_Acquisto` (
  `id_scarpa` int(10) DEFAULT NULL,
  `id_taglia` int(10) NOT NULL,
  `id_acquisto` int(10) DEFAULT NULL,
  `quantita` int(11) NOT NULL,
  `prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Dettagli_Acquisto`
--

INSERT INTO `Dettagli_Acquisto` (`id_scarpa`, `id_taglia`, `id_acquisto`, `quantita`, `prezzo`) VALUES
(28, 4, 16, 1, 85),
(29, 1, 16, 3, 63.2),
(37, 6, 17, 2, 50),
(35, 5, 17, 4, 45),
(29, 7, 18, 1, 63.2),
(29, 15, 18, 7, 63.2),
(33, 11, 18, 1, 36),
(40, 10, 19, 3, 40);

-- --------------------------------------------------------

--
-- Struttura della tabella `Gruppo_Applicativo`
--

CREATE TABLE `Gruppo_Applicativo` (
  `id_gruppo_applicativo` int(10) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Gruppo_Applicativo`
--

INSERT INTO `Gruppo_Applicativo` (`id_gruppo_applicativo`, `nome`) VALUES
(1, 'Admin'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Struttura della tabella `Indirizzo`
--

CREATE TABLE `Indirizzo` (
  `id_indirizzo` int(10) NOT NULL,
  `id_utente` int(10) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `citta` varchar(50) DEFAULT NULL,
  `via` varchar(50) DEFAULT NULL,
  `CAP` char(5) DEFAULT NULL,
  `altro` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Indirizzo`
--

INSERT INTO `Indirizzo` (`id_indirizzo`, `id_utente`, `nome`, `citta`, `via`, `CAP`, `altro`) VALUES
(14, 42, 'Giacomo Calcara', 'Roma', 'Giuseppe Spataro, 65', '00155', 'Primo piano'),
(15, 42, 'Giacomo Calcara', 'Trapani', 'Giuseppe La Francesca, 4', '91100', 'Terzo piano'),
(16, 45, 'Francesco Di Stefano', 'Trapani', 'Vespri, 12', '91100', 'Piano 3');

-- --------------------------------------------------------

--
-- Struttura della tabella `Marca`
--

CREATE TABLE `Marca` (
  `id_marca` int(10) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Marca`
--

INSERT INTO `Marca` (`id_marca`, `nome`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(4, 'Asics'),
(6, 'Converse'),
(8, 'Diadora'),
(9, 'Woman Style'),
(10, 'Lumberjack'),
(11, 'Kiomi '),
(12, 'Timberland'),
(13, 'Anna Field '),
(14, 'Aeyde '),
(15, 'Pier One ');

-- --------------------------------------------------------

--
-- Struttura della tabella `Scarpa`
--

CREATE TABLE `Scarpa` (
  `id_scarpa` int(10) NOT NULL,
  `codice` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `prezzo` float DEFAULT NULL,
  `sconto` float NOT NULL,
  `id_marca` int(10) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `descrizione` varchar(1000) NOT NULL,
  `attivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Scarpa`
--

INSERT INTO `Scarpa` (`id_scarpa`, `codice`, `nome`, `prezzo`, `sconto`, `id_marca`, `foto`, `descrizione`, `attivo`) VALUES
(27, 'nikeAirHuarache', 'Air Huarache', 120, 0, 1, 'air-huarache.jpg', 'Nuova collezione 2017', 1),
(28, 'rosheOne', 'Roshe One', 100, 15, 1, 'roshe-one.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(29, 'aceTango', 'Ace Tango', 79, 20, 2, 'ace-tango.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(30, 'stormer', 'Stormer', 50, 0, 4, 'stormer.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(31, 'kiomi', 'Kiomi', 20, 50, 11, 'kiomi.jpg', 'La nostra occasione.', 1),
(32, 'classic', 'Classic', 70, 0, 12, 'classic.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(33, 'adilette', 'Adilette', 45, 20, 2, 'adilette.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(34, 'annaField', 'Anna Field', 30, 0, 13, 'ballerine.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(35, 'stivalettiAeyde', 'Stivaletti', 50, 10, 14, 'stivaletti.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(36, 'premium', 'Premium', 120, 20, 12, 'premium.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(37, 'camel', 'Camel', 50, 0, 15, 'camel.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(38, 'lightBlue', 'Light Blue', 35, 0, 15, 'light-blue.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(39, 'nude', 'Nude', 69, 0, 13, 'nude.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1),
(40, 'sienna', 'Sienna', 50, 20, 14, 'sienna.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Scarpa_Categoria`
--

CREATE TABLE `Scarpa_Categoria` (
  `id_scarpa` int(10) DEFAULT NULL,
  `id_categoria` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Scarpa_Categoria`
--

INSERT INTO `Scarpa_Categoria` (`id_scarpa`, `id_categoria`) VALUES
(31, 8),
(31, 12),
(32, 9),
(32, 12),
(33, 8),
(33, 13),
(35, 9),
(35, 15),
(36, 9),
(36, 15),
(37, 8),
(37, 16),
(39, 9),
(39, 17),
(40, 9),
(40, 17),
(27, 8),
(27, 9),
(27, 10),
(28, 8),
(28, 9),
(28, 10),
(29, 8),
(29, 11),
(30, 8),
(30, 11),
(34, 9),
(34, 14),
(38, 8),
(38, 16);

-- --------------------------------------------------------

--
-- Struttura della tabella `Stock_Scarpe`
--

CREATE TABLE `Stock_Scarpe` (
  `quantita` int(10) DEFAULT NULL,
  `id_scarpa` int(10) DEFAULT NULL,
  `id_taglia` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Stock_Scarpe`
--

INSERT INTO `Stock_Scarpe` (`quantita`, `id_scarpa`, `id_taglia`) VALUES
(3, 27, 16),
(0, 27, 15),
(73, 27, 14),
(0, 27, 13),
(8, 27, 12),
(0, 27, 11),
(31, 27, 10),
(12, 27, 9),
(11, 27, 8),
(4, 27, 7),
(5, 27, 6),
(8, 27, 5),
(22, 27, 4),
(8, 27, 3),
(7, 27, 2),
(5, 27, 1),
(0, 28, 16),
(5, 28, 15),
(5, 28, 14),
(5, 28, 13),
(5, 28, 12),
(5, 28, 11),
(5, 28, 10),
(5, 28, 9),
(5, 28, 8),
(5, 28, 7),
(5, 28, 6),
(5, 28, 5),
(5, 28, 4),
(5, 28, 3),
(5, 28, 2),
(5, 28, 1),
(0, 29, 16),
(7, 29, 15),
(0, 29, 14),
(7, 29, 13),
(0, 29, 12),
(7, 29, 11),
(0, 29, 10),
(7, 29, 9),
(0, 29, 8),
(7, 29, 7),
(0, 29, 6),
(7, 29, 5),
(0, 29, 4),
(7, 29, 3),
(0, 29, 2),
(7, 29, 1),
(10, 30, 16),
(10, 30, 15),
(9, 30, 14),
(9, 30, 13),
(9, 30, 12),
(8, 30, 11),
(8, 30, 10),
(8, 30, 9),
(7, 30, 8),
(7, 30, 7),
(6, 30, 6),
(5, 30, 5),
(4, 30, 4),
(3, 30, 3),
(2, 30, 2),
(1, 30, 1),
(5, 31, 16),
(7, 31, 15),
(4, 31, 14),
(36, 31, 13),
(5, 31, 12),
(5, 31, 11),
(5, 31, 10),
(0, 31, 9),
(5, 31, 8),
(2, 31, 7),
(2, 31, 6),
(2, 31, 5),
(2, 31, 4),
(2, 31, 3),
(12, 31, 2),
(12, 31, 1),
(0, 32, 16),
(4, 32, 15),
(0, 32, 14),
(0, 32, 13),
(30, 32, 12),
(3, 32, 11),
(3, 32, 10),
(9, 32, 9),
(9, 32, 8),
(12, 32, 7),
(0, 32, 6),
(0, 32, 5),
(20, 32, 4),
(29, 32, 3),
(19, 32, 2),
(19, 32, 1),
(9, 33, 16),
(2, 33, 15),
(2, 33, 14),
(41, 33, 13),
(4, 33, 12),
(4, 33, 11),
(48, 33, 10),
(9, 33, 9),
(8, 33, 8),
(4, 33, 7),
(9, 33, 6),
(8, 33, 5),
(4, 33, 4),
(0, 33, 3),
(0, 33, 2),
(0, 33, 1),
(0, 34, 16),
(8, 34, 15),
(8, 34, 14),
(0, 34, 13),
(4, 34, 12),
(4, 34, 11),
(4, 34, 10),
(4, 34, 9),
(4, 34, 8),
(4, 34, 7),
(4, 34, 6),
(48, 34, 5),
(33, 34, 4),
(5, 34, 3),
(9, 34, 2),
(48, 34, 1),
(55, 35, 16),
(5, 35, 15),
(5, 35, 14),
(5, 35, 13),
(0, 35, 12),
(5, 35, 11),
(5, 35, 10),
(5, 35, 9),
(5, 35, 8),
(5, 35, 7),
(5, 35, 6),
(5, 35, 5),
(5, 35, 4),
(5, 35, 3),
(5, 35, 2),
(0, 35, 1),
(6, 36, 16),
(6, 36, 15),
(6, 36, 14),
(6, 36, 13),
(6, 36, 12),
(6, 36, 11),
(6, 36, 10),
(0, 36, 9),
(6, 36, 8),
(6, 36, 7),
(6, 36, 6),
(6, 36, 5),
(6, 36, 4),
(6, 36, 3),
(6, 36, 2),
(6, 36, 1),
(3, 37, 16),
(0, 37, 15),
(3, 37, 14),
(0, 37, 13),
(3, 37, 12),
(0, 37, 11),
(0, 37, 10),
(3, 37, 9),
(0, 37, 8),
(0, 37, 7),
(3, 37, 6),
(3, 37, 5),
(3, 37, 4),
(3, 37, 3),
(3, 37, 2),
(3, 37, 1),
(0, 38, 16),
(8, 38, 15),
(0, 38, 14),
(8, 38, 13),
(8, 38, 12),
(0, 38, 11),
(8, 38, 10),
(9, 38, 9),
(9, 38, 8),
(9, 38, 7),
(0, 38, 6),
(69, 38, 5),
(6, 38, 4),
(6, 38, 3),
(6, 38, 2),
(6, 38, 1),
(9, 39, 16),
(6, 39, 15),
(9, 39, 14),
(6, 39, 13),
(9, 39, 12),
(6, 39, 11),
(9, 39, 10),
(6, 39, 9),
(9, 39, 8),
(6, 39, 7),
(9, 39, 6),
(6, 39, 5),
(9, 39, 4),
(6, 39, 3),
(9, 39, 2),
(6, 39, 1),
(3, 40, 16),
(5, 40, 15),
(4, 40, 14),
(3, 40, 13),
(5, 40, 12),
(4, 40, 11),
(0, 40, 10),
(5, 40, 9),
(4, 40, 8),
(3, 40, 7),
(5, 40, 6),
(4, 40, 5),
(3, 40, 4),
(5, 40, 3),
(4, 40, 2),
(3, 40, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Taglia`
--

CREATE TABLE `Taglia` (
  `id_taglia` int(10) NOT NULL,
  `taglia_uk_m` float DEFAULT NULL,
  `taglia_uk_f` float NOT NULL,
  `taglia_eu` float DEFAULT NULL,
  `taglia_us_m` float DEFAULT NULL,
  `taglia_us_f` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Taglia`
--

INSERT INTO `Taglia` (`id_taglia`, `taglia_uk_m`, `taglia_uk_f`, `taglia_eu`, `taglia_us_m`, `taglia_us_f`) VALUES
(1, 3, 2.5, 35, 3.5, 5),
(2, 3.5, 3, 35.5, 4, 5.5),
(3, 4, 3.5, 36, 4.5, 6),
(4, 4.5, 4, 37, 5, 6.5),
(5, 5, 4.5, 37.5, 5.5, 7),
(6, 5.5, 5, 38, 6, 7.5),
(7, 6, 5.5, 38.5, 6.5, 8),
(8, 6.5, 6, 39, 7, 8.5),
(9, 7, 6.5, 40, 7.5, 9),
(10, 7.5, 7, 41, 8, 9.5),
(11, 8, 7.5, 42, 8.5, 10),
(12, 8.5, 8, 43, 9, 10.5),
(13, 10, 9.5, 44, 10.5, 12),
(14, 11, 10.5, 45, 11.5, 13),
(15, 12, 11.5, 46.5, 12.5, 14),
(16, 13.5, 13, 48.5, 14, 15.5);

-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
--

CREATE TABLE `Utente` (
  `id_utente` int(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `id_gruppo_applicativo` int(10) DEFAULT NULL,
  `attivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Utente`
--

INSERT INTO `Utente` (`id_utente`, `email`, `password`, `id_gruppo_applicativo`, `attivo`) VALUES
(1, 'admin@root', '702baf0ab00246bf06bdacd5b1e542b6', 1, 1),
(42, 'cliente1@cliente', 'ba8c69bf0c7ffc3348df34ac7ccf9860', 2, 1),
(45, 'cliente2@cliente', '2355f637d9e7a7df8e674bca681f86dc', 2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Wishlist`
--

CREATE TABLE `Wishlist` (
  `id_utente` int(10) DEFAULT NULL,
  `id_scarpa` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Acquisto`
--
ALTER TABLE `Acquisto`
  ADD PRIMARY KEY (`id_acquisto`),
  ADD KEY `FK_Acquisto_0` (`id_indirizzo`),
  ADD KEY `FK_Acquisto_1` (`id_utente`);

--
-- Indici per le tabelle `Carta_Di_Credito`
--
ALTER TABLE `Carta_Di_Credito`
  ADD PRIMARY KEY (`id_carta`,`id_utente`);

--
-- Indici per le tabelle `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indici per le tabelle `Dettagli_Acquisto`
--
ALTER TABLE `Dettagli_Acquisto`
  ADD KEY `FK_Dettagli_Acquisto_0` (`id_scarpa`),
  ADD KEY `FK_Dettagli_Acquisto_1` (`id_acquisto`),
  ADD KEY `FK_Dettagli_Acquisto_2` (`id_taglia`);

--
-- Indici per le tabelle `Gruppo_Applicativo`
--
ALTER TABLE `Gruppo_Applicativo`
  ADD PRIMARY KEY (`id_gruppo_applicativo`);

--
-- Indici per le tabelle `Indirizzo`
--
ALTER TABLE `Indirizzo`
  ADD PRIMARY KEY (`id_indirizzo`),
  ADD KEY `FK_Indirizzo_0` (`id_utente`);

--
-- Indici per le tabelle `Marca`
--
ALTER TABLE `Marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indici per le tabelle `Scarpa`
--
ALTER TABLE `Scarpa`
  ADD PRIMARY KEY (`id_scarpa`),
  ADD UNIQUE KEY `codice` (`codice`),
  ADD KEY `FK_Scarpa_0` (`id_marca`);

--
-- Indici per le tabelle `Scarpa_Categoria`
--
ALTER TABLE `Scarpa_Categoria`
  ADD KEY `FK_Scarpa_Categoria_0` (`id_scarpa`),
  ADD KEY `FK_Scarpa_Categoria_1` (`id_categoria`);

--
-- Indici per le tabelle `Stock_Scarpe`
--
ALTER TABLE `Stock_Scarpe`
  ADD UNIQUE KEY `id_scarpa` (`id_scarpa`,`id_taglia`),
  ADD KEY `FK_Stock_Scarpe_0` (`id_scarpa`),
  ADD KEY `FK_Stock_Scarpe_1` (`id_taglia`);

--
-- Indici per le tabelle `Taglia`
--
ALTER TABLE `Taglia`
  ADD PRIMARY KEY (`id_taglia`);

--
-- Indici per le tabelle `Utente`
--
ALTER TABLE `Utente`
  ADD PRIMARY KEY (`id_utente`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_Utente_0` (`id_gruppo_applicativo`);

--
-- Indici per le tabelle `Wishlist`
--
ALTER TABLE `Wishlist`
  ADD UNIQUE KEY `id_utente` (`id_utente`,`id_scarpa`),
  ADD KEY `FK_Wishlist_0` (`id_scarpa`),
  ADD KEY `FK_Wishlist_1` (`id_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Acquisto`
--
ALTER TABLE `Acquisto`
  MODIFY `id_acquisto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT per la tabella `Carta_Di_Credito`
--
ALTER TABLE `Carta_Di_Credito`
  MODIFY `id_carta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT per la tabella `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT per la tabella `Indirizzo`
--
ALTER TABLE `Indirizzo`
  MODIFY `id_indirizzo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT per la tabella `Marca`
--
ALTER TABLE `Marca`
  MODIFY `id_marca` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT per la tabella `Scarpa`
--
ALTER TABLE `Scarpa`
  MODIFY `id_scarpa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT per la tabella `Taglia`
--
ALTER TABLE `Taglia`
  MODIFY `id_taglia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT per la tabella `Utente`
--
ALTER TABLE `Utente`
  MODIFY `id_utente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Acquisto`
--
ALTER TABLE `Acquisto`
  ADD CONSTRAINT `FK_Acquisto_0` FOREIGN KEY (`id_indirizzo`) REFERENCES `Indirizzo` (`id_indirizzo`),
  ADD CONSTRAINT `FK_Acquisto_1` FOREIGN KEY (`id_utente`) REFERENCES `Utente` (`id_utente`);

--
-- Limiti per la tabella `Dettagli_Acquisto`
--
ALTER TABLE `Dettagli_Acquisto`
  ADD CONSTRAINT `FK_Dettagli_Acquisto_0` FOREIGN KEY (`id_scarpa`) REFERENCES `Scarpa` (`id_scarpa`),
  ADD CONSTRAINT `FK_Dettagli_Acquisto_1` FOREIGN KEY (`id_acquisto`) REFERENCES `Acquisto` (`id_acquisto`),
  ADD CONSTRAINT `FK_Dettagli_Acquisto_2` FOREIGN KEY (`id_taglia`) REFERENCES `Taglia` (`id_taglia`);

--
-- Limiti per la tabella `Indirizzo`
--
ALTER TABLE `Indirizzo`
  ADD CONSTRAINT `FK_Indirizzo_0` FOREIGN KEY (`id_utente`) REFERENCES `Utente` (`id_utente`);

--
-- Limiti per la tabella `Scarpa`
--
ALTER TABLE `Scarpa`
  ADD CONSTRAINT `FK_Scarpa_0` FOREIGN KEY (`id_marca`) REFERENCES `Marca` (`id_marca`);

--
-- Limiti per la tabella `Scarpa_Categoria`
--
ALTER TABLE `Scarpa_Categoria`
  ADD CONSTRAINT `FK_Scarpa_Categoria_0` FOREIGN KEY (`id_scarpa`) REFERENCES `Scarpa` (`id_scarpa`),
  ADD CONSTRAINT `FK_Scarpa_Categoria_1` FOREIGN KEY (`id_categoria`) REFERENCES `Categoria` (`id_categoria`);

--
-- Limiti per la tabella `Stock_Scarpe`
--
ALTER TABLE `Stock_Scarpe`
  ADD CONSTRAINT `FK_Stock_Scarpe_0` FOREIGN KEY (`id_scarpa`) REFERENCES `Scarpa` (`id_scarpa`),
  ADD CONSTRAINT `FK_Stock_Scarpe_1` FOREIGN KEY (`id_taglia`) REFERENCES `Taglia` (`id_taglia`);

--
-- Limiti per la tabella `Utente`
--
ALTER TABLE `Utente`
  ADD CONSTRAINT `FK_Utente_0` FOREIGN KEY (`id_gruppo_applicativo`) REFERENCES `Gruppo_Applicativo` (`id_gruppo_applicativo`);

--
-- Limiti per la tabella `Wishlist`
--
ALTER TABLE `Wishlist`
  ADD CONSTRAINT `FK_Wishlist_0` FOREIGN KEY (`id_scarpa`) REFERENCES `Scarpa` (`id_scarpa`),
  ADD CONSTRAINT `FK_Wishlist_1` FOREIGN KEY (`id_utente`) REFERENCES `Utente` (`id_utente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
