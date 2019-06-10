<?php
include './database.php';
include './cart.class.php';

session_start();

if(!isset($_SESSION['customerUsername'])) {
    header('Location: ./sign_in.php');
}

$item_id = $_GET['id'];

$db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

if(!$db) {
    die("Cannot connect to database");
}

$item_sql = "SELECT * FROM item WHERE id='{$item_id}'";
$customizations_sql = "SELECT * FROM customization WHERE item_id='{$item_id}'";

$item_db = mysqli_query($db, $item_sql);
$customizations_db = mysqli_query($db, $customizations_sql);

mysqli_close($db);

$item_details = mysqli_fetch_assoc($item_db);

if(mysqli_num_rows($customizations_db) == 0) {

    if(!isset($_COOKIE['cart'])) {
        $Item = new CartItem($item_id, $item_details['name'], $item_details['price'], 1);

        setcookie("cart", serialize(array($Item)));
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
            $Item = new CartItem($item_id, $item_details['name'], $item_details['price'], 1);
            array_push($cart, $Item);

            setcookie("cart", serialize($cart));
            header("Location: ./cart.php");
        }

    }
} else {
    if(isset($_COOKIE['cart'])) {
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
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>KFC Chicken, Burgers and Rice - Checkout Delicious Menu and Order Online</title>
        <link rel="icon" href="./img/favicon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/addToCart.css">
        <link rel="stylesheet" href="./css/layout.css">
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
                        if(isset($_SESSION['customerUsername'])) {
                            echo "<a href='#'>Hello {$_SESSION['customerName']}</a>&nbsp;&nbsp;&bull;&nbsp;";
                            echo '<a href="/signout.php">Sign out</a>&nbsp;&nbsp;&bull;&nbsp;';
                        } else {
                            echo '<a href="/sign_in.php">Sign in</a>&nbsp;&nbsp;&bull;&nbsp;';
                            echo '<a href="/register.php">Register</a>&nbsp;&nbsp;&bull;&nbsp;';
                        }
                    ?>
                    <a href="/cart.php">Cart (4)</a>&nbsp;
                    <a href="/cart.php"><img style="width: 60px; height: 60px;" src="./img/shopping_cart.png" alt=""></a>
                </div>
            </div>
        </div>

        <div class="menuBar">
            <div class="topnav">
                <div class="menuBarContent">
                    <div>
                        <a class="active" href="/">DEALS</a>
                        <a href="./menu.php">MENU</a>
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
                <h3 style="font-family: 'Laila', serif; text-align: center;">Select Customizations for <?php echo $item_details['name']; ?></h3>
                <form action="add_to_cart_with_customizations.php?id=<?php echo $item_id; ?>" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Customization</th>
                                <th>Price</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($customization = mysqli_fetch_assoc($customizations_db)) {
                                    echo "<tr>";
                                    echo "    <td>{$customization['name']}</td>";
                                    echo "    <td>{$customization['price']}</td>";
                                    echo "    <td>";
                                    echo "        <input type='checkbox' name='customizations[]' value='{$customization[id]}&{$customization[name]}&{$customization[price]}'></input>";
                                    echo "    </td>";
                                    echo "</tr>";
                                }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type='submit' class="defaultButton" value='Add to Cart'></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <div class="bottomNav">
            <div class="bottomNavContents">
                <div>
                    <a href="/">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/about-kfc.php">About KFC</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/contact-us.php">Contact Us</a>&nbsp;&nbsp;&nbsp;
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
