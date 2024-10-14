-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS mess_management;

-- Select the database
USE mess_management;

-- Create the 'admins' table if it doesn't exist
CREATE TABLE IF NOT EXISTS admins (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert admin user with a raw password (hash the password later using PHP)
-- Note: Replace 'admin123' with the hashed version of the password later
INSERT INTO admins (username, email, password) VALUES 
('admin', 'admin@example.com', 'admin123');

-- Create the 'mess_menu' table
CREATE TABLE IF NOT EXISTS mess_menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    day VARCHAR(10) NOT NULL,
    meal_time VARCHAR(10) NOT NULL,
    menu TEXT NOT NULL
);
CREATE TABLE mess_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert default users with hashed passwords (passwords: default1, default2)
INSERT INTO mess_users (email, password) VALUES 
('mess1@hostel.com', 'mess123'),
('mess2@hostel.com', 'mess456');


--
-- Table for student registration requests
CREATE TABLE IF NOT EXISTS `student_requests` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(50) NOT NULL,
    `lastname` VARCHAR(50) NOT NULL,
    `regnumber` VARCHAR(50) NOT NULL,
    `department` VARCHAR(30) NOT NULL,
    `year` VARCHAR(6) NOT NULL,
    `roomno` INT(3) NOT NULL,
    `block` VARCHAR(2) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `photo` VARCHAR(255) NOT NULL,
    `is_approved` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
);

-- Table for approved students
CREATE TABLE IF NOT EXISTS `student_approved` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(50) NOT NULL,
    `lastname` VARCHAR(50) NOT NULL,
    `regnumber` VARCHAR(50) NOT NULL,
    `department` VARCHAR(30) NOT NULL,
    `year` VARCHAR(6) NOT NULL,
    `roomno` INT(3) NOT NULL,
    `block` VARCHAR(2) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `photo` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);
-- TABLE FOR STORING THE QUERIES 
CREATE TABLE IF NOT EXISTS `queries` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `regnumber` VARCHAR(50) NOT NULL,
    `student_name` VARCHAR(100) NOT NULL,
    `query_area` VARCHAR(50) NOT NULL,
    `query_text` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`regnumber`) REFERENCES `student_approved`(`regnumber`) ON DELETE CASCADE
);

-- TABLE FOR STORING THE MESS LOGIN

CREATE TABLE mess_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20)
);

