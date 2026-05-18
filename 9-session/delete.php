<?php

require 'config.php';

$id = $_GET['id'];



$query = "SELECT * FROM products WHERE id = :id";

$stmt = $pdo->prepare($query);

$stmt->execute([
    ':id' => $id
]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);



if($product['image']) {

    unlink('img/' . $product['image']);
}


$deleteQuery = "DELETE FROM products WHERE id = :id";

$deleteStmt = $pdo->prepare($deleteQuery);

$deleteStmt->execute([
    ':id' => $id
]);

header("Location: index.php");
exit;