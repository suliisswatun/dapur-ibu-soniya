function toggleDropdown() {
  const dropdown = document.querySelector(".user-dropdown");
  if (dropdown) {
    dropdown.classList.toggle("active");
  }
}

// Close dropdown if clicked outside
document.addEventListener("click", function (e) {
  const userIcon = document.querySelector(".user-icon");
  const dropdown = document.querySelector(".user-dropdown");
  // Pastikan dropdown dan userIcon ada sebelum akses classList
  if (dropdown && userIcon && !userIcon.contains(e.target)) {
    dropdown.classList.remove("active");
  }
});
