<?php
$name = $_SESSION['user']['username']??'';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <span style="display:block; text-align:right;"><?= $name?></span>
    <a style="display:block; text-align:right;" href="/logout">Выйти</a>
    <h1>Update <?= $data[0]['id'] ?></h1>
    <form method="POST" class="mb-3" action="/products/<?= $data[0]['id']?>/update">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= $data[0]['name']?>">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="<?= $data[0]['price']?>">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Product</button>
    </form>
</div>
</body>
</html>
