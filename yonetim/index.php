<?php
session_start();

// Giriş yapılmamışsa giris.php'ye yönlendir
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: giris.php");
    exit();
}

// Giriş yapılmışsa dashboard'a yönlendir
header("Location: dashboard.php");
exit();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli Giriş</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background: white;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <img src="../avatar.png" alt="Logo" class="rounded-circle">
                <h2>Yönetim Paneli</h2>
            </div>
            <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php 
                if ($_GET['error'] == 1) {
                    if (isset($_GET['type']) && $_GET['type'] == 'password') {
                        echo "Şifre hatalı!";
                    } elseif (isset($_GET['type']) && $_GET['type'] == 'user') {
                        echo "Kullanıcı bulunamadı!";
                    } else {
                        echo "Kullanıcı adı veya şifre hatalı!";
                    }
                } elseif ($_GET['error'] == 2) {
                    echo "Sistem hatası! Lütfen daha sonra tekrar deneyin.";
                }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <form action="giris.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Şifre</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 