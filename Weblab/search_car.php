<!-- Developed by 66312251 ธนภัทร ทองโต -->
<?php
// เชื่อมต่อฐานข้อมูล
$host = "localhost";
$user = "root";
$pass = "";
$db = "mycardb";
$conn = new mysqli($host, $user, $pass, $db, 3307);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// ค้นหาข้อมูล
$search = "";
if (isset($_POST['search'])) {
   $search = $_POST['keyword'];
   $sql = "SELECT Car.CarID, Car.CarName, Car.CarPrice, CarBrand.BrandName, CarType.CarTypeName
           FROM Car
           JOIN CarBrand ON Car.BrandID = CarBrand.BrandID
           JOIN CarType ON Car.CarTypeID = CarType.CarTypeID
           WHERE Car.CarName LIKE '%$search%' OR CarBrand.BrandName LIKE '%$search%'";
} else {
   $sql = "SELECT Car.CarID, Car.CarName, Car.CarPrice, CarBrand.BrandName, CarType.CarTypeName
           FROM Car
           JOIN CarBrand ON Car.BrandID = CarBrand.BrandID
           JOIN CarType ON Car.CarTypeID = CarType.CarTypeID";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ค้นหาข้อมูลรถยนต์</title>
<style>
       /* จัดให้อยู่ตรงกลาง */
       .center {
           text-align: center;
       }
       /* จัดปุ่มและ input ให้อยู่ตรงกลาง */
       .form-container {
           display: flex;
           justify-content: center;
           align-items: center;
           gap: 10px;
           margin-bottom: 20px;
       }
       /* ปุ่ม */
       button {
           font-size: 16px;
           padding: 8px 15px;
           border: none;
           cursor: pointer;
           border-radius: 5px;
       }
       /* ปุ่ม Search สีเขียว */
       button[name="search"] {
           background-color: #28a745;
           color: white;
       }
       /* ปุ่ม Reset สีส้ม */
       button[name="reset"] {
           background-color: #ff9800;
           color: white;
       }
       /* ช่อง input */
       input[type="text"] {
           padding: 8px;
           font-size: 16px;
           width: 250px;
       }
       /* ตาราง */
       table {
           width: 100%;
           border-collapse: collapse;
           margin-top: 10px;
           border: 2px solid black; /* ขอบตารางสีดำ */
       }
       th, td {
           border: 2px solid black;
           padding: 10px;
           text-align: left;
       }
       /* เปลี่ยนสีหัวตาราง */
       th {
           background-color: #007bff; /* สีน้ำเงิน */
           color: white;
       }
       /* เปลี่ยนสีแถวสลับกัน */
       tr:nth-child(even) { 
           background-color:rgb(245, 188, 16); /* สีเทาอ่อน */
       }
       tr:nth-child(odd) {
           background-color: #ffffff; /* สีขาว */
       }
       /* เปลี่ยนสีเมื่อเอาเมาส์ไปวาง */
       tr:hover {
           background-color: #cce5ff; /* สีฟ้าอ่อน */
       }
</style>
</head>
<body>
<h2 class="center">ค้นหาข้อมูลรถยนต์</h2>
<div class="form-container">
<form method="post">
<input type="text" name="keyword" placeholder="กรุณาป้อนข้อความ" value="<?= $search ?>">
<button type="submit" name="search">Search</button>
<button type="submit" name="reset">Reset</button>
</form>
</div>
<table>
<tr>
<th>CarID</th>
<th>CarName</th>
<th>CarPrice</th>
<th>BrandName</th>
<th>CarTypeName</th>
</tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['CarID'] ?></td>
<td><?= $row['CarName'] ?></td>
<td><?= number_format($row['CarPrice']) ?> บาท</td>
<td><?= $row['BrandName'] ?></td>
<td><?= $row['CarTypeName'] ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
<?php
$conn->close();
?>
