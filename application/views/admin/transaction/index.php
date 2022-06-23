<?php
if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
    unset($_SESSION['message']);
}
?>



<!-- Striped Rows -->
<div class="card">
    <h5 class="card-header"><?php echo $title; ?></h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="3%">No</th>
                    <th>tanggal</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>type</th>
                    <th>Harga</th>
                    <th>status</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                <?php $no = 1;
                foreach ($transaction as $data) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($data->created_at)); ?></td>
                        <td><?php echo $data->fullname; ?></td>
                        <td><?php echo $data->product_name; ?></td>
                        <td><?php echo $data->product_type; ?></td>
                        <td>Rp <?php echo number_format($data->total_amount, 0, ",", "."); ?></td>
                        <td><span class="badge bg-label-success me-1"><?php echo $data->payment_status; ?></span></td>
                        <td>
                            <a href="<?php echo base_url('admin/transaction/detail/') . $data->id; ?>" class="btn btn-primary text-white btn-sm"><i class="bx bx-ghost"></i> Lihat</a>
                        </td>
                    </tr>

                <?php $no++;
                }; ?>



            </tbody>
        </table>

        <div class="card-footer bg-white p-0 m-0 pt-3 ps-5">
            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>
        </div>
    </div>
</div>
<!--/ Striped Rows -->