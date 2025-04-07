<?php
require_once '../config.php';

// Önce mevcut yönetici var mı kontrol et
$check_query = "SELECT COUNT(*) as count FROM yoneticiler WHERE kullanici_adi = 'admin'";
$result = mysqli_query($conn, $check_query);
$row = mysqli_fetch_assoc($result);

if ($row['count'] > 0) {
    echo "Admin hesabı zaten mevcut!<br>";
    echo "<a href='index.php'>Giriş sayfasına git</a>";
    exit();
}

// Varsayılan yönetici bilgileri
$username = "admin";
$password = "admin123"; // Bu şifreyi not alın
$email = "admin@example.com";

// Şifreyi hash'le
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Yöneticiyi ekle
$query = "INSERT INTO yoneticiler (kullanici_adi, sifre, email) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $email);
    if (mysqli_stmt_execute($stmt)) {
        echo "Yönetici hesabı başarıyla oluşturuldu!<br>";
        echo "Kullanıcı adı: " . $username . "<br>";
        echo "Şifre: " . $password . "<br>";
        echo "<a href='index.php'>Giriş sayfasına git</a>";
    } else {
        if (mysqli_errno($conn) == 1062) {
            echo "Bu kullanıcı adı veya email zaten kullanımda!<br>";
        } else {
            echo "Hata: " . mysqli_error($conn);
        }
    }
} else {
    echo "Hata: " . mysqli_error($conn);
}

// Mevcut yöneticileri listele
echo "<hr><h3>Mevcut Yöneticiler:</h3>";
$list_query = "SELECT id, kullanici_adi, email, son_giris FROM yoneticiler";
$list_result = mysqli_query($conn, $list_query);
if ($list_result && mysqli_num_rows($list_result) > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Kullanıcı Adı</th><th>Email</th><th>Son Giriş</th></tr>";
    while ($admin = mysqli_fetch_assoc($list_result)) {
        echo "<tr>";
        echo "<td>" . $admin['id'] . "</td>";
        echo "<td>" . htmlspecialchars($admin['kullanici_adi']) . "</td>";
        echo "<td>" . htmlspecialchars($admin['email']) . "</td>";
        echo "<td>" . ($admin['son_giris'] ? date('d.m.Y H:i', strtotime($admin['son_giris'])) : 'Hiç giriş yapmadı') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Henüz hiç yönetici yok.";
}
?> 