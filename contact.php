<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Fashion Recomendation-Contact</title>
    <?php require('inc/links.php') ?>
</head>

<body>
    <?php require('inc/header.php') ?>
    <!-- Contact Hero Section -->
    <section class="page-hero">
        <div class="hero-content">
            <h1 data-aos="fade-up">Contact Us</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="200">Get in touch with our fashion experts</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="section contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="contact-info">
                        <h2 class="mb-4">Get In Touch</h2>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Location</h4>
                                <p>123 Fashion Street, Style City, SC 12345</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>Phone</h4>
                                <p>+1 9820355989</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email</h4>
                             <a href="mailto: qudsiyas954@gmail.com" class="text-decoration-none a-contact" >qudsiyas954@gmail.com</a>   
                            </div>
                        </div>
                        <div class="social-links mt-4">
                            <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="contact-form">
                        <form id="contactForm" method="POST">
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" placeholder="Your Name" name="name" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="email" class="form-control" placeholder="Your Email" name="email" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" placeholder="Subject" name="subject" required>
                            </div>
                            <div class="form-group mb-4">
                                <textarea class="form-control" rows="5" placeholder="Your Message" name="message" required></textarea>
                            </div>
                            <button type="submit" name="send" class="btn btn-custom">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
if(isset($_POST['send'])) {
    $frm_data = filteration($_POST);
    $q = "INSERT INTO `contact`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];
    $res = insert($q,$values,"ssss"); 
    if($res==1) {
        alert('success', 'Mail Send');
    } else {
        alert('error', 'Mail Not Send Server Down');
    }

}


?>

   

    <?php require('inc/footer.php') ?>

    <script type="module" src="main.js"></script>
    <?php require('inc/scripts.php')  ?>
</body>

</html>