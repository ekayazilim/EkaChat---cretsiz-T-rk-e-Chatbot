<?php
// Veritabanı bağlantı bilgileri
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "chatbot";

// Veritabanı bağlantısı
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Bağlantı kontrolü
if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Türkçe karakter desteği
mysqli_set_charset($conn, "utf8mb4");
?> 