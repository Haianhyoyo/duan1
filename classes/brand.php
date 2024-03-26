<?php

?>
<?php
class brand
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    /**
     * Chèn danh mục mới vào cơ sở dữ liệu
     *
     * @param string $catName Tên danh mục
     *
     * @return chuỗi Cảnh báo HTML
     */
    public function insert_brand($brandName)
    {
        // Xác thực đầu vào
        $brandName = $this->fm->validation($brandName);

        // Vệ sinh đầu vào
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        // Kiểm tra xem tên danh mục có trống không
        if (empty($brandName)) {
            // Trả về lỗi nếu tên danh mục trống
            $alert = "<span class='error'>Thương hiệu không được trống</span>";
            return $alert;
        } else {
            // Truy vấn để chèn danh mục mới
            $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";

            // Chèn danh mục mới vào cơ sở dữ liệu
            $result = $this->db->insert($query);

            // Kiểm tra xem chèn có thành công không
            if ($result) { // nếu insert thành công
                $alert = "<span class='success'>Chèn thương hiệu thành công</span>";
                return $alert;
            } else {
                // Trả về lỗi nếu chèn thất bại
                $alert = "<span class='error'>Chèn thương hiệu không thành công</span>";
                return $alert;
            }
        }
    }


    /**
     * Lấy danh sách tất cả danh mục
     *
     * @return array Mảng các danh mục
     */

    public function show_brand()
    {
        // Truy vấn lấy tất cả danh mục
        $query = "SELECT * FROM tbl_brand order by brandId  desc";
        // Thực thi truy vấn
        $result = $this->db->select($query);
        // Trả về kết quả
        return $result;
    }
    /**
     * Lấy thông tin danh mục theo mã
     *
     * @param int $id Mã danh mục
     *
     * @return array Thông tin danh mục
     */
    public function getbrandbyId($id)
    {
        // Truy vấn lấy thông tin danh mục theo mã
        $query = "SELECT * FROM tbl_brand where brandId = '$id'";
        // Thực thi truy vấn
        $result = $this->db->select($query);
        // Trả về kết quả
        return $result;
    }

    /**
     * Cập nhật danh mục
     *
     * @param string $catName Tên danh mục
     * @param int $id Mã danh mục
     *
     * @return chuỗi Cảnh báo HTML
     */
    public function update_brand($brandName, $id)
    {
        // Xác thực đầu vào
        $brandName = $this->fm->validation($brandName);

        // Vệ sinh đầu vào
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        // Kiểm tra xem tên danh mục có trống không
        if (empty($brandName)) {
            // Trả về lỗi nếu tên danh mục trống
            $alert = "<span class='error'>Thương hiệu không được trống</span>";
            return $alert;
        } else {
            // Truy vấn để chèn danh mục mới
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";

            // Cập nhật danh mục vào cơ sở dữ liệu
            $result = $this->db->update($query);

            // Kiểm tra xem cập nhật có thành công không
            if ($result) { // nếu update thành công
                $alert = "<span class='success'>Cập nhật thương hiệu thành công</span>";
                return $alert;
            } else {
                // Trả về lỗi nếu cập nhật thất bại
                $alert = "<span class='error'>Cập nhật thương hiệu không thành công</span>";
                return $alert;
            }
        }
    }

    /**
     * Xóa danh mục
     *
     * @param int $id Mã danh mục
     *
     * @return chuỗi Cảnh báo HTML
     */
    public function del_brand($id)
    {
        $query = "DELETE FROM tbl_brand where brandId = '$id'";
        $result = $this->db->delete($query);

        if ($result) { // nếu insert thành công
            $alert = "<span class='success'>Xóa thương hiệu thành công</span>";
        } else {
            $alert = "<span class='error'>Xóa thương hiệu Không thành công</span>";
        }

        return $alert;
    }
}
?>