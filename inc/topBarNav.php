<style>
  /* Make logo image circular */
  .navbar-brand img {
    border-radius: 50%; /* This makes the image circular */
  }

  /* Hover effect for navbar items */
  .nav-item .nav-link {
    transition: color 0.3s ease, background-color 0.3s ease;
  }

  .nav-item .nav-link:hover {
    background-color: #fff; /* Light background on hover */
    color: #ff4600 !important; /* Text color changes to match navbar background */
  }

  /* Optional: Hover effect for the login button */
  .d-flex .text-light:hover {
    color: #ff4600 !important;
  }
  button[type="button"]{
    background-color: transparent !important;
    font-size: 15px;
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

    $('#navbarResponsive').on('show.bs.collapse', function() {
      $('#mainNav').addClass('navbar-shrink');
    });

    $('#navbarResponsive').on('hidden.bs.collapse', function() {
      if ($('body').offset().top == 0)
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
