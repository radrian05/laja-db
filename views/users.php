<?php
require_once '../models/User.php'; 

function generateTable() {
    $userModel = new User(); // Crear instancia del modelo
    $users = $userModel->getUsers(); // Obtener la lista de usuarios

    if ($users) { 
        foreach ($users as $user): ?>
            <tr id='<?php echo $user->userId; ?>'>
                <td><?php echo $user->userId; ?></td>
                <td><?php echo $user->userName; ?></td>
                <td><?php echo $user->userUid; ?></td>
                <td>********************************</td>
                <td><?php echo $user->IS_ADMIN ? 'Sí' : 'No'; ?></td>
                <td>
                    <button>Editar</button>
                    <button>Remover</button>
                </td>
            </tr>
        <?php endforeach;
    } else { ?>
        <tr>
            <td colspan="5">No se encontraron usuarios.</td>
        </tr>
    <?php }
}
?>