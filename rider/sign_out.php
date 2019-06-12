<?php

session_start();
unset($_SESSION['riderUsername']);
unset($_SESSION['riderId']);
header('Location: ./index.php');
