<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include './cart.class.php';

// $Item = new CartItem(1, "Burger");
// $Item2 = new CartItem(2, "Juice");
//
// $Item->addCustomization("23", "Fruit Juice");
// $Item->addCustomization("56", "Orange Juice");
// $Item->addCustomization("87", "Jasmine Juice");
//
// var_dump($Item);
//
// $Item->removeCustomization("56");
//
// echo "<br>";
//
// var_dump($Item);
//
// echo "<br>Items Array<br>";
//
// $Items = array($Item, $Item2);
//
// setcookie("cart", serialize($Items));
//
// echo count($Items);
//
// unset($Items[0]);
//
// var_dump($Items);

$Item = new CartItem(1, "Burger", 550);

$Item->addCustomization(23, "Sausage", 240);
$Item->addCustomization(56, "Onions", 150);
$Item->addCustomization(29, "Jam", 320);

$Item2 = new CartItem(2, "Taco", 350);

$Item2->addCustomization(44, "Beans", 200);

$Items = array($Item, $Item2);

setcookie("cart", serialize($Items));
