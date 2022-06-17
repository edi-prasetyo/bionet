<?php $meta = $this->meta_model->get_meta(); ?>




<div id="myCarousel" class="carousel slide my-5" data-bs-ride="carousel">
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






<!-- <section class="bg-white py-5">
    <div class="container py-5">
        <h1 class="py-3"><?php if ($this->session->userdata('language') == 'EN') : ?>
                <?php echo $homepage->product_title_en; ?>
            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                <?php echo $homepage->product_title_id; ?>
            <?php else : ?>
                <?php echo $homepage->product_title_id; ?>
            <?php endif; ?>
        </h1>
        <div style="font-size:18px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo base_url('assets/img/galery/' . $homepage->product_img); ?>" class="d-block mx-lg-auto img-fluid rounded-3" alt="<?php echo $homepage->product_title_id; ?>" loading="lazy">
                </div>
                <div class="col-md-8">
                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                        <?php echo $homepage->product_desc_en; ?>
                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                        <?php echo $homepage->product_desc_id; ?>
                    <?php else : ?>
                        <?php echo $homepage->product_desc_id; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</section> -->

<section class="pt-5 pb-5 bg-light">
    <div class="container">

        <h2 class="display-4 text-center fw-bold">
            <?php if ($this->session->userdata('language') == 'EN') : ?>
                <?php echo $homepage->service_title_en; ?>
            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                <?php echo $homepage->service_title_id; ?>
            <?php else : ?>
                <?php echo $homepage->service_title_id; ?>
            <?php endif; ?>
        </h2>



        <div class="row d-flex mb-5">

            <?php foreach ($layanan as $layanan) : ?>
                <div class="col-10 mx-auto col-md-4">
                    <div class="my-3 card card-body shadow p-4 ">
                        <div class="row align-items-center d-flex text-md-center text-lg-start">
                            <div class="col-12 col-sm-3 col-md-3 text-center px-0">
                                <div class="icon-wrap text-primary my-3 display-3">
                                    <?php echo $layanan->layanan_icon; ?>
                                </div>
                            </div>
                            <div class="col-12 col-md-9 mt-3 mt-lg-0">
                                <h3 class="">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        <?php echo $layanan->layanan_name_en; ?>
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        <?php echo $layanan->layanan_name_id; ?>
                                    <?php else : ?>
                                        <?php echo $layanan->layanan_name_id; ?>
                                    <?php endif; ?>
                                </h3>
                                <p class=" mb-0">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        <?php echo $layanan->layanan_desc_en; ?>
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        <?php echo $layanan->layanan_desc_id; ?>
                                    <?php else : ?>
                                        <?php echo $layanan->layanan_desc_id; ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>








<section class="my-5">
    <div class="container">
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
                            <a href="<?php echo base_url('product/order/' . md5($product_monthly->id)); ?>">Order</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>









<!-- <section>
    <div class="container px-4 py-5 my-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="<?php echo base_url('assets/img/galery/' . $homepage->about_img); ?>" class="d-block mx-lg-auto img-fluid rounded-3" width="100%" alt="<?php echo $homepage->about_title_id; ?>" loading=" lazy">
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold">

                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                <?php echo $homepage->about_title_en; ?>
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                <?php echo $homepage->about_title_id; ?>
                            <?php else : ?>
                                <?php echo $homepage->about_title_id; ?>
                            <?php endif; ?>

                        </h1>
                        <p style="font-size:18px;">
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                <?php echo $homepage->about_desc_en; ?>
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                <?php echo $homepage->about_desc_id; ?>
                            <?php else : ?>
                                <?php echo $homepage->about_desc_id; ?>
                            <?php endif; ?>

                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="my-5 mt-5">
    <div class="container">
        <h2 class="display-5 mb-5">
            <?php if ($this->session->userdata('language') == 'EN') : ?>
                News Updates
            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                Berita Terkini
            <?php else : ?>
                Berita Terkini
            <?php endif; ?>
        </h2>
        <div class="row">
            <?php foreach ($berita as $berita) : ?>
                <div class="col-md-4">
                    <div class="post-slide3">
                        <div class="post-img">
                            <img src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>" alt="">
                            <span class="post-icon">
                                <i class="fa fa-book"></i>
                            </span>
                        </div>
                        <div class="post-body">
                            <ul class="post-bar">
                                <li><?php echo date('j M Y', strtotime("$berita->date_created")); ?></li>
                                <li>
                                    <a href="<?php echo base_url('category/item/' . $berita->category_slug); ?>"><?php echo $berita->category_name; ?></a>

                                </li>
                            </ul>
                            <h3 class="post-title"><a href="<?php echo base_url('berita/detail/' . $berita->berita_slug); ?>">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        <?php echo $berita->berita_title_en; ?>
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        <?php echo $berita->berita_title_id; ?>
                                    <?php else : ?>
                                        <?php echo $berita->berita_title_id; ?>
                                    <?php endif; ?>
                                </a></h3>
                            <p class="post-description">
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <?php echo substr($berita->berita_desc_en, 0, 95); ?>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <?php echo substr($berita->berita_desc_id, 0, 95); ?>
                                <?php else : ?>
                                    <?php echo substr($berita->berita_desc_id, 0, 95); ?>
                                <?php endif; ?> </p>
                            <a href="<?php echo base_url('berita/detail/' . $berita->berita_slug); ?>" class="read-more">
                                <i class="fa fa-long-arrow-right"></i>
                                <span>
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        Read More
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        Selengkapnya
                                    <?php else : ?>
                                        Selengkapnya
                                    <?php endif; ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>