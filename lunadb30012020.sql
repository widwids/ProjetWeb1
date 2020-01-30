-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2020 at 11:41 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lunadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_nom` varchar(45) NOT NULL,
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_nom`) VALUES
(1, 'cat11'),
(2, 'cat23456'),
(4, 'categorie55'),
(6, 'qwe'),
(8, 'ert'),
(10, 'wer'),
(11, '545677'),
(12, 'testing123');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `clients_id` int(11) NOT NULL AUTO_INCREMENT,
  `clients_adresse` varchar(45) NOT NULL,
  `clients_telephone` varchar(45) NOT NULL,
  `clients_nom` varchar(45) NOT NULL,
  PRIMARY KEY (`clients_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clients_id`, `clients_adresse`, `clients_telephone`, `clients_nom`) VALUES
(1, '123 fausse rue', '438-789-4561', 'client1'),
(3, '123 pinewood', '514-123-4567', 'limewire'),
(4, '12 angele', '4384567890', 'kazaa'),
(5, '789 galaxy', '438-456-7894', 'zeus'),
(6, '2345 fafabebe', '514-456-1230', 'pizza hut'),
(7, 'montreal', '514-625-8451', 'maisonneuve');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(45) NOT NULL,
  `commandes_adresse` varchar(45) NOT NULL,
  `commandes_etat` varchar(45) NOT NULL,
  `commandes_commentaire` varchar(45) DEFAULT NULL,
  `fk_client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commande_client1_idx` (`fk_client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `date`, `commandes_adresse`, `commandes_etat`, `commandes_commentaire`, `fk_client_id`) VALUES
(1, '31012020', '789 bidon', 'en attente', 'commentaires4', 5),
(13, '31012020', '789 invention, montreal', 'en attente', 'commentaires3', 7),
(14, '31012020', 'quebec city', 'en attente', 'commentaires4', 8),
(15, '30012020', '2050 pie ix', 'termine', 'commentaires5', 9),
(16, '29012020', 'village val-cartier', 'termine', 'commentaires6', 10),
(21, '24012020', '651 srirasha', 'termine', 'commentaires11', 15),
(22, '31012020', '6514 derksberg', 'en attente', 'commentaires3', 7),
(23, '30012020', 'quebec city', 'termine', 'commentaires5', 6),
(24, '31012020', '789 bidonville', 'en attente', 'commentaires15', 6);

-- --------------------------------------------------------

--
-- Table structure for table `commandes_produits`
--

DROP TABLE IF EXISTS `commandes_produits`;
CREATE TABLE IF NOT EXISTS `commandes_produits` (
  `quantite_produit` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  PRIMARY KEY (`commande_id`,`produit_id`),
  KEY `fk_commande_produit_produit1_idx` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandes_produits`
--

INSERT INTO `commandes_produits` (`quantite_produit`, `commande_id`, `produit_id`) VALUES
(11, 1, 1),
(100, 1, 9),
(50, 15, 3),
(50, 16, 2),
(50, 21, 1),
(50, 23, 4);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `produits_id` int(11) NOT NULL AUTO_INCREMENT,
  `produits_nom` varchar(45) NOT NULL,
  `produits_description` varchar(255) NOT NULL,
  `produits_prix` decimal(10,0) NOT NULL,
  `produits_quantite` int(11) NOT NULL,
  `fk_categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`produits_id`),
  KEY `fk_produit_categorie1_idx` (`fk_categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`produits_id`, `produits_nom`, `produits_description`, `produits_prix`, `produits_quantite`, `fk_categorie_id`) VALUES
(1, 'produit1', 'desc10', '100', 100, 1),
(2, 'produit2', 'desc2', '200', 100, 2),
(3, 'produit3', 'desc3', '300', 100, 4),
(4, 'produit4', 'description', '111', 500, 1),
(5, 'produit5', 'desc', '22', 50, 2),
(6, 'produit6', 'desc', '123', 654, 4),
(7, 'produit7', 'descrip', '123', 654, 1),
(9, 'produit8', 'Une grosse planete', '100000', 10, 12),
(10, 'produit9', 'lorem', '123', 123, 1),
(11, 'produit10', '10', '10', 10, 12),
(12, 'produit11', '10', '10', 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `utilisateurs_nom` varchar(45) NOT NULL,
  `utilisateurs_password` varchar(45) NOT NULL,
  `utilisateurs_privilege` varchar(45) NOT NULL,
  PRIMARY KEY (`utilisateurs_nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`utilisateurs_nom`, `utilisateurs_password`, `utilisateurs_privilege`) VALUES
('admin', 'admin', 'admin'),
('gestion', 'gestion', 'gestion'),
('vendeur', 'vendeur', 'vendeur');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fk_commande_client1` FOREIGN KEY (`fk_client_id`) REFERENCES `clients` (`clients_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commandes_produits`
--
ALTER TABLE `commandes_produits`
  ADD CONSTRAINT `fk_commande_produit_commande` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_commande_produit_produit1` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`produits_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_produit_categorie1` FOREIGN KEY (`fk_categorie_id`) REFERENCES `categories` (`categories_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
