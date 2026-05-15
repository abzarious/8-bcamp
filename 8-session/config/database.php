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

	$success = "Alhamdulillah nyambung database";

	echo "<script>alert(" . json_encode($success) . ");</script>";
} catch (Exception $e) {
	$err_message = "pedot ki, piye jal : " . $e->getMessage();

    echo "<script>alert(" . json_encode($err_message) . ");</script>";
}


?>