<?php
$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');

$query = "
    SELECT p.name AS product_name, p.price, c.name AS category_name, s.quantity
    FROM product p
    JOIN category c ON p.category_id = c.id
    JOIN stock s ON p.id = s.product_id
";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список товаров</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mb-5">
        <h1 class="mb-4">Товары в наличии</h1>
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>Категория</th>
                    <th>Остаток на складе</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td><?= number_format($row['price'], 2) ?> ₽</td>
                        <td><?= htmlspecialchars($row['category_name']) ?></td>
                        <td><?= $row['quantity'] ?> шт.</td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>