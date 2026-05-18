<?php

session_start();

$cart = $_SESSION['cart'] ?? [];

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between mb-4">

        <h2>Shopping Cart</h2>

        <a href="index.php" class="btn btn-secondary">
            Kembali Belanja
        </a>

    </div>

    <?php if(count($cart) > 0) : ?>

        <div class="table-responsive">

            <table class="table table-bordered bg-white">

                <thead class="table-dark">

                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach($cart as $item) : ?>

                        <?php
                            $subtotal = $item['price'] * $item['qty'];
                            $total += $subtotal;
                        ?>

                        <tr>

                            <td width="120">

                                <img
                                    src="img/<?= $item['image']; ?>"
                                    width="80"
                                    class="img-thumbnail"
                                >

                            </td>

                            <td>
                                <?= $item['product_name']; ?>
                            </td>

                            <td>
                                Rp <?= number_format($item['price']); ?>
                            </td>

                            <td>
                                <?= $item['qty']; ?>
                            </td>

                            <td>
                                Rp <?= number_format($subtotal); ?>
                            </td>

                            <td>

                                <a
                                    href="remove_cart.php?id=<?= $item['id']; ?>"
                                    class="btn btn-danger btn-sm"
                                >
                                    Remove
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

                <tfoot>

                    <tr>

                        <td colspan="4" class="text-end fw-bold">
                            Total
                        </td>

                        <td colspan="2" class="fw-bold text-primary">

                            Rp <?= number_format($total); ?>

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

    <?php else : ?>

        <div class="alert alert-warning">

            Keranjang masih kosong.

        </div>

    <?php endif; ?>

</div>

</body>
</html>