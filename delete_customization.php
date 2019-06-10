<?php

include './cart.class.php';

$item_id = $_GET['id'];
$customization_id = $_GET['cid'];

$cart = unserialize($_COOKIE['cart']);

$found = false;
$foundIndex = -1;

for($i = 0; $i < count($cart); $i++) {
    if($cart[$i]->getID() == $item_id) {
        $found = true;
        $foundIndex = $i;
    }
}

if($found) {
    $cart[$foundIndex]->removeCustomization($customization_id);
    setcookie("cart", serialize($cart));
    header("Location: ./cart.php");
} else {
    header("Location: ./cart.php");
}
