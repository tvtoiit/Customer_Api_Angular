<?php

function test_db_connection() {
    $db_host     = 'localhost';
    $db_user     = 'root';
    $db_password ='';
    $db_name     = 'customersystem';

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        //$db gọi là đối tượng kết nối.

        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
        $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo "Kết nối thành công!";
        return $db;
    } catch(PDOException $e) {

        echo "Lỗi kết nối: " . $e->getMessage();
        exit;
    }
}

$db_connection = test_db_connection();

$db_connection = null;

?>
