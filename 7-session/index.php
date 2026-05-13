<?php  

if ( isset($_POST['submit']) ) {
	if ( empty($_POST["product_name"] && $_POST["price"] && $_POST["desc"]) ) {
		$error = true;
	} else {
		$success = true;
	}
}


$products = [
	[
		"name" => "Macbook M4",
		"price" => 25000000,
		"desc" => "Laptop dengan spesifikasi kelas atas harga kelas menengah"
	],
	[
		"name" => "Uniqlo Pullover Hoodie Sweat",
		"price" => 600000,
		"desc" => "Hoodie Pullover super nyaman dan stylist"
	],
	[
		"name" => "Casio G-Shock GK34P",
		"price" => 2500000,
		"desc" => "Jam super tahan segala macam cuaca"
	]
];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>php</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<style>
		.box {
			width: 400px;
			height: 400px;
			margin: 50px auto;
			border: 1px solid darkgray;
			border-radius: 10px;
			box-sizing: border-box;
		}

		.error {
			color: red;
			text-align: center;
		}
	</style>
</head>
<body>

<?php if ( isset($error) ) : ?>
	<div class="alert alert-danger" role="alert">
	  Data produk belum lengkap!
	</div>
<?php endif; ?>

<?php if ( isset($success) ) : ?>
	<div class="alert alert-success" role="alert">
	  Data produk telah ditambahkan!
	</div>
<?php endif; ?>

<div class="container-sm">
  <div class="box">
	<form class="m-5" action="" method="post">
	  <div class="mb-3">
		  <label for="product_name" class="form-label">Product Name</label>
		  <input type="text" class="form-control" id="product_name" placeholder="Product Name" name="product_name" >
	  </div>
	  <div class="input-group mb-3">
		  <span class="input-group-text">Rp</span>
		  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="1500000" name="price" >
	  </div>
	  <div class="mb-3">
		  <label for="desc" class="form-label">Description</label>
		  <textarea class="form-control" id="desc" rows="3" name="desc" ></textarea>
	  </div>
	  <button type="submit" name="submit" class="btn btn-success">Submit</button>
	</form>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>