<style>
  .user-img {
    position: absolute;
    height: 27px;
    width: 27px;
    object-fit: cover;
    left: -7%;
    top: -12%;
  }

  .navbar-toggler {
    border: none;
  }

  .navbar-nav {
    flex-direction: column;
  }

  .navbar-collapse {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;
    background-color: #ff4600;
    box-shadow: 2px 0 5px rgba(0,0,0,0.3);
    transform: translateX(-100%);
    transition: transform 0.3s ease-in-out;
    z-index: 1000;
  }

  .navbar-collapse.show {
    transform: translateX(0);
  }

  .navbar-collapse .nav-link {
    color: white;
  }

  .navbar-collapse .nav-link:hover {
    color: #fff !important;
  }

  .navbar-brand img {
    border-radius: 50%;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#ff4600">
  <div class="container px-4 px-lg-5">
    <a class="navbar-brand" href="./">
      <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      <?php echo $_settings->info('short_name') ?>
    </a>
    <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
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

    $('.navbar-toggler').click(function() {
      $('#navbarSupportedContent').toggleClass('show');
    });

    $('#search-form').submit(function(e) {
      e.preventDefault();
      var sTxt = $('[name="search"]').val();
      if (sTxt != '')
        location.href = './?p=products&search=' + sTxt;
    });
  });
</script>
