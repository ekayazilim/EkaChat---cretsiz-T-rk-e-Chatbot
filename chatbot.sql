-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 Nis 2025, 17:26:27
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `chatbot`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `sorular` text NOT NULL,
  `cevaplar` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `chatbot`
--

INSERT INTO `chatbot` (`id`, `sorular`, `cevaplar`) VALUES
(1, 'Merhaba', 'Hoş geldiniz! Eka Sunucu ve Eka Yazılım olarak size nasıl yardımcı olabiliriz?'),
(2, 'Eka Sunucu nedir?', 'Eka Sunucu, güvenilir ve performans odaklı sunucu çözümleri sunan bir hizmettir.'),
(3, 'Eka Yazılım ne yapar?', 'Eka Yazılım, kurumsal yazılım çözümleri, web tasarımı ve özel yazılım geliştirme hizmetleri sunar.'),
(4, 'Sunucu hizmetleriniz nelerdir?', 'VDS, VPS, Kiralık Sunucu, Hosting ve Alan Adı hizmetleri sunuyoruz.'),
(5, 'Yazılım geliştirme hizmeti veriyor musunuz?', 'Evet, ihtiyaca özel yazılım geliştirme hizmeti sunuyoruz.'),
(6, 'Alan adı tescili yapıyor musunuz?', 'Evet, .com, .net, .org ve birçok uzantıda alan adı tescili yapıyoruz.'),
(7, 'Web sitesi tasarımı yapıyor musunuz?', 'Evet, modern ve mobil uyumlu web siteleri tasarlıyoruz.'),
(8, 'Sunucularınız Türkiye lokasyonlu mu?', 'Evet, Türkiye lokasyonlu yüksek performanslı sunucular kullanıyoruz.'),
(9, 'Yedekleme hizmetiniz var mı?', 'Evet, günlük, haftalık ve isteğe bağlı yedekleme çözümleri sunuyoruz.'),
(10, 'Destek saatleriniz nedir?', '7/24 teknik destek sağlamaktayız.'),
(11, 'Eka Sunucu nerede bulunuyor?', 'Merkezimiz Türkiye’dedir. Sunucu lokasyonlarımız Türkiye ve Avrupa’dadır.'),
(12, 'Litespeed sunucu kuruyor musunuz?', 'Evet, talep üzerine Litespeed kurulumu yapıyoruz.'),
(13, 'WordPress kurulumu yapıyor musunuz?', 'Evet, WordPress ve diğer CMS sistemlerinin kurulumunu yapıyoruz.'),
(14, 'Hazır web sitesi paketleriniz var mı?', 'Evet, sektör bazlı hazır web site paketlerimiz mevcuttur.'),
(15, 'Sunucularınız SSD mi?', 'Evet, tüm sunucularımız NVMe veya SSD disklerle çalışır.'),
(16, 'Webmail desteğiniz var mı?', 'Evet, mail kurulum ve yapılandırma desteği sunuyoruz.'),
(17, 'Fiyatlarınız ne kadar?', 'Detaylı fiyatlar için ekasunucu.com veya ekayazilim.com adresimizi ziyaret edebilirsiniz.'),
(18, 'Ödeme yöntemleri nelerdir?', 'Havale, EFT, kredi kartı ve online ödeme sistemleri ile ödeme alıyoruz.'),
(19, 'Faturaları nasıl alabilirim?', 'Tüm işlemler için e-fatura tarafınıza otomatik olarak gönderilir.'),
(20, 'cPanel kurulumu yapıyor musunuz?', 'Evet, lisanslı cPanel kurulum ve yapılandırması yapıyoruz.'),
(21, 'SSL sertifikası sağlıyor musunuz?', 'Evet, ücretsiz ve ücretli SSL seçeneklerimiz mevcuttur.'),
(22, 'Sunucu kiralama süresi ne kadar?', 'Aylık, 3 aylık, 6 aylık ve yıllık seçenekler sunuyoruz.'),
(23, 'Yazılım projesi ne kadar sürede teslim edilir?', 'Teslim süresi proje kapsamına göre değişmektedir.'),
(24, 'Hangi programlama dillerinde destek veriyorsunuz?', 'PHP, JavaScript, Python ve daha fazlası için destek sunuyoruz.'),
(25, 'Güvenlik duvarı kuruyor musunuz?', 'Evet, sunucularınız için güvenlik duvarı yapılandırması yapıyoruz.'),
(26, 'Sunucum yavaş çalışıyor, yardım eder misiniz?', 'Evet, performans analizleri ve optimizasyon hizmeti sağlıyoruz.'),
(27, 'Hosting paketleriniz nelerdir?', 'Bireysel ve kurumsal için farklı hosting paketlerimiz bulunmaktadır.'),
(28, 'Mobil uyumlu site yapıyor musunuz?', 'Evet, tüm tasarımlarımız mobil uyumludur.'),
(29, 'Veritabanı yedeklemesi yapıyor musunuz?', 'Evet, düzenli veritabanı yedekleme hizmeti sunuyoruz.'),
(30, 'Hazır e-ticaret sistemi sunuyor musunuz?', 'Evet, yönetim paneliyle birlikte gelen hazır e-ticaret paketlerimiz mevcuttur.'),
(31, 'Sunucu izleme hizmeti veriyor musunuz?', 'Evet, uptime takibi ve bildirim sistemi sunuyoruz.'),
(32, 'SEO uyumlu yazılım yapıyor musunuz?', 'Evet, SEO uyumlu yazılım ve web sitesi geliştiriyoruz.'),
(33, 'Panel üzerinden site yönetimi mümkün mü?', 'Evet, kullanıcı dostu yönetim paneli sunuyoruz.'),
(34, 'Sunucu yeniden başlatma işlemi nasıl yapılır?', 'Müşteri panelimiz üzerinden tek tıkla yeniden başlatabilirsiniz.'),
(35, 'Yazılım fiyatlandırması nasıl yapılır?', 'Fiyatlandırma projenin kapsamına ve taleplerinize göre belirlenir.'),
(36, 'Firewall kurulum hizmetiniz var mı?', 'Evet, Linux ve Windows sunucular için firewall kurulumu yapıyoruz.'),
(37, 'WordPress eklentisi geliştirme hizmetiniz var mı?', 'Evet, ihtiyaca özel WordPress eklentisi geliştiriyoruz.'),
(38, 'Lisans hizmeti sağlıyor musunuz?', 'Evet, cPanel, LiteSpeed, WHMCS gibi lisanslar sağlıyoruz.'),
(39, 'WHMCS kurulumu yapıyor musunuz?', 'Evet, WHMCS kurulumu ve yapılandırması hizmetimiz vardır.'),
(40, 'Yazılım güncellemesi yapıyor musunuz?', 'Evet, mevcut sistemler için güncelleme hizmeti sunuyoruz.'),
(41, 'Hosting taşıma işlemi yapıyor musunuz?', 'Evet, ücretsiz hosting taşıma hizmeti sunuyoruz.'),
(42, 'Hangi veritabanlarını destekliyorsunuz?', 'MySQL, MariaDB, PostgreSQL ve SQLite desteklenmektedir.'),
(43, 'Veri merkezi nerededir?', 'Sunucularımız İstanbul ve Almanya veri merkezlerinde barındırılmaktadır.'),
(44, 'Sunucu güvenliği sağlıyor musunuz?', 'Evet, firewall, brute-force koruması ve root güvenliği sağlıyoruz.'),
(45, 'Destek sistemi nasıl çalışıyor?', 'Canlı destek, e-posta ve destek bilet sistemi ile hizmet veriyoruz.'),
(46, 'Site hızı için optimizasyon yapıyor musunuz?', 'Evet, site hızlandırma ve önbellekleme çözümleri sunuyoruz.'),
(47, 'E-posta kurulumu yapıyor musunuz?', 'Evet, tüm cihazlar için e-posta kurulumu sağlıyoruz.'),
(48, 'İş takibi yapıyor musunuz?', 'Evet, her proje için detaylı iş planı ve ilerleme raporu sunuyoruz.'),
(49, 'Eka Yazılım ile nasıl iletişim kurabilirim?', 'info@ekayazilim.com adresine mail atabilir veya ekayazilim.com üzerinden iletişime geçebilirsiniz.'),
(50, 'Eka Sunucu ile nasıl iletişim kurabilirim?', 'destek@ekasunucu.com adresine yazabilir ya da ekasunucu.com üzerinden destek talebi oluşturabilirsiniz.'),
(51, 'Banka hesaplarınız nedir?', 'Banka bilgilerimize şu bağlantıdan ulaşabilirsiniz: https://www.ekasunucu.com/banka-hesaplarimiz'),
(52, 'Google Play Kapalı Test Yönetimi Hizmeti almak istiyorum', 'Hizmet detayları için: https://www.ekasunucu.com/kategori/google-play-kapali-test-yonetimi-hizmetleri üzerinden kredi kartı veya banka havalesi ile ödeme sağlayabilirsiniz. 0850 307 34 58 numarasıyla arayarak ya da WhatsApp üzerinden iletişime geçebilirsiniz.'),
(53, 'Hetzner sunucularınız var mı?', 'Evet, Almanya lokasyonlu Hetzner sunucularımız için: https://www.ekasunucu.com/kategori/almanya-lokasyon-hetzner-cloud üzerinden ödeme yapabilirsiniz.'),
(54, 'Türkiye lokasyon vps veya vds var mı?', 'Evet, Türkiye lokasyonlu VDS/VPS sunucularımızı buradan inceleyebilirsiniz: https://www.ekasunucu.com/kategori/turkiye-lokasyon-vds-vps'),
(55, 'Telefon numaranız nedir?', 'Bize 0 850 307 34 58 numarasından arayarak veya WhatsApp üzerinden ulaşabilirsiniz.'),
(56, 'Muhasebe iletişim bilgileri nedir?', 'Muhasebe ve faks gibi işlemler için sabit hattımız: (0212) 993 34 58');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `soru_istatistikleri`
--

