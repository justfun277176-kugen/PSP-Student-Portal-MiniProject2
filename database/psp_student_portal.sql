-- =========================================================
-- PSP STUDENT PORTAL DATABASE SCHEMA & SEED DATA
-- Course: DFP40443 Full Stack Web Development
-- Mini Project 1 (Sesi 1 2026/2027)
-- =========================================================

CREATE DATABASE IF NOT EXISTS psp_student_portal
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE psp_student_portal;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS students;
SET FOREIGN_KEY_CHECKS=1;

-- 1. Students Table
CREATE TABLE students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nric VARCHAR(20) NOT NULL UNIQUE,
    program VARCHAR(150) NOT NULL,
    marks DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    profile_picture VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_marks CHECK (marks >= 0.00 AND marks <= 100.00)
) ENGINE=InnoDB;

-- 2. Users Table (Authentication & Access Control)
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT UNSIGNED NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('student','admin') NOT NULL DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_users_student FOREIGN KEY (student_id) REFERENCES students(id)
        ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

-- 3. Seed Initial 6 Student Records
INSERT INTO students (id, name, nric, program, marks) VALUES
(1, 'Pritika', '010101-01-0101', 'Diploma in Information Technology', 88.50),
(2, 'Kugen Raj', '020202-02-0202', 'Diploma in Information Technology', 92.00),
(3, 'Vickneswari', '030303-03-0303', 'Diploma in Information Technology', 81.25),
(4, 'Muhammad Amirul', '040404-04-0404', 'Diploma in Information Technology', 75.00),
(5, 'Sarah Tan', '050505-05-0505', 'Diploma in Information Technology', 89.00),
(6, 'Ahmad Zaki', '060606-06-0606', 'Diploma in Information Technology', 94.50);

-- 4. Seed User Accounts with Hashed Passwords
-- Student Default Password: Student@123
-- Admin Default Password:   Admin@123
INSERT INTO users (student_id, username, password_hash, role) VALUES
(1, '010101-01-0101', '$2y$10$MGZYFiQX8Xzq3W6YSNXo5O8GTTRGHeFmcEACDkfIwWdjts.pYq3A6', 'student'),
(2, '020202-02-0202', '$2y$10$MGZYFiQX8Xzq3W6YSNXo5O8GTTRGHeFmcEACDkfIwWdjts.pYq3A6', 'student'),
(3, '030303-03-0303', '$2y$10$MGZYFiQX8Xzq3W6YSNXo5O8GTTRGHeFmcEACDkfIwWdjts.pYq3A6', 'student'),
(4, '040404-04-0404', '$2y$10$MGZYFiQX8Xzq3W6YSNXo5O8GTTRGHeFmcEACDkfIwWdjts.pYq3A6', 'student'),
(5, '050505-05-0505', '$2y$10$MGZYFiQX8Xzq3W6YSNXo5O8GTTRGHeFmcEACDkfIwWdjts.pYq3A6', 'student'),
(6, '060606-06-0606', '$2y$10$MGZYFiQX8Xzq3W6YSNXo5O8GTTRGHeFmcEACDkfIwWdjts.pYq3A6', 'student'),
(NULL, 'admin', '$2y$10$UUPZRKgIYrwlB8Q6iCN.seXOBjxg.NYBTwddkkQYMokr0Kw9jUAoy', 'admin');
