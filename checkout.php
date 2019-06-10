<?php
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

        <div class="checkoutContainer">
            <div class="checkoutWrapper">
                <div>
                    <h1 style="font-family: 'Laila', serif; text-align: center;">Checkout</h1>
                    <form action="/checkout.php" method="post">
                        <table>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Name</td>
                                <td><input type="text" class="signInInput" name="chName" id="chName"></td>
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
                                <td><input type="text" class="signInInput" name="chPrice" id="chPrice" value="7570" disabled></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Payment Method&nbsp;&nbsp;</td>
                                <td>
                                    <input type="radio" name="chPaymentMethod" value="cash" id="chPaymentMethod">&nbsp;&nbsp;Cash on Delivery&nbsp;&nbsp;
                                    <input type="radio" name="chPaymentMethod" value="online" id="chPaymentMethod">&nbsp;&nbsp;Pay Online&nbsp;&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Terms and Agreement&nbsp;&nbsp;</td>
                                <td><input type="checkbox" name="chAgreement" id="chAgreement">&nbsp;&nbsp;I accept to terms and agreements</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="float: right;">
                                    <button type="submit" class="defaultButton" name="" value="Continue" onclick="signInClicked()">Continue</button>
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
                    <a href="#">About KFC</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#">Contact Us</a>&nbsp;&nbsp;&nbsp;
                    <a href="#">Feedback</a>
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
