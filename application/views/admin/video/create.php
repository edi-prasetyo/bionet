<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
    </div>
    <div class="card-body">
        <?php
        //Form Open
        echo form_open(base_url('admin/video/create/'));
        ?>

        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Judul Video</label>

            <div class="col-lg-9">
                <input type="text" class="form-control" name="video_title" placeholder="Judul Video">

            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Title Video (EN)</label>

            <div class="col-lg-9">
                <input type="text" class="form-control" name="video_title_en" placeholder="Title Video">

            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Video Embed</label>

            <div class="col-lg-9">
                <textarea class="form-control" name="video_embed" placeholder="Embed Video"></textarea>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Deskripsi Halaman <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <textarea class="form-control" id="summernote" name="video_desc" placeholder="Deskripsi Halaman"></textarea>

            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Video Description (EN) <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <textarea class="form-control" id="summernote2" name="video_desc_en" placeholder="Deskripsi Halaman"></textarea>

            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-lg-3"></label>
            <div class="col-lg-9">
                <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
            </div>
        </div>


        <?php
        //Form Close
        echo form_close();
        ?>

    </div>
</div>