# PSP Student Portal — Mini Project 1 (DFP40443)

Official assessment project repository for **DFP40443 Full Stack Web Development — Mini Project 1 (Sesi I 2025/2026)**.

---

## 🚀 Quick Start Setup Instructions

1. **Extract / Position Project Directory**:
   Ensure the project folder `PSP_Student_Portal_MiniProject1` is placed directly inside your XAMPP `htdocs` folder:
   `C:\xampp\htdocs\PSP_Student_Portal_MiniProject1`

2. **Start Web Server & Database**:
   Launch **XAMPP Control Panel** and start both **Apache** and **MySQL** modules.

3. **Import MySQL Database Schema & Seed Data**:
   - Open **phpMyAdmin** in your web browser (`http://localhost/phpmyadmin/`).
   - Create a database named `psp_student_portal` (or select SQL import directly).
   - Import the database script located at:
     `database/psp_student_portal.sql`

4. **Launch Application**:
   Access the student portal at:
   `http://localhost/PSP_Student_Portal_MiniProject1/public/`

---

## 🔑 Demonstration Account Credentials

| User Role | Username / NRIC | Password | Access Privileges |
| :--- | :--- | :--- | :--- |
| **Student** | `010101-01-0101` | `Student@123` | Dashboard, My Profile (Session-bound), Change Password |
| **Admin** | `admin` | `Admin@123` | Dashboard, Student Grade CRUD (Create, Read, Update, Delete) |

*Note: Passwords are encrypted using `password_hash()` (bcrypt) in the MySQL database.*

---

## 📁 Repository MVC Architecture

- `config/`: Application configuration (`config.php`), database connection (`database.php`), session authorization (`auth.php`), CSRF protection (`csrf.php`).
- `controllers/`: MVC Controllers (`AuthController.php`, `ProfileController.php`, `StudentController.php`).
- `models/`: MVC Data Models with PDO Prepared Statements (`AuthModel.php`, `StudentModel.php`).
- `views/`: Layout headers/footers, Auth views, Profile views, Student CRUD views.
- `public/`: Web server document root containing `index.php` Front Controller, CSS (`css/style.css`), and JavaScript (`js/main.js`).
- `database/`: Official MySQL database export file (`psp_student_portal.sql`).
- `docs/`: Technical Report (`REPORT_CONTENT.md`) and submission documentation.

---

## 📊 Complete Evidence & Rubric Checklist

Refer to `docs/REPORT_CONTENT.md` for the exhaustive 22-section Technical Report and screenshot evidence matrix.


## Student CRUD repair
The StudentModel reads the complete `students` table using the same PDO connection as CREATE/UPDATE/DELETE. A direct verification route is available at `index.php?action=students_direct`.
