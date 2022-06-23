<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
?>


<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">

            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Bionet Admin</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MAIN</span>
        </li>
        <!-- Dashboard -->
        <li class="menu-item <?php if ($this->uri->segment(2) == "dashboard") {
                                    echo 'active';
                                } ?>">
            <a href="<?php echo base_url('admin/dashboard'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-item <?php if ($this->uri->segment(2) == "product") {
                                    echo 'active';
                                } ?>">
            <a href="<?php echo base_url('admin/product'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Analytics">Product</div>
            </a>
        </li>
        <li class="menu-item <?php if ($this->uri->segment(2) == "transaction") {
                                    echo 'active';
                                } ?>">
            <a href="<?php echo base_url('admin/transaction'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                <div data-i18n="Analytics">Transaksi</div>
            </a>
        </li>

        <!-- Layouts -->

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Web Pages</span>
        </li>
        <li class="menu-item <?php if ($this->uri->segment(2) == "category" || $this->uri->segment(2) == "berita") {
                                    echo 'active open';
                                } ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Blog</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item <?php if ($this->uri->segment(2) == "berita") {
                                            echo 'active';
                                        } ?>">
                    <a href="<?php echo base_url('admin/berita'); ?>" class="menu-link">
                        <div data-i18n="Without menu">Berita</div>
                    </a>
                </li>
                <li class="menu-item <?php if ($this->uri->segment(2) == "category") {
                                            echo 'active';
                                        } ?>">
                    <a href="<?php echo base_url('admin/category'); ?>" class="menu-link">
                        <div data-i18n="Without navbar">Category</div>
                    </a>
                </li>
            </ul>
        </li>



        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Settings</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">AKun Saya</div>
            </a>
        </li>
        <!-- User interface -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Profile Web</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="ui-accordion.html" class="menu-link">
                        <div data-i18n="Accordion">Meta</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-alerts.html" class="menu-link">
                        <div data-i18n="Alerts">Logo</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-badges.html" class="menu-link">
                        <div data-i18n="Badges">Faficon</div>
                    </a>
                </li>

            </ul>
        </li>

        <!-- Extended components -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">Pengaturan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-text-divider.html" class="menu-link">
                        <div data-i18n="Text Divider">Email</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-text-divider.html" class="menu-link">
                        <div data-i18n="Text Divider">Menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-text-divider.html" class="menu-link">
                        <div data-i18n="Text Divider">Whatsapp</div>
                    </a>
                </li>
            </ul>
        </li>



    </ul>
</aside>
<!-- / Menu -->