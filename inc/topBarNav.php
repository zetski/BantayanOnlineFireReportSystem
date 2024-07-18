<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Sidebar and Navbar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
    .sidebar {
      height: 100%;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #2980B9;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }
    .sidebar a {
      padding: 10px 15px;
      text-decoration: none;
      font-size: 25px;
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
      margin-left: 50px;
    }
    .openbtn {
      font-size: 20px;
      cursor: pointer;
      background-color: #2980B9;
      color: white;
      padding: 10px 15px;
      border: none;
    }
    .openbtn:hover {
      background-color: #444;
    }
    @media screen and (max-height: 450px) {
      .sidebar {padding-top: 15px;}
      .sidebar a {font-size: 18px;}
    }
    @media (min-width: 768px) {
      .sidebar {width: 250px;}
      .content {margin-left: 250px;}
    }
  </style>
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="./">Home</a>
    <a href="./?p=report">Report</a>
    <a href="javascript:void(0)" id="search_report">View Status</a>
    <a href="./?p=about">About Us</a>
    <a href="./?p=contact">FireSafety</a>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#2980B9">
    <div class="container px-4 px-lg-5">
      <button class="openbtn" onclick="openNav()">☰</button>
      <a class="navbar-brand" href="./">
        <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
        <?php echo $_settings->info('short_name') ?>
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex align-items-center ms-auto">
          <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./admin">Login</a>
        </div>
      </div>
    </div>
  </nav>
</div>

<!-- Content -->
<div class="content">
  <!-- Your page content goes here -->
  <div class="container mt-5 pt-5">
    <h1>WELCOME</h1>
    <p>"Together, we continue to empower first responders with data and insights that drive quality and performance improvements across the entire health and public safety spectrum"</p>
    <p>Fire safety is the set of practices intended to reduce the destruction caused by fire. Fire safety measures include those that are intended to prevent ignition of an uncontrolled fire, and those that are used to limit development and effects of a fire after it starts.</p>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
  function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.querySelector(".content").style.marginLeft = "250px";
  }

  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.querySelector(".content").style.marginLeft = "0";
  }

  $(function() {
    $('#search_report').click(function() {
      uni_modal("Search Request Report", "report/search.php");
    });

    $('#navbarResponsive').on('show.bs.collapse', function() {
      $('#mainNav').addClass('navbar-shrink');
    });

    $('#navbarResponsive').on('hidden.bs.collapse', function() {
      if ($('body').offset.top == 0)
        $('#mainNav').removeClass('navbar-shrink');
    });

    $('#search-form').submit(function(e) {
      e.preventDefault();
      var sTxt = $('[name="search"]').val();
      if (sTxt != '')
        location.href = './?p=products&search=' + sTxt;
    });
  });
</script>

</body>
</html>
