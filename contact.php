<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Use Fire Extinguisher</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
            margin-top: 50px;
            margin-bottom: 10px
        }
        .carousel-item>img {
            object-fit: contain !important;
            height: 100%;
            width: 100%;
        }
        #carouselExampleControls .carousel-inner {
            height: 35em !important;
        }
        .carousel-item {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .carousel .carousel-item {
            transition: none;
        }
        .instruction-card {
            border: 1px solid #000;
            padding: 20px;
            margin-top: 20px;
        }
        .instruction-step {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .instruction-step img {
            width: 50px;
            height: 50px;
            margin-right: 20px;
        }
        .instruction-step p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
                            $upload_path = "uploads/contact";
                            if(is_dir(base_app.$upload_path)): 
                            $file = scandir(base_app.$upload_path);
                            $_i = 0;
                                foreach($file as $img):
                                    if(in_array($img, array('.', '..')))
                                        continue;
                            $_i++;
                        ?>
                        <div class="carousel-item h-100 <?php echo $_i == 1 ? "active" : '' ?>">
                            <img src="<?php echo validate_image($upload_path.'/'.$img) ?>" class="d-block w-100 h-100" alt="<?php echo $img ?>">
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="instruction-card">
                    <h3 class="text-center">How to Use Fire Extinguisher</h3>
                    <center><hr style="height:2px;width:5em;opacity:1" class="bg-danger"></center>
                    <div class="instruction-step">
                        <img src="img/usa.jpg">
                        <p>Pull the pin in the handle</p>
                    </div>
                    <div class="instruction-step">
                        <img src="img/singko.jpg">
                        <p>Aim the nozzle at the base of the fire</p>
                    </div>
                    <div class="instruction-step">
                        <img src="img/aim.jpg">
                        <p>Squeeze the lever slowly</p>
                    </div>
                    <div class="instruction-step">
                        <img src="img/swep.jpg">
                        <p>Sweep from side to side</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Use Fire Extinguisher</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
            margin-top: 50px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .carousel-item>img {
            object-fit: contain !important;
            height: 100%;
            width: 100%;
        }
        #carouselExampleControls .carousel-inner {
            height: 35em !important;
            position: relative;
        }
        .carousel-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
            opacity: 0;
            z-index: 1;
        }
        .carousel-item.active {
            transform: translateX(0);
            opacity: 1;
            z-index: 2;
        }
        .carousel-item-next, .carousel-item-prev {
            transform: translateX(100%);
            z-index: 3;
        }
        .carousel-item-prev {
            transform: translateX(-100%);
        }
        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: #000;
            border-radius: 50%;
        }
        .instruction-card {
            border: 1px solid #000;
            padding: 20px;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .instruction-card:hover {
            transform: translateY(-5px);
        }
        .instruction-step {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in-out;
        }
        .instruction-step img {
            width: 50px;
            height: 50px;
            margin-right: 20px;
            transition: transform 0.3s;
        }
        .instruction-step img:hover {
            transform: scale(1.2);
        }
        .instruction-step p {
            margin: 0;
            font-size: 1.1em;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
                            $upload_path = "uploads/contact";
                            if(is_dir(base_app.$upload_path)): 
                            $file = scandir(base_app.$upload_path);
                            $_i = 0;
                                foreach($file as $img):
                                    if(in_array($img, array('.', '..')))
                                        continue;
                            $_i++;
                        ?>
                        <div class="carousel-item h-100 <?php echo $_i == 1 ? "active" : '' ?>">
                            <img src="<?php echo validate_image($upload_path.'/'.$img) ?>" class="d-block w-100 h-100" alt="<?php echo $img ?>">
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="instruction-card">
                    <h3 class="text-center">How to Use Fire Extinguisher</h3>
                    <center><hr style="height:2px;width:5em;opacity:1" class="bg-danger"></center>
                    <div class="instruction-step">
                        <img src="img/usa.jpg">
                        <p>Pull the pin in the handle</p>
                    </div>
                    <div class="instruction-step">
                        <img src="img/singko.jpg">
                        <p>Aim the nozzle at the base of the fire</p>
                    </div>
                    <div class="instruction-step">
                        <img src="img/aim.jpg">
                        <p>Squeeze the lever slowly</p>
                    </div>
                    <div class="instruction-step">
                        <img src="img/swep.jpg">
                        <p>Sweep from side to side</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
