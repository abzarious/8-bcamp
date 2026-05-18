<?php

session_start();

require 'config/database.php';


$id = $_GET['id'] ?? null;

if(!$id) {

    header("Location: index.php");
    exit;
}



$query = "SELECT * FROM products WHERE id = ?";

$stmt = $pdo->prepare($query);

$stmt->execute([$id]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);


if(!$product) {

    header("Location: index.php");
    exit;
}



if(!isset($_SESSION['cart'])) {

    $_SESSION['cart'] = [];
}


if(isset($_SESSION['cart'][$id])) {

    $_SESSION['cart'][$id]['qty']++;

} else {

    $_SESSION['cart'][$id] = [

        'id' => $product['id'],
        'product_name' => $product['product_name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'qty' => 1

    ];
}


header("Location: index.php");
exit;