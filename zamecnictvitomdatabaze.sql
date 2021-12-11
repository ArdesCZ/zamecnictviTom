-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 17. lis 2021, 13:51
-- Verze serveru: 10.4.14-MariaDB
-- Verze PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `zamecnictvitomdatabaze`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `portfolio`
--

CREATE TABLE `portfolio` (
  `idPortfolia` int(11) NOT NULL,
  `nazev` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `portfolio`
--

INSERT INTO `portfolio` (`idPortfolia`, `nazev`) VALUES
(1, '1.jpg'),
(2, '2.jpg'),
(3, '3.jpg'),
(4, '4.jpg'),
(5, '5.jpg'),
(6, '6.jpg'),
(7, '7.jpg'),
(8, '8.jpg'),
(9, '9.jpg'),
(10, '10.jpg'),
(11, '11.jpg'),
(12, '12.jpg'),
(13, '13.jpg'),
(14, '14.jpg'),
(15, '15.jpg'),
(16, '16.jpg'),
(17, '17.jpg'),
(18, '18.jpg'),
(19, '19.jpg'),
(20, '20.jpg'),
(21, '21.jpg'),
(22, '22.jpg'),
(23, '23.jpg'),
(24, '24.jpg'),
(25, '25.jpg'),
(26, '26.jpg'),
(27, '27.jpg'),
(28, '28.jpg'),
(29, '29.jpg'),
(30, '30.jpg'),
(31, '31.jpg'),
(32, '32.jpg'),
(33, '33.jpg'),
(34, '34.jpg'),
(35, '35.jpg'),
(36, '36.jpg'),
(37, '37.jpg');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `idUzivatele` int(11) NOT NULL,
  `uzivJM` varchar(40) NOT NULL,
  `heslo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`idUzivatele`, `uzivJM`, `heslo`) VALUES
(1, 'adminTom', '98d7abd2e2414aa482e1554b0afca8738f9e2cba');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`idPortfolia`);

--
-- Klíče pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`idUzivatele`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `idPortfolia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `idUzivatele` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
