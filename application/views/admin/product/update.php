<?php
if (isset($error_upload)) {
  echo '<div class="alert alert-warning">' . $error_upload . '</div>';
}


// Form Open
echo form_open('admin/product/update/' . $product->id, array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
?>

<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card">
      <div class="card-header p-4 bg-white">
        <h4 class="mb-0"><?php echo $title; ?></h4>
      </div>
      <div class="card-body">

        <div class="row">

          <div class="col-md-3">
            <label>Tipe Produk </label>
          </div>
          <div class="col-lg-9 my-2">
            <select name="product_type" class="form-control" required>
              <option value="">Pilih Type</option>
              <option value="monthly" <?php if ($product->product_type == 'monthly') {
                                        echo "selected";
                                      } ?>>Monthly</option>
              <option value="voucher">Voucher</option>
            </select>
            <div class="invalid-feedback">Silahkan pilih status berita</div>
          </div>


          <div class="col-md-3">
            <label>Nama Produk </label>
          </div>
          <div class="col-md-9 my-2">
            <div class="form-group form-group-lg">
              <input type="text" name="product_name" class="form-control" placeholder="Nama Produk" value="<?php echo $product->product_name; ?>" required>
              <div class="invalid-feedback">Silahkan masukan nama Produk.</div>
            </div>
          </div>
          <div class="col-md-3">
            <label>Kuota </label>
          </div>
          <div class="col-md-9 my-2">
            <div class="form-group form-group-lg">
              <input type="text" name="kuota" class="form-control" placeholder="kuota" value="<?php echo $product->kuota; ?>" required>
              <div class="invalid-feedback">Silahkan masukan nama Produk.</div>
            </div>
          </div>
          <div class="col-md-3">
            <label>Speed </label>
          </div>
          <div class="col-md-9 my-2">
            <div class="form-group form-group-lg">
              <input type="text" name="speed" class="form-control" placeholder="Speed" value="<?php echo $product->speed; ?>" required>
              <div class="invalid-feedback">Silahkan masukan nama Produk.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Speed Download </label>
          </div>
          <div class="col-md-9 my-2">
            <div class="form-group form-group-lg">
              <input type="text" name="speed_download" class="form-control" placeholder="Speed Download" value="<?php echo $product->speed_download; ?>" required>
              <div class="invalid-feedback">Silahkan masukan nama Produk.</div>
            </div>
          </div>
          <div class="col-md-3">
            <label>Speed Upload </label>
          </div>
          <div class="col-md-9 my-2">
            <div class="form-group form-group-lg">
              <input type="text" name="speed_upload" class="form-control" placeholder="Speed Upload" value="<?php echo $product->speed_upload; ?>" required>
              <div class="invalid-feedback">Silahkan masukan nama Produk.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Harga </label>
          </div>
          <div class="col-md-9 my-2">
            <div class="form-group form-group-lg">
              <input type="text" name="price" class="form-control" placeholder="Harga" value="<?php echo $product->price; ?>" required>
              <div class="invalid-feedback">Silahkan masukan nama Produk.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Deskripsi</label>
          </div>
          <div class="col-md-9 my-2">
            <div class="form-group">
              <textarea name="description" class="form-control" id="summernote" placeholder="Deskripsi Produk" required><?php echo $product->description; ?></textarea>
              <div class="invalid-feedback">Silahkan masukan Deskripsi Produk.</div>
            </div>
          </div>




          <div class="col-md-3"></div>
          <div class="col-md-9">
            <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan</button>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php
//Form close
echo form_close();
?>