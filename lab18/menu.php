<?php
require_once 'data.php';
require_once 'functions.php';
?>
<nav class="bg-gray-800 p-4">
    <div class="container mx-auto">
        <?php echo generateMenu($menuItems); ?>
    </div>
</nav>