CREATE TABLE `soru_istatistikleri` (
  `id` int(11) NOT NULL,
  `soru_id` int(11) NOT NULL,
  `goruntulenme` int(11) NOT NULL DEFAULT 0,
  `son_goruntulenme` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

CREATE TABLE `yoneticiler` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(50) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `son_giris` datetime DEFAULT NULL,
  `olusturma_tarihi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `kullanici_adi`, `sifre`, `email`, `son_giris`, `olusturma_tarihi`) VALUES
(1, 'admin', '$2y$10$1alJUdiPnRAFhA3GZgkfoOEfiB6Hj1E9S5o3QVPh4tIJ2Hri36.CO', 'admin@example.com', '2025-04-07 18:24:13', '2025-04-07 15:24:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetim_loglari`
--

CREATE TABLE `yonetim_loglari` (
  `id` int(11) NOT NULL,
  `yonetici_id` int(11) NOT NULL,
  `islem` varchar(50) NOT NULL,
  `detay` text DEFAULT NULL,
  `ip_adresi` varchar(45) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `yonetim_loglari`
--

INSERT INTO `yonetim_loglari` (`id`, `yonetici_id`, `islem`, `detay`, `ip_adresi`, `tarih`) VALUES
(1, 1, 'giris', 'Başarılı giriş', '::1', '2025-04-07 15:24:13');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `soru_istatistikleri`
--
ALTER TABLE `soru_istatistikleri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soru_id` (`soru_id`);

--
-- Tablo için indeksler `yoneticiler`
--
ALTER TABLE `yoneticiler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `yonetim_loglari`
--
ALTER TABLE `yonetim_loglari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yonetici_id` (`yonetici_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Tablo için AUTO_INCREMENT değeri `soru_istatistikleri`
--
ALTER TABLE `soru_istatistikleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `yoneticiler`
--
ALTER TABLE `yoneticiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `yonetim_loglari`
--
ALTER TABLE `yonetim_loglari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `soru_istatistikleri`
--
ALTER TABLE `soru_istatistikleri`
  ADD CONSTRAINT `soru_istatistikleri_ibfk_1` FOREIGN KEY (`soru_id`) REFERENCES `sorular` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `yonetim_loglari`
--
ALTER TABLE `yonetim_loglari`
  ADD CONSTRAINT `yonetim_loglari_ibfk_1` FOREIGN KEY (`yonetici_id`) REFERENCES `yoneticiler` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
