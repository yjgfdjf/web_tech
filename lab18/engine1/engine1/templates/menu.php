<?php
function generateMenu($items, $isSubmenu = false) {
    $ulClass = $isSubmenu ? 'ml-4 list-disc' : 'flex space-x-4';
    $output = "<ul class='$ulClass'>";
    foreach ($items as $item) {
        $output .= "<li>";
        $output .= "<a href='{$item['link']}' class='text-blue-600 hover:underline'>{$item['title']}</a>";
        if (isset($item['submenu'])) {
            $output .= generateMenu($item['submenu'], true);
        }
        $output .= "</li>";
    }
    $output .= "</ul>";
    return $output;
}
?>
<?php echo generateMenu($menus); ?>