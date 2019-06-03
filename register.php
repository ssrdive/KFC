<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>KFC Chicken, Burgers and Rice - Checkout Delicious Menu and Order Online</title>
        <link rel="icon" href="./img/favicon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/layout.css">
        <link rel="stylesheet" href="./css/register.css">
        <script type="text/javascript">
            function registerClicked() {
                var firstName = document.getElementById('firstName').value;
                var lastName = document.getElementById('lastName').value;
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('confirmPassword').value;

                if(firstName == '' || lastName == '' ||
                    email == '' || password == '' ||
                    confirmPassword == '') {
                        event.preventDefault();
                        alert('Please make sure all fields are filled');
                } else if(!(password === confirmPassword)) {
                    event.preventDefault();
                    alert('Passwords do not match');
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
                    <a href="/signIn.php">Sign in</a>&nbsp;&nbsp;&bull;&nbsp;
                    <a href="/register.php">Register</a>&nbsp;&nbsp;&bull;&nbsp;
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

        <div class="signInContainer">
            <div class="signInWrapper">
                <div>
                    <h1 style="font-family: 'Laila', serif; text-align: center;">Join KFC Online!</h1>
                    <form action="/register.php" method="post">
                        <table>
                            <tr>
                                <td style="font-family: 'Laila', serif;">First Name</td>
                                <td><input type="text" id="firstName" placeholder="First Name" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Last Name</td>
                                <td><input type="text" id="lastName" placeholder="Last Name" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Email</td>
                                <td><input type="text" id="email" placeholder="Email" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Pasword&nbsp;&nbsp;</td>
                                <td><input type="password" id="password" placeholder="Password" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Laila', serif;">Confirm Password&nbsp;&nbsp;</td>
                                <td><input type="password" id="confirmPassword" placeholder="Confirm Password" class="signInInput"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="float: right;">
                                    <button type="submit" class="defaultButton" name="" value="Sign in" onclick="registerClicked()">Register</button>
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
