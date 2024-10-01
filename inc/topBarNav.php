<style>
  button[type="button"]{
    background-color: transparent !important;
    margin-left: 5px;
  }
  /* Sidebar styling with formal hover effect */
  .sidebar {
    position: fixed;
    left: -250px;
    top: 0;
    width: 250px;
    height: 100%;
    background-color: #333333; /* Darker sidebar background */
    transition: left 0.3s ease;
    z-index: 1000;
  }

  .navbar-brand,
  .navbar-nav {
    margin-left: -70px; /* Adjust this value to move more or less */
  }

  .navbar-brand img{
    border-radius: 50%;
  }
  .sidebar.show {
    left: 0;
  }

  .sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .sidebar ul li {
    padding: 0;
  }

  .sidebar ul li a {
    color: #fff; /* White text */
    text-decoration: none;
    display: block;
    padding: 0.75rem 1.5rem; /* Adjusted padding for better spacing */
    font-size: 16px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  /* Hover effect for sidebar items */
  .sidebar ul li a:hover {
    background-color: #ff4600; /* Formal orange hover background */
    color: #fff; /* Ensure text stays white */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for more depth */
  }

  /* Active state styling */
  .sidebar ul li a.active {
    background-color: #ff4600; /* Keep the active state similar to hover */
    color: #fff; /* Ensure text stays white */
    font-weight: bold; /* Make the active link bold */
  }

  /* Responsive for smaller devices */
  @media (max-width: 768px) {
    .sidebar ul {
      padding-top: 4rem;
    }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #ff4600;">
  <div class="container px-4 px-lg-5">
    <a class="navbar-brand" href="./">
      <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" alt="Logo" loading="lazy">
      <?php echo $_settings->info('short_name') ?>
    </a>
    <button class="navbar-toggler btn btn-sm" type="button" id="sidebarToggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
        <li class="nav-item"><a class="nav-link text-white" href="./">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="./?p=report">Report</a></li>
        <li class="nav-item"><a class="nav-link text-white" id="search_report" href="javascript:void(0)">View Status</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="./?p=about">About Us</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="./?p=contact">Contact Us</a></li>
      </ul>
      <div class="d-flex align-items-center">
        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./admin">Login</a>
      </div>
    </div>
  </div>
</nav>

<!-- Sidebar content -->
<div class="sidebar" id="sidebarMenu">
  <ul>
    <li><a href="./">Home</a></li>
    <li><a href="./?p=report">Report</a></li>
    <li><a href="javascript:void(0)" id="search_report_sidebar">View Status</a></li>
    <li><a href="./?p=about">About Us</a></li>
    <li><a href="./?p=contact">Contact Us</a></li>
    <li><a href="./admin">Login</a></li>
  </ul>
</div>

<script>
  $(document).ready(function() {
    $('#sidebarToggle').click(function() {
      $('#sidebarMenu').toggleClass('show');
    });

    // Modal for search report
    $('#search_report, #search_report_sidebar').click(function() {
      uni_modal("Search Request Report", "report/search.php");
    });
  });
</script>
