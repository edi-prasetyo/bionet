<?php $meta = $this->meta_model->get_meta(); ?>




<div id="myCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <?php $i = 1;
        foreach ($slider as $slider) { ?>
            <div class="carousel-item <?php if ($i == 1) {
                                            echo 'active';
                                        } ?> ">
                <a href="<?php echo base_url() . $slider->galery_url; ?>"><img style="border-radius: 5px;" class="img-fluid" width="100%" src="<?php echo base_url('assets/img/galery/' . $slider->galery_img) ?>" alt="<?php echo $slider->galery_title ?>"></a>

            </div>
        <?php $i++;
        } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>




<section class="pt-5 pb-5 bg-light">
    <div class="container my-5">

        <h2 class="text-center">
            <?php if ($this->session->userdata('language') == 'EN') : ?>
                <?php echo $homepage->service_title_en; ?>
            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                <?php echo $homepage->service_title_id; ?>
            <?php else : ?>
                <?php echo $homepage->service_title_id; ?>
            <?php endif; ?>
        </h2>


        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <?php foreach ($layanan as $layanan) : ?>
                <div class="feature col text-center">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-primary bg-gradient text-white fs-2 mb-3 p-5 rounded">
                        <?php echo $layanan->layanan_icon; ?>
                    </div>
                    <h3><?php if ($this->session->userdata('language') == 'EN') : ?>
                            <?php echo $layanan->layanan_name_en; ?>
                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                            <?php echo $layanan->layanan_name_id; ?>
                        <?php else : ?>
                            <?php echo $layanan->layanan_name_id; ?>
                        <?php endif; ?></h3>
                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                        <?php echo $layanan->layanan_desc_en; ?>
                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                        <?php echo $layanan->layanan_desc_id; ?>
                    <?php else : ?>
                        <?php echo $layanan->layanan_desc_id; ?>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

        </div>


    </div>



</section>




<section class="my-5">
    <div class="container pb-5">
        <h2 class="text-center my-5 pb-5">
            Pilihan Paket
        </h2>
        <div class="row">

            <?php foreach ($product_monthly as $product_monthly) : ?>

                <div class="col-md-3 col-sm-6">
                    <div class="pricingTable 
                    <?php if ($product_monthly->product_name == "Basic") {
                        echo "green";
                    } elseif ($product_monthly->product_name == "Standard") {
                        echo "blue";
                    } elseif ($product_monthly->product_name == "Premium") {
                        echo "red";
                    } else {
                    }; ?>">
                        <div class="pricingTable-header">

                            <div class="price-value"> Rp. <?php echo number_format($product_monthly->price, 0, ",", "."); ?> <span class="month">Per Bulan</span> </div>
                        </div>
                        <h3 class="heading"><?php echo $product_monthly->product_name; ?></h3>
                        <div class="pricing-content">
                            <ul>
                                <li>Up to <b><?php echo $product_monthly->speed; ?></b> Mbps</li>
                                <li>Download Speed<b><?php echo $product_monthly->speed_download; ?></b> Mbps</li>
                                <li>Upload Speed<b><?php echo $product_monthly->speed_upload; ?></b> Mbps</li>
                                <li><?php echo $product_monthly->kuota; ?></li>
                            </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="<?php echo base_url('product/order/' . md5($product_monthly->id)); ?>">Berlangganan</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>






<section class="bg-success">
    <div class="container my-5 pb-5">
        <h2 class="text-center my-5 pb-5 text-white">
            Voucher Wifi
        </h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($product_voucher as $product_voucher) : ?>
                <div class="col-md-3">
                    <div class="card shadow border">
                        <div class="card-body">
                            <h4><?php echo $product_voucher->product_name; ?></h4>
                            <h2 class="fw-bold">Rp. <?php echo number_format($product_voucher->price, 0, ",", "."); ?></h2>
                            <p class="card-text">
                                Speed Up to <?php echo $product_voucher->speed; ?> Mbps</p>
                        </div>
                        <div class="card-footer">

                            <div class="d-grid gap-2">
                                <a href="<?php echo base_url('product/order/' . md5($product_voucher->id)); ?>" class="btn btn-success text-white">Beli Voucher</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>