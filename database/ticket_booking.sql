CREATE DATABASE IF NOT EXISTS ticket_booking;
USE ticket_booking;

CREATE TABLE IF NOT EXISTS tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(20) NOT NULL,
    pax_name VARCHAR(100) NOT NULL,
    ticket_number VARCHAR(50) NOT NULL,
    airline VARCHAR(100) NOT NULL,
    basic_fare DECIMAL(10,2) NOT NULL,
    other_taxes DECIMAL(10,2) NOT NULL,
    total_selling DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
