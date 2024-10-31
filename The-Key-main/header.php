<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/key-white.png" type="image/x-icon">
    <title>Key Sec</title>
</head>
<body>
    <header class="header" id="header">
        <nav class="nav">
            <div class="nav-menu">
                <ul class="nav-list">
                    <li class="nav-item"><a href="service.php" class="nav-link" id="1">Services</a></li>
                    <li class="nav-item"><a href="public.php" class="nav-link" id="2">Publications</a></li>
                    <a href="index.php" class="nav-logo" id="3">
                        <img src="img/key-white.png" alt="logo">
                    </a>
                    <li class="nav-item"><a href="about.php" class="nav-link" id="4">A propos</a></li>
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item"><a href="dashboard.php" class="nav-link" id="5">Dashboard</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a href="login.php" class="nav-link" id="7">Se connecter</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <?php if ($isLoggedIn): ?>
            <a href="logout.php" class="logout-btn">Deconnexion</a></li>
        <?php endif; ?>
    </header>

    <script>setActiveLink();</script>
</body>
</html>
