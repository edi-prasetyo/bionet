<div class="container my-5 pt-5">
    <div class="row m-0">
        <div class="col-md-7 col-12 mx-auto">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="row box-right">
                        <div class="col-md-7 ps-0 ">
                            <p class="textmuted fw-bold h6 mb-0">TOTAL PEMBELIAN</p>
                            <p class="h1 fw-bold d-flex">Rp. <?php echo number_format($product->price, 0, ",", "."); ?> </p>
                            <p class="ms-3 px-2 bg-green">per Bulan</p>
                        </div>
                        <div class="col-md-5">
                            <h3><?php echo $product->product_name; ?></h3>
                            <p class="text-muted"><?php echo $product->description; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 px-0">
                    <div class="box-right">
                        <div class="d-flex mb-2">
                            <p class="fw-bold">Informasi Pelanggan</p>

                        </div>
                        <?php echo form_open('product/order/' . md5($product->id)); ?>
                        <div class="row">

                            <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product->product_name; ?>">
                            <input type="hidden" name="amount" value="<?php echo $product->price; ?>">
                            <input type="hidden" name="total_amount" value="<?php echo $product->price; ?>">

                            <div class="col-12 mb-2">
                                <p class="textmuted h8">Nama Lengkap</p>
                                <input class="form-control" name="fullname" type="text" placeholder="Nama Lengkap">
                            </div>
                            <div class="col-6">
                                <p class="textmuted h8">email</p>
                                <input class="form-control" name="email" type="text" placeholder="email">
                            </div>
                            <div class="col-6">
                                <p class="textmuted h8">Whatsapp</p>
                                <input class="form-control" name="whatsapp" type="text" placeholder="Whatsapp">
                            </div>
                            <div class="col-12 mt-2">
                                <p class="textmuted h8">Alamat</p>
                                <textarea class="form-control" name="address" placeholder="Alamat"></textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary btn-block">Checkout</button>
                            </div>

                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>