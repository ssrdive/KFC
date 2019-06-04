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
        <link rel="stylesheet" href="../css/signIn.css">
        <link rel="stylesheet" href="../css/dash.css">
        <script type="text/javascript">
            function addItem() {
                var name = document.getElementById('addItemName').value;
                var price = document.getElementById('addItemPrice').value;
                var image = document.getElementById('addItemImage').value;

                if(name == '' || price == '' || image == '' || isNaN(price)) {
                    event.preventDefault();
                    alert('Please enter all the details');
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
                <img style="width: 80px" src="../img/logo.png">
            </div>
            <div class="topSideBar">
                <div>
                    <a href="#">Hello <?php echo "{$_SESSION['adminUsername']}"; ?></a>&nbsp;&nbsp;&bull;&nbsp;
                    <a href="./signout.php">Sign out</a>
                </div>
            </div>
        </div>

        <div class="menuBar">
            <div class="topnav">
                <div class="menuBarContent">
                    <div>
                        <a class="active" href="#home">DEALS</a>
                        <a href="#about">MENU</a>
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
                    <h4>Add Item</h4>
                    <form action="./addItem.php" method="post" enctype="multipart/form-data">
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
                                <td><button type="submit" class="defaultButton" name="add" value="Add" onclick="addItem()">Add</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="adminAreaContainerItem">
                    <h4>Add Customization</h4>
                    <form action="./addCustomization.php" method="post">
                        <table>
                            <tr>
                                <td>Item</td>
                                <td>
                                    <select name="item" id="item">
                                        
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><td><input type="text" id="addCustomizationName" name="addCustomizationName" class="signInInput"></td></td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><td><input type="text" id="addCustomizationPrice" name="addCustomizationPrice" class="signInInput"></td></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="adminAreaContainerItem">
                    <h4>Remove Item</h4>
                </div>
                <div class="adminAreaContainerItem">
                    <h4>Remove Customimzation</h4>
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
