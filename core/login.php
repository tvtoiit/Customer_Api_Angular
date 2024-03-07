<?php

class Login {
    private $comn;
    private $table = "mstuser";
    public $psnCd;
    public $userid;
    public $passWord;
    public $userName;

    public function __construct($db) {
        $this->comn = $db;
    }

    public function loginQuery() {
        // Câu truy vấn SQL để kiểm tra tài khoản và mật khẩu
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " WHERE userid = :userid AND password = :password";
        
        // Chuẩn bị câu truy vấn
        $stmt = $this->comn->prepare($query);

        // Bind các tham số
        $stmt->bindParam(":userid", $this->userid);
        $stmt->bindParam(":password", $this->passWord);

        // Thực thi truy vấn
        $stmt->execute();

        // Lấy kết quả
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Trả về số lượng bản ghi tìm thấy
        return $result['count'];
    }
}

?>