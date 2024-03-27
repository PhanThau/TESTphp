<?php
// Import class NhanVien
require_once("./entities/nhanvien.class.php");

// Xử lý khi người dùng gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $maNV = $_POST['maNV'];
    $tenNV = $_POST['tenNV'];
    $phai = $_POST['phai'];
    $noisinh = $_POST['noisinh'];
    $maphong = $_POST['maphong'];
    $luong = $_POST['luong'];

    // Tạo đối tượng Nhân viên
    $nhanvien = new NhanVien($maNV, $tenNV, $phai, $noisinh, $maphong, $luong);
    
    // Gọi phương thức save để lưu vào cơ sở dữ liệu
    $result = $nhanvien->save();
    if ($result) {
        echo "Thêm nhân viên thành công!";
    } else {
        echo "Thêm nhân viên thất bại!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
</head>
<body>
    <h2>Thêm nhân viên</h2>
    <form method="post">
        <label for="maNV">Mã nhân viên:</label><br>
        <input type="text" id="maNV" name="maNV" required><br>
        
        <label for="tenNV">Tên nhân viên:</label><br>
        <input type="text" id="tenNV" name="tenNV" required><br>
        
        <label for="phai">Phái:</label><br>
        <select id="phai" name="phai">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nu</option>
        </select><br>
        
        <label for="noisinh">Nơi sinh:</label><br>
        <input type="text" id="noisinh" name="noisinh" required><br>
        
        <label for="maphong">Mã phòng:</label><br>
        <input type="text" id="maphong" name="maphong" required><br>
        
        <label for="luong">Lương:</label><br>
        <input type="text" id="luong" name="luong" required><br><br>
        
        <input type="submit" value="Thêm nhân viên">
    </form>
</body>
</html>
