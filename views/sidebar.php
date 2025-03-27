<?php
$current_page = basename($_SERVER['PHP_SELF']);

function generateSidebar($current_page) {
    $pages = [
        'home.php' => 'Inicio',
        'dashboard.php' => 'Lista de Productos',
        'category.php' => 'Categorías',
        'userControl.php' => 'Usuarios',
        '../controllers/Users.php?q=logout' => 'Cerrar Sesión'
    ];

    echo '<div class="sidebar" role="navigation" aria-label="Barra lateral">';
    echo '<span class="closeSidebarButton" role="button" aria-label="Cerrar barra lateral">&times;</span>';
    echo '<ul>';
    foreach ($pages as $file => $name) {
        if ($file === $current_page) {
            echo "<li><a href='$file' class='active' aria-current='page'>$name</a></li>";
        } else {
            echo "<li><a href='$file'>$name</a></li>";
        }
    }
    echo '</ul>';
    echo '</div>';
    echo '<button class="toggle" aria-label="Abrir barra lateral">&#9776;</button>'; // Botón toggle
}
?>