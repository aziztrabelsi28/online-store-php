-- ============================================================
--  Magasin (online store) - database
--  Rebuilt from the queries used by the PHP code.
--  Import with phpMyAdmin (Import tab) or:  mysql -u root -p < database.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS `ecommerce`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;
USE `ecommerce`;

-- ------------------------------------------------------------
-- users: login accounts (login_action.php, register.php)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id`       INT NOT NULL AUTO_INCREMENT,
  `email`    VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role`     ENUM('client','admin') NOT NULL DEFAULT 'client',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_email` (`email`)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- clients: customer details, linked to users by email
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `clients` (
  `id`      INT NOT NULL AUTO_INCREMENT,
  `nom`     VARCHAR(100) NOT NULL,
  `email`   VARCHAR(100) NOT NULL,
  `adresse` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_clients_email` (`email`)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- produits: all products. Category-specific columns
--   books       -> author, genre
--   clothes     -> genre (type: shirt, pants...), size, gender
--   electronics -> none
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `produits` (
  `id`          INT NOT NULL AUTO_INCREMENT,
  `nom`         VARCHAR(150) NOT NULL,
  `description` TEXT,
  `prix`        DECIMAL(10,2) NOT NULL DEFAULT 0,
  `stock`       INT NOT NULL DEFAULT 0,
  `categorie`   ENUM('books','clothes','electronics') NOT NULL,
  `author`      VARCHAR(100) DEFAULT NULL,
  `genre`       VARCHAR(50)  DEFAULT NULL,
  `size`        VARCHAR(10)  DEFAULT NULL,
  `gender`      VARCHAR(20)  DEFAULT NULL,
  `image`       VARCHAR(255) DEFAULT NULL,   -- file name inside uploads/
  PRIMARY KEY (`id`),
  KEY `idx_produits_categorie` (`categorie`)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- commandes: one row per order (checkout.php)
-- date_commande defaults to now, because create_order.php
-- inserts an order without a date.
-- client_id is set to NULL if the client is deleted, so the
-- "Delete client" button in the admin never fails.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `commandes` (
  `id`            INT NOT NULL AUTO_INCREMENT,
  `client_id`     INT DEFAULT NULL,
  `date_commande` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_commandes_client` (`client_id`),
  CONSTRAINT `fk_commandes_client`
    FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- commande_details: the lines of each order
-- produit_id is set to NULL if the product is deleted, so the
-- "Delete product" button never fails on an ordered product.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `commande_details` (
  `id`          INT NOT NULL AUTO_INCREMENT,
  `commande_id` INT NOT NULL,
  `produit_id`  INT DEFAULT NULL,
  `quantite`    INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_details_commande` (`commande_id`),
  KEY `idx_details_produit` (`produit_id`),
  CONSTRAINT `fk_details_commande`
    FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_details_produit`
    FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Starter data
-- Admin account (the code compares passwords in plain text).
-- Log in with admin@magasin.com / admin123, then change it.
-- ------------------------------------------------------------
INSERT IGNORE INTO `users` (`email`, `password`, `role`)
VALUES ('admin@magasin.com', 'admin123', 'admin');
