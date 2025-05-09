<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Üretim Takip Sistemi SİLTER | Yönetim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <style>
        .text-bg-orange {
            background-color: var(--bs-orange);
        }

        .card-header {
            animation: 1s linear infinite progress-bar-stripes !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .progress {
            height: 1.5rem;
            border-color: var(--bs-border-color) !important;
            --bs-progress-bg: var(--bs-border-color);
        }

        .bg-orange {
            background-color: #a75a1b;
        }

        .bg-green {
            background-color: #177549;
        }

        .bg-red {
            background-color: var(--bs-danger-border-subtle)
        }

        .progress-bar-animated {
            animation: 1s linear infinite progress-bar-stripes !important;
        }

        .main-title {
            text-shadow: 1px 1px 2px #000;
        }

        .main-info-text {
            overflow: hidden;
        }

        .info-text {
            display: flex;
            width: max-content;
            animation: marquee 10s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .fi-rs-sigma {
            margin-right: 2px;
            font-size: 18px;
        }

        .text-line-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body data-bs-theme="dark">
    <div class="mx-3">
        <nav class="row my-2 pb-3 align-items-center">
            <div class="col-sm-4 text-start px-3">
                <a class="navbar-brand" href="#">
                    <img src="http://siltronics.net/assets/images/resimler/yeniLogo.svg" class="col-4">
                </a>
            </div>
            <div class="col-sm-4 text-center">
                <h2 class="text-info main-title">
                    ÜRETİM TAKİP SİSTEMİ
                </h2>
            </div>
        </nav>
        <div class="card shadow">
            <div class="card-header text-center">
                <h3 class="text-light m-0">PLASTİK ENJEKSİYON</h3>
                <span class="fs-4 mb-0 text-success-emphasis"><i class="bi bi-play-circle"></i> <span>2</span></span>
                <span class="fs-4 mb-0 text-warning-emphasis px-3"><i class="bi bi-pause-circle"></i> <span>4</span></span>
                <span class="fs-4 mb-0 text-danger-emphasis"><i class="bi bi-exclamation-circle"></i> <span>2</span></span>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-6 g-4 justify-content-center">
                    <div class="col shadow">
                        <div class="card h-100 text-bg-danger">
                            <div class="card-header fw-bold fs-5 bg-red">PLS01 / KRAUSE MAFFIE</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5 row">
                                        <i class="bi bi-journal-text pe-0 w-auto"></i>
                                        <span class="fw-bold fs-5 col text-line-2">
                                            Pls - Buton Kilit Azimut (Yekpare Taban)
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <div class="row my-2 align-items-center">
                                        <i class="bi bi-exclamation-circle pe-2 fs-5 position-absolute"></i>
                                        <span class="fw-bold fs-5 col col-7 px-0">
                                            <p class="m-0 main-info-text float-end col-9">
                                                <span class="info-text">
                                                    Kalıp Arıza Sorunu
                                                </span>
                                            </p>
                                        </span>
                                        <div class="col-5">
                                            <p class="m-0 text-center fw-bold">500 Adet</p>
                                            <div class="progress border" role="progressbar">
                                                <div class="progress-bar bg-danger fw-bold fs-6 progress-bar-striped" style="width: 97%"></div>
                                            </div>
                                            <p class="m-0 text-center fw-bold">97%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:09:23</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <span class="fw-bold fs-5"><i class="fi fi-rs-duration-alt pe-2 align-middle"></i></i>02:14:29</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-orange">
                            <div class="card-header fw-bold fs-5 bg-orange">PLS01 / ERAT MAK.</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5 row">
                                        <i class="bi bi-journal-text pe-0 w-auto"></i>
                                        <span class="fw-bold fs-5 col text-line-2">
                                            Pls - Dirsek Bayrak - (PetÇam)
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <div class="row my-2 align-items-center">
                                        <i class="bi bi-pause-circle pe-2 fs-5 position-absolute"></i>
                                        <span class="fw-bold fs-5 col col-7 px-0">
                                            <p class="m-0 main-info-text float-end col-9">
                                                <span class="info-text">
                                                    Yemek Molası
                                                </span>
                                            </p>
                                        </span>
                                        <div class="col-5">
                                            <p class="m-0 text-center fw-bold">1000 Adet</p>
                                            <div class="progress border" role="progressbar">
                                                <div class="progress-bar text-bg-orange fw-bold fs-6 progress-bar-striped" style="width: 12%"></div>
                                            </div>
                                            <p class="m-0 text-center fw-bold">12%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:19:01</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <span class="fw-bold fs-5"><i class="fi fi-rs-duration-alt pe-2 align-middle"></i></i>00:50:18</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-danger">
                            <div class="card-header fw-bold fs-5 bg-red">PLS01 / ENGEL 350</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5 row">
                                        <i class="bi bi-journal-text pe-0 w-auto"></i>
                                        <span class="fw-bold fs-5 col text-line-2">
                                            Tapa - (PetÇam)
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <div class="row my-2 align-items-center">
                                        <i class="bi bi-exclamation-circle pe-2 fs-5 position-absolute"></i>
                                        <span class="fw-bold fs-5 col col-7 px-0">
                                            <p class="m-0 main-info-text float-end col-9">
                                                <span class="info-text">
                                                    Elektrik Arıza
                                                </span>
                                            </p>
                                        </span>
                                        <div class="col-5">
                                            <p class="m-0 text-center fw-bold">300 Adet</p>
                                            <div class="progress border" role="progressbar">
                                                <div class="progress-bar bg-danger fw-bold fs-6 progress-bar-striped" style="width: 42%"></div>
                                            </div>
                                            <p class="m-0 text-center fw-bold">42%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:09:23</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <span class="fw-bold fs-5"><i class="fi fi-rs-duration-alt pe-2 align-middle"></i></i>02:14:29</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-orange">
                            <div class="card-header fw-bold fs-5 bg-orange">PLS01 / YIZUMI</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5 row">
                                        <i class="bi bi-journal-text pe-0 w-auto"></i>
                                        <span class="fw-bold fs-5 col text-line-2">
                                            Çoraplık - Mafsal (ERKEK) - Mini Plus
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <div class="row my-2 align-items-center">
                                        <i class="bi bi-pause-circle pe-2 fs-5 position-absolute"></i>
                                        <span class="fw-bold fs-5 col col-7 px-0">
                                            <p class="m-0 main-info-text float-end col-9">
                                                <span class="info-text">
                                                    Kalıp Değişim
                                                </span>
                                            </p>
                                        </span>
                                        <div class="col-5">
                                            <p class="m-0 text-center fw-bold">2000 Adet</p>
                                            <div class="progress border" role="progressbar">
                                                <div class="progress-bar text-bg-orange fw-bold fs-6 progress-bar-striped" style="width: 55%"></div>
                                            </div>
                                            <p class="m-0 text-center fw-bold">55%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:16:36</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <span class="fw-bold fs-5"><i class="fi fi-rs-duration-alt pe-2 align-middle"></i></i>06:24:55</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 bg-success">
                            <div class="card-header fw-bold fs-5 bg-green">PLS01 / DEMAG 250 S3</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5 row">
                                        <i class="bi bi-journal-text pe-0 w-auto"></i>
                                        <span class="fw-bold fs-5 col text-line-2">
                                            Zemin - Ütü dinlendirme SQUAD baskısız
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <div class="row my-2 align-items-center">
                                        <div class="col-7">
                                            <span class="fw-bold fs-5 px-0">
                                                <i class="bi bi-play-circle pe-2 fs-5"></i>
                                                Çalışıyor
                                            </span>
                                        </div>
                                        <div class="col-5">
                                            <p class="m-0 text-center fw-bold">2000 Adet</p>
                                            <div class="progress border" role="progressbar">
                                                <div class="progress-bar bg-success fw-bold fs-6 progress-bar-striped progress-bar-animated" style="width: 55%"></div>
                                            </div>
                                            <p class="m-0 text-center fw-bold">55%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>02:32:42</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <span class="fw-bold fs-5"><i class="fi fi-rs-duration-alt pe-2 align-middle"></i></i>03:24:55</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-orange">
                            <div class="card-header fw-bold fs-5 bg-orange">PLS01 / POTENZA 250</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5 row">
                                        <i class="bi bi-journal-text pe-0 w-auto"></i>
                                        <span class="fw-bold fs-5 col text-line-2">
                                            Pls - Dış gövde-Buhar ayar mek.siyah azimut
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <div class="row my-2 align-items-center">
                                        <i class="bi bi-pause-circle pe-2 fs-5 position-absolute"></i>
                                        <span class="fw-bold fs-5 col col-7 px-0">
                                            <p class="m-0 main-info-text float-end col-9">
                                                <span class="info-text">
                                                    Belirsiz Duruş
                                                </span>
                                            </p>
                                        </span>
                                        <div class="col-5">
                                            <p class="m-0 text-center fw-bold">1500 Adet</p>
                                            <div class="progress border" role="progressbar">
                                                <div class="progress-bar text-bg-orange fw-bold fs-6 progress-bar-striped" style="width: 86%"></div>
                                            </div>
                                            <p class="m-0 text-center fw-bold">86%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:16:36</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <span class="fw-bold fs-5"><i class="fi fi-rs-duration-alt pe-2 align-middle"></i></i>6:24:55</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 bg-success">
                            <div class="card-header fw-bold fs-5 bg-green">PLS01 / DEMAG 250 NC3</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5 row">
                                        <i class="bi bi-journal-text pe-0 w-auto"></i>
                                        <span class="fw-bold fs-5 col text-line-2">
                                            Ayak - Kazan destek takozu (sac/mn)
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <div class="row my-2 align-items-center">
                                        <div class="col-7">
                                            <span class="fw-bold fs-5 px-0">
                                                <i class="bi bi-play-circle pe-2 fs-5"></i>
                                                Çalışıyor
                                            </span>
                                        </div>
                                        <div class="col-5">
                                            <p class="m-0 text-center fw-bold">400 Adet</p>
                                            <div class="progress border" role="progressbar">
                                                <div class="progress-bar bg-success fw-bold fs-6 progress-bar-striped progress-bar-animated" style="width: 61%"></div>
                                            </div>
                                            <p class="m-0 text-center fw-bold">61%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>05:02:30</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <span class="fw-bold fs-5"><i class="fi fi-rs-duration-alt pe-2 align-middle"></i></i>08:59:05</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-orange">
                            <div class="card-header fw-bold fs-5 bg-orange">PLS01 / POTENZA 80</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5 row">
                                        <i class="bi bi-journal-text pe-0 w-auto"></i>
                                        <span class="fw-bold fs-5 col text-line-2">
                                            Blok - Kordon koruyucu
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <div class="row my-2 align-items-center">
                                        <i class="bi bi-pause-circle pe-2 fs-5 position-absolute"></i>
                                        <span class="fw-bold fs-5 col col-7 px-0">
                                            <p class="m-0 main-info-text float-end col-9">
                                                <span class="info-text">
                                                    AR-GE Numune
                                                </span>
                                            </p>
                                        </span>
                                        <div class="col-5">
                                            <p class="m-0 text-center fw-bold">800 Adet</p>
                                            <div class="progress border" role="progressbar">
                                                <div class="progress-bar text-bg-orange fw-bold fs-6 progress-bar-striped" style="width: 74%"></div>
                                            </div>
                                            <p class="m-0 text-center fw-bold">74%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:47:21</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <span class="fw-bold fs-5"><i class="fi fi-rs-duration-alt pe-2 align-middle"></i></i>04:12:43</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>