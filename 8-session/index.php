<?php
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

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="bg-light">

    <div class="container py-5">
        <h2 class="mb-4">Daftar Produk</h2>

        <div class="row g-3 mb-4">
            <!-- Kolom Cari -->
            <div class="col-md-6">
                <input type="text" id="inputCari" class="form-control" placeholder="Cari nama produk...">
            </div>
            <!-- Kolom Filter -->
            <div class="col-md-6">
              <form method="GET">
                <select name="category_id" id="pilihKategori" class="form-select">
                    <option value="Semua">Semua Kategori</option>
                    <?php foreach ($categories as $category): ?>
			            <option value="<?= $category['id']; ?>" >
			                <?= $category['name']; ?>
			            </option>

        			<?php endforeach; ?>
                </select>
                <button type="submit">
			        Filter
			    </button>
              </form>
            </div>
        </div>

        
        <div class="row row-cols-1 row-cols-md-3 g-4" id="tempatProduk">
        <?php foreach ($products as $product) : ?>
        	<div class="col">
                <div class="card shadow-sm">
                    <div class="bungkus-gambar">
                        <img src="img/<?= $product['image'];  ?>" alt="<?= $product['product_name'];  ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['product_name'];  ?></h5>
                        <p class="text-muted small">
                        	<?php 
                        		if ( $product['category_id'] == 1) {
                        			echo "Electronics";
                        		} else if ($product['category_id'] == 2) {
                        			echo "Home Living";
                        		} else {
                        			echo "Apparel";
                        		}
                        	?>
                        </p>
                        <p class="card-text"><?= $product['description'];  ?></p>
                        <h6 class="text-primary">Harga: <?= $product['price'];  ?></h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>