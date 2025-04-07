<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Yönetim Paneli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fas fa-robot"></i>
            <span>Chatbot Panel</span>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="index.php" class="<?php echo $sayfa == 'index' ? 'active' : ''; ?>">
                    <i class="fas fa-home"></i>
                    <span>Ana Sayfa</span>
                </a>
            </li>
            <li>
                <a href="sorular.php" class="<?php echo $sayfa == 'sorular' ? 'active' : ''; ?>">
                    <i class="fas fa-question-circle"></i>
                    <span>Soru Yönetimi</span>
                </a>
            </li>
            <li>
                <a href="ayarlar.php" class="<?php echo $sayfa == 'ayarlar' ? 'active' : ''; ?>">
                    <i class="fas fa-cog"></i>
                    <span>Ayarlar</span>
                </a>
            </li>
            <li>
                <a href="cikis.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Çıkış Yap</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title"><?php echo $sayfa_baslik; ?></h1>
            <?php if(isset($header_button)): ?>
            <div class="header-actions">
                <?php echo $header_button; ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if(isset($_SESSION['mesaj'])): ?>
        <div class="alert alert-<?php echo $_SESSION['mesaj_tur']; ?>">
            <?php 
            echo $_SESSION['mesaj'];
            unset($_SESSION['mesaj']);
            unset($_SESSION['mesaj_tur']);
            ?>
        </div>
        <?php endif; ?>

        <?php include($sayfa_icerik); ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Mobile menu toggle
        $(document).ready(function() {
            $('.mobile-toggle').click(function() {
                $('.sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html> 