document.querySelector(".menu-toggle").addEventListener("click", function () {
  document.querySelector(".sidebar").classList.toggle("active");
  document.querySelector(".topbar").classList.toggle("sidebar-collapsed");
  document.querySelector(".main-content").classList.toggle("sidebar-collapsed");
});
