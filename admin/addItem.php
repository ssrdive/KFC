<?php

    include '../database.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

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
        header('Location: ./index.php?message=Item+added');
    } else {
        header('Location: ./index.php?message=Failed+to+add+item');
    }


?>
