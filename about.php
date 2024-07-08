<section class="py-5">
    <div class="container">
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
</section>