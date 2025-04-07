<?php
session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: index.php");
    exit();
}
require_once '../config.php';

// Toplam soru sayısını al
$query = "SELECT COUNT(*) as total FROM chatbot";
$result = mysqli_query($conn, $query);
$total_questions = 0;
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_questions = $row['total'];
}

// Son eklenen soruları al
$recent_query = "SELECT id, sorular, cevaplar FROM chatbot ORDER BY id DESC LIMIT 5";
$recent_result = mysqli_query($conn, $recent_query);
$recent_questions = [];
if ($recent_result) {
    while ($row = mysqli_fetch_assoc($recent_result)) {
        $recent_questions[] = $row;
    }
}

// Son giriş yapan yönetici bilgisini al
$admin_query = "SELECT son_giris FROM yoneticiler WHERE id = ?";
$stmt = mysqli_prepare($conn, $admin_query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['admin_id']);
    mysqli_stmt_execute($stmt);
    $admin_result = mysqli_stmt_get_result($stmt);
    $admin_data = mysqli_fetch_assoc($admin_result);
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .big-number {
            font-size: 3rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .question-preview {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .welcome-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <h4 class="text-white text-center mb-4">Yönetim Paneli</h4>
                <a href="dashboard.php"><i class="bi bi-house-door"></i> Ana Sayfa</a>
                <a href="sorular.php"><i class="bi bi-chat-dots"></i> Soru-Cevap Yönetimi</a>
                <a href="cikis.php"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a>
            </div>
            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Hoş Geldiniz</h2>
                    <?php if(isset($admin_data['son_giris'])): ?>
                    <div class="welcome-text">
                        Son giriş: <?php echo date('d.m.Y H:i', strtotime($admin_data['son_giris'])); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Toplam Soru-Cevap</h5>
                                <div class="big-number"><?php echo $total_questions; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Son Eklenen Sorular</h5>
                            <a href="sorular.php" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg"></i> Yeni Soru Ekle
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">ID</th>
                                        <th>Soru</th>
                                        <th>Cevap</th>
                                        <th style="width: 100px;">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_questions as $question): ?>
                                    <tr>
                                        <td><?php echo $question['id']; ?></td>
                                        <td class="question-preview"><?php echo htmlspecialchars($question['sorular']); ?></td>
                                        <td class="question-preview"><?php echo htmlspecialchars($question['cevaplar']); ?></td>
                                        <td>
                                            <a href="sorular.php" class="btn btn-primary btn-sm">
                                                <i class="bi bi-pencil"></i> Düzenle
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 