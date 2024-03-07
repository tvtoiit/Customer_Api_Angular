<?php
class Search {
    private $comn;
    private $table="mstcustomer";
    public $customerid;
    public $customerName;
    public $sex;
    public $birthday;
    public $email;
    public $address;
    public $deleteYmd;

    public function __construct($db) {
        $this->comn = $db;
    }

    public function deleteCustomer($customerIds) {
        if (empty($customerIds)) {
            echo "hong co customer de xoa";
            return false;
        }
    
        //Chuyển mảng id thành chuỗi
        $customerIdsString = implode(",", $customerIds);
    
        //query xoa khach hang
        $query = "DELETE FROM " .$this->table. " WHERE customer_id IN ($customerIdsString)";
    
        $stmt = $this->comn->prepare($query);
    
        //Thuc thi truy van
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function searchCustomer($name, $sex, $birthdayFrom, $birthdayTo) {
        // Bắt đầu xây dựng câu truy vấn SQL
        $query = "SELECT CUSTOMER_ID, CUSTOMER_NAME, CASE WHEN SEX = 0 THEN 'Male' ELSE 'Female' END AS SEX, BIRTHDAY, ADDRESS 
        FROM $this->table 
        WHERE DELETE_YMD IS NULL";

        // Danh sách các tham số sẽ được sử dụng trong truy vấn SQL
        $parameters = array();

        // Thêm điều kiện tìm kiếm theo tên nếu có
        if (!empty($name)) {
        $query .= " AND CUSTOMER_NAME LIKE ?";
        $parameters[] = "%$name%";
        }

        // Thêm điều kiện tìm kiếm theo giới tính nếu có
        if (!empty($sex)) {
        $query .= " AND SEX = ?";
        $parameters[] = $sex;
        }

        // Thêm điều kiện tìm kiếm theo ngày sinh bắt đầu nếu có
        if (!empty($birthdayFrom)) {
        $query .= " AND BIRTHDAY >= ?";
        $parameters[] = $birthdayFrom;
        }

        // Thêm điều kiện tìm kiếm theo ngày sinh kết thúc nếu có
        if (!empty($birthdayTo)) {
        $query .= " AND BIRTHDAY <= ?";
        $parameters[] = $birthdayTo;
        }

        // Sắp xếp kết quả theo CUSTOMER_ID
        $query .= " ORDER BY CUSTOMER_ID";

        // Thực hiện truy vấn SQL và trả về kết quả
        $stmt = $this->comn->prepare($query);
        $stmt->execute($parameters);

        // Lấy dữ liệu từ kết quả truy vấn
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}


?>