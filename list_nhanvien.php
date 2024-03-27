<?php
require_once("entities/nhanvien.class.php");
include_once("header.php");

if(isset($_GET['maNV'])) {
    // Xóa nhân viên nếu có tham số 'maNV' được truyền qua URL
    $maNV_to_delete = $_GET['maNV'];
    $result = NhanVien::delete($maNV_to_delete);
    if($result) {
        echo "<p>Nhân viên đã được xóa thành công.</p>";
    } else {
        echo "<p>Xảy ra lỗi khi xóa nhân viên.</p>";
    }
}

$listNhanVien = NhanVien::list_nhanvien();
// Phân trang
$soNhanVienTrenTrang = 5;
$soTrang = ceil(count($listNhanVien) / $soNhanVienTrenTrang);

$trangHienTai = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($trangHienTai - 1) * $soNhanVienTrenTrang;

$nhanvienList = array_slice($listNhanVien, $offset, $soNhanVienTrenTrang);
// Hiển thị danh sách nhân viên
echo "<h2>Danh sách nhân viên</h2>";
echo "<table border='1'>";
echo "<tr><th>Mã nhân viên</th><th>Tên nhân viên</th><th>Phái</th><th>Nơi sinh</th><th>Mã phòng</th><th>Lương</th><th>Thao tác</th></tr>";
foreach ($nhanvienList as $nhanvien) {
    echo "<tr>";
    echo "<td>".$nhanvien["Ma_NV"]."</td>";
    echo "<td>".$nhanvien["Ten_NV"]."</td>";
    echo "<td>".$nhanvien["Phai"]."</td>";
    echo "<td>";
    if ($nhanvien["Phai"] == "Nu") {
        echo "<img src='img/nu.png' alt='Woman' width='30' height='30' class='gender-image'>";
    } elseif ($nhanvien["Phai"] == "Nam") {
        echo "<img src='img/nam.png' alt='Man' width='30' height='30' class='gender-image'>";
    }
    echo "</td>";
    echo "<td>".$nhanvien["Noi_Sinh"]."</td>";
    echo "<td>".$nhanvien["Ma_Phong"]."</td>";
    echo "<td>".$nhanvien["Luong"]."</td>";
    echo "<td><a href='/ktgiuaky/update_nhanvien.php?maNV=".$nhanvien["Ma_NV"]."'>Sửa</a> | <a href='?maNV=".$nhanvien["Ma_NV"]."'>Xóa</a></td>";
    echo "</tr>";
}
echo "</table>";
// Phân trang
echo "<div class='pagination'>";
for ($i = 1; $i <= $soTrang; $i++) {
    echo "<a href='?page=".$i."' ".($i == $trangHienTai ? 'class="active"' : '').">".$i."</a>";
}
echo "</div>";

include_once("footer.php");
?>
