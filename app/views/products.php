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
    <h1>Manage Products</h1>
    <form method="POST" class="mb-3" action="/products">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control">
        </div>
        <button type="submit" name="create" class="btn btn-primary">Add Product</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td>
                        <form method="POST" style="display:inline-block;" action="/products/delete">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
