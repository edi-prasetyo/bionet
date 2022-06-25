<div class="col-md-6">
    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>
    <?php echo form_open('admin/sender/update/' . $sender->id); ?>
    <div class="card mb-4">
        <h5 class="card-header">Whatsapp Seting</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">

            <label class="form-label">Whatsapp Notification</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class='bx bxl-whatsapp'></i></span>
                <input type="text" name="whatsapp_notif" class="form-control" value="<?php echo $sender->whatsapp_notif; ?>">
            </div>
            <label class="form-label">Whatsapp Api</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class='bx bxs-hot'></i></span>
                <input type="text" name="whatsapp_api" class="form-control" value="<?php echo $sender->whatsapp_api; ?>">
            </div>
            <div class="d-grid gap-2 col-lg-6 mt-3">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>

        </div>
    </div>

    <div class="card mb-4">
        <h5 class="card-header">Payment Gateway Seting</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">


            <label for="exampleFormControlSelect1" class="form-label">Environment</label>
            <select class="form-select" name="midtrans_environment">
                <option value="false" <?php if ($sender->midtrans_environment == 'false') {
                                            echo "selected";
                                        }; ?>>Sandbox</option>
                <option value="true" <?php if ($sender->midtrans_environment == 'true') {
                                            echo "selected";
                                        }; ?>>Production</option>
            </select>

            <label class="form-label">Server Key</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class='bx bx-wallet'></i></span>
                <input type="text" name="midtrans_server_key" class="form-control" value="<?php echo $sender->midtrans_server_key; ?>">
            </div>
            <label class="form-label">Client Key</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class='bx bx-wallet'></i></span>
                <input type="text" name="midtrans_client_key" class="form-control" value="<?php echo $sender->midtrans_client_key; ?>">
            </div>
            <div class="d-grid gap-2 col-lg-6 mt-3">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>

        </div>
    </div>
    <?php echo form_close(); ?>
</div>