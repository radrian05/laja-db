<?php
require_once '../controllers/users.php'; // Incluir el controlador de usuarios

function generateTable() {
    $usersController = new Users(); // Crear instancia del controlador
    $users = $usersController->getUsers(); // Obtener la lista de usuarios desde el controlador

    if ($users) { 
        foreach ($users as $user): ?>
            <tr id='<?php echo $user->userId; ?>'>
                <td><?php echo $user->userId; ?></td>
                <td><?php echo $user->userName; ?></td>
                <td><?php echo $user->userUid; ?></td>
                <td>********************************</td>
                <td><?php echo $user->IS_ADMIN ? 'Sí' : 'No'; ?></td>
                <td><?php echo $user->IS_ACTIVE ? 'Sí' : 'No'; ?></td>
                <td>
                    <?php if ($user->IS_ACTIVE): ?>
                        <button class="changePassword">Cambiar Contraseña</button>
                        <button class="disableUser" onclick="window.location.href = '../controllers/users.php?q=disableUser&id=<?php echo $user->userId; ?>'">Desactivar</button>
                    <?php else: ?>
                        <button class="enableUser" onclick="window.location.href = '../controllers/users.php?q=enableUser&id=<?php echo $user->userId; ?>'">Reactivar</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach;
    } else { ?>
        <tr>
            <td colspan="7">No se encontraron usuarios.</td>
        </tr>
    <?php }
}
?>