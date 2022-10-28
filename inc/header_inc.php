<div class="container-fluid mt-3 header-content">
    <header class="d-flex justify-content-between">
        <div class="logo">
            <a href="<?= URL ?>index.php">
                <img src="./img/netflix_logo.png" alt="Netflix Logo">
            </a>
        </div>
        <?php if (userConnected()) : ?>
            <ul class="navbar-nav flex-row d-flex justify-content-end">
            <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>authentication.php?action=logout">Logout</a>
                </li>
            </ul>
            <?php else : ?>
                <a class="auth-btn" href="<?= URL ?>authentication.php">Sign in</a>
            <?php endif ?>
    </header>
</div>