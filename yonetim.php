<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Üretim Takip Sistemi SİLTER | Yönetim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .text-bg-orange {
            background-color: var(--bs-orange);
        }

        .card-header {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .progress {
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
            text-shadow: 1px 1px 30px;
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
                            <div class="card-header fw-bold fs-4 bg-red">PLS01 / KRAUSE MAFFIE</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-journal-text pe-2"></i>36549</span>
                                    <span>/</span>
                                    <span class="fst-italic">OPLS01</span>
                                </div>
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-box-seam pe-2"></i>2172018</span>
                                </div>
                                <div class="row my-3">
                                    <span class="fw-bold fs-5 col-7"><i class="bi bi-exclamation-circle pe-2"></i>Kalıp Arıza</span>
                                    <div class="col-5">
                                        <div class="progress h-100 border" role="progressbar">
                                            <div class="progress-bar bg-danger fw-bold fs-6 progress-bar-striped progress-bar-animated" style="width: 97%"></div>
                                        </div>
                                        <p class="m-0 text-center fw-bold">97%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:09:23</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <p class="m-0"><i class="bi bi-person-circle"></i> Hamza TUNÇ</p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-orange text-light">
                            <div class="card-header bg-orange fw-bold fs-5">PLS01 / ERAT MAK.</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-journal-text pe-2"></i>36547</span>
                                    <span>/</span>
                                    <span class="fst-italic">OPLS01</span>
                                </div>
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-box-seam pe-2"></i>2172022</span>
                                </div>
                                <div class="row my-3">
                                    <span class="fw-bold fs-5 col-7"><i class="bi bi-play-circle pe-2"></i>Çalışıyor</span>
                                    <div class="col-5">
                                        <div class="progress h-100 border" role="progressbar">
                                            <div class="progress-bar text-bg-orange fw-bold fs-6 progress-bar-striped progress-bar-animated" style="width: 15%"></div>
                                        </div>
                                        <p class="m-0 text-center fw-bold">15%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>01:42:11</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <p class="m-0"><i class="bi bi-person-circle"></i> Hamza TUNÇ</p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-danger">
                            <div class="card-header bg-red fw-bold fs-5">PLS01 / ENGEL 350</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-journal-text pe-2"></i>36545</span>
                                    <span>/</span>
                                    <span class="fst-italic">OPLS01</span>
                                </div>
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-box-seam pe-2"></i>2171990</span>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold fs-5"><i class="bi bi-exclamation-circle pe-2"></i>Kalıp Arıza</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:59:01</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <p class="m-0"><i class="bi bi-person-circle"></i> Hamza TUNÇ</p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-orange text-light">
                            <div class="card-header bg-orange fw-bold fs-5">PLS01 / YIZUMI</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-journal-text pe-2"></i>36540</span>
                                    <span>/</span>
                                    <span class="fst-italic">OPLS01</span>
                                </div>
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-box-seam pe-2"></i>2172019</span>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold fs-5"><i class="bi bi-pause-circle pe-2"></i>Yemek Molası</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>04:08:36</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <p class="m-0"><i class="bi bi-person-circle"></i> Hamza TUNÇ</p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-success">
                            <div class="card-header bg-green fw-bold fs-5">PLS01 / DEMAG 250 S3</div>
                            <div class="card-body py-2">
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-journal-text pe-2"></i>36569</span>
                                    <span>/</span>
                                    <span class="fst-italic">OPLS01</span>
                                </div>
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-box-seam pe-2"></i>2172015</span>
                                </div>
                                <div class="row my-3">
                                    <span class="fw-bold fs-5 col-7"><i class="bi bi-play-circle pe-2"></i>Çalışıyor</span>
                                    <div class="col-5">
                                        <div class="progress h-100 border border-success" role="progressbar">
                                            <div class="progress-bar bg-success fw-bold fs-6 progress-bar-striped progress-bar-animated" style="width: 80%"></div>
                                        </div>
                                        <p class="m-0 text-center fw-bold">80%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:36:21</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <p class="m-0"><i class="bi bi-person-circle"></i> Hamza TUNÇ</p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-orange text-light">
                            <div class="card-header bg-orange fw-bold fs-5">PLS01 / POTENZA 250</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-journal-text pe-2"></i>36568</span>
                                    <span>/</span>
                                    <span class="fst-italic">OPLS02</span>
                                </div>
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-box-seam pe-2"></i>2172022</span>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold fs-5"><i class="bi bi-pause-circle pe-2"></i>Yemek Molası</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>03:01:15</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <p class="m-0"><i class="bi bi-person-circle"></i> Hamza TUNÇ</p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-success">
                            <div class="card-header bg-green fw-bold fs-5">PLS01 / DEMAG 250 NC3</div>
                            <div class="card-body py-2">
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-journal-text pe-2"></i>36569</span>
                                    <span>/</span>
                                    <span class="fst-italic">OPLS01</span>
                                </div>
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-box-seam pe-2"></i>2172015</span>
                                </div>
                                <div class="row my-3">
                                    <span class="fw-bold fs-5 col-7"><i class="bi bi-play-circle pe-2"></i>Çalışıyor</span>
                                    <div class="col-5">
                                        <div class="progress h-100 border border-success" role="progressbar">
                                            <div class="progress-bar bg-success fw-bold fs-6 progress-bar-striped progress-bar-animated" style="width: 48%"></div>
                                        </div>
                                        <p class="m-0 text-center fw-bold">48%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>00:36:21</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <p class="m-0"><i class="bi bi-person-circle"></i> Hamza TUNÇ</p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow">
                        <div class="card h-100 text-bg-orange text-light">
                            <div class="card-header bg-orange fw-bold fs-5">PLS01 / POTENZA 80</div>
                            <div class="card-body py-2 row">
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-journal-text pe-2"></i>36532</span>
                                    <span>/</span>
                                    <span class="fst-italic">OPLS02</span>
                                </div>
                                <div>
                                    <span class="fw-bold fs-5"><i class="bi bi-box-seam pe-2"></i>2172021</span>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold fs-5"><i class="bi bi-pause-circle pe-2"></i>Yemek Molası</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <small class="col-sm-6">
                                        <span class="fw-bold fs-5"><i class="bi bi-clock pe-2"></i>01:10:52</span>
                                    </small>
                                    <small class="col-sm-6 text-end">
                                        <p class="m-0"><i class="bi bi-person-circle"></i> Hamza TUNÇ</p>
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