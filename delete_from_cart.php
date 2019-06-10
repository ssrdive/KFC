<?php
include './cart.class.php';

$item_id = $_GET['id'];
$cart = unserialize($_COOKIE['cart']);

$found = false;
$foundIndex = -1;

for($i = 0; $i < count($cart); $i++) {
    if($cart[$i]->getID() == $item_id) {
        $found = true;
        $foundIndex = $i;
    }
}

unset($cart[$foundIndex]);
$cart = array_values($cart);
setcookie("cart", serialize($cart));
header("Location: ./cart.php");

?>
