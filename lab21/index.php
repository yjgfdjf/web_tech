<?php
require_once 'functions.php';
$products = getProducts();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <style>
        .catalog { display: flex; flex-wrap: wrap; gap: 20px; }
        .product { border: 1px solid #ccc; padding: 10px; width: 200px; text-align: center; }
        .product img { max-width: 100%; height: auto; }
        .product a { text-decoration: none; color: #333; }
    </style>
</head>
<body>
    <h1>Каталог товаров</h1>
    <div class="catalog">
        <?php if (empty($products)): ?>
            <p>Товары не найдены.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <a href="product.php?id=<?php echo $product['id']; ?>">
                        <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p>Цена: <?php echo number_format($product['price'], 2); ?> руб.</p>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>