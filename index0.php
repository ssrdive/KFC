<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php

        class Cart {
            public $name = "Shamal";
        }

        if(isset($_POST['create'])) {
            setcookie("cart", json_encode(new Cart()));
        }

        ?>

        <form class="" action="./index.php" method="post">
            <input type="submit" name="create" value="Create">
        </form>
    </body>
</html>
