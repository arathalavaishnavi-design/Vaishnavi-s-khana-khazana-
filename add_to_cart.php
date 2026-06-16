<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo json_encode(["status" => "error", "message" => "Please LogIn first to build your order!"]);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['item_id'])) {
    $id = $data['item_id'];
    $name = $data['item_name'];
    $price = $data['item_price'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += 1;
    } else {
        $_SESSION['cart'][$id] = ["name" => $name, "price" => $price, "qty" => 1];
    }
    echo json_encode(["status" => "success"]);
}
?>