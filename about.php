<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card rounded-0">
                    <div class="card-body">
                        <?= htmlspecialchars_decode(file_get_contents('./about.html')) ?>
                        <div style="margin-left: 50px">
                            <h5>Contact Us</h5>
                            <dl>
                                <dt>Email</dt>
                                <dd><?= $_settings->info('email') ?></dd>
                                <dt>Telephone No</dt>
                                <dd><?= $_settings->info('phone') ?></dd>
                                <dt>Mobile No</dt>
                                <dd><?= $_settings->info('mobile') ?></dd>
                                <dt>Address</dt>
                                <dd><?= $_settings->info('address') ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div id="officer-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="officer1.jpg" class="d-block w-100" alt="Officer 1">
                        </div>
                        <div class="carousel-item">
                            <img src="officer2.jpg" class="d-block w-100" alt="Officer 2">
                        </div>
                        <div class="carousel-item">
                            <img src="officer3.jpg" class="d-block w-100" alt="Officer 3">
                        </div>
                        <!-- Add more carousel items as needed -->
                    </div>
                    <!-- Optional: Add navigation controls -->
                    <a class="carousel-control-prev" href="#officer-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#officer-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
