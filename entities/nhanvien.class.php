<?php
// TO DO:
require_once("./config/db.class.php");

class NhanVien {
    public $maNV;
    public $tenNV;
    public $phai;
    public $noisinh;
    public $maphong;
    public $luong;

    public function __construct($nv_id, $nv_name, $nv_phai, $nv_noisinh, $maphong_id, $nv_luong) {
        $this->maNV = $nv_id;
        $this->tenNV = $nv_name;
        $this->phai = $nv_phai;
        $this->noisinh = $nv_noisinh;
        $this->maphong = $maphong_id;
        $this->luong = $nv_luong;
    }

    
    // Hàm lưu sản phẩm
    public function save() {
        $db = new DB();
        // SQL statement to insert a new row
        $sql = "INSERT INTO Nhanvien (Ma_NV , Ten_NV, Phai, Noi_Sinh, Ma_Phong , Luong)
                VALUES ('$this->maNV','$this->tenNV','$this->phai','$this->noisinh','$this->maphong','$this->luong')";

        $result = $db->query_execute($sql);
        return $result;
    }
    public function update() {
        $db = new DB();
        // SQL statement to update existing row
        $sql = "UPDATE Nhanvien SET Ten_NV = '$this->tenNV', Phai = '$this->phai', Noi_Sinh = '$this->noisinh', Ma_Phong = '$this->maphong', Luong = '$this->luong' WHERE Ma_NV = '$this->maNV'";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function getNhanVien($maNV) {
        $db = new DB();
        $sql = "SELECT * FROM nhanvien WHERE Ma_NV = '$maNV'";
        $result = $db->select_to_array($sql);
        if (!empty($result)) {
            $nhanvien = new NhanVien($result[0]['Ma_NV'], $result[0]['Ten_NV'], $result[0]['Phai'], $result[0]['Noi_Sinh'], $result[0]['Ma_Phong'], $result[0]['Luong']);
            return $nhanvien;
        } else {
            return null;
        }
    }
    

    // Hàm xóa nhân viên
    public static function delete($maNV) {
        $db = new DB();
        // SQL statement to delete row
        $sql = "DELETE FROM Nhanvien WHERE Ma_NV = '$maNV'";
        $result = $db->query_execute($sql);
        return $result;
    }
    
    public static function list_nhanvien(){
        $db = new Db();
        $sql = "SELECT * FROM nhanvien";
        $result = $db->select_to_array($sql);
        return $result;
    }
    

}
