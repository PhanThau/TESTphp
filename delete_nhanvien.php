<?php
// Import class NhanVien
require_once("./entities/nhanvien.class.php");

// Kiểm tra xem có dữ liệu POST được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['maNV'])) {
    // Lấy mã nhân viên từ form
    $maNV = $_POST['maNV'];


    // Gọi phương thức xóa nhân viên với mã nhân viên đã lấy được
    $result = NhanVien::delete($maNV);
    if ($result) {
        echo "Xóa nhân viên thành công!";
    } else {
        echo "Xóa nhân viên thất bại!";
    }
}
?>
