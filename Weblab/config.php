<?php
// เปิดการรายงานข้อผิดพลาดของ MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost"; // หรือ 127.0.0.1
$username = "root"; // ค่าเริ่มต้นของ XAMPP
$password = ""; // ค่าเริ่มต้นของ XAMPP (เว้นว่าง)
$dbname = "mycardb"; // ชื่อฐานข้อมูล

try {
    $conn = new mysqli($servername, $username, $password, $dbname,3307);
    $conn->set_charset("utf8"); // ตั้งค่าการเข้ารหัสเป็น UTF-8
} catch (mysqli_sql_exception $e) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage());
}
?>
