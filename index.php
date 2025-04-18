<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Fashion Recommendation - Home</title>
    <?php require('inc/links.php') ?>
</head>

<body>
    <?php require('inc/header.php') ?>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-content">
            <h1>Discover Your Style</h1>
            <p class="lead mb-4">Get personalized fashion recommendations tailored just for you</p>
            <a href="recommendation.php" class="btn btn-custom">Get Recommendations</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="about-card">
                        <h3>Our Mission</h3>
                        <p>We help fashion enthusiasts discover their perfect style through personalized recommendations and expert guidance.</p>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="about-card">
                        <h3>Our Vision</h3>
                        <p>To revolutionize the way people discover and express their personal style through technology and fashion expertise.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Use Section -->
    <section class="section how-to-use">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="step-card">
                        <i class="fas fa-upload fa-3x mb-3"></i>
                        <h3>Upload Image</h3>
                        <p>Choose a clothing image to upload and start the journey</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-card">
                        <i class="fas fa-magic fa-3x mb-3"></i>
                        <h3>AI Style Match</h3>
                        <p>Our AI scans your image and finds similar fashion styles</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-card">
                        <i class="fas fa-thumbs-up fa-3x mb-3"></i>
                        <h3>View Suggestions</h3>
                        <p>Explore recommended outfits that match your uploaded look</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Fashion Carousel -->
    <section class="fashion-carousel-section">
        <div class="container">
            <h2 class="section-title">Trending Styles</h2>
            <div class="swiper fashion-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="images/carousel/images1.jpeg" alt="Summer Collection">
                        <h3>Summer Collection</h3>
                        <p>Elegant dresses for the perfect summer look</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1485230895905-ec40ba36b9bc?q=80&w=1170" alt="Autumn Vibes">
                        <h3>Autumn Vibes</h3>
                        <p>Cozy and stylish autumn essentials</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="images/carousel/evening.jpeg" alt="Evening Wear">
                        <h3>Evening Wear</h3>
                        <p>Sophisticated looks for special occasions</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=2070" alt="Street Style">
                        <h3>Street Style</h3>
                        <p>Urban fashion with an edge</p>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=2070" alt="Casual Chic">
                        <h3>Casual Chic</h3>
                        <p>Effortlessly stylish everyday looks</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require('inc/footer.php') ?>
    <script type="module" src="main.js"></script>
    <?php require('inc/scripts.php') ?>
</body>

</html>
