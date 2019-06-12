<?php
include '../cart.class.php';
include '../database.php';
session_start();
session_start();
if(!isset($_SESSION['adminUsername'])) {
    header('Location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>KFC Chicken, Burgers and Rice - Checkout Delicious Menu and Order Online</title>
        <link rel="icon" href="../img/favicon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/layout.css">
        <link rel="stylesheet" href="../css/cart.css">
        <script type="text/javascript">
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Laila" rel="stylesheet">
    </head>
    <body>
        <div class="logoRow">
            <div>
                <img style="width: 80px" src="../img/logo.png">
            </div>
            <div class="topSideBar">
                <div>
                    <?php
                        include '../layout/sign_in_menu.php';
                    ?>
                    <a href="/cart.php"><img style="width: 60px; height: 60px;" src="../img/shopping_cart.png" alt=""></a>
                </div>
            </div>
        </div>

        <div class="menuBar">
            <div class="topnav">
                <div class="menuBarContent">
                    <div>
                        <a class="active" href="/">DEALS</a>
                        <a href="/menu.php">MENU</a>
                    </div>
                    <div class="search-container">
                        <div>
                            <form action="#">
                                <input type="text" placeholder="Search.." name="search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cartContainer">
            <div class="cartWrapper">
                <div>
                    <h1 style="font-family: 'Laila', serif; text-align: center;">Order Items</h1>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Price (RS)</th>
                                <th>Options (RS)</th>
                                <th>Price (RS)</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                                $order_id = $_GET['id'];

                                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                                if(!$db) {
                                    die("Cannot connect to database");
                                }

                                $sql = "SELECT * FROM orders_items WHERE orders_id = '{$order_id}'";

                                $order_items = mysqli_query($db, $sql);

                                $totalPrice = 0;

                                while($order_item = mysqli_fetch_assoc($order_items)) {

                                    $customizations_price = 0;

                                    $sql = "SELECT * FROM orders_item_customization WHERE orders_id = {$order_id} AND item_id = {$order_item['item_id']}";

                                    $customizations = mysqli_query($db, $sql);

                                    while($customization = mysqli_fetch_assoc($customizations)) {
                                        $customizations_price = $customizations_price + $customization['price'] * $order_item['qty'];
                                    }

                                    $price = $order_item['qty'] * $order_item['price'] + $customizations_price;
                                    $totalPrice = $totalPrice + $price;

                                    echo "<tr>";
                                    echo "    <td>{$order_item['name']}</td>";
                                    echo "    <td>{$order_item['qty']}</td>";
                                    echo "    <td>{$order_item['price']}</td>";
                                    echo "    <td>{$customizations_price}</td>";
                                    echo "    <td>{$price}</td>";
                                    echo "</tr>";

                                    $sql = "SELECT * FROM orders_item_customization WHERE orders_id = {$order_id} AND item_id = {$order_item['item_id']}";

                                    $customizations = mysqli_query($db, $sql);

                                    while($customization = mysqli_fetch_assoc($customizations)) {
                                        echo "<tr>";
                                        echo "    <td><i>&nbsp;&nbsp;+  {$customization['name']}</i></td>";
                                        echo "    <td></td>";
                                        echo "    <td>{$customization['price']}</td>";
                                        echo "    <td></td>";
                                        echo "    <td></td>";
                                        echo "</tr>";
                                    }

                                }

                                echo "<tr>";
                                echo "    <td><b>Total</b></td>";
                                echo "    <td></td>";
                                echo "    <td></td>";
                                echo "    <td></td>";
                                echo "    <td>{$totalPrice}</td>";
                                echo "    <td></td>";
                                echo "</tr>";

                                // $totalPrice = 0;
                                //
                                // if(isset($_COOKIE['cart'])) {
                                //     $cart = unserialize($_COOKIE['cart']);
                                //
                                //     for($i = 0; $i < count($cart); $i++) {
                                //
                                //         $customizations_price = 0;
                                //
                                //         $customizations = $cart[$i]->getCustomizations();
                                //
                                //         for($j = 0; $j < count($customizations); $j++) {
                                //             $customizations_price = $customizations_price + ($customizations[$j]->getPrice() * $cart[$i]->getQty());
                                //         }
                                //
                                //         $price = $cart[$i]->getPrice() * $cart[$i]->getQty() + $customizations_price;
                                //
                                //         $totalPrice = $totalPrice + $price;
                                //
                                //         echo "<tr>";
                                //         echo "    <td>{$cart[$i]->getName()}</td>";
                                //         echo "    <td>{$cart[$i]->getQty()}</td>";
                                //         echo "    <td>{$cart[$i]->getPrice()}</td>";
                                //         echo "    <td>{$customizations_price}</td>";
                                //         echo "    <td>{$price}</td>";
                                //         echo "    <td><a href='../delete_from_cart.php?id={$cart[$i]->getID()}'>Delete</a></td>";
                                //         echo "</tr>";
                                //
                                //         for($j = 0; $j < count($customizations); $j++) {
                                //             echo "<tr>";
                                //             echo "    <td><i>&nbsp;&nbsp;+  {$customizations[$j]->getName()}</i></td>";
                                //             echo "    <td></td>";
                                //             echo "    <td>{$customizations[$j]->getPrice()}</td>";
                                //             echo "    <td></td>";
                                //             echo "    <td></td>";
                                //             echo "    <td><a href='../delete_customization.php?id={$cart[$i]->getID()}&cid={$customizations[$j]->getId()}'>Delete</a></td>";
                                //             echo "</tr>";
                                //         }
                                //     }
                                // }
                                //
                                // echo "<tr>";
                                // echo "    <td><b>Total</b></td>";
                                // echo "    <td></td>";
                                // echo "    <td></td>";
                                // echo "    <td></td>";
                                // echo "    <td>{$totalPrice}</td>";
                                // echo "    <td></td>";
                                // echo "</tr>";

                            ?>
                        </tbody>
                    </table>
                    <a href='../menu.php'><button type="submit" class="secondaryButton" name="" value="Sign in">Order More</button></a>
                    <a href='../checkout.php'><button type="submit" class="defaultButton" name="" value="Sign in">Checkout</button></a>
                 </div>
            </div>
        </div>

        <div class="bottomNav">
            <div class="bottomNavContents">
                <div>
                    <a href="/">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/about_kfc.php">About KFC</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/contact_us.php">Contact Us</a>&nbsp;&nbsp;&nbsp;
                    <a href="/feedback.php">Feedback</a>
                </div>
                <div class="socialMediaIcons">
                    <a href="#"><img style="width: 30px; height: 30px;" src="../img/fb-icon.jpg" alt=""></a>
                    <a href="#"><img style="width: 30px; height: 30px;" src="../img/instagram-icon.png" alt=""></a>
                    <a href="#"><img style="width: 30px; height: 30px;" src="../img/twitter-icon.png" alt=""></a>
                </div>
            </div>
        </div>
    </body>
</html>
