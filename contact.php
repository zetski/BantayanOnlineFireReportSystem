<style>
    .contact-icon {
        font-size: 1.5em;
        color: #dc3545; /* Bootstrap danger color */
        margin-right: 10px;
    }

    .contact-details {
        margin-top: 20px;
    }

    .contact-details dt {
        display: flex;
        align-items: center;
    }

    .contact-details dd {
        margin-left: 2em;
    }

    .content {
        margin-top: 100px;
    }

    .card {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0;
    }

    .card-body {
        flex: 1;
        padding: 20px;
    }

    .card img {
        width: 300px; /* Adjust image width */
        object-fit: cover;
        border-top-left-radius: 0.25rem; /* Match the card border radius */
        border-bottom-left-radius: 0.25rem; /* Match the card border radius */
    }
</style>

<div class="container">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12"> <!-- Increased width by using larger column sizes -->
                <div class="card rounded-0 shadow-sm">
                    <img src="your-image-url.jpg" alt="Contact Us Image" class="img-fluid"> <!-- Add your image URL here -->
                    <div class="card-body">
                        <h3 class="text-center"><b>Contact Us</b></h3>
                        <center>
                            <hr style="height:2px;width:5em;opacity:1" class="bg-danger">
                        </center>
                        <dl class="contact-details">
                            <dt class="text-muted">
                                <i class="fas fa-envelope contact-icon"></i> Email
                            </dt>
                            <dd><?= $_settings->info('email') ?></dd>
                            <dt class="text-muted">
                                <i class="fas fa-phone contact-icon"></i> Telephone #
                            </dt>
                            <dd><?= $_settings->info('phone') ?></dd>
                            <dt class="text-muted">
                                <i class="fas fa-mobile-alt contact-icon"></i> Mobile #
                            </dt>
                            <dd><?= $_settings->info('mobile') ?></dd>
                            <dt class="text-muted">
                                <i class="fas fa-map-marker-alt contact-icon"></i> Address
                            </dt>
                            <dd><?= $_settings->info('address') ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
