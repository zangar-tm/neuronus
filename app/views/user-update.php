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
    <h1>Update <?= $data[0]['id']?></h1>
    <form method="POST" class="mb-3" action="/users/<?= $data[0]['id']?>/update">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= $data[0]['username']?>">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Update User</button>
    </form>
</div>
</body>
</html>
