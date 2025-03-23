<?php
$current_page = basename($_SERVER['PHP_SELF']);

function generateSidebar($current_page) {
    $pages = [
        'home.php' => 'Inicio',
        'dashboard.php' => 'Lista de Productos',
        'userControl.php' => 'Usuarios',
        '../controllers/Users.php?q=logout' => 'Cerrar Sesión'
    ];

    echo '<div class="sidebar">';
    echo '<span class="closeSidebarButton">&times;</span>';
    echo '<ul>';
    foreach ($pages as $file => $name) {
        if ($file === $current_page) {
            echo "<li><a href='$file' class='active'>$name</a></li>";
        }else {
            echo "<li><a href='$file'>$name</a></li>";
        }
    }
    echo '</ul>';
    echo '</div>';
    echo '<button class="toggle" tabindex="0" aria-label="Abrir Sidebar">&#9776;</button>'; // Botón toggle
}
?>