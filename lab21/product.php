<?php
require_once 'functions.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$product = getProduct($_GET['id']);
if (!$product) {
    header('Location: index.php');
    exit;
}
$feedback = getFeedback($product['id']);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author'], $_POST['text'])) {
    $author = trim($_POST['author']);
    $text = trim($_POST['text']);
    if (empty($author) || empty($text)) {
        $error = 'Заполните все поля.';
    } else {
        addFeedback($product['id'], $author, $text);
        header('Location: product.php?id=' . $product['id']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <style>
        .product { max-width: 600px; margin: 0 auto; text-align: center; }
        .product img { max-width: 100%; height: auto; }
        .feedback { border-top: 1px solid #ccc; margin-top: 20px; }
        .feedback-item { border-bottom: 1px solid #eee; padding: 10px 0; }
        .form { margin: 20px 0; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="product">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <p>Цена: <?php echo number_format($product['price'], 2); ?> руб.</p>
        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
        <a href="index.php">Назад в каталог</a>
    </div>
    <div class="feedback">
        <h2>Отзывы</h2>
        <div class="form">
            <form method="post">
                <label>Ваше имя:</label><br>
                <input type="text" name="author" required><br>
                <label>Отзыв:</label><br>
                <textarea name="text" required></textarea><br>
                <button type="submit">Отправить</button>
                <?php if ($error): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>
            </form>
        </div>
        <?php if (empty($feedback)): ?>
            <p>Отзывов пока нет.</p>
        <?php else: ?>
            <?php foreach ($feedback as $item): ?>
                <div class="feedback-item">
                    <p><strong><?php echo htmlspecialchars($item['author']); ?></strong> (<?php echo $item['created_at']; ?>)</p>
                    <p><?php echo nl2br(htmlspecialchars($item['text'])); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>