<?php  
$host = "127.0.0.1";
$dbname = "8bcamp";
$username = "root";
$password = "";


try {
	$pdo = new PDO (
		"mysql:host=$host;dbname=$dbname;charset=utf8mb4",
		$username,
		$password
	);

	$pdo ->setAttribute(
		PDO::ATTR_ERRMODE,
		PDO::ERRMODE_EXCEPTION
	);

	echo "nyambung bro";
} catch (Exception $e) {
	echo "pedot ki, piye jal : " . $e->getMessage();
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP</title>
</head>
<body>
<h1>Connection</h1>
</body>
</html>