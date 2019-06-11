<?php
include './database.php';
include './cart.class.php';

$item_id = $_GET['id'];
$customizations = $_POST['customizations'];

$db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

if(!$db) {
    die("Cannot connect to database");
}

$item_sql = "SELECT * FROM item WHERE id='{$item_id}'";

$item_db = mysqli_query($db, $item_sql);

mysqli_close($db);

$item_details = mysqli_fetch_assoc($item_db);

if(count($customizations) == 0) {
    if(!isset($_COOKIE['cart'])) {
        $item = new CartItem($item_id, $item_details['name'], $item_details['price'], 1);

        setcookie("cart", serialize(array($item)));
        header("Location: ./cart.php");
    } else {
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
            $curQty = $cart[$foundIndex]->getQty();
            $cart[$foundIndex]->setQty($curQty + 1);

            setcookie("cart", serialize($cart));
            header("Location: ./cart.php");
        } else {
            $item = new CartItem($item_id, $item_details['name'], $item_details['price'], 1);
            array_push($cart, $item);

            setcookie("cart", serialize($cart));
            header("Location: ./cart.php");
        }

    }
} else {
    if(!isset($_COOKIE['cart'])) {
        $item = new CartItem($item_id, $item_details['name'], $item_details['price'], 1);

        for($i = 0; $i < count($customizations); $i++) {
            $customization = explode("&", $customizations[$i]);
            $item->addCustomization($customization[0], $customization[1], $customization[2]);
        }

        setcookie("cart", serialize(array($item)));
        header("Location: ./cart.php");
    } else {
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
            $curQty = $cart[$foundIndex]->getQty();
            $cart[$foundIndex]->setQty($curQty + 1);

            setcookie("cart", serialize($cart));
            header("Location: ./cart.php");
        } else {
            $item = new CartItem($item_id, $item_details['name'], $item_details['price'], 1);

            for($i = 0; $i < count($customizations); $i++) {
                $customization = explode("&", $customizations[$i]);
                $item->addCustomization($customization[0], $customization[1], $customization[2]);
            }
            array_push($cart, $item);

            setcookie("cart", serialize($cart));
            header("Location: ./cart.php");
        }

    }
}

?>
