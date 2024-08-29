-- Create the database
CREATE DATABASE IF NOT EXISTS mess_management;
USE mess_management;

-- Create the admins table
CREATE TABLE IF NOT EXISTS admins (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the students table
CREATE TABLE IF NOT EXISTS students (
    id INT(12) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -- Insert a sample admin user
-- INSERT INTO admins (username, email, password) VALUES 
-- ('admin', 'admin@example.com', '12345');
