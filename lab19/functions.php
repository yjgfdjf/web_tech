<?php
function buildGallery($thumbnailDir, $originalDir) {
    $output = '';
    if (!is_dir($thumbnailDir)) {
        return '<p>Папка с миниатюрами не найдена.</p>';
    }
    $files = scandir($thumbnailDir);
    foreach ($files as $file) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png']) && is_file("$thumbnailDir/$file")) {
            $output .= "<a href='$originalDir$file' target='_blank'>";
            $output .= "<img src='$thumbnailDir$file' alt='$file'>";
            $output .= "</a>";
        }
    }
    return $output ?: '<p>Изображения не найдены.</p>';
}

function uploadImage($file, $originalDir, $thumbnailDir) {
    if (!is_dir($originalDir) && !mkdir($originalDir, 0777, true)) {
        return 'Не удалось создать папку для оригиналов.';
    }
    if (!is_dir($thumbnailDir) && !mkdir($thumbnailDir, 0777, true)) {
        return 'Не удалось создать папку для миниатюр.';
    }

    if ($file['size'] > 5 * 1024 * 1024) {
        return 'Файл слишком большой (максимум 5 МБ).';
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
        return 'Недопустимый формат файла (только jpg, jpeg, png).';
    }

    $filename = uniqid() . '.' . $ext;
    $originalPath = $originalDir . $filename;
    $thumbnailPath = $thumbnailDir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $originalPath)) {
        return 'Ошибка при загрузке файла.';
    }

    try {
        $image = match ($ext) {
            'jpg', 'jpeg' => imagecreatefromjpeg($originalPath),
            'png' => imagecreatefrompng($originalPath),
            default => throw new Exception('Неподдерживаемый формат.'),
        };

        list($width, $height) = getimagesize($originalPath);
        if ($width > 1000) {
            $newWidth = 1000;
            $newHeight = (int)($height * ($newWidth / $width));
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            match ($ext) {
                'jpg', 'jpeg' => imagejpeg($resized, $originalPath, 90),
                'png' => imagepng($resized, $originalPath, 9),
            };
            imagedestroy($resized);
        }

        $thumbWidth = 200;
        $thumbHeight = (int)($height * ($thumbWidth / $width));
        $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($thumb, $image, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
        match ($ext) {
            'jpg', 'jpeg' => imagejpeg($thumb, $thumbnailPath, 90),
            'png' => imagepng($thumb, $thumbnailPath, 9),
        };

        imagedestroy($image);
        imagedestroy($thumb);
        return true;
    } catch (Exception $e) {
        unlink($originalPath);
        return 'Ошибка при обработке изображения: ' . $e->getMessage();
    }
}

function logRequest() {
    $logDir = 'logs/';
    $logFile = $logDir . 'log.txt';
    if (!is_dir($logDir) && !mkdir($logDir, 0777, true)) {
        return;
    }

    $lines = file_exists($logFile) ? count(file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)) : 0;

    if ($lines >= 10) {
        $archiveIndex = 0;
        while (file_exists($logDir . "log$archiveIndex.txt")) {
            $archiveIndex++;
        }
        rename($logFile, $logDir . "log$archiveIndex.txt");
    }

    $time = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$time] Request to index.php\n", FILE_APPEND | LOCK_EX);
}
?>