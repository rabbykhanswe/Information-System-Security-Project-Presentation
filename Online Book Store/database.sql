-- Create the Database
CREATE DATABASE IF NOT EXISTS bookstore_security;
USE bookstore_security;

-- Table for Registration (Vulnerable Passwords)
CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,       -- Stores Playfair Encrypted text
    security_ans VARCHAR(255) NOT NULL    -- Stores Playfair Encrypted text
);

-- Table for Payments (Vulnerable VISA Info)
CREATE TABLE payments (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    book_name VARCHAR(100) NOT NULL,
    card_number VARCHAR(255) NOT NULL,    -- Stores Playfair Encrypted text
    cvv VARCHAR(50) NOT NULL,             -- Stores Playfair Encrypted text
    expiry_date VARCHAR(20) NOT NULL,
    payment_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);