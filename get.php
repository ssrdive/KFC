<?php

    include './cart.class.php';

    // if (isset($_COOKIE["cart"])) {
    //   $data = $_COOKIE["cart"];
    //   $serialized_data = serialize($data);
    //   $size = strlen($serialized_data);
    //   echo 'Length : ' . strlen($data);
    //   echo "<br/>";
    //   echo 'Size : ' . ($size * 8 / 1024) . ' Kb';
    // }

    $cart = unserialize($_COOKIE['cart']);

    // $cart[0]->removeCustomization(56);

    for($i = 0; $i < count($cart); $i++) {
        echo "<b>".$cart[$i]->getName()."</b>&mdash;{$cart[$i]->getQty()}&mdash;{$cart[$i]->getPrice()}<br>";

        $customizations = $cart[$i]->getCustomizations();

        for($j = 0; $j < count($customizations); $j++) {
            echo "&nbsp;&nbsp;&nbsp;<i>".$customizations[$j]->getName()."</i><br>";
        }
    }
?>
