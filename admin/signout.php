<?php

session_start();
unset($_SESSION['adminUsername']);
header('Location: ./index.php');
