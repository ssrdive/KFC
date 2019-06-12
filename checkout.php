<?php

error_reporting(E_ERROR | E_PARSE);

if(!isset($_COOKIE['cart'])) {
    header("Location ./menu.php");
}

include './cart.class.php';
include './database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>KFC Chicken, Burgers and Rice - Checkout Delicious Menu and Order Online</title>
        <link rel="icon" href="./img/favicon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/layout.css">
        <link rel="stylesheet" href="./css/checkout.css">
        <script type="text/javascript">
            function payClicked() {
                var chName = document.getElementById('chName').value;
                var chAddressNo = document.getElementById('chAddressNo').value;
                var chStreet = document.getElementById('chStreet').value;
                var chCity = document.getElementById('chCity').value;
                var chDistrict = document.getElementById('chDistrict').value;
                var chPrice = document.getElementById('chPrice').value;
                var chCardNo = document.getElementById('chCardNo').value;
                var chExpiry = document.getElementById('chExpiry').value;
                var chCVV = document.getElementById('chCVV').value;

                var chAgreement = document.getElementById('chAgreement').checked;

                if(chName == '' || chAddressNo == '' || chStreet == '' || chCity == '' || chDistrict == '' || chPrice == '' || chCardNo == '' || chExpiry == '' || chCVV == '') {
                    alert('Please make sure all details are entered');
                    event.preventDefault();
                }

                if(!chAgreement) {
                    alert('Please agree to terms and conditions');
                    event.preventDefault();
                }
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Laila" rel="stylesheet">
    </head>
    <body>
        <div class="logoRow">
            <div>
                <img style="width: 80px" src="./img/logo.png">
            </div>
            <div class="topSideBar">
                <div>
                    <?php
                        include './layout/sign_in_menu.php';
                    ?>
                    <a href="/cart.php"><img style="width: 60px; height: 60px;" src="./img/shopping_cart.png" alt=""></a>
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

        <?php

            if(isset($_POST['pay'])) {

                $name = $_POST['chName'];
                $address_no = $_POST['chAddressNo'];
                $street = $_POST['chStreet'];
                $city = $_POST['chCity'];
                $district = $_POST['chDistrict'];
                $price = $_POST['chPrice'];

                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                if(!$db) {
                    die("Cannot connect to database");
                }

                if(isset($_SESSION['customerUsername'])) {
                    $sql = "INSERT INTO orders (c_id, c_name, c_address_no, c_street, c_city, c_district, price) VALUES ('{$_SESSION['customerId']}', '{$name}', '{$address_no}', '{$street}', '{$city}', '{$district}', '{$price}')";
                } else {
                    $sql = "INSERT INTO orders (c_name, c_address_no, c_street, c_city, c_district, price) VALUES ('{$name}', '{$address_no}', '{$street}', '{$city}', '{$district}', '{$price}')";
                }

                $result = mysqli_query($db, $sql);

                if($result) {
                    $order_id = mysqli_insert_id($db);

                    $cart = unserialize($_COOKIE['cart']);

                    for($i = 0; $i < count($cart); $i++) {
                        $sql = "INSERT INTO orders_items (orders_id, item_id, price, qty, name) VALUES ('{$order_id}', '{$cart[$i]->getID()}', '{$cart[$i]->getPrice()}', '{$cart[$i]->getQty()}', '{$cart[$i]->getName()}')";

                        mysqli_query($db, $sql);

                        $customizations = $cart[$i]->getCustomizations();

                        if(count($customizations) > 0) {
                            for($j = 0; $j < count($customizations); $j++) {
                                $sql = "INSERT INTO orders_item_customization (orders_id, item_id, customization_id, price, name) VALUES ('{$order_id}', '{$cart[$i]->getID()}', '{$customizations[$j]->getId()}', '{$customizations[$j]->getPrice()}', '{$customizations[$j]->getName()}')";

                                mysqli_query($db, $sql);
                            }
                        }
                    }

                    echo "<script type='text/javascript'>alert('Order placed order id is {$order_id}');</script>";
                    unset($_COOKIE['cart']);
                    setcookie('cart', '', time() - 3600);
                } else {
                    echo "<script type='text/javascript'>alert('Failed to place order');</script>";
                }

            }

        ?>

        <div class="checkoutContainer">
            <div class="checkoutWrapper">
                <div>
                    <h1 style="font-family: 'Laila', serif; text-align: center;">Checkout</h1>
                    <form action="/checkout.php" method="post">
                        <table>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Name</td>
                                <td><input type="text" class="signInInput" name="chName" value="<?php if(isset($_SESSION['customerUsername'])) { echo $_SESSION['customerName']; } ?>" id="chName"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Address No&nbsp;&nbsp;</td>
                                <td><input type="text" class="signInInput" name="chAddressNo" id="chAddressNo"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Street&nbsp;&nbsp;</td>
                                <td><input type="text" class="signInInput" name="chStreet" id="chStreet"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">City&nbsp;&nbsp;</td>
                                <td><input type="text" class="signInInput" name="chCity" id="chCity"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">District&nbsp;&nbsp;</td>
                                <td><input type="text" class="signInInput" name="chDistrict" id="chDistrict"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Price (RS)&nbsp;&nbsp;</td>
                                <?php
                                    $cart = unserialize($_COOKIE['cart']);

                                    $totalPrice = 0;

                                    if(isset($_COOKIE['cart'])) {
                                        for($i = 0; $i < count($cart); $i++) {

                                            $customizations_price = 0;

                                            $customizations = $cart[$i]->getCustomizations();

                                            for($j = 0; $j < count($customizations); $j++) {
                                                $customizations_price = $customizations_price + ($customizations[$j]->getPrice() * $cart[$i]->getQty());
                                            }

                                            $price = $cart[$i]->getPrice() * $cart[$i]->getQty() + $customizations_price;

                                            $totalPrice = $totalPrice + $price;
                                        }
                                    }
                                ?>
                                <td><input type="text" class="signInInput" name="chPrice" id="chPrice" value="<?php echo $totalPrice; ?>" readonly></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Card Number&nbsp;&nbsp;</td>
                                <td><input type="text" class="signInInput" name="chCardNo" id="chCardNo"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Expiry&nbsp;&nbsp;</td>
                                <td><input type="text" class="signInInput" name="chExpiry" id="chExpiry" placeholder="MM/YY"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">CVV&nbsp;&nbsp;</td>
                                <td><input type="text" class="signInInput" name="chCVV" id="chCVV"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Terms and Agreement&nbsp;&nbsp;</td>
                                <td><input type="checkbox" name="chAgreement" id="chAgreement">&nbsp;&nbsp;I accept to terms and conditions</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="float: right;">
                                    <button type="submit" class="defaultButton" name="pay" value="Pay" onclick="payClicked()">Pay</button>
                                </td>
                            </tr>
                        </table>
                    </form>
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
                    <a href="#"><img style="width: 30px; height: 30px;" src="./img/fb-icon.jpg" alt=""></a>
                    <a href="#"><img style="width: 30px; height: 30px;" src="./img/instagram-icon.png" alt=""></a>
                    <a href="#"><img style="width: 30px; height: 30px;" src="./img/twitter-icon.png" alt=""></a>
                </div>
            </div>
        </div>
    </body>
</html>
