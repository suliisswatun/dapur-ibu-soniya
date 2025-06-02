<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dapur Ibu Soniya</title>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  </head>
  <body>
    <nav class="navigation">
        <a href="#" class="logo">
            <img src="assets/img/logodapur.png" alt=""> 
            <h3>Dapur Ibu Soniya</h3> 
        </a>

        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>

        <ul class="nav">
            <li><a href="#home">Beranda</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#ulasan">Ulasan</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="#tentang">Tentang Kami</a></li>
        </ul>

        <div class="right-nav">
          <a href="https://www.facebook.com/share/15QrcWMCu1/" class="sosmed" target="_blank" rel="noopener noreferrer">
            <span class="iconify" data-icon="mdi:facebook" style="color: #4267b2; font-size: 24px;"></span>
          </a>
        </div>
    </nav>

    <main>
    <!-- Banner -->
    <section class="banner-section banner">
      <div class="banner-content">
        <h1>Dapur Ibu Soniya <br />Lezat Dan Bergizi</h1>
        <p>Beli Sekarang Dan Nikmati Kenikmatannya</p>
        <div class="search-bar">
            <input type="text" placeholder="Cari menu favorit Anda" />
            <button>Pencarian</button>
        </div>
      </div>
      <div class="banner-image">
        <img src="assets/img/logodapur.png" alt="Dapur Ibu Soniya Logo" style="max-width: 100%; height: auto;" />
      </div>
    </section>

    <section class="about-section" id="tentang">
  <h1 class="title" style="text-align: center; color: #d35400;">Tentang Kami</h1>
  <div class="about-container" style="text-align: center; max-width: 800px; margin: 0 auto;">
    <p>
      Selamat datang di Dapur Ibu Soniya, tempat di mana rasa rumahan bertemu dengan kelezatan yang tak terlupakan.
      Kami menghadirkan berbagai pilihan hidangan lezat yang dibuat dengan sepenuh hati, dari seafood segar, cemilan gurih, hingga minuman yang menyegarkan.
    </p>
    
    <div id="moreText" style="display: none;">
      <p>
        Berawal dari dapur sederhana dengan resep turun-temurun, kami tumbuh dengan satu misi: menyajikan makanan yang bukan hanya enak, tapi juga penuh makna.
        Setiap masakan yang keluar dari dapur kami membawa cerita, cinta, dan komitmen terhadap kualitas.
      </p>
      <p>
        Di Dapur Ibu Soniya, kami percaya bahwa makanan terbaik adalah yang membuatmu merasa seperti di rumah.
        Terima kasih telah menjadi bagian dari perjalanan rasa kami.
      </p>
    </div>

    <button onclick="toggleText()" id="toggleButton" style="margin-top: 10px; padding: 8px 16px; border: none; background-color: #d35400; color: white; border-radius: 6px; cursor: pointer;">
      Baca Selengkapnya
    </button>
  </div>
</section>

<script>
  function toggleText() {
    const moreText = document.getElementById("moreText");
    const button = document.getElementById("toggleButton");
    if (moreText.style.display === "none") {
      moreText.style.display = "block";
      button.textContent = "Tutup";
    } else {
      moreText.style.display = "none";
      button.textContent = "Baca Selengkapnya";
    }
  }
</script>


    <h1 class="title" id="menu">Menu Kami</h1>

    <div class="buttons">
      <button class="btn">Semua Menu</button>
      <button class="btn">Makanan</button>
      <button class="btn">Minuman</button>
      <button class="btn">Cemilan</button>
    </div>

<div class="menu-wrapper">
  <?php
    // Ambil data menu dari database
    $query = "SELECT * FROM menu";
    $result = mysqli_query($koneksi, $query);

    // Folder gambar (relatif dari homepage.php ke foto_menu di root project)
    $img_folder = 'foto_menu/';

    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        // Path gambar untuk src (relatif dari homepage.php)
        $img_path = $img_folder . $row['foto_menu'];

        // Path absolut untuk pengecekan file (gunakan path server, bukan URL)
        $img_path_abs = __DIR__ . '/foto_menu/' . $row['foto_menu'];

        // Cek apakah file gambar ada di server dan nama file tidak kosong
        if (empty($row['foto_menu']) || !is_file($img_path_abs)) {
          // Jika gambar tidak ada, gunakan gambar default
          $img_path = 'assets/img/menu/default.jpg';
        }
        $harga = 'Rp. ' . number_format($row['harga'], 0, ',', '.');
  ?>
    <div class="menu-card" data-category="<?php echo htmlspecialchars($row['jenis_menu']); ?>">
      <div class="menu-image">
        <span class="badge">Hot</span>
        <img src="<?php echo htmlspecialchars($img_path); ?>" alt="<?php echo htmlspecialchars($row['nama_menu']); ?>">
      </div>
      <div class="menu-content">
        <h3><?php echo htmlspecialchars($row['nama_menu']); ?></h3>
        <p>By <span class="chef-name">Dapur Ibu Soniya</span></p>
        <p class="price"><?php echo $harga; ?></p>
      </div>
    </div>
  <?php
      }
    } else {
      echo "<p>Menu belum tersedia.</p>";
    }
  ?>
