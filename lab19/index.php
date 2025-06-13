<?php
require_once 'functions.php';
logRequest(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $error = uploadImage($_FILES['image'], 'uploads/', 'thumbnails/');
    if ($error === true) {
        header('Location: index.php'); 
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея фотографий</title>
    <style>
        .gallery { display: flex; flex-wrap: wrap; gap: 10px; }
        .gallery img { width: 200px; height: auto; }
        .form { margin: 20px 0; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Галерея фотографий</h1>
    <div class="form">
        <form method="post" enctype="multipart/form-data">
            <label>Загрузить изображение (jpg, jpeg, png, до 5 МБ):</label><br>
            <input type="file" name="image" accept="image/jpeg,image/png" required><br><br>
            <button type="submit">Загрузить</button>
        </form>
        <?php if (isset($error) && is_string($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
    <div class="gallery">
        <?php echo buildGallery('thumbnails/', 'uploads/'); ?>
    </div>
</body>
</html>
