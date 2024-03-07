<?php
require_once '../../core/login.php';
require_once '../../includes/config.php';


$userid = isset($_POST['userid']) ? $_POST['userid'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Khởi tạo kết nối đến cơ sở dữ liệu
$db_connection = test_db_connection();

// Khởi tạo đối tượng Login với kết nối đến cơ sở dữ liệu
$login = new Login($db_connection);

// Thiết lập giá trị cho thuộc tính userid và passWord
$login->userid = $userid;
$login->passWord = $password;

// Gọi hàm loginQuery() để kiểm tra tài khoản và mật khẩu
$count = $login->loginQuery();

// Kiểm tra kết quả trả về từ hàm loginQuery()
if ($count > 0) {
    // Đăng nhập thành công
    echo json_encode(array("message" => "Đăng nhập thành công"));
} else {
    // Sai tên đăng nhập hoặc mật khẩu
    echo json_encode(array("message" => "Sai tên đăng nhập hoặc mật khẩu"));
}
?>