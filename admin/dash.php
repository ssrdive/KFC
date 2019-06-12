<?php

include '../database.php';

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
        <link rel="stylesheet" href="../css/sign_in.css">
        <link rel="stylesheet" href="../css/dash.css">
        <script type="text/javascript">
            function addItemValidation() {
                var name = document.getElementById('addItemName').value;
                var price = document.getElementById('addItemPrice').value;
                var image = document.getElementById('addItemImage').value;

                if(name == '' || price == '' || image == '' || isNaN(price)) {
                    event.preventDefault();
                    alert('Please enter all the details');
                }
            }

            function addCustomizationValidation() {
                var item = document.getElementById('item').value;
                var name = document.getElementById('addCustomizationName').value;
                var price = document.getElementById('addCustomizationPrice').value;

                if(name == '' || price == '' || item == '' || isNaN(price)) {
                    event.preventDefault();
                    alert('Please enter all the details');
                }
            }

            function addUserValidation() {
                var name = document.getElementById('addUserName').value;
                var password = document.getElementById('addUserPassword').value;

                if(name == '' || password == '') {
                    event.preventDefault();
                    alert('Please enter the username and password');
                }
            }

            function addRiderValidation() {
                var username = document.getElementById('addRiderUsername').value;
                var password = document.getElementById('addRiderPassword').value;
                var name = document.getElementById('addRiderName').value;

                if(username == '' || password == '' || name == '') {
                    event.preventDefault();
                    alert('Please enter all details');
                }
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Laila" rel="stylesheet">
    </head>
    <body>

        <?php
            if(isset($_POST['addItem'])) {
                $name = $_POST['addItemName'];
                $price = $_POST['addItemPrice'];
                $deal = $_POST['deal'];
                $file_tmp = $_FILES['addItemImage']['tmp_name'];
                $tmp = explode('.',$_FILES['addItemImage']['name']);
                $file_ext=strtolower(end($tmp));

                $new_file_name = bin2hex(random_bytes(16)).".".$file_ext;

                $val = move_uploaded_file($file_tmp, "../img/upload/".$new_file_name);

                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                if(!$db) {
                    die("Cannot connect to database");
                }

                $sql = "INSERT INTO item (name, price, image, deal) VALUES ('{$name}', '{$price}', '{$new_file_name}', '{$deal}');";

                $result = mysqli_query($db, $sql);

                mysqli_close($db);

                if($result) {
                    echo "<script type='text/javascript'>alert('Item added')</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Failed to add item')</script>";
                }
            } else if(isset($_POST['addCustomization'])) {
                $item_id = $_POST['item'];
                $name = $_POST['addCustomizationName'];
                $price = $_POST['addCustomizationPrice'];

                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                if(!$db) {
                    die("Cannot connect to database");
                }

                $sql = "INSERT INTO customization (item_id, name, price) VALUES ('{$item_id}', '{$name}', '{$price}');";

                $result = mysqli_query($db, $sql);

                mysqli_close($db);

                if($result) {
                    echo "<script type='text/javascript'>alert('Customization added')</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Failed to add customization')</script>";
                }
            } else if(isset($_POST['deleteItem'])) {
                $item_id = $_POST['item'];

                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                if(!$db) {
                    die("Cannot connect to database");
                }

                $sql = "DELETE FROM customization WHERE item_id='{$item_id}';";

                $result = mysqli_query($db, $sql);

                if($result) {
                    $sql = "DELETE FROM item WHERE id='{$item_id}';";
                    $result = mysqli_query($db, $sql);
                    if($result) {
                        echo "<script type='text/javascript'>alert('Item deleted')</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('Failed to delete item. Customizations deleted')</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Failed to delete relevant customizations')</script>";
                }
            } else if(isset($_POST['deleteCustomization'])) {
                $customization = $_POST['customization'];

                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                if(!$db) {
                    die("Cannot connect to database");
                }

                $sql = "DELETE FROM customization WHERE id='{$customization}';";

                $result = mysqli_query($db, $sql);

                if($result) {
                    echo "<script type='text/javascript'>alert('Customization deleted')</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Failed to delete customization')</script>";
                }
            } else if(isset($_POST['addUser'])) {
                $name = $_POST['addUserName'];
                $password = $_POST['addUserPassword'];

                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                if(!$db) {
                    die("Cannot connect to database");
                }

                $sql = "INSERT INTO admin_user (username, password) VALUES ('{$name}', '{$password}');";

                $result = mysqli_query($db, $sql);

                if($result) {
                    echo "<script type='text/javascript'>alert('User added')</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Failed to add user')</script>";
                }
            } else if(isset($_POST['addRider'])) {
                $username = $_POST['addRiderUsername'];
                $password = $_POST['addRiderPassword'];
                $name = $_POST['addRiderName'];

                $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                if(!$db) {
                    die("Cannot connect to database");
                }

                $sql = "INSERT INTO rider (username, password, name) VALUES ('{$username}', '{$password}', '{$name}');";

                $result = mysqli_query($db, $sql);

                if($result) {
                    echo "<script type='text/javascript'>alert('Rider added')</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Failed to add rider')</script>";
                }
            }
        ?>

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

        <div class="signInContainer">
            <div class="signInWrapper">
                <div>
                    <h1 style="font-family: 'Laila', serif; text-align: center;">Admin Area</h1>
                </div>
            </div>

            <div class="adminAreaContainer">
                <div class="adminAreaContainerItem">
                    <h4>Orders</h4>
                    <table>
                        <tr>
                            <td><button onclick="window.location.href='./orders.php'" class="secondaryButton">Manage Orders</button></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="adminAreaContainerItem">
                    <h4>Add Item</h4>
                    <form action="./dash.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" id="addItemName" name="addItemName" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><input type="text" id="addItemPrice" name="addItemPrice" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td><input type="file" id="addItemImage" name="addItemImage" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td>Deal</td>
                                <td>
                                    <select name="deal" id="deal">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="defaultButton" name="addItem" value="Add" onclick="addItemValidation()">Add Item</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="adminAreaContainerItem">
                    <h4>Add Customization</h4>
                    <form action="./dash.php" method="post">
                        <table>
                            <tr>
                                <td>Item</td>
                                <td>
                                    <select name="item" id="item">
                                        <?php
                                            $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                                            if(!$db) {
                                                die("Cannot connect to database");
                                            }

                                            $sql = "SELECT * FROM item;";

                                            $result = mysqli_query($db, $sql);

                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" id="addCustomizationName" name="addCustomizationName" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><input type="text" id="addCustomizationPrice" name="addCustomizationPrice" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="defaultButton" name="addCustomization" value="Add" onclick="addCustomizationValidation()">Add Customization</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="adminAreaContainerItem">
                    <h4>Remove Item</h4>
                    <form action="./dash.php" method="post">
                        <table>
                            <tr>
                                <td>Item</td>
                                <td>
                                    <select name="item" id="item">
                                        <?php
                                            $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                                            if(!$db) {
                                                die("Cannot connect to database");
                                            }

                                            $sql = "SELECT * FROM item;";

                                            $result = mysqli_query($db, $sql);

                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="defaultButton" name="deleteItem" value="Add">Delete Item</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="adminAreaContainerItem">
                    <h4>Remove Customimzation</h4>
                    <form action="./dash.php" method="post">
                        <table>
                            <tr>
                                <td>Customization</td>
                                <td>
                                    <select name="customization" id="customization">
                                        <?php
                                            $db = mysqli_connect(DB_IP, DB_USER, DB_PASSWORD, DB_NAME);

                                            if(!$db) {
                                                die("Cannot connect to database");
                                            }

                                            $sql = "SELECT C.name as c_name, C.id as c_id, I.name as i_name FROM customization C LEFT JOIN item I ON I.id = C.item_id;";

                                            $result = mysqli_query($db, $sql);

                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['c_id']}'>{$row['i_name']}&mdash;{$row['c_name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="defaultButton" name="deleteCustomization" value="Add">Delete Customization</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="adminAreaContainerItem">
                    <h4>Add User</h4>
                    <form action="./dash.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Username</td>
                                <td><input type="text" id="addUserName" name="addUserName" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="password" id="addUserPassword" name="addUserPassword" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="defaultButton" name="addUser" value="Add" onclick="addUserValidation()">Add User</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="adminAreaContainerItem">
                    <h4>Add Rider</h4>
                    <form action="./dash.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Username</td>
                                <td><input type="text" id="addRiderUsername" name="addRiderUsername" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="password" id="addRiderPassword" name="addRiderPassword" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" id="addRiderName" name="addRiderName" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="defaultButton" name="addRider" value="Add" onclick="addRiderValidation()">Add Rider</button></td>
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
