<?php
session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: index.php");
    exit();
}
require_once '../config.php';

// Düzenleme işlemi
if(isset($_POST['duzenle'])) {
    $id = $_POST['id'];
    $soru = $_POST['soru'];
    $cevap = $_POST['cevap'];
    
    $query = "UPDATE chatbot SET sorular = ?, cevaplar = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $soru, $cevap, $id);
        if (mysqli_stmt_execute($stmt)) {
            // Log kaydı
            $log_query = "INSERT INTO yonetim_loglari (yonetici_id, islem, detay) VALUES (?, 'soru_duzenle', ?)";
            $log_stmt = mysqli_prepare($conn, $log_query);
            if ($log_stmt) {
                $detay = "Soru düzenlendi (ID: " . $id . ")";
                mysqli_stmt_bind_param($log_stmt, "is", $_SESSION['admin_id'], $detay);
                mysqli_stmt_execute($log_stmt);
            }
            header("Location: sorular.php?success=3");
            exit();
        }
    }
}

// Soru ekleme işlemi
if(isset($_POST['ekle'])) {
    $soru = $_POST['soru'];
    $cevap = $_POST['cevap'];
    
    // Soru ve cevabı ekle
    $query = "INSERT INTO chatbot (sorular, cevaplar) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $soru, $cevap);
        if (mysqli_stmt_execute($stmt)) {
            // Log kaydı
            $soru_id = mysqli_insert_id($conn);
            $log_query = "INSERT INTO yonetim_loglari (yonetici_id, islem, detay) VALUES (?, 'soru_ekle', ?)";
            $log_stmt = mysqli_prepare($conn, $log_query);
            if ($log_stmt) {
                $detay = "Yeni soru eklendi: " . substr($soru, 0, 50) . "...";
                mysqli_stmt_bind_param($log_stmt, "is", $_SESSION['admin_id'], $detay);
                mysqli_stmt_execute($log_stmt);
            }
            header("Location: sorular.php?success=1");
            exit();
        }
    }
}

// Soru silme işlemi
if(isset($_GET['sil'])) {
    $id = $_GET['sil'];
    
    // Soruyu sil
    $query = "DELETE FROM chatbot WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            // Log kaydı
            $log_query = "INSERT INTO yonetim_loglari (yonetici_id, islem, detay) VALUES (?, 'soru_sil', ?)";
            $log_stmt = mysqli_prepare($conn, $log_query);
            if ($log_stmt) {
                $detay = "Soru silindi (ID: " . $id . ")";
                mysqli_stmt_bind_param($log_stmt, "is", $_SESSION['admin_id'], $detay);
                mysqli_stmt_execute($log_stmt);
            }
            header("Location: sorular.php?success=2");
            exit();
        }
    }
}

// Mevcut soruları al
$query = "SELECT id, sorular as soru, cevaplar as cevap FROM chatbot ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$questions = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soru-Cevap Yönetimi</title>
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
                <h2 class="mb-4">Soru-Cevap Yönetimi</h2>
                
                <?php if(isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php 
                        if($_GET['success'] == 1) {
                            echo "Soru başarıyla eklendi!";
                        } elseif($_GET['success'] == 2) {
                            echo "Soru başarıyla silindi!";
                        } elseif($_GET['success'] == 3) {
                            echo "Soru başarıyla güncellendi!";
                        }
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <!-- Soru Ekleme Formu -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Yeni Soru-Cevap Ekle</h5>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="soru" class="form-label">Soru</label>
                                <input type="text" class="form-control" id="soru" name="soru" required>
                            </div>
                            <div class="mb-3">
                                <label for="cevap" class="form-label">Cevap</label>
                                <textarea class="form-control" id="cevap" name="cevap" rows="3" required></textarea>
                            </div>
                            <button type="submit" name="ekle" class="btn btn-primary">Ekle</button>
                        </form>
                    </div>
                </div>

                <!-- Mevcut Sorular Listesi -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mevcut Sorular</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Soru</th>
                                        <th>Cevap</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($questions as $question): ?>
                                    <tr>
                                        <td><?php echo $question['id']; ?></td>
                                        <td><?php echo htmlspecialchars($question['soru']); ?></td>
                                        <td><?php echo htmlspecialchars($question['cevap']); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" 
                                                    onclick="duzenleAc(<?php echo $question['id']; ?>, 
                                                             '<?php echo addslashes(htmlspecialchars($question['soru'])); ?>', 
                                                             '<?php echo addslashes(htmlspecialchars($question['cevap'])); ?>')">
                                                <i class="bi bi-pencil"></i> Düzenle
                                            </button>
                                            <a href="sorular.php?sil=<?php echo $question['id']; ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Bu soruyu silmek istediğinizden emin misiniz?')">
                                                <i class="bi bi-trash"></i> Sil
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

    <!-- Düzenleme Modal -->
    <div class="modal fade" id="duzenleModal" tabindex="-1" aria-labelledby="duzenleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="duzenleModalLabel">Soru-Cevap Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="duzenle_id">
                        <div class="mb-3">
                            <label for="duzenle_soru" class="form-label">Soru</label>
                            <input type="text" class="form-control" id="duzenle_soru" name="soru" required>
                        </div>
                        <div class="mb-3">
                            <label for="duzenle_cevap" class="form-label">Cevap</label>
                            <textarea class="form-control" id="duzenle_cevap" name="cevap" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                        <button type="submit" name="duzenle" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function duzenleAc(id, soru, cevap) {
        document.getElementById('duzenle_id').value = id;
        document.getElementById('duzenle_soru').value = soru;
        document.getElementById('duzenle_cevap').value = cevap;
        var myModal = new bootstrap.Modal(document.getElementById('duzenleModal'));
        myModal.show();
    }
    </script>
</body>
</html> 