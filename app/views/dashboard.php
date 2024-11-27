<?php
$name = $_SESSION['user']['username']??'';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container mt-5">
    <span style="display:block; text-align:right;"><?= $name?></span>
    <a style="display:block; text-align:right;" href="/logout">Выйти</a>
    <h1>Product Statistics</h1>
    <canvas id="productChart" width="400" height="200"></canvas>
</div>
<script>
    const ctx = document.getElementById('productChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode(array_column($data, 'name')) ?>,
            datasets: [{
                label: 'Products Price',
                data: <?= json_encode(array_column($data, 'price')) ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false,
            }]
        }
    });
</script>
</body>
</html>
