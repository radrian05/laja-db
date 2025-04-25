<?php
include_once '../helpers/session_helper.php';
if (isset($_SESSION['userId'])) {
    header("location: ../views/home.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?> <!-- Incluye Bootstrap y otros recursos -->
    <title>Inventario</title>
</head>

<body>
    <section class="vh-100" style="background-image: url('fondo.jpeg'); background-size: cover; background-position: center;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4">
                                <h2 class="fw-bold mb-2 text-uppercase">Inventario</h2>
                                <p class="text-white-50 mb-5">Por favor, ingresa tu usuario y contraseña</p>

                                <form method="post" action="../controllers/Users.php" aria-label="Iniciar Sesión">
                                    <input type="hidden" name="type" value="login">

                                    <div class="form-floating mb-4">
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Nombre de Usuario" required>
                                        <label for="name">Nombre de Usuario</label>
                                    </div>

                                    <div class="form-floating mb-4">
                                        <input type="password" id="userPwd" name="userPwd" class="form-control form-control-lg" placeholder="Contraseña" required>
                                        <label for="userPwd">Contraseña</label>
                                    </div>

                                    <?php flash('login') ?>

                                    <button type="submit" class="btn btn-outline-light btn-lg px-5">Iniciar Sesión</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>