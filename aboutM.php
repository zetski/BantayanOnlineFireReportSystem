<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Fire Reporting System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: Arial, sans-serif;
            background-image: url('./officerimg/firebg.webp');
            background-size: cover;
            background-position: center;
        }

        /* Container for the whole page */
        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background-color: #f45000;
            color: white;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .header .back-button {
            color: white;
            text-decoration: none;
            margin-right: auto;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .header .back-button i {
            margin-right: 8px;
        }

        .header h1 {
            flex: 1;
            text-align: center;
            font-size: 15px;
        }

        /* Content Section */
        .content {
            flex: 1;
            text-align: center;
            background-color: rgba(249, 249, 249, 0.8);
            padding: 50px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 30px;
        }

        .mission, .vision {
            font-size: 24px;
            font-weight: bold;
            color: black;
            margin-bottom: 10px;
        }

        /* Officers Carousel Section */
        .carousel-container {
            position: relative;
            width: 100%;
            max-width: 300px;
            overflow: hidden;
            /* background-image: url('./firebg.webp');
            background-size: cover;
            background-position: center; */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease;
        }

        .officer {
            min-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .officer img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .officer h3 {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }

        /* Carousel buttons */
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .prev-btn {
            left: 10px;
        }

        .next-btn {
            right: 10px;
        }

        /* Footer */
        .footer {
            background-color: #808080;
            padding: 20px 10px;
            color: white;
            display: flex;
            justify-content: space-around;
            align-items: center;
            font-size: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer .contact-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: white;
        }

        .footer .contact-item i {
            font-size: 20px;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            color: #ff4600;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .mission, .vision {
                font-size: 20px;
            }

            .officer img {
                width: 100px;
                height: 100px;
            }

            .footer {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .mission, .vision {
                font-size: 18px;
            }

            .footer .contact-item {
                font-size: 14px;
            }

            .footer .contact-item i {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header with Back Button -->
        <header class="header">
            <a href="./" class="back-button">
                <i class="fas fa-arrow-left"></i> 
            </a>
            <h1>Online Fire Reporting System</h1>
        </header>

        <!-- Content Section -->
        <div class="content">
            <!-- Mission and Vision Section -->
            <div class="mission">Mission</div>
            <p>Prevent and suppress destructive fires, investigate their causes, enforce fire codes and other related laws, and respond to man-made and natural disasters and other emergencies.</p>
            <div class="vision">Vision</div>
            <p>A modern fire service fully capable of ensuring a fire-safe nation by 2034.</p>

            <!-- Officers Carousel Section -->
            <div class="carousel-container">
                <button class="carousel-btn prev-btn" onclick="prevSlide()">&#10094;</button>
                <div class="carousel" id="carousel">
                    <div class="officer">
                        <img src="./officerimg/aspin.jpg" alt="Officer 1">
                        <h3>Officer 1</h3>
                    </div>
                    <div class="officer">
                        <img src="./officerimg/dlaw.jpg" alt="Officer 2">
                        <h3>Officer 2</h3>
                    </div>
                    <div class="officer">
                        <img src="./officerimg/gear5.jpg" alt="Officer 3">
                        <h3>Officer 3</h3>
                    </div>
                </div>
                <button class="carousel-btn next-btn" onclick="nextSlide()">&#10095;</button>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <span>09481752040</span>
            </div>
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <a href="mailto:bantayancentral@gmail.com">bfpmadridejos@gmail.com</a>
            </div>
            <div class="contact-item">
                <i class="fab fa-facebook"></i>
                <a href="https://facebook.com" target="_blank">facebook.com</a>
            </div>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>Poblacion, Bantayan, Cebu</span>
            </div>
        </footer>
    </div>

    <script>
        let currentSlide = 0;

        function showSlide(index) {
            const carousel = document.getElementById('carousel');
            const totalSlides = document.querySelectorAll('.officer').length;
            
            if (index >= totalSlides) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = totalSlides - 1;
            } else {
                currentSlide = index;
            }
            
            const offset = -currentSlide * 100;
            carousel.style.transform = `translateX(${offset}%)`;
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }
    </script>
</body>
</html>
