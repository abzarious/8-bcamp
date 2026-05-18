<?php
session_start();

require 'config/database.php';

// Filter Category

$categorySql = "SELECT * FROM categories";
$categoryStmt = $pdo->query($categorySql);
$categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

$categoryId = $_GET['category_id'] ?? '';

$sql = "
    SELECT *
    FROM products
    WHERE 1
";

$params = [];

if ($categoryId != '') {

    $sql .= " AND category_id = ?";

    $params[] = $categoryId;
}

// Cart

$totalCart = 0;

if(isset($_SESSION['cart'])) {

    foreach($_SESSION['cart'] as $item) {

        $totalCart += $item['qty'];
    }
}

// Read DB

$sql .= " ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (Opsional, untuk ikon di tombol filter) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="bg-light">

    <div class="container py-5">
	   	

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

            <h2 class="text-dark fw-bold mb-0">
                Daftar Produk
            </h2>

            <div class="d-flex gap-2">

                <a href="create.php" class="btn btn-primary">
                    Tambah Product
                </a>

                <a href="cart.php" class="btn btn-dark">

                    <i class="bi bi-cart-fill"></i>

                    Cart
                    (
                        <?= $totalCart; ?>
                    )

                </a>

            </div>

        </div>


	    <div class="row g-3 mb-5 align-items-end">
	        <!-- Kolom Cari -->
	        <div class="col-md-6">
	            <label for="inputCari" class="form-label fw-medium text-secondary">Cari Produk</label>
	            <input type="text" id="inputCari" class="form-control" placeholder="Cari nama produk..." style="height: 45px;">
	        </div>
	        
	        <!-- Kolom Filter Kategori -->
	        <div class="col-md-6">
	            <form method="GET" class="m-0">
	                <label for="pilihKategori" class="form-label fw-medium text-secondary">Pilih Kategori</label>
	                <div class="input-group">
	                    <select name="category_id" id="pilihKategori" class="form-select" style="height: 45px;">
	                        <option value="Semua">Semua Kategori</option>
	                        <?php foreach ($categories as $category): ?>
	                            <option value="<?= $category['category_id']; ?>">
	                                <?= $category['category_name']; ?>
	                            </option>
	                        <?php endforeach; ?>
	                    </select>
	                    <button type="submit" class="btn btn-primary px-4">
	                        <i class="bi bi-filter"></i> Filter
	                    </button>
	                </div>
	            </form>
	        </div>
	    </div>


        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="tempatProduk">
            <?php foreach ($products as $product) : ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <div class="bungkus-gambar overflow-hidden bg-white text-center">
                            <img src="img/<?= $product['image']; ?>" class="img-fluid card-img-top" alt="<?= $product['product_name']; ?>">
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title h6 fw-bold mb-1"><?= $product['product_name']; ?></h5>
                            
                         
                            <p class="text-muted small mb-2 text-uppercase tracking-wider" style="font-size: 0.75rem;">
                                <?php 
                                    if ($product['category_id'] == 1) {
                                        echo "Electronics";
                                    } else if ($product['category_id'] == 2) {
                                        echo "Home Living";
                                    } else {
                                        echo "Apparel";
                                    }
                                ?>
                            </p>
                            
                            <p class="card-text text-secondary small flex-grow-1">
                                <?= $product['description']; ?>
                            </p>
                            
                            <h6 class="text-primary fw-bold mt-3 mb-0">
                                Rp <?= number_format($product['price'], 0, ',', '.'); ?>
                            </h6>
                            <!-- Action Button -->

                            <div class="product-action d-none mt-3">
                                <a
                                    href="add_to_cart.php?id=<?= $product['id']; ?>"
                                    class="btn btn-primary btn-sm"
                                >
                                    Add To Cart
                                </a>
                                <a
                                    href="update.php?id=<?= $product['id']; ?>"
                                    class="btn btn-warning btn-sm"
                                >
                                    Update
                                </a>
                                <a
                                    href="delete.php?id=<?= $product['id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus product ini?')"
                                >
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    

    <script src="js/script.js"></script>
    <script>
        const productCards = document.querySelectorAll('.product-card');

        productCards.forEach(card => {

            card.addEventListener('click', function() {

                const action = this.querySelector('.product-action');

                action.classList.toggle('d-none');

            });

        });

        const actionButtons = document.querySelectorAll('.product-action a');

        actionButtons.forEach(button => {

            button.addEventListener('click', function(event) {

                event.stopPropagation();

            });

        });
    </script>
</body>
</html>