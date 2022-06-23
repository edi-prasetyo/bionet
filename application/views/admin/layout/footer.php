<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->



<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?php echo base_url('assets/template/admin/assets/vendor/libs/jquery/jquery.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/admin/assets/vendor/libs/popper/popper.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/admin/assets/vendor/js/bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>

<script src="<?php echo base_url('assets/template/admin/assets/vendor/js/menu.js'); ?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<!-- <script src="<?php echo base_url('assets/template/admin/assets/vendor/libs/apex-charts/apexcharts.js'); ?>"></script> -->

<!-- Main JS -->
<script src="<?php echo base_url('assets/template/admin/assets/js/main.js'); ?>"></script>

<!-- Page JS -->
<script src="<?php echo base_url('assets/template/admin/assets/js/dashboards-analytics.js'); ?>"></script>


<!--SUMMERNOTE-->
<link href="<?php echo base_url('assets/template/web/vendor/summernote/summernote-lite.min.css'); ?> " rel="stylesheet">
<script src="<?php echo base_url('assets/template/web/vendor/summernote/summernote-lite.min.js'); ?>"></script>
<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 130,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
    $('#summernote2').summernote({
        tabsize: 2,
        height: 130,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>

<!-- Place this tag in your head or just before your close body tag. -->
<!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
</body>

</html>