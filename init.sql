CREATE DATABASE IF NOT EXISTS php_form_userdata;
USE php_form_userdata;

CREATE TABLE IF NOT EXISTS user_info (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(50),
     age INT,
     address VARCHAR(255),
     email VARCHAR(100) NOT NULL,
     password VARCHAR(255) NOT NULL,
     terms VARCHAR(20),
     UNIQUE (email)
);
