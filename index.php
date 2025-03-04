<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G KOD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .durumKutu {
            display: none;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .group-div:nth-child(odd) {
            /* box-shadow: var(--bs-box-shadow-lg) !important; */
            background-color: #f2f2f2;
        }

        .group-div:nth-child(even) {
            box-shadow: var(--bs-box-shadow) !important;
        }

        .nav-item-hover {
            transition: 0.2s ease;
        }

        .nav-item-hover:hover {
            color: darkblue;
            font-weight: bolder;
            font-size: 18px;
        }
    </style>
</head>

<body class="">
    <div>
        <?php
        session_start();
        if (isset($_GET["clear"]) && $_GET["clear"] == true) {
            session_destroy();
            // header("location: http://siltronics.net/gkod/");
            header("location: ./");
        }
        echo '<div class="col-sm-3">';
        include "navbar.php";
        echo '</div>';
        echo '<div id="main" class="col-sm-10 ps-3 float-end mt-4">';
        $veri_array = [];
        $aperture_degerleri = [];
        $grup_sayi = 0;
        if (isset($_SESSION['aperture_degerleri'])) {
            $aperture_degerleri = $_SESSION['aperture_degerleri'];
        }
        if (isset($_POST["submit"])) {
            $icerik = $_POST["text"];
            $satir = explode("\n", $icerik);
            $gecici_array = [];
            foreach ($satir as $veri) {
                $veri = trim($veri);
                if (empty($veri)) continue;
                $ayir = explode(':', $veri);
                if (count($ayir) == 2) {
                    $deger = trim($ayir[0]);
                    $veri = trim($ayir[1]);
                    if ($deger == "Location") {
                        preg_match('/\((.*?)\)/', $veri, $kordinat);
                        if (!empty($kordinat[1])) {
                            list($x, $y) = explode(',', $kordinat[1]);
                            $veri = 'X' . trim($x) . 'Y' . trim($y);
                        }
                    }
                    if ($deger == "Aperture used") {
                        $gecici_array[$deger] = $veri;
                        if (!in_array($veri, $aperture_degerleri)) {
                            $aperture_degerleri[] = $veri;
                        }
                    }
                    if ($deger == "Rotation" || $deger == "Location") {
                        $gecici_array[$deger] = $veri;
                        $veri = str_replace("deg", "", $veri);
                    }
                    if ($deger == "In file") {
                        $veri_array[] = $gecici_array;
                        $_SESSION["veri_array"] = $veri_array;
                        $gecici_array = [];
                    }
                }
            }
            $_SESSION['aperture_degerleri'] = $aperture_degerleri;
        }
        if (empty($veri_array) && empty($aperture_degerleri)) {
        ?>
            <form method="post" class="container col-sm-8 mt-5 pt-5">
                <h5>İçerik Girişi</h5>
                <textarea name="text" class="form-control shadow-lg" rows="10" required></textarea>
                <button class="btn btn-primary mt-3 col-sm-4" type="submit" name="submit">İleri</button>
            </form>
        <?php }
        if (isset($_POST['set_grup_sayi'])) {
            $grup_sayi = (int)$_POST['grup_sayi'];
        } ?>
        <?php if (!empty($aperture_degerleri) && isset($_POST["submit"])) { ?>
            <form method="post" class="container col-sm-8 mt-5 pt-5">
                <div class="card mt-5 shadow-lg">
                    <div class="card-body">
                        <h5>Kaç grup oluşturmak istiyorsunuz?</h5>
                        <input type="number" placeholder="Maks: <?= count($aperture_degerleri); ?>" name="grup_sayi" required class="form-control" min="1" max="<?= count($aperture_degerleri); ?>" autofocus>
                        <button class="btn btn-primary mt-3 col-sm-4" type="submit" name="set_grup_sayi">İleri</button>
                    </div>
                </div>
            </form>
        <?php }
        if ($grup_sayi > 0 && !empty($aperture_degerleri)) { ?>
            <div class="container col-sm-8 mt-5 pt-5">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5>Gruba ata:</h5>
                        <form method="post">
                            <div>
                                <h6>Grup D0 (●) için süre seçimi:</h6>
                                <div class="row mb-3">
                                    <div class="">
                                        <label class="form-label text-success">Giriş Süresi Bekleme:</label>
                                        <input autofocus type="number" name="sure1[0]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php for ($i = 1; $i <= $grup_sayi; $i++) { ?>
                                <div class="group-div rounded p-3">
                                    <h6>Grup D<?= $i; ?> için değerleri seçin:</h6>
                                    <div>
                                        <?php foreach ($aperture_degerleri as $index => $aperture) { ?>
                                            <div class="form-check d-inline-block col-2 mx-3" id="checkbox_Id_<?= $aperture; ?>">
                                                <input onclick="delc(<?= $aperture; ?>)" class="form-check-input aperture-checkbox" type="checkbox"
                                                    name="grup[<?= $i; ?>][]" value="<?= $aperture; ?>"
                                                    id="aperture<?= $i . '-' . $index; ?>" data-aperture="<?= $aperture; ?>">
                                                <label class="form-check-label" for="aperture<?= $i . '-' . $index; ?>">
                                                    <?= $aperture; ?>
                                                </label>
                                            </div>
                                        <?php } ?>

                                        <div>
                                            <label class="form-check-label text-primary" for="grupDurum<?= $i; ?>">
                                                Çizgi ( <span style="font-weight: bold; color: #000;">|</span> )
                                            </label>
                                            <div class="form-check d-inline-block align-middle">
                                                <input class="form-check-input" type="checkbox" name="grupDurum[<?= $i; ?>]" id="grupDurum<?= $i; ?>">
                                            </div>
                                        </div>
                                        <div class="durumKutu" id="durumKutuId<?= $i; ?>">
                                            <div class="row border-bottom pb-2">
                                                <div class="col-6">
                                                    <label for="" class="form-label text-primary">Uzunluk: </label>
                                                    <div>
                                                        <input type="number" name="uzunluk[<?= $i; ?>]" class="form-control" max="4.99" min="0" step="0.01" value="0" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label text-primary">Açı Değeri:</label>
                                                    <select name="aci_degeri[<?= $i; ?>]" class="form-select" required>
                                                        <option value="0">0 (X)</option>
                                                        <option value="90">90 (Y)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="form-label text-success">Giriş Süresi Bekleme:</label>
                                            <input type="number" name="sure1[<?= $i; ?>]" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-danger">Çıkış Süresi Bekleme:</label>
                                            <input type="number" name="sure2[<?= $i; ?>]" class="form-control">
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const durumKutu = document.getElementById('grupDurum<?= $i; ?>');
                                            const durumInput = document.getElementById('durumKutuId<?= $i; ?>');

                                            durumKutu.addEventListener('change', function() {
                                                if (this.checked) {
                                                    durumInput.style.display = 'block';
                                                } else {
                                                    durumInput.style.display = 'none';
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                                <hr>
                                <hr class="d-none">
                            <?php } ?>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary col-sm-8" type="submit" name="grupKaydet">Grupları Kaydet</button>
                                </div>

                                <div class="text-end container col-sm-6">
                                    <a class="btn btn-danger col-sm-8" href="?clear=true">Temizle</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const kutu = document.querySelectorAll('.aperture-checkbox');

                    kutu.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                            const secili = this.dataset.aperture;
                            if (this.checked) {
                                kutu.forEach(function(digerCheckbox) {
                                    if (digerCheckbox !== checkbox && digerCheckbox.dataset.aperture === secili) {
                                        digerCheckbox.parentElement.remove();
                                    }
                                });
                            }
                        });
                    });
                });
            </script>
        <?php }
        if (isset($_POST['grupKaydet']) && isset($_POST['grup'])) {
            $seciliGrup = $_POST['grup'];
            $d0_ = [];
            $_SESSION['seciliGrup'] = $seciliGrup;
            $_SESSION['sure1'] = $_POST['sure1'];
            $_SESSION['sure2'] = $_POST['sure2'];
            $_SESSION['d0_sure1'] = $_POST['sure1'][0];

            $_SESSION['uzunluk'] = $_POST['uzunluk'];
            $_SESSION['aci_degeri'] = $_POST['aci_degeri'];
            foreach ($aperture_degerleri as $aperture) {
                $durum = false;
                foreach ($seciliGrup as $grup) {
                    if (in_array($aperture, $grup)) {
                        $durum = true;
                        break;
                    }
                }
                if (!$durum) {
                    $d0_[] = $aperture;
                }
            }
        ?>
            <div class="container col-sm-11 m-auto mt-5 pt-4">
                <div class="row">
                    <div class="mb-3 col-sm-4">
                        <h5>Kaydedilen Gruplar:</h5>
                        <ul class="list-group col-sm-8 shadow-lg">
                            <?php if (count($d0_) > 0) { ?>
                                <li class="list-group-item">
                                    <span class="fw-bold">
                                        Grup D0:
                                    </span>
                                    <p class="m-0">
                                        -
                                        <?php $d0_verisi = implode(', ', $d0_);
                                        $d0_verisi = str_replace(",", "<br>- ", $d0_verisi);
                                        echo $d0_verisi;
                                        ?>
                                    </p>
                                </li>
                            <?php }
                            foreach ($seciliGrup as $grupNo => $grup) { ?>
                                <li class="list-group-item">
                                    <span class="fw-bold">
                                        Grup D<?= $grupNo; ?>:
                                    </span>
                                    <p class="m-0">
                                        -
                                        <?php
                                        $secilen_grup = implode(', ', $grup);
                                        $secilen_grup = str_replace(",", "<br>- ", $secilen_grup);
                                        echo $secilen_grup; ?>
                                    </p>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- <hr class="my-5"> -->
                    <form method="post" class="col-sm-8">
                        <h5>Gerekli Bilgiler:</h5>
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div>
                                    <label class="form-label">Açıklama:</label>
                                    <input type="text" name="aciklama" class="form-control" autofocus autocomplete="off">
                                </div>
                                <div class="row">
                                    <div class="col-6 my-3">
                                        <label class="form-label">Ofset X Değeri:</label>
                                        <input type="number" name="x" class="form-control">
                                    </div>
                                    <div class="col-6 my-3">
                                        <label class="form-label">Ofset Y Değeri:</label>
                                        <input type="number" name="y" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Emniyetli Yükseklik:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Z</span>
                                            <input type="number" name="emniyetliYukseklik" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">İşlem Yüksekliği:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">Z</span>
                                            <input type="number" name="islemYuksekligi" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Dozaj Aç Komutu:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">M</span>
                                            <input type="number" name="dozajAcKomutu" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Dozaj Kapat Komutu:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">M</span>
                                            <input type="number" name="dozajKapatKomutu" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">G00 Hız:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">F</span>
                                            <input type="number" name="g00Hiz" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">G01 Hız:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">F</span>
                                            <input type="number" name="g01Hiz" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Home X Kordinatı:</label>
                                        <input type="number" name="homeXKordinati" class="form-control" required>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Home Y Kordinatı:</label>
                                        <input type="number" name="homeYKordinati" class="form-control" required>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Home Z Kordinatı:</label>
                                        <input type="number" name="homeZKordinati" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary col-sm-8" name="bilgiKaydet">Kaydet</button>
                                    </div>
                                    <div class="text-end col-sm-6">
                                        <a class="btn btn-danger col-sm-8" href="?clear=true">Temizle</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }
        if (isset($_POST['bilgiKaydet'])) {
            $aciklama = $_POST["aciklama"];
            $x = $_POST["x"];
            $y = $_POST["y"];
            $emniyetliYukseklik = $_POST["emniyetliYukseklik"];
            $g00Hiz = $_POST["g00Hiz"];
            $g01Hiz = $_POST["g01Hiz"];
            if (isset($_SESSION["veri_array"])) {
                $veri_array = $_SESSION["veri_array"];
            }
            if (isset($_SESSION["aci_degeri"]) && isset($_SESSION["uzunluk"])) {
                $aci_degeri = $_SESSION["aci_degeri"];
                $uzunluk = $_SESSION["uzunluk"];
            }
            $homeXKordinati = $_POST["homeXKordinati"];
            $homeYKordinati = $_POST["homeYKordinati"];
            $homeZKordinati = $_POST["homeZKordinati"];
            function a_ret($grupNo)
            {
                $emniyetliYukseklik = $_POST["emniyetliYukseklik"];
                $dozajAcKomutu = $_POST["dozajAcKomutu"];
                $dozajKapatKomutu = $_POST["dozajKapatKomutu"];
                $islemYuksekligi = $_POST["islemYuksekligi"];
                $sure1 = $_SESSION['sure1'];
                $sure2 = $_SESSION['sure2'];
                // echo $value . "<br>";

                echo "G1Z$islemYuksekligi" . "<br>";
                echo "M$dozajAcKomutu<br>";
                if ($sure1[$grupNo] != 0) {
                    echo "G4P" . $sure1[$grupNo] . "<br>";
                }
                global $aci_degeri, $uzunluk;
                if (isset($aci_degeri) && isset($aci_degeri[$grupNo])) {
                    if ($uzunluk[$grupNo] > 0) {
                        if ($aci_degeri[$grupNo] == 0) {
                            echo "X" . $_SESSION["veri_x_bitis"] . "Y" . $_SESSION["veri_y"] . "<br>";
                        } elseif ($aci_degeri[$grupNo] == 90) {
                            echo "X" . $_SESSION["veri_x"] . "Y" . $_SESSION["veri_y_bitis"] . "<br>";
                        }
                    }
                }
                echo "M$dozajKapatKomutu<br>";
                if ($grupNo != 0) {
                    echo "G4P" . $sure2[$grupNo] . "<br>";
                }
                echo "G0Z$emniyetliYukseklik<br>";
                if ($grupNo != 0) {
                    if ($sure2[$grupNo] != 0) {
                        // echo "G4P" . $sure2[$grupNo] . "<br>";
                    }
                }
            }
            function kordinatHesap($value, $x, $y, $emniyetliYukseklik)
            {
                $kordinat = $value;
                preg_match('/X([\d.]+)Y([\d.]+)/', $kordinat, $cikti);
                $veri_x = $cikti[1];
                $veri_y = $cikti[2];
                $_SESSION["veri_x"] = $veri_x = floatval($veri_x) + floatval($x);
                $_SESSION["veri_y"] = $veri_y = floatval($veri_y) + floatval($y);
                $_SESSION["d0_location"] = "X" . $_SESSION["veri_x"] . "Y" . $_SESSION["veri_y"];
                if (!function_exists('aci_0')) {
                    function aci_0($uzunluk, $emniyetliYukseklik)
                    {
                        global $veri_x, $veri_y;
                        $_SESSION["veri_x_baslangic"] = $veri_x_baslangic = $_SESSION["veri_x"] - ($uzunluk / 2);
                        $_SESSION["veri_x_bitis"] = $veri_x_bitis = $_SESSION["veri_x"] + ($uzunluk / 2);
                        echo "G0X" . $veri_x_baslangic . "Y" . $_SESSION["veri_y"] . "Z" . $emniyetliYukseklik . "<br>";
                    }
                }
                if (!function_exists('aci_90')) {
                    function aci_90($uzunluk, $emniyetliYukseklik)
                    {
                        global $veri_x, $veri_y;
                        $_SESSION["veri_y_baslangic"] = $veri_y_baslangic = $_SESSION["veri_y"] - ($uzunluk / 2);
                        $_SESSION["veri_y_bitis"] = $veri_y_bitis = $_SESSION["veri_y"] + ($uzunluk / 2);
                        echo "G0X" . $_SESSION["veri_x"] . "Y" . $veri_y_baslangic . "Z" . $emniyetliYukseklik . "<br>";
                    }
                }
                // echo "X" . $veri_x . "Y" . $veri_y . "Z" . $emniyetliYukseklik . "<br>";
            } ?>
            <button id="copy_btn" class="btn btn-outline-primary col-sm-1" style="position: fixed;right: 5%;top: 10%;" onclick="metniKopyala()">Kopyala</button>
            <a href="?clear=true" class="btn btn-outline-secondary col-sm-1" style="position: fixed;left: 18%;top: 10%;">Temizle</a>
            <script>
                function metniKopyala() {
                    let metin = document.getElementById("kopyala").innerText;
                    let textarea = document.createElement("textarea");
                    textarea.value = metin;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand("copy");
                    document.body.removeChild(textarea);
                    document.getElementById("copy_btn").innerHTML = "Metin Kopyalandı";
                    document.getElementById("copy_btn").classList.add("btn-outline-success");
                }
            </script>
        <?php
            echo "<pre class='container col-sm-5 fs-6 mt-5 pt-2 border rounded shadow-lg ps-4' id='kopyala' style='font-size: 0.8rem!important;'>";
            echo "($aciklama)<br>";
            echo "G0F$g00Hiz" . "<br>";
            echo "G01F" . $g01Hiz . "<br><br>";
            foreach ($veri_array as $index => $item) {
                foreach ($item as $key => $value) {
                    if ($key == "Location") {
                        kordinatHesap($value, $x, $y, $emniyetliYukseklik);
                    }
                }
                foreach ($item as $key => $value) {
                    if ($key == "Aperture used" || $key == "Location") {
                        if ($key == "Aperture used") {
                            if (isset($_SESSION['seciliGrup']) && is_array($_SESSION['seciliGrup'])) {
                                $seciliGrup = $_SESSION['seciliGrup'];
                            }
                            $bulundu = false;
                            foreach ($seciliGrup as $grupNo => $grup) {
                                if ($grupNo != 0) {
                                    if (in_array($value, $grup)) {
                                        $g = "aci_$aci_degeri[$grupNo]";
                                        $g($uzunluk[$grupNo], $emniyetliYukseklik);
                                        // echo $value . "<br>";
                                        a_ret($grupNo);
                                        $bulundu = true;
                                        break;
                                    }
                                }
                            }
                            if (!$bulundu) {
                                echo "G0" . $_SESSION["d0_location"] . "Z" . $emniyetliYukseklik . "<br>";
                                a_ret(0);
                            }
                        }
                    }
                }
                echo "<br>";
            }
            global $homeXKordinati, $homeYKordinati, $homeZKordinati;
            echo "G0X" . $homeXKordinati . "Y" . $homeYKordinati . "Z" . $homeZKordinati;
            echo "</pre>";
            session_destroy();
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>