<div class="container-fluid">
 <div class="row">
    <style>
        #sidebarMenu{
            height: 100vh;
        }
        .nav-link{
            display: flex;
            text-decoration: none;
            color: black;
        }
        .nav-link > i{
            margin-left: 3px;
        }
    </style>

    <nav id="sidebarMenu" class="col-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
            <a class="nav-link" href="<?=base_url('/Dashboard')?>">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                                Dashboard
             </a>
                            <a class="nav-link" href="<?=base_url('/kecamatan')?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Kecamatan
                            </a>
                            <a class="nav-link" href="<?=base_url('/sekolah')?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Sekolah
                            </a>

            </ul>
        <hr>
        <div class="small">&copy 2023 - UNU Al Ghazali Cilacap</div>
        </div>
    </nav>