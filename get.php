<?php

    include './cart.class.php';

    $cart = unserialize($_COOKIE['cart']);
    // var_dump($cart);
    //
    // echo $cart[0]->getName();

    // $cart[0]->removeCustomization(23);

    for($i = 0; $i < count($cart); $i++) {
        echo "<b>".$cart[$i]->getName()."</b>&mdash;{$cart[$i]->getPrice()}<br>";

        $customizations = $cart[$i]->getCustomizations();

        for($j = 0; $j < count($customizations); $j++) {
            echo "&nbsp;&nbsp;&nbsp;<i>".$customizations[$j]->getName()."</i><br>";
        }
    }
?>
