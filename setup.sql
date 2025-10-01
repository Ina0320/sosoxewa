-- Create database
CREATE DATABASE IF NOT EXISTS sosoxewa_db;
USE sosoxewa_db;

-- Create users table for admin login
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create testimonials table
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(255) NOT NULL,
    profession VARCHAR(255),
    testimonial_text TEXT NOT NULL,
    rating INT DEFAULT 5,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a default admin user (password is 'admin' hashed with md5)
INSERT INTO users (username, password) VALUES ('admin', MD5('admin')) ON DUPLICATE KEY UPDATE password = MD5('admin');

-- Insert sample testimonials
INSERT INTO testimonials (client_name, profession, testimonial_text, rating, image) VALUES
('Client Name 1', 'Profession 1', 'Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 5, 'img/testimonial-1.jpg'),
('Client Name 2', 'Profession 2', 'Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 5, 'img/testimonial-1.jpg'),
('Client Name 3', 'Profession 3', 'Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 5, 'img/testimonial-1.jpg');

-- Create articles table for blog posts
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    publish_date DATE NOT NULL,
    tags VARCHAR(255),
    excerpt TEXT,
    content TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
