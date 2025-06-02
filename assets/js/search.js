document
  .querySelector(".search-bar button")
  .addEventListener("click", function () {
    const query = document
      .querySelector(".search-bar input")
      .value.trim()
      .toLowerCase();
    const menuCards = document.querySelectorAll(".menu-card");

    if (query) {
      let found = false;

      menuCards.forEach((card) => {
        const title = card.querySelector("h3").textContent.toLowerCase();

        if (title.includes(query)) {
          card.style.display = "flex"; // Tampilkan kartu menu yang cocok
          found = true;
        } else {
          card.style.display = "none"; // Sembunyikan kartu menu yang tidak cocok
        }
      });

      if (!found) {
        alert("Menu tidak ditemukan!");
      }
    } else {
      alert("Masukkan kata kunci untuk pencarian!");
      menuCards.forEach((card) => {
        card.style.display = "flex"; // Tampilkan semua kartu jika input kosong
      });
    }
  });
