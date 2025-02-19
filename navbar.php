<style>
    .button-hover:hover {
        background-color: #5d7084;
    }

    .nav {
        background-color: #fff;
    }

    .btn-toggle,
    .dropdown-menu {
        background-color: #444d56;
    }

    a {
        text-decoration: none;
    }

    .btn-toggle-nav:after {
        border: none !important;
    }

    .btn-toggle-nav a {
        color: #fff !important;
    }

    .nav-bot-item {
        display: block;
        padding: 0.25rem 0;
        padding-left: 1rem;
    }

    .card {
        margin: 0.3rem !important;
        padding: 0;
        width: 75%;
    }
</style>
<!-- #region LEFTBAR-->
<div class="offcanvas offcanvas-start show" style="width: 15%; background: #212529;" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">
            <img src="http://siltronics.net/assets/images/resimler/yeniLogo.svg" width="100%">
        </h5>
    </div>
    <hr class="text-white my-2">
    <p class="text-white text-center m-0 h5">Kullanıcı Adı</p>
    <hr class="text-white my-2">
    <div class="offcanvas-body p-0" id="canvasBody">
        <ul class="list-inline">
            <!-- <li class="nav-inline-item mb-3">
                <div class="dropdown">
                    <button class="btn dropdown-toggle text-white border-0 w-100 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        G KOD
                    </button>
                    <ul class="dropdown-menu w-100">
                        <li><a class="dropdown-item text-white nav-item-bg-hover" href="index.php">Anasayfa</a></li>
                        <li><a class="dropdown-item text-white nav-item-bg-hover" href="login.php">Giriş Yap</a></li>
                    </ul>
                </div>
            </li> -->
            <ul class="list-unstyled ps-0">
                <li class="mb-2">
                    <button class="btn btn-toggle text-start ps-4 rounded-0 text-white w-100 button-hover" data-bs-toggle="collapse"
                        data-bs-target="#home-collapse" aria-expanded="true">
                        G KOD
                    </button>
                    <!-- 
                        data-bs-target = id
                     -->
                    <div class="collapse" id="home-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 text-white d-flex justify-content-center flex-wrap" style="margin-top: 0.3rem;">
                            <li class="card dropdown-menu my-2 button-hover">
                                <a href="index.php" class="nav-bot-item card-body">Anasayfa</a>
                            </li>
                            <li class="card dropdown-menu my-2 button-hover">
                                <a href="login.php" class="nav-bot-item">Giriş</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </ul>
    </div>
</div>
<!-- #endregion -->
<!-- #region TOPBAR-->
<div class="row">
    <ul id="topbar" class="nav position-fixed w-100 border-bottom" style="top:0;left:15%;z-index:1;align-items: center;">
        <li class="nav-item">
            <a class="nav-link text-white" aria-current="page">
                <svg id="list-close" onclick="list_close()" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list text-dark" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
                <svg id="list-open" onclick="list_open()" style="cursor: pointer; display: none;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list text-dark" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </a>
        </li>
        <li class="nav-item h5">
            G KOD DÜZENLE
        </li>
    </ul>
</div>
<!-- #endregion -->
<script>
    function list_close() {
        document.getElementById("offcanvasScrolling").style.display = "none";
        document.getElementById("topbar").style.left = "0";
        document.getElementById("list-close").style.display = "none";
        document.getElementById("list-open").style.display = "inline";
        document.getElementById("main").classList.add("col-sm-12");
    }

    function list_open() {
        document.getElementById("offcanvasScrolling").style.display = "block";
        document.getElementById("topbar").style.left = "15%";
        document.getElementById("list-close").style.display = "inline";
        document.getElementById("list-open").style.display = "none";
        document.getElementById("main").classList.remove("col-sm-12");
        document.getElementById("main").classList.add("col-sm-10");
        document.getElementById("canvasBody").style.height = "-webkit-fill-available";
    }
</script>