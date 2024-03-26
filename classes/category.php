<?php

?>
<?php
class category
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
    public function insert_category($catName)
    {
        // Xác thực đầu vào
        $catName = $this->fm->validation($catName);

        // Vệ sinh đầu vào
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        // Kiểm tra xem tên danh mục có trống không
        if (empty($catName)) {
            // Trả về lỗi nếu tên danh mục trống
            $alert = "<span class='error'>Danh mục không được trống</span>";
            return $alert;
        } else {
            // Truy vấn để chèn danh mục mới
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";

            // Chèn danh mục mới vào cơ sở dữ liệu
            $result = $this->db->insert($query);

            // Kiểm tra xem chèn có thành công không
            if ($result) { // nếu insert thành công
                $alert = "<span class='success'>Chèn danh mục thành công</span>";
                return $alert;
            } else {
                // Trả về lỗi nếu chèn thất bại
                $alert = "<span class='error'>Chèn danh mục không thành công</span>";
                return $alert;
            }
        }
    }


    /**
     * Lấy danh sách tất cả danh mục
     *
     * @return array Mảng các danh mục
     */
    public function show_category()
    {
        // Truy vấn lấy tất cả danh mục
        $query = "SELECT * FROM tbl_category order by catId  desc";
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
    public function update_category($catName, $id)
    {
        // Xác thực đầu vào
        $catName = $this->fm->validation($catName);

        // Vệ sinh đầu vào
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        // Kiểm tra xem tên danh mục có trống không
        if (empty($catName)) {
            // Trả về lỗi nếu tên danh mục trống
            $alert = "<span class='error'>Danh mục không được trống</span>";
            return $alert;
        } else {
            // Truy vấn để chèn danh mục mới
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";

            // Cập nhật danh mục vào cơ sở dữ liệu
            $result = $this->db->update($query);

            // Kiểm tra xem cập nhật có thành công không
            if ($result) { // nếu update thành công
                $alert = "<span class='success'>Cập nhật danh mục thành công</span>";
                return $alert;
            } else {
                // Trả về lỗi nếu cập nhật thất bại
                $alert = "<span class='error'>Cập nhật danh mục không thành công</span>";
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
    public function del_category($id)
    {
        $query = "DELETE FROM tbl_category where catId = '$id'";
        $result = $this->db->delete($query);

        if ($result) { // nếu insert thành công
            $alert = "<span class='success'>Xóa danh mục thành công</span>";
        } else {
            $alert = "<span class='error'>Xóa danh mục Không thành công</span>";
        }

        return $alert;
    }

    /**
     * Lấy thông tin danh mục theo mã
     *
     * @param int $id Mã danh mục
     *
     * @return array Thông tin danh mục
     */
    public function getcatbyId($id)
    {
        // Truy vấn lấy thông tin danh mục theo mã
        $query = "SELECT * FROM tbl_category where catId = '$id'";
        // Thực thi truy vấn
        $result = $this->db->select($query);
        // Trả về kết quả
        return $result;
    }
}
?>