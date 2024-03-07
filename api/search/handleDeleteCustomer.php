<?php
require_once '../../core/search.php';
require_once '../../includes/config.php';

$db_connection = test_db_connection();

$search = new Search($db_connection);

//mang chua id
$customerIds = array(1, 2, 3);

$result = $search->deleteCustomer($customerIds);

if ($result) {
    echo json_decode(array("message" => "xoa khach hang thanh cong!"));
} else {
    echo json_decode(array("message" => "Xoa khach hang khong thanh cong!"));
}

?>