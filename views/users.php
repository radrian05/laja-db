<?php
require_once '../controllers/users.php'; // Incluir el controlador de usuarios

function generateTable() {
    $usersController = new Users(); // Crear instancia del controlador
    $users = $usersController->getUsers(); // Obtener la lista de usuarios desde el controlador

    echo '<div class="table-responsive">'; // Contenedor responsivo de Bootstrap
    echo '<table class="table table-bordered align-middle">'; // Tabla con clases de Bootstrap
    echo '<thead class="table">';
    echo '<tr>';
    echo '<th scope="col">ID</th>';
    echo '<th scope="col">Nombre</th>';
    echo '<th scope="col">Nombre de usuario</th>';
    echo '<th scope="col">Contraseña</th>';
    echo '<th scope="col">Administrador</th>';
    echo '<th scope="col">Activo</th>';
    echo '<th scope="col">Acciones</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    if ($users) {
        foreach ($users as $user) {
            echo '<tr id="' . $user->userId . '">';
            echo '<td>' . htmlspecialchars($user->userId) . '</td>';
            echo '<td>' . htmlspecialchars($user->userName) . '</td>';
            echo '<td>' . htmlspecialchars($user->userUid) . '</td>';
            echo '<td>********************************</td>';
            echo '<td>' . ($user->IS_ADMIN ? 'Sí' : 'No') . '</td>';
            echo '<td>' . ($user->IS_ACTIVE ? 'Sí' : 'No') . '</td>';
            echo '<td class="d-flex gap-2">';
            if ($user->IS_ACTIVE) {
                echo '<button class="btn btn-warning btn-sm changePassword" data-bs-toggle="modal" data-bs-target="#changePasswordModal" data-id="' . $user->userId . '">Cambiar Contraseña</button>';
                echo '<button class="btn btn-danger btn-sm disableUser" onclick="window.location.href = \'../controllers/users.php?q=disableUser&id=' . $user->userId . '\'">Desactivar</button>';
            } else {
                echo '<button class="btn btn-success btn-sm enableUser" onclick="window.location.href = \'../controllers/users.php?q=enableUser&id=' . $user->userId . '\'">Reactivar</button>';
            }
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="7" class="text-center">No se encontraron usuarios.</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>