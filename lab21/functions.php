<?php
function getDbConnection() {
    $dsn = 'pgsql:host=localhost;port=5432;dbname=web_tech';
    $user = 'postgres';
    $password = 'P@ssw0rd';
    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die('Ошибка подключения к БД: ' . $e->getMessage());
    }
}

function getProducts() {
    $db = getDbConnection();
    $stmt = $db->query("SELECT id, name, image, price FROM products");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProduct($id) {
    $db = getDbConnection();
    $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getFeedback($product_id) {
    $db = getDbConnection();
    $stmt = $db->prepare("SELECT author, text, created_at FROM feedback WHERE product_id = :product_id ORDER BY created_at DESC");
    $stmt->execute(['product_id' => $product_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addFeedback($product_id, $author, $text) {
    $db = getDbConnection();
    $stmt = $db->prepare("INSERT INTO feedback (product_id, author, text) VALUES (:product_id, :author, :text)");
    return $stmt->execute([
        'product_id' => $product_id,
        'author' => $author,
        'text' => $text
    ]);
}

function uploadImage($file) {
    $uploadDir = 'images/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            return 'Не удалось создать папку для изображений.';
        }
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return 'Ошибка загрузки файла: ' . $file['error'];
    }
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
        return 'Недопустимый формат (только jpg, jpeg, png).';
    }
    $filename = uniqid() . '.' . $ext;
    $path = $uploadDir . $filename;
    if (move_uploaded_file($file['tmp_name'], $path)) {
        return $filename;
    }
    return 'Ошибка при сохранении файла.';
}
?>