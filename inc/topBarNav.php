<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fire Reporting System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #2980B9;
        }
        .navbar-brand img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            margin-right: 20px;
        }
        .navbar-nav .nav-link:hover {
            color: #ffdd57 !important;
        }
        .navbar-nav .active {
            color: #ffdd57 !important;
        }
        .login {
            color: #fff !important;
            font-weight: bold;
        }
        .login:hover {
            color: #ffdd57 !important;
        }
        .navbar-brand, .navbar-nav {
            margin-left: 0; /* Reset the margin to default */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container px-4 px-lg-5">
            <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="./">
                <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Bantayan BFP" loading="lazy">
                <?php echo $_settings->info('short_name') ?>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="./">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./?p=report">Report</a></li>
                    <li class="nav-item"><a class="nav-link" id="search_report" href="javascript:void(0)">View Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="./?p=about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="./?p=contact">FireSafety</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <a class="login text-decoration-none" href="./admin">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
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
