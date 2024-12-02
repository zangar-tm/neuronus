<?php
$name = $_SESSION['user']['username']??'';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <span style="display:block; text-align:right;"><?= $name?></span>
    <a style="display:block; text-align:right;" href="/logout">Выйти</a>
    <h1>Manage Users</h1>
    <form method="POST" class="mb-3" action="/users">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
            </select>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Add User</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['username'] ?></td>
                    <td><?= $item['role'] ?></td>
                    <td>
                        <?php if ($_SESSION['user']['id'] != $item['id']) {?>
                        <form method="POST" style="display:inline-block;" action="/users/<?=$item['id']?>/delete">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                        <?php }; ?>
                        <a href="/users/<?=$item['id']?>" type="button" class="btn btn-primary">Update</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
