<div class="offcanvas offcanvas-start custom-sidebar" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="true" data-bs-scroll="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-block" id="offcanvas">Menú</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
            <li class="nav-item">
                <a href="home.php" class="btn btn-outline-primary nav-link">
                    <i class="fs-5 bi-house"></i><span class="ms-1 d-inline">Home</span>
                </a>
            </li>
            <li>
                <a href="dashboard.php" class="btn btn-outline-primary nav-link">
                    <i class="fs-5 bi-list-ul"></i><span class="ms-1 d-inline">Lista de productos</span>
                </a>
            </li>
            <li>
                <a href="category.php" class="btn btn-outline-primary nav-link">
                    <i class="fs-5 bi-table"></i><span class="ms-1 d-inline">Categorias</span>
                </a>
            </li>
            <li>
                <a href="brand.php" class="btn btn-outline-primary nav-link">
                    <i class="fs-5 bi-grid"></i><span class="ms-1 d-inline">Marcas</span>
                </a>
            </li>
            <?php if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN'] == 1): ?>
                        <li>
                            <a href="userControl.php" class="btn btn-outline-primary nav-link">
                                <i class="fs-5 bi-people"></i><span class="ms-1 d-inline">Control de usuarios</span>
                            </a>
                        </li>
            <?php endif; ?>

            <li class="nav-item mt-3">
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" id="darkModeSwitch" checked>
                    <label class="form-check-label" for="darkModeSwitch">
                        <i class="bi bi-moon"></i>
                    </label>
                </div>
            </li>
        </ul>
    </div>
</div>

<nav class="navbar bg-body-secondary sticky-top navbar-expand-lg border-bottom"> <!--NAVBAR-->
    <div class="container-fluid">
        <button class="btn btn-outline-secondary float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
            <i class="bi bi-list"></i>
        </button>
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="img/logo.jpeg" alt="Bootstrap" height="28" class="me-2">
        </a>
        <a href="#" class="nav-link dropdown-toggle" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person"><?php echo explode(" ", $_SESSION['userName'])[0]; ?></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="../controllers/Users.php?q=logout">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>