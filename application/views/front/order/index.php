<?php
$meta = $this->meta_model->get_meta();
// error_reporting(0);
// ini_set('display_errors', 0);
?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $meta->title ?> | <?php echo $meta->tagline ?></title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo/' . $meta->favicon); ?>">
    <meta name="description" content="<?php echo $deskripsi ?>">
    <meta name="keywords" content="<?php echo $meta->title . ',' . $keywords ?>">
    <meta name="author" content="<?php echo $meta->title ?>">
    <meta name="google-site-verification" content="<?php echo $meta->google_meta ?>" />
    <meta name="msvalidate.01" content="<?php echo $meta->bing_meta ?>" />

    <link rel="canonical" href="<?php echo base_url(); ?>" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $meta->title . ',' . $keywords ?>" />
    <meta property="og:description" content="<?php echo $deskripsi ?>" />
    <meta property="og:url" content="<?php echo base_url(); ?>" />
    <meta property="og:image" content="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>" />
    <meta property="og:site_name" content="<?php echo $meta->title ?>" />
    <meta name="twitter:description" content="<?php echo $deskripsi ?>" />
    <meta name="twitter:title" content="<?php echo $meta->title ?>" />



    <!-- Vendor CSS Files -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/web/vendor/bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/web/vendor/offcanvas/offcanvas.css">
    <link href="<?php echo base_url('assets/template/web/vendor/icons/feather-icons/feather.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/web/vendor/icons/fontawesome/css/all.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/web/vendor/bootstrap-icons/bootstrap-icons.css'); ?>">
    <!-- flag-icon-css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/web/vendor/flag-icon-css/css/flag-icon.min.css'); ?>">
    <!-- Custom CSS File -->
    <link href="<?php echo base_url('assets/template/web/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/web/css/custom.css'); ?>" rel="stylesheet">



    <!-- Midtrans Payment -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="your_client_key"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    $id             = $this->session->userdata('id');
    $user           = $this->user_model->user_detail($id);
    $meta           = $this->meta_model->get_meta();
    $menu           = $this->menu_model->get_menu();
    ?>




    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img style="height:60px;" src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>"></a>
            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size: 18px;">
                    <?php foreach ($menu as $menu) : ?>
                        <li class="nav-item me-3 ms-2">
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                <a class="nav-link" aria-current="page" href="<?php echo base_url() . $menu->url; ?>"><?php echo $menu->name_en; ?></a>
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                <a class="nav-link" aria-current="page" href="<?php echo base_url() . $menu->url; ?>"><?php echo $menu->name_id; ?></a>
                            <?php else : ?>
                                <a class="nav-link" aria-current="page" href="<?php echo base_url() . $menu->url; ?>"><?php echo $menu->name_id; ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo base_url('contact'); ?>">
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                contact Us
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                Hubungi Kami
                            <?php else : ?>
                                Hubungi Kami
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>

                <ul class="nav" style="font-size: 18px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                <i class="flag-icon flag-icon-us mr-2 border"></i> <?php echo $this->session->userdata('language', 'EN'); ?> <i class="feather-chevron-down"></i>
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                <i class="flag-icon flag-icon-id mr-2 border"></i> <?php echo $this->session->userdata('language', 'ID'); ?> <i class="feather-chevron-down"></i>
                            <?php else : ?>
                                <i class="flag-icon flag-icon-id mr-2 border"></i> ID <i class="feather-chevron-down"></i>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="<?php echo base_url('language/translate/ID'); ?>">Indonesia</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('language/translate/EN'); ?>">English</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary text-white" href="https://api.whatsapp.com/send?phone=<?php echo $meta->whatsapp; ?>">
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                Get Quote
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                Minta Penawaran
                            <?php else : ?>
                                Minta Penawaran
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5 pt-5">

        <div class="col-md-7 mx-auto">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div>Invoice</div>
                    <div><?php echo $transaction->invoice_number; ?></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            Nama Pelanggan : <?php echo $transaction->fullname; ?><br>
                            Alamat : <?php echo $transaction->address; ?>

                        </div>
                        <div class="col-6 text-end">
                            No. Whatsapp : <?php echo $transaction->whatsapp; ?><br>
                            Email : <?php echo $transaction->email; ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Amount</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><?php echo $transaction->product_name; ?></th>
                                        <td>1</td>
                                        <td><?php echo number_format($transaction->amount, 0, ",", "."); ?></td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex h7 mb-2">
                            <p class="">Total Amount</p>
                            <p class="ms-auto">Rp. <?php echo number_format($transaction->total_amount, 0, ",", "."); ?></p>
                        </div>
                        <div class="h8 mb-5">
                            <p class="alert alert-danger">Silahkan lakukan Pembayaran Sebelum tanggal 14 januari 2022 </p>
                        </div>
                    </div>



                </div>
            </div>

        </div>


    </div>


    <div class="form my-5 pt-5">
        <div class="container">
            <div class="d-grid gap-2">

                <!-- Midtrans -->
                <form id="payment-form" method="post" action="<?= site_url('order/finish/' . $transaction->id) ?>">
                    <input type="hidden" name="result_type" id="result-type" value="">
                    <input type="hidden" name="result_data" id="result-data" value="">
                    <input type="hidden" id="gross_amount" name="gross_amount" value="<?php echo $transaction->total_amount; ?>">
                    <input type="hidden" id="amount" name="amount" value="<?php echo $transaction->amount; ?>">
                    <input type="hidden" id="name" name="name" value="<?php echo $transaction->product_name; ?>">
                    <input type="hidden" id="first_name" name="first_name" value="<?php echo $transaction->fullname; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $transaction->email; ?>">
                    <input type="hidden" id="phone" name="phone" value="<?php echo $transaction->whatsapp; ?>">
                    <button class="btn btn-primary btn-block h8" id="pay-button">Bayar <span class="ms-3 fas fa-arrow-right"></span></button>

                </form>



                <!-- /Midtrans -->

            </div>
        </div>
    </div>









    <!-- Load javascript Jquery -->
    <!-- <script src="<?php echo base_url() ?>assets/template/web/vendor/jquery/jquery.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>assets/template/web/vendor/bootstrap/bootstrap.bundle.min.js"></script> -->
    <script src="<?php echo base_url() ?>assets/template/web/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/template/web/vendor/offcanvas/offcanvas.js" type="text/javascript"></script>

    <!-- Color Picker JS -->


    <!-- Midtrans Payment -->
    <script type="text/javascript">
        $('#pay-button').click(function(event) {
            event.preventDefault();
            $(this).attr("disabled", "disabled");

            var gross_amount = $('#gross_amount').val();
            var amount = $('#amount').val();
            var name = $('#name').val();
            var first_name = $('#first_name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();

            $.ajax({
                type: 'post',
                url: '<?= site_url() ?>order/token',
                data: {
                    gross_amount: gross_amount,
                    amount: amount,
                    name: name,
                    first_name: first_name,
                    email: email,
                    phone: phone
                },
                cache: false,

                success: function(data) {
                    //location = data;

                    console.log('token = ' + data);

                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type, data) {
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                        //resultType.innerHTML = type;
                        //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {

                        onSuccess: function(result) {
                            changeResult('success', result);
                            console.log(result.status_message);
                            console.log(result);
                            $("#payment-form").submit();
                        },
                        onPending: function(result) {
                            changeResult('pending', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        },
                        onError: function(result) {
                            changeResult('error', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        }
                    });
                }
            });
        });
    </script>



</body>

</html>