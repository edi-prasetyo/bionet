<div class="col-md-7 mx-auto">
    <div class="card">
        <div class="card-header bg-white">
            <?php echo $title; ?>
        </div>
        <div class="card-body">


            <div class="text-center">
                <?php
                echo $this->session->flashdata('message');
                if (isset($error_upload)) {
                    echo '<div class="alert alert-warning">' . $error_upload . '</div>';
                }
                ?>
            </div>
            <?php
            echo form_open_multipart('admin/bank/update/' . $bank->id);
            ?>

            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Nama Bank <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="bank_name" placeholder="Nama Bank" value="<?php echo $bank->bank_name; ?>">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Nomor Rekening <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="bank_number" placeholder="Nomor rekening" value="<?php echo $bank->bank_number; ?>">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Atas Nama <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="bank_account" placeholder="Atas Nama" value="<?php echo $bank->bank_account; ?>">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Cabang <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="bank_branch" placeholder="Cabang" value="<?php echo $bank->bank_branch; ?>">
                </div>
            </div>

    
            <div class="form-group row">
                <div class="col-lg-3"></div>
                <div class="col-lg-9">
                    <button type="submit" class="btn btn-primary btn-block">
                        Update Bank
                    </button>
                </div>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>