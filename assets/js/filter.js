// Fungsi untuk menampilkan semua menu saat halaman dimuat
function showAllMenus() {
  const menuCards = document.querySelectorAll(".menu-card");
  const allButton = document.querySelector(".buttons .btn:first-child"); // Tombol "Semua Menu"

  if (menuCards.length > 0) {
    // Tampilkan semua menu
    menuCards.forEach((card) => {
      card.style.display = "flex"; // Pastikan semua menu terlihat
    });

    // Tambahkan kelas aktif pada tombol "Semua Menu"
    document.querySelectorAll(".buttons .btn").forEach((btn) => {
      btn.classList.remove("active");
    });
    allButton.classList.add("active");
  } else {
    console.error("Tidak ada menu yang ditemukan!");
  }
}

// Panggil fungsi saat halaman dimuat
document.addEventListener("DOMContentLoaded", showAllMenus);

document.querySelectorAll(".buttons .btn").forEach((button) => {
  button.addEventListener("click", function () {
    const category = this.textContent.toLowerCase(); // Ambil kategori dari teks tombol
    const menuCards = document.querySelectorAll(".menu-card");

    if (menuCards.length > 0) {
      // Tampilkan menu berdasarkan kategori
      menuCards.forEach((card) => {
        const cardCategory = card.getAttribute("data-category").toLowerCase();

        if (category === "semua menu" || cardCategory === category) {
          card.style.display = "flex"; // Tampilkan kartu menu yang cocok
        } else {
          card.style.display = "none"; // Sembunyikan kartu menu yang tidak cocok
        }
      });

      // Tambahkan kelas aktif pada tombol yang diklik
      document.querySelectorAll(".buttons .btn").forEach((btn) => {
        btn.classList.remove("active");
      });
      this.classList.add("active");
    } else {
      console.error("Tidak ada menu yang ditemukan!");
    }
  });
});
