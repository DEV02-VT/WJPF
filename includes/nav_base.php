<!--<nav class="navbar navbar-expand-lg navbar-light">
    <div class="mx-auto my-2 order-0 order-md-1 position-relative">
        <a class="navbar-brand"><img src="img/logo.png" height="70" class="d-inline-block align-top brand_image" alt=""></a>
    </div>
    <div class="navbar-collapse collapse w-100 dual-collapse2 order-1 order-md-0">
        <ul class="navbar-nav ms-auto text-center">
            <li class="nav-item"><a class="nav-link" href="index.php">Startseite</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php">Startseite</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php">Startseite</a></li>
        </ul>
    </div>
    <div class="mx-auto my-2 order-0 order-md-1 position-relative">
        <button class="navbar-toggler mt-3" type="button" data-bs-toggle="collapse" data-bs-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>-->

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php#"><img src="img/logo_wjpf.png" height="70" class="d-inline-block align-top brand_image" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <!--<span class="navbar-toggler-icon"></span>--><img src="img/menu.png" class="d-inline-block align-top brand_image" alt="">
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php#members">Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#board">Board</a>
                </li>
<!--                <li class="nav-item">
                    <a class="nav-link" href="index.php#publications">Publications</a>
                </li>
                -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php#championships">Championships</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#contact">Contact</a>
                </li>
                <?php if (user_is_admin() || user_is_board_user()){ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarAdminDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">Administration</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarAdminDropdown">
                            <?php if (user_is_admin() || user_is_board_user()){ ?>
                                <li><a class="dropdown-item" href="admin_association.php">Associations</a></li>
                                <li><a class="dropdown-item" href="admin_user.php">User</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <?php if (logged_in()) {?>
                        <a class="" href="logout.php"><img src="img/logout.png" class="d-inline-block align-top login_logo" title="Logout" alt="Logout"></a>
                    <?php }else{ ?>
                        <a class="" href="login.php"><img src="img/login.png" class="d-inline-block align-top login_logo" title="Login" alt="Login"></a>
                    <?php }?>
                </li>
            </ul>
        </div>
    </div>
</nav>

