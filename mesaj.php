<?php
require_once 'config.php';

// URL'leri tıklanabilir linklere dönüştüren fonksiyon
function makeLinksClickable($text) {
    $pattern = '/(https?:\/\/[^\s]+)/i';
    return preg_replace($pattern, '<a href="$1" target="_blank">$1</a>', $text);
}

if(isset($_POST['mesaj'])) {
    $mesaj = trim($_POST['mesaj']);
    
    // Boş mesaj kontrolü
    if(empty($mesaj)) {
        echo json_encode(['cevap' => 'Lütfen bir soru sorun.']);
        exit;
    }
    
    // Soruyu veritabanında ara
    $query = "SELECT cevaplar FROM chatbot WHERE sorular LIKE ?";
    $stmt = mysqli_prepare($conn, $query);
    $search_term = "%" . $mesaj . "%";
    mysqli_stmt_bind_param($stmt, "s", $search_term);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if($row = mysqli_fetch_assoc($result)) {
        // Veritabanından gelen cevaptaki URL'leri tıklanabilir yap
        $cevap = makeLinksClickable($row['cevaplar']);
    } else {
        $cevap = "Merhaba, size daha iyi yardımcı olabilmek için lütfen bizimle iletişime geçin:\n\n";
        $cevap .= "📞 Tel: <a href='tel:08503073458'>0850 307 3458</a>\n";
        $cevap .= "📱 WhatsApp: <a href='https://wa.me/9053073458'>0850 307 3458</a>\n";
        $cevap .= "✉️ E-posta: <a href='mailto:info@ekayazilim.com.tr'>info@ekayazilim.com.tr</a>\n\n";
        $cevap .= "Çalışma Saatleri:\n";
        $cevap .= "Pazartesi - Cuma: 09:00 - 18:00\n";
        $cevap .= "Cumartesi: 09:00 - 14:00\n\n";
        $cevap .= "Size en kısa sürede dönüş yapacağız.";
    }
    
    echo json_encode(['cevap' => $cevap]);
} else {
    echo json_encode(['cevap' => 'Bir hata oluştu.']);
}
?>