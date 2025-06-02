window.addEventListener("load", function () {
  setTimeout(function () {
    const loader = document.querySelector(".loader-container");
    loader.style.transition =
      "opacity 0.7s cubic-bezier(.4,0,.2,1), top 0.7s cubic-bezier(.4,0,.2,1)";
    loader.classList.add("fade-out");
    setTimeout(function () {
      loader.style.display = "none";
    }, 800); // Tunggu sampai transisi selesai sebelum benar-benar menghilangkan loader
  }, 200); // Tampilkan sebentar, lalu fade-out
});
