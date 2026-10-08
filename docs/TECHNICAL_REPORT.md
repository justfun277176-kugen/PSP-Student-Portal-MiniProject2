# TECHNICAL REPORT: WEB BASED PSP STUDENT PORTAL
**Course:** DFP40443 Full Stack Web Development  
**Assessment:** Mini Project 1 (Sesi 1 2026/2027)  
**CLO 1:** Integrate PHP and MySQL with Bootstrap to build database-driven web applications projects (P4, PLO3)

---

## 1. Project Architecture & MVC Structure
The Web Based PSP Student Portal is engineered using the **Model-View-Controller (MVC)** design pattern to ensure clean separation of concerns, modularity, and security.

### Folder Structure
```
PSP_Student_Portal_MiniProject1/
├── config/
│   ├── config.php         # Session initialization & base configuration
│   ├── database.php       # PDO MySQL connection setup
│   ├── auth.php           # Session guards & access control helpers
│   └── csrf.php           # Anti-CSRF token generator & validator
├── controllers/
│   ├── AuthController.php # Login, Logout & Password Exchange logic
│   ├── ProfileController.php # Session-based Profile Management
│   └── StudentController.php # CRUD operations for Student Records
├── models/
│   ├── AuthModel.php      # User authentication & password update queries
│   └── StudentModel.php   # MySQL Prepared Statements for Student CRUD
├── views/
│   ├── auth/login.php     # Authentication View
│   ├── profile/index.php  # Student Profile View (Part 1.1)
│   ├── profile/password.php # Password Exchange View (Part 1.2)
│   ├── students/
│   │   ├── index.php      # Student Records Table View (Part 2 READ/DELETE)
│   │   ├── create.php     # Add Student Form View (Part 2 CREATE)
│   │   └── edit.php       # Edit Student Form View (Part 2 UPDATE)
│   ├── dashboard.php      # Role-based Portal Dashboard
│   └── layouts/
│       ├── header.php     # Common Navigation Header
│       └── footer.php     # Common Footer & JS inclusions
├── database/
│   └── psp_student_portal.sql # Complete Database Dump & Seed Data
└── public/
    ├── index.php          # Front Controller / Central Router
    ├── css/style.css      # Custom Styles
    └── js/main.js         # Client-side validation & deletion prompts
```

---

## 2. Part 1: Profile Management & Account Security

### 1.1 Student Profile Page
- **Session Management:** The system checks `$_SESSION['user_id']` using the `currentUserId()` helper.
- **Strict Access Control:** Parameter tampering via `$_GET['id']` or `$_POST['student_id']` is ignored. Students can only query and view their own personal profile data.
- **Data Displayed:** Full Name, NRIC/IC Number, Academic Program, and Current Marks.

### 1.2 Password Exchange Module
- **Validation Logic:** The system retrieves the user record and verifies the old password using PHP's `password_verify()`.
- **Data Security:** New passwords must meet a minimum 8-character policy. They are encrypted using `password_hash($newPassword, PASSWORD_DEFAULT)` prior to database storage.
- **Client & Server Validation:** Includes HTML5 constraint validation, live JavaScript confirmation matching, and server-side validation error handling.

---

## 3. Part 2: Grade Management System Revamp (CRUD Operations)

### 2.1 Dynamic Database Integration (MySQL)
All data operations interact directly with the MySQL `psp_student_portal` database via PDO.

### 2.2 CRUD Operations Summary
1. **CREATE (`student_create`):** Form collects Full Name, NRIC, Academic Program, and Marks (0-100). Uses `INSERT INTO students` via prepared statements.
2. **READ (`students`):** Renders all student records in a Bootstrap styled table displaying ID, Name, NRIC, Program, Marks, Edit button, and Delete button.
3. **UPDATE (`student_edit`):** Pre-fills student data into form inputs. Processes updates via `UPDATE students SET ... WHERE id = :id`.
4. **DELETE (`student_delete`):** Secure POST action protected by CSRF token and a JavaScript confirmation modal (`onsubmit="return confirm(...)"`) before permanent record deletion.

---

## 4. SQL Security & Secure Coding Practices
- **Prepared Statements:** All SQL operations use PDO prepared statements with parameter binding (`:id`, `:name`, `:nric`, `:program`, `:marks`, `:username`, `:password_hash`) to prevent **SQL Injection (SQLi)**.
- **XSS Prevention:** Output escaping is enforced using `htmlspecialchars($val, ENT_QUOTES, 'UTF-8')` via the `e()` utility.
- **CSRF Protection:** Anti-CSRF tokens generated with `bin2hex(random_bytes(32))` are validated on all state-modifying requests (Login, Password Update, Create, Edit, Delete).
- **Session Protection:** Calls `session_regenerate_id(true)` upon successful login to prevent Session Fixation attacks.

---

## 5. Entity Relationship Diagram (ERD)
```
+-----------------------------------+       +-----------------------------------+
|             students              |       |               users               |
+-----------------------------------+       +-----------------------------------+
| id (PK, INT UNSIGNED)             |<------| id (PK, INT UNSIGNED)             |
| name (VARCHAR 100)                | 1   0..1| student_id (FK, INT UNSIGNED NULL)|
| nric (VARCHAR 20, UNIQUE)         |       | username (VARCHAR 50, UNIQUE)     |
| program (VARCHAR 150)             |       | password_hash (VARCHAR 255)       |
| marks (DECIMAL 5,2)               |       | role (ENUM 'student', 'admin')    |
| created_at (TIMESTAMP)            |       | created_at (TIMESTAMP)            |
| updated_at (TIMESTAMP)            |       +-----------------------------------+
+-----------------------------------+
```

---

## 6. Demonstration Credentials
- **Student Account:**
  - Username / NRIC: `010101-01-0101`
  - Password: `Student@123`
- **Admin Account:**
  - Username: `admin`
  - Password: `Admin@123`
