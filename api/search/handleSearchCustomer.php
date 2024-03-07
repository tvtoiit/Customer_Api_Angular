<?php
    require_once '../../core/search.php';
    require_once '../../includes/config.php';
    
    // Khởi tạo kết nối đến cơ sở dữ liệu
    $db_connection = test_db_connection();
    
    // Khởi tạo đối tượng Search với kết nối đến cơ sở dữ liệu
    $search = new Search($db_connection);
    
    // Các thông tin tìm kiếm
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $sex = isset($_POST['sex']) ? $_POST['sex'] : null;
    $birthdayFrom = isset($_POST['birthdayFrom']) ? $_POST['birthdayFrom'] : null;
    $birthdayTo = isset($_POST['birthdayTo']) ? $_POST['birthdayTo'] : null;
    
    // Gọi hàm searchCustomer() với các thông tin tìm kiếm
    $searchResult = $search->searchCustomer($name, $sex, $birthdayFrom, $birthdayTo);
    
    // Xử lý kết quả trả về, ví dụ: hiển thị dữ liệu hoặc trả về JSON
    if ($searchResult) {
        echo $searchResult;
        // Xử lý kết quả, ví dụ: hiển thị dữ liệu
        // foreach ($searchResult as $customer) {
        //     echo "Customer ID: " . $customer['CUSTOMER_ID'] . "<br>";
        //     echo "Customer Name: " . $customer['CUSTOMER_NAME'] . "<br>";
        //     echo "Sex: " . $customer['SEX'] . "<br>";
        //     echo "Birthday: " . $customer['BIRTHDAY'] . "<br>";
        //     echo "Address: " . $customer['ADDRESS'] . "<br>";
        //     echo "<br>";
        // }
    } else {
        // Xử lý trường hợp không tìm thấy dữ liệu
        echo "Không tìm thấy khách hàng phù hợp.";
    }    

?>