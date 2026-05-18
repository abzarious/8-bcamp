<?php

require 'config/database.php';


$id = $_GET['id'];



$productQuery = "SELECT * FROM products WHERE id = :id";

$productStmt = $pdo->prepare($productQuery);

$productStmt->execute([
    ':id' => $id
]);

$product = $productStmt->fetch(PDO::FETCH_ASSOC);



$categoryQuery = "SELECT * FROM categories";

$categoryStmt = $pdo->query($categoryQuery);

$categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['submit'])) {

    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    $imageName = $product['image'];

  
    if($_FILES['image']['name']) {

        

        if($product['image']) {

            unlink('img/' . $product['image']);
        }

        $imageName = time() . '-' . $_FILES['image']['name'];

        $tmpName = $_FILES['image']['tmp_name'];

        move_uploaded_file(
            $tmpName,
            'img/' . $imageName
        );
    }

   

    $query = "UPDATE products SET

                product_name = :product_name,
                image = :image,
                category_id = :category_id,
                price = :price,
                description = :description,
                stock = :stock

              WHERE id = :id";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        ':product_name' => $product_name,
        ':image' => $imageName,
        ':category_id' => $category_id,
        ':price' => $price,
        ':description' => $description,
        ':stock' => $stock,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">
            <h3>Edit Product</h3>
        </div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

             
                <div class="mb-3">

                    <label class="form-label">
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="product_name"
                        class="form-control"
                        value="<?= $product['product_name']; ?>"
                        required
                    >
                </div>

               
                <div class="mb-3">

                    <label class="form-label">
                        Product Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                    >

                    <div class="mt-2">

                        <?php if($product['image']) : ?>

                            <img
                                src="img/<?= $product['image']; ?>"
                                width="120"
                                class="img-thumbnail"
                            >

                        <?php endif; ?>

                    </div>
                </div>

           
                <div class="mb-3">

                    <label class="form-label">
                        Category
                    </label>

                    <select
                        name="category_id"
                        class="form-select"
                        required
                    >

                        <?php foreach($categories as $category) : ?>

                            <option
                                value="<?= $category['category_id']; ?>"

                                <?= $product['category_id'] == $category['category_id']
                                    ? 'selected'
                                    : '';
                                ?>
                            >

                                <?= $category['category_name']; ?>

                            </option>

                        <?php endforeach; ?>

                    </select>
                </div>

               
                <div class="mb-3">

                    <label class="form-label">
                        Price
                    </label>

                    <input
                        type="number"
                        name="price"
                        class="form-control"
                        value="<?= $product['price']; ?>"
                        required
                    >
                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                    ><?= $product['description']; ?></textarea>
                </div>

           
                <div class="mb-3">

                    <label class="form-label">
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        value="<?= $product['stock']; ?>"
                    >
                </div>

                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary"
                >
                    Update
                </button>

                <a href="index.php" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>