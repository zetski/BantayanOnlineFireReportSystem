<style>
  .user-img {
    position: absolute;
    height: 27px;
    width: 27px;
    object-fit: cover;
    left: -7%;
    top: -12%;
  }

  .user-dd:hover {
    color: #fff !important;
  }

  /* Sidebar styling */
  .sidebar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1000; /* Ensure it overlays above all content */
    top: 0;
    left: 0;
    background-color: #ff4600;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }

  .sidebar a {
    padding: 10px 15px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
    transition: 0.3s;
  }

  .sidebar a:hover {
    color: #f1f1f1;
  }

  .sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
  }

  .navbar {
    background-color: #ff4600 !important;
  }
</style>

<!-- Sidebar Structure -->
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="./">Home</a>
  <a href="./?p=report">Report</a>
  <a href="javascript:void(0)" id="search_report">View Status</a>
  <a href="./?p=about">About Us</a>
  <a href="./?p=contact">Contact Us</a>
  <a href="./admin">Login</a>
</div>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container px-4 px-lg-5">
    <!-- Button to open the sidebar -->
    <button class="navbar-toggler btn btn-sm" type="button" onclick="openNav()">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="./">
      <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      <?php echo $_settings->info('short_name') ?>
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
        <li class="nav-item"><a class="nav-link text-white" aria-current="page" href="./">Home</a></li>
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


<script>
  $(function() {
    $('#search_report').click(function() {
      uni_modal("Search Request Report", "report/search.php");
    });

    $('#navbarSupportedContent').on('show.bs.collapse', function() {
      $('.navbar').addClass('navbar-shrink');
    });

    $('#navbarSupportedContent').on('hidden.bs.collapse', function() {
      if ($(window).scrollTop() === 0) {
        $('.navbar').removeClass('navbar-shrink');
      }
    });

    $('#search-form').submit(function(e) {
      e.preventDefault();
      var sTxt = $('[name="search"]').val();
      if (sTxt != '') {
        location.href = './?p=products&search=' + sTxt;
      }
    });
  });

  function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
  }
</script>

