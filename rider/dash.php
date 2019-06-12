<?php

include '../database.php';

session_start();
if(!isset($_SESSION['riderUsername'])) {
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
                    <a href="#">Hello <?php echo "{$_SESSION['adminUsername']}"; ?></a>&nbsp;&nbsp;&bull;&nbsp;
                    <a href="./sign_out.php">Sign out</a>
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
            if(isset($_POST['complete'])) {
                $order_id = $_GET['id'];

                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                if(!$db) {
                    die("Cannot connect to database");
                }

                $sql = "UPDATE orders SET status = 'Completed' WHERE id = '{$order_id}'";

                $result = mysqli_query($db, $sql);
            }
        ?>

        <div class="cartContainer">
            <div class="cartWrapper">
                <div>
                    <h1 style="font-family: 'Laila', serif; text-align: center;">Orders</h1>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address No</th>
                                <th>Street</th>
                                <th>City</th>
                                <th>District</th>
                                <th>Price</th>
                                <th>Mark Complete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                                if(!$db) {
                                    die("Cannot connect to database");
                                }

                                $sql = "SELECT * FROM orders WHERE rider_id = '{$_SESSION['riderId']}' AND status != 'Completed';";

                                $result = mysqli_query($db, $sql);

                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "    <td>{$row['id']}</td>";
                                    echo "    <td>{$row['c_name']}</td>";
                                    echo "    <td>{$row['c_address_no']}</td>";
                                    echo "    <td>{$row['c_street']}</td>";
                                    echo "    <td>{$row['c_city']}</td>";
                                    echo "    <td>{$row['c_district']}</td>";
                                    echo "    <td>{$row['price']}</td>";
                                    echo "<td><form action='./dash.php?id={$row['id']}' method='post'>";
                                    echo "    <input type='submit' value='Complete' class='secondaryButton' name='complete'>";
                                    echo "</form></td>";
                                }
                            ?>
                        </tbody>
                    </table>

                    <?php

                    ?>
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
