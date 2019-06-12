<?php

include './database.php';
include './cart.class.php';

session_start();
if(!isset($_SESSION['customerUsername'])) {
    header('Location: ./sign_in.php');
}

$order_id = $_GET['id'];

$db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

if(!$db) {
    die("Cannot connect to database");
}

$sql = "SELECT * FROM orders_items WHERE orders_id = '{$order_id}'";

$order_items = mysqli_query($db, $sql);

$cart = array();

while($order_item = mysqli_fetch_assoc($order_items)) {
    $item = new CartItem($order_item['item_id'], $order_item['name'], $order_item['price'], $order_item['qty']);

    array_push($cart, $item);

    $sql = "SELECT * FROM orders_item_customization WHERE orders_id = {$order_id} AND item_id = {$order_item['item_id']}";

    $customizations = mysqli_query($db, $sql);

    while($customization = mysqli_fetch_assoc($customizations)) {
        $item->addCustomization($customization['customization_id'], $customization['name'], $customization['price']);
    }
}

setcookie("cart", serialize($cart));
header("Location: ./cart.php");
