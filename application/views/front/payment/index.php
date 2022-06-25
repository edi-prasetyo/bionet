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

                </div>



                <!-- Midtrans -->


                <form action="<?php echo site_url() ?>payment/vtweb_checkout" method="POST" id="payment-form">
                    <input type="hidden" id="transaksi_id" name="transaksi_id" value="<?php echo $transaction->id; ?>">
                    <input type="hidden" id="gross_amount" name="gross_amount" value="<?php echo $transaction->total_amount; ?>">
                    <input type="hidden" id="amount" name="amount" value="<?php echo $transaction->amount; ?>">
                    <input type="hidden" id="name" name="name" value="<?php echo $transaction->product_name; ?>">
                    <input type="hidden" id="first_name" name="first_name" value="<?php echo $transaction->fullname; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $transaction->email; ?>">
                    <input type="hidden" id="phone" name="phone" value="<?php echo $transaction->whatsapp; ?>">


                    <button class="btn btn-success" type="submit">Submit Payment</button>
                </form>

                <!-- /Midtrans -->

            </div>
        </div>
    </div>
</div>