<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>KFC Chicken, Burgers and Rice - Checkout Delicious Menu and Order Online</title>
        <link rel="icon" href="./img/favicon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/index.css">
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

        <div class="slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100"src ="./img/slider_image_2.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="./img/slider_image_2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="./img/slider_image_3.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="./img/slider_image_4.jpg" alt="Fourth slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>

        <div class="dealsTitle">
            <div style="padding-top: 20px;">
                <h1 style="font-family: 'Laila', serif;">DEALS</h1>
            </div>
        </div>

        <div class="dealsItems">

            <div class="dealsItem">
                <div>
                    <a href="#"><img style="width: 276px; border-radius: 10px;" src="./img/deal-double-down-combo.png" alt="Double Down Combo"></a>
                </div>
                <div class="dealsItemDetails" style="padding-top: 10px">
                    <div>Double Down Combo &bull; RS. 1100</div>
                    <div class="addToCart"><button style="float: right;">Add to cart</button></div>
                </div>
            </div>

            <div class="dealsItem">
                <div>
                    <a href="#"><img style="width: 276px; border-radius: 10px;" src="./img/deal-kfc-favorites.png"></a>
                </div>
                <div class="dealsItemDetails" style="padding-top: 10px">
                    <div>KFC Favorites &bull; RS. 950</div>
                    <div class="addToCart"><button style="float: right;">Add to cart</button></div>
                </div>
            </div>

            <div class="dealsItem">
                <div>
                    <a href="#"><img style="width: 276px; border-radius: 10px;" src="./img/deal-wednesday-strips-bucket.png"></a>
                </div>
                <div class="dealsItemDetails" style="padding-top: 10px">
                    <div>Wednesday Strips Bucket &bull; RS. 900</div>
                    <div class="addToCart"><button style="float: right;">Add to cart</button></div>
                </div>
            </div>

            <div class="dealsItem">
                <div>
                    <a href="#"><img style="width: 276px; border-radius: 10px;" src="./img/deal-smoky-grilled.png"></a>
                </div>
                <div class="dealsItemDetails" style="padding-top: 10px">
                    <div>Smoky Grilled &bull; RS. 1350</div>
                    <div class="addToCart"><button style="float: right;">Add to cart</button></div>
                </div>
            </div>

            <div class="dealsItem">
                <div>
                    <a href="#"><img style="width: 276px; border-radius: 10px;" src="./img/deal-zinger-doubles.png"></a>
                </div>
                <div class="dealsItemDetails" style="padding-top: 10px">
                    <div>Zinger Doubles &bull; RS. 550</div>
                    <div class="addToCart"><button style="float: right;">Add to cart</button></div>
                </div>
            </div>

            <div class="dealsItem">
                <div>
                    <a href="#"><img style="width: 276px; border-radius: 10px;" src="./img/deal-ultimate-savings-bucket.png"></a>
                </div>
                <div class="dealsItemDetails" style="padding-top: 10px">
                    <div>Ultimate Savings Bucket &bull; RS. 1500</div>
                    <div class="addToCart"><button style="float: right;">Add to cart</button></div>
                </div>
            </div>

            <div class="dealsItem">
                <div>
                    <a href="#"><img style="width: 276px; border-radius: 10px;" src="./img/deal-big-8.png"></a>
                </div>
                <div class="dealsItemDetails" style="padding-top: 10px">
                    <div>Big 8 &bull; RS. 1200</div>
                    <div class="addToCart"><button style="float: right;">Add to cart</button></div>
                </div>
            </div>

            <div class="dealsItem">
                <div>
                    <a href="#"><img style="width: 276px; border-radius: 10px;" src="./img/deal-kfc-44.png"></a>
                </div>
                <div class="dealsItemDetails" style="padding-top: 10px">
                    <div>KFC 44 &bull; RS. 960</div>
                    <div class="addToCart"><button style="float: right;">Add to cart</button></div>
                </div>
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