</div>

    <section class="customers" id="serverResponse">
    <!-- <section class="riview-section" id="serverResponse"> -->
      <h2 id="ulasan">Mengapa Pelanggan Menyukai Kami?</h2>
      <p>Bagikan pengalaman Anda <a href="https://maps.app.goo.gl/X9NTjztvx156XKvU7">disini!</a></p>
      <div class="customers-container">
        <div class="box">

          <script src="https://static.elfsight.com/platform/platform.js" async></script>
          <div class="elfsight-app-82d811e1-e113-4bde-b47d-270c26d4554b" data-elfsight-app-lazy></div>

        </div>
      </div>
    </section>

    <section class="contact-section" id="kontak">
        <h1 class="sectionheader">Hubungi Kami</h1>
        <h3 class="heading">Kami Siap Melayani Anda</h3>

        <div class="contactForm">
          <form id="whatsapp-form" class="contact-form" onsubmit="sendMessage()">
            <h1 class="sub-heading">Mau menikmati hidangan lezat?</h1>
            <p class="para">Pesan sekarang atau tanyakan lebih lanjut!</p>

            <input type="text" class="input" id="name" placeholder="Nama anda..." required>
            <input type="text" class="input" id="address" placeholder="Titik Lokasi..." required>
            <textarea class="input" id="message" cols="30" rows="5" placeholder="Tuliskan pesanan Anda dengan jelas dan rinci (Contoh : Saya ingin memesan Cumi Bakar 1 Porsi)" required></textarea>
            <button class="btn btn-primary px-4" type="submit">
              Kirim Pesan
            </button>
            <!-- <input type="submit" class="input submit" value="Kirim pesan"> -->
          </form>

          <div class="map-container">
            <div class="mapBg"></div>
            <div class="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.283851543398!2d108.3874987!3d-6.357292600000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ebf127ca9c2d3%3A0x128960e5b1a735b8!2sIkan%20Bakar%20Ibu%20SONIYAHbalongan%20indah!5e0!3m2!1sid!2sid!4v1744298104244!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </section>
    </main>
      
    
    <footer>
      <div class="row">
        <div class="col">
          <img src="assets/img/logodapur.png" class="logo" alt="Logo Dapur Ibu Soniya">
          <p>Dapur Ibu Soniya<br>Selalu Di Hati</p>
        </div>
        <div class="col">
          <h3>Jam Operasional <div class="underline"><span></span></div></h3>
          <p>Buka Setiap Hari:</p>
          <p>07.00 - 18.00 WIB</p>
        </div>
        <div class="col">
          <h3>Links <div class="underline"><span></span></div></h3>
          <ul>
            <li><a href="#home">Beranda</a></li>
            <li><a href="#tentang">Tentang Kami</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#reservasi">Reservasi</a></li>
            <li><a href="#faq">FAQ</a></li>
          </ul>
        </div>
        <div class="col">
          <h3> Cerita Kuliner <div class="underline"><span></span></div></h3>
          <form class="footer-form">
            <i class="fa-regular fa-envelope"></i>
            <input type="email" class="email-input" placeholder="Masukkan Alamat Email Anda" />
            <button type="submit"><i class="fas fa-arrow-right"></i></button>
          </form>            
        </div>
        <hr>
        <p class="hakcipta">&copy; 2025 Dapur Ibu Soniya. Seluruh Hak Cipta Dilindungi.</p>
      </footer>
      
      <div class="loader-container">
        <img src="assets/img/loader.gif" alt="Loading..." class="loader">
      </div>
      
      <script>
        document.getElementById('whatsapp-form').addEventListener('submit', function (e) {
          e.preventDefault();

          const name = document.getElementById('name').value.trim();
          const address = document.getElementById('address').value.trim();
          const message = document.getElementById('message').value.trim();

          const phoneNumber = '6281315219386';
          const text = `Halo Admin!\nSaya *${name}*, titik lokasi saya *${address}*\n*${message}*`;

          const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(text)}`;

          window.open(url, '_blank');
        });

        // Hamburger menu toggle
        document.addEventListener('DOMContentLoaded', function() {
          const hamburger = document.querySelector('.hamburger');
          const nav = document.querySelector('.navigation .nav');
          hamburger.addEventListener('click', function() {
            nav.classList.toggle('show');
          });
          // Tutup sidebar saat klik menu
          nav.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
              nav.classList.remove('show');
            });
          });
        });
      </script>
      <script src="assets/js/loader.js"></script>
      <script src="assets/js/kirimpesan.js"></script>
      <script src="assets/js/navbar.js"></script>
      <script src="assets/js/search.js"></script>
      <script src="assets/js/filter.js?"></script>
  </body>
</html>
