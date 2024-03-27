<?php
require_once("./entities/nhanvien.class.php");

// Kiểm tra xem có dữ liệu POST được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['maNV'])) {
    // Lấy dữ liệu từ form
    $maNV = $_POST['maNV'];
    $tenNV = $_POST['tenNV'];
    $phai = $_POST['phai'];
    $noisinh = $_POST['noisinh'];
    $maphong = $_POST['maphong'];
    $luong = $_POST['luong'];

    // Tạo đối tượng Nhân viên
    $nhanvien = new NhanVien($maNV, $tenNV, $phai, $noisinh, $maphong, $luong);
    
    // Gọi phương thức update để cập nhật thông tin vào cơ sở dữ liệu
    $result = $nhanvien->update();
    if ($result) {
        echo "Cập nhật thông tin nhân viên thành công!";
    } else {
        echo "Cập nhật thông tin nhân viên thất bại!";
    }
} else {
    // Lấy mã nhân viên từ URL
    $maNV = $_GET['maNV'];

    // Tạo đối tượng Nhân viên và lấy thông tin từ cơ sở dữ liệu
    $nhanvien = NhanVien::getNhanVien($maNV);

    // Kiểm tra xem nhân viên có tồn tại không
    if ($nhanvien) {
        // Hiển thị form để sửa thông tin nhân viên
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin nhân viên</title>
</head>
<body>
    <h2>Cập nhật thông tin nhân viên</h2>
    <form method="post">
        <input type="hidden" name="maNV" value="<?php echo $nhanvien->maNV; ?>">
        
        <label for="tenNV">Tên nhân viên:</label><br>
        <input type="text" id="tenNV" name="tenNV" value="<?php echo $nhanvien->tenNV; ?>" required><br>
        
        <label for="phai">Phái:</label><br>
        <select id="phai" name="phai">
            <option value="Nam" <?php if ($nhanvien->phai == 'Nam') echo 'selected'; ?>>Nam</option>
            <option value="Nu" <?php if ($nhanvien->phai == 'Nu') echo 'selected'; ?>>Nu</option>
        </select><br>
        
        <label for="noisinh">Nơi sinh:</label><br>
        <input type="text" id="noisinh" name="noisinh" value="<?php echo $nhanvien->noisinh; ?>" required><br>
        
        <label for="maphong">Mã phòng:</label><br>
        <input type="text" id="maphong" name="maphong" value="<?php echo $nhanvien->maphong; ?>" required><br>
        
        <label for="luong">Lương:</label><br>
        <input type="text" id="luong" name="luong" value="<?php echo $nhanvien->luong; ?>" required><br><br>
        
        <input type="submit" value="Cập nhật thông tin nhân viên">
    </form>
</body>
</html>
<?php
    } else {
        echo "Không tìm thấy nhân viên!";
    }
}
?>
