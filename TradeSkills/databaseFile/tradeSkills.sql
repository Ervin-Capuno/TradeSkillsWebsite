-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 02:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `tradeSkills`

CREATE TABLE `users` (
  userId INT AUTO_INCREMENT,
  username VARCHAR(255),
  password VARCHAR(255),
  userPicture BLOB,
  email VARCHAR(255), 
  firstName VARCHAR(255),
  lastName VARCHAR(255),
  age INT,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users` AUTO_INCREMENT = 1000;

CREATE TABLE `hobby`(
  hobbyId INT AUTO_INCREMENT,
  userId INT,
  primaryHobby VARCHAR(255),
  secondaryHobby VARCHAR(255),
  tertiaryHobby VARCHAR(255),
  PRIMARY KEY (hobbyId),
  FOREIGN KEY (`userId`) REFERENCES `users`(`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `hobby` AUTO_INCREMENT = 100;

COMMIT;

