## 📚 LearnEnglish.com

A web platform for learning English, built in PHP with an MVC architecture. Uses a MySQL database to manage users, courses, videos, certificates, and quizzes, with a dynamic interface built in HTML/CSS/JS, hosted locally via XAMPP.

### Features
- User accounts and progress tracking
- Course and video management
- Quizzes and certificate generation
- MVC architecture (Model / View / Controller)

### Tech Stack
- **Backend:** PHP 8
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Local server:** XAMPP (Apache + MySQL)

### Getting Started

**Prerequisites:**
- XAMPP installed (Apache + MySQL)
- PHP 8

**Setup:**

1. Clone the repository into your XAMPP `htdocs` folder.

2. Start Apache and MySQL from the XAMPP control panel.

3. Create a MySQL database named `projet`.

4. Database connection settings are defined in `Config/configBDD.php`:

<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'projet');
?>

5. Open the project in your browser via:

 http://localhost/LearnEnglish.com/
