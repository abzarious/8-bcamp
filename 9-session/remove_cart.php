<?php

session_start();


$id = $_GET['id'] ?? null;



if($id && isset($_SESSION['cart'][$id])) {

    unset($_SESSION['cart'][$id]);
}



if(isset($_SESSION['cart']) && empty($_SESSION['cart'])) {

    unset($_SESSION['cart']);
}



header("Location: cart.php");
exit;