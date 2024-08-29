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
        margin-top: 20px;
    }
</style>
<div class="container">
    <div class="content">
    </div>
    <div class="row mt-lg-n4 mt-md-n4 justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card rounded-0">
            <div class="card-body">
                        <h3 class="text-center"><b>Contact Us</b></h3>
                        <center><hr style="height:2px;width:5em;opacity:1" class="bg-danger"></center>
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
<script>
    $(function(){
    })
</script>
