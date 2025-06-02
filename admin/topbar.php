<div class="topbar">
  <div class="menu-toggle"><i class="fas fa-bars"></i></div>
  <div class="user-icon" onclick="toggleDropdown()">
    <i class="fas fa-user-circle"></i>
    <div class="user-dropdown">
      <a href="profile.php"><i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?></a>
      <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
</div>
