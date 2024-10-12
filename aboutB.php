<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container for the whole page */
        .container {
            text-align: center;
            background-color: #f9f9f9;
            padding-bottom: 50px;
        }

        /* About Us Section */
        .about-us-section {
            position: relative;
            background-image: url('./officerimg/bfpbg.jpg'); /* Replace with your actual image path */
            background-size: cover;
            background-position: center;
            height: 400px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Dark overlay for better text visibility */
        .about-us-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .about-us-section h1,
        .about-us-section .mission,
        .about-us-section .vision {
            z-index: 2;
            position: relative;
            color: white;
        }

        .about-us-section h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .mission, .vision {
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* Officers Section */
        .carousel-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            margin-top: 30px;
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease;
        }

        .officer {
            min-width: 100%;
            transition: transform 0.5s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .officer img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white; /* White stroke */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Drop shadow */
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

        /* Hide buttons on large screens */
        @media (min-width: 768px) {
            .carousel-btn {
                display: none;
            }

            .carousel {
                display: flex;
                justify-content: space-around;
            }

            .officer {
                min-width: auto;
                margin: 0 10px;
            }
        }

        /* Contact Section */
        .contact-section {
            margin-top: 50px;
        }

        .contact-section h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .contact-icons {
            display: flex;
            justify-content: center;
            gap: 30px;
            font-size: 24px;
        }

        .contact-icons a {
            color: #333;
            text-decoration: none;
        }

        .contact-icons a:hover {
            color: #ff4600;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- About Us Section -->
        <div class="about-us-section">
            <div class="mission">Mission</div>
            <p>Prevent and suppress destructive fires, investigate their causes, enforce fire codes and other related laws, and respond to man-made and natural disasters and other emergencies.</p>
            <div class="vision">Vision</div>
            <p>A modern fire service fully capable of ensuring a fire-safe nation by 2034.</p>
        </div>

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

        <!-- Contact Section -->
        <div class="contact-section">
            <h2>Contact Us</h2>
            <div class="contact-icons">
                <a href="tel:+09538278512"><i class="fas fa-phone"></i></a>
                <a href="mailto:bgf@gmail.com"><i class="fas fa-envelope"></i></a>
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.bfp.com" target="_blank"><i class="fas fa-globe"></i></a>
            </div>
        </div>
    </div>

    <script>
        let currentSlide = 0;

        function showSlide(index) {
            const carousel = document.getElementById('carousel');
            const totalSlides = document.querySelectorAll('.officer').length;
            
            // Ensure index is within bounds
            if (index >= totalSlides) {
                currentSlide = 0; // Loop back to the first slide
            } else if (index < 0) {
                currentSlide = totalSlides - 1; // Loop to the last slide
            } else {
                currentSlide = index;
            }
            
            const offset = -currentSlide * 100; // Slide width is 100%
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
