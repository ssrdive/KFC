<?php

session_start();
unset($_SESSION['customerUsername']);
unset($_SESSION['customerName']);
header('Location: ./index.php');
