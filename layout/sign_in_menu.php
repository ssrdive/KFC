<?php
    $cartItems = 0;

    if(isset($_COOKIE['cart'])) {
        $cart = unserialize($_COOKIE['cart']);
        $cartItems = count($cart);
    }

    if(isset($_SESSION['customerUsername'])) {
        echo "<a href='./my_orders.php'>Hello {$_SESSION['customerName']}</a>&nbsp;&nbsp;&bull;&nbsp;";
        echo '<a href="/sign_out.php">Sign out</a>&nbsp;&nbsp;&bull;&nbsp;';
        echo "<a href='/cart.php'>Cart ({$cartItems})</a>&nbsp;";
    } else {
        echo '<a href="/sign_in.php">Sign in</a>&nbsp;&nbsp;&bull;&nbsp;';
        echo '<a href="/register.php">Register</a>&nbsp;&nbsp;&bull;&nbsp;';
        echo "<a href='/cart.php'>Cart ({$cartItems})</a>&nbsp;";
    }
?>
