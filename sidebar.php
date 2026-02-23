<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
  <h2 class="sidebar-title">INORWAT</h2>
  <nav>
    <ul class="sidebar-menu">
      <li class="menu-item <?php if(basename($_SERVER['PHP_SELF'])=='monitoring.php') echo 'active'; ?>">
        <a href="monitoring.php">
          <img src="images/icons8-house-48.png" alt="Dashboard Icon" class="menu-icon">
          <span>Dashboard</span>
        </a>
      </li>
      <li class="menu-item <?php if(basename($_SERVER['PHP_SELF'])=='inorwat1.php') echo 'active'; ?>">
        <a href="inorwat1.php">
          <img src="images/icons8-recycling-48.png" alt="Inorwat I Icon" class="menu-icon">
          <span>Inorwat I</span>
        </a>
      </li>
      <li class="menu-item <?php if(basename($_SERVER['PHP_SELF'])=='inorwat2.php') echo 'active'; ?>">
        <a href="inorwat2.php">
          <img src="images/icons8-recycling-48.png" alt="Inorwat II Icon" class="menu-icon">
          <span>Inorwat II</span>
        </a>
      </li>
      <li class="menu-item <?php if(basename($_SERVER['PHP_SELF'])=='addinorwat.php') echo 'active'; ?>">
        <a href="addinorwat.php">
          <img src="images/icons8-plus-48.png" alt="Add Inorwat Icon" class="menu-icon">
          <span>Add Inorwat</span>
        </a>
      </li>
    </ul>
  </nav>
</aside>
