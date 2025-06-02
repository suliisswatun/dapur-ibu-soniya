function toggleMenu() {
  const nav = document.querySelector(".nav");
  nav.classList.toggle("active");
}

document.addEventListener("click", (e) => {
  const nav = document.querySelector(".nav");
  const burgerMenu = document.querySelector(".burger-menu");

  // Sembunyikan menu jika klik di luar area menu atau burger
  if (!nav.contains(e.target) && !burgerMenu.contains(e.target)) {
    nav.classList.remove("active");
  }
});
