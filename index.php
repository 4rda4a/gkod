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

<body>
    <div>
        <?php
        date_default_timezone_set('Europe/Istanbul');
        session_start();
        if (empty($_SESSION["gizle"])) {
            $_SESSION["gizle"] = false;
        }
        if (isset($_GET["clear"]) && $_GET["clear"] == true) {
            $temp = $_SESSION['icerik'] ?? null;
            session_unset();
            if ($temp !== null) {
                $_SESSION['icerik'] = $temp;
            }
            //session_destroy();
            //header("location: http://siltronics.net/gkod/");
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
        if (isset($_GET["edit"])) {
            $edit = true;
            $_SESSION["gizle"] = true;
            $icerik = $_SESSION["icerik"][$_GET["edit"]];
            $_SESSION["gizle2"] = "OK";
        } else {
            $edit = $_SESSION["gizle2"] = false;
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
            $_SESSION["gizle"] = true;
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $_SESSION["gizle"] = false;
        } else {
            $_SESSION["gizle2"] = "NO";
        }
        if ($_SESSION["gizle"] == false && !$edit) {
        ?>
            <form method="post" class="container col-sm-8 mt-5 pt-5">
                <h5>İçerik Girişi</h5>
                <textarea name="text" class="form-control shadow-lg" rows="10" required></textarea>
                <button class="btn btn-primary mt-3 col-sm-4" type="submit" name="submit">İleri</button>
            </form>
        <?php
        }
        if (isset($_POST['set_grup_sayi'])) {
            $grup_sayi = (int)$_POST['grup_sayi'];
            $_SESSION["bilgi"]["grup_sayi"] = $grup_sayi;
            $_SESSION["gizle"] = true;
        } ?>
        <?php if (!empty($aperture_degerleri) && isset($_POST["submit"])) {
        ?>
            <form method="post" class="container col-sm-8 mt-5 pt-5">
                <div class="card mt-5 shadow-lg">
                    <div class="card-body">
                        <h5>Kaç grup oluşturmak istiyorsunuz?</h5>
                        <input type="number" value="" placeholder="Maks: <?= count($aperture_degerleri); ?>" name="grup_sayi" required class="form-control" min="1" max="<?= count($aperture_degerleri); ?>" autofocus>
                        <button class="btn btn-primary mt-3 col-sm-4" type="submit" name="set_grup_sayi">İleri</button>
                    </div>
                </div>
            </form>
        <?php }
        if (
            $grup_sayi > 0 && !empty($aperture_degerleri) || $_SESSION["gizle2"] === "OK"
        ) {
            $_SESSION["gizle2"] = "NO";
            if ($edit) {
                $grup_sayi = $icerik["grup_sayi"];
                $_SESSION["bilgi"]["grup_sayi"] = $grup_sayi;
            }
        ?>
            <div class="container col-sm-8 mt-5 pt-5">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5>Gruba ata:</h5>
                        <form method="post">
                            <div>
                                <h6>Grup D0 (●) için süre seçimi:</h6>
                                <div>
                                    <?php
                                    if ($edit) {
                                        $aperture_degerleri = $icerik["seciliGrup"][0];
                                        foreach ($aperture_degerleri as $index => $aperture) { ?>
                                            <div class="form-check d-inline-block col-2 mx-3" id="checkbox_Id_<?= $aperture; ?>">
                                                <input class="form-check-input aperture-checkbox" type="checkbox"
                                                    name="grup[0][]" value="<?= $aperture; ?>"
                                                    id="aperture0-<?= $aperture ?>" data-aperture="<?= $aperture; ?>"
                                                    <?php
                                                    if ($edit) {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                                <label class="form-check-label" for="aperture0-<?= $aperture ?>">
                                                    <?= $aperture; ?>
                                                </label>
                                            </div>
                                    <?php }
                                    }
                                    ?>
                                </div>
                                <div class="row mb-3">
                                    <div class="">
                                        <label class="form-label text-success">Giriş Süresi Bekleme:</label>
                                        <input autofocus type="number" value="<?php if ($edit) {
                                                                                    echo $icerik["sure1"][0];
                                                                                } ?>" name="sure1[0]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php for ($i = 1; $i <= $grup_sayi; $i++) { ?>
                                <div class="group-div rounded p-3">
                                    <h6>Grup D<?= $i; ?> için değerleri seçin:</h6>
                                    <div>
                                        <?php
                                        if ($edit) {
                                            $aperture_degerleri = $icerik["seciliGrup"][$i];
                                        }
                                        foreach ($aperture_degerleri as $index => $aperture) { ?>
                                            <div class="form-check d-inline-block col-2 mx-3" id="checkbox_Id_<?= $aperture; ?>">
                                                <input class="form-check-input aperture-checkbox" type="checkbox"
                                                    name="grup[<?= $i; ?>][]" value="<?= $aperture; ?>"
                                                    id="aperture<?= $i . '-' . $index; ?>" data-aperture="<?= $aperture; ?>"
                                                    <?php
                                                    if ($edit) {
                                                        echo "checked";
                                                    }
                                                    ?>>
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
                                                <input
                                                    <?php
                                                    if ($edit && $icerik["uzunluk"][$i] > 0) {
                                                        echo "checked";
                                                    }
                                                    ?>
                                                    class="form-check-input" type="checkbox" name="grupDurum[<?= $i; ?>]" id="grupDurum<?= $i; ?>">
                                            </div>
                                        </div>
                                        <div
                                            <?php
                                            if ($edit && $icerik["uzunluk"][$i] > 0) {
                                                echo "style='display: block;'";
                                            }
                                            ?> class="durumKutu" id="durumKutuId<?= $i; ?>">
                                            <div class="row border-bottom pb-2">
                                                <div class="col-6">
                                                    <label for="" class="form-label text-primary">Uzunluk: </label>
                                                    <div>
                                                        <input value="<?php
                                                                        if ($edit) {
                                                                            echo $icerik["uzunluk"][$i];
                                                                        } else {
                                                                            echo 0;
                                                                        }
                                                                        ?>"
                                                            type="number"
                                                            name="uzunluk[<?= $i; ?>]"
                                                            class="form-control"
                                                            id="durumUzunlukId<?= $i; ?>"
                                                            max="4.99"
                                                            min="0"
                                                            step="0.01">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label text-primary">Açı Değeri:</label>
                                                    <select name="aci_degeri[<?= $i; ?>]" class="form-select">
                                                        <option <?php
                                                                if ($edit && $icerik["aci_degeri"][$i] == 0) {
                                                                    echo "selected";
                                                                }
                                                                ?> value="0">0 (X)</option>
                                                        <option <?php
                                                                if ($edit && $icerik["aci_degeri"][$i] == 90) {
                                                                    echo "selected";
                                                                }
                                                                ?> value="90">90 (Y)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="form-label text-success">Giriş Süresi Bekleme:</label>
                                            <input value="<?php
                                                            if ($edit) {
                                                                echo $icerik["sure1"][$i];
                                                            }
                                                            ?>" type="number" name="sure1[<?= $i; ?>]" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-danger">Çıkış Süresi Bekleme:</label>
                                            <input value="<?php
                                                            if ($edit) {
                                                                echo $icerik["sure2"][$i];
                                                            }
                                                            ?>" type="number" name="sure2[<?= $i; ?>]" class="form-control">
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var durumKutu = document.getElementById('grupDurum<?= $i; ?>');
                                            var durumInput = document.getElementById('durumKutuId<?= $i; ?>');

                                            durumKutu.addEventListener('change', function() {
                                                if (this.checked) {
                                                    durumInput.style.display = 'block';
                                                } else {
                                                    document.getElementById('durumUzunlukId<?= $i; ?>').value = 0;
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
                                    <button class="btn btn-primary col-sm-8" type="submit" name="grupKaydet">Kaydet</button>
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
                    var kutu = document.querySelectorAll('.aperture-checkbox');

                    kutu.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                            var secili = this.dataset.aperture;
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
        <?php
        }
        if (isset($_POST['grupKaydet']) && isset($_POST['grup']) && $_SESSION["gizle"]) {
            $_SESSION["gizle2"] = "NO";
            $seciliGrup = $_POST['grup'];
            $d0_ = [];
            $_SESSION['seciliGrup'] = $_SESSION['bilgi']['seciliGrup'] = $seciliGrup;
            $_SESSION['sure1'] = $_SESSION['bilgi']['sure1'] = $_POST['sure1'];
            $_SESSION['sure2'] = $_SESSION['bilgi']['sure2'] = $_POST['sure2'];
            $_SESSION['d0_sure1'] = $_POST['sure1'][0];

            $_SESSION['uzunluk'] = $_SESSION['bilgi']['uzunluk'] = $_POST['uzunluk'];
            $_SESSION['aci_degeri'] = $_SESSION['bilgi']['aci_degeri'] = $_POST['aci_degeri'];
            $_SESSION['d0_'] = [];
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
                    $_SESSION['d0_'][] = $aperture;
                    $_SESSION['bilgi']['seciliGrup'][0][] = $aperture;
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
                                    <input value="<?php
                                                    if ($edit) {
                                                        echo $icerik["aciklama"] . "_Copy";
                                                    }
                                                    ?>" type="text" name="aciklama" class="form-control" autofocus autocomplete="off">
                                </div>
                                <div class="row">
                                    <div class="col-6 my-3">
                                        <label class="form-label">Ofset X Değeri:</label>
                                        <input value="<?php
                                                        if ($edit) {
                                                            echo $icerik["x"];
                                                        }
                                                        ?>" type="number" name="x" class="form-control" step="0.01">
                                    </div>
                                    <div class="col-6 my-3">
                                        <label class="form-label">Ofset Y Değeri:</label>
                                        <input value="<?php
                                                        if ($edit) {
                                                            echo $icerik["y"];
                                                        }
                                                        ?>" type="number" name="y" class="form-control" step="0.01">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Emniyetli Yükseklik:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Z</span>
                                            <input value="<?php
                                                            if ($edit) {
                                                                echo $icerik["emniyetliYukseklik"];
                                                            }
                                                            ?>" type="number" name="emniyetliYukseklik" class="form-control" required step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">İşlem Yüksekliği:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">Z</span>
                                            <input value="<?php
                                                            if ($edit) {
                                                                echo $icerik["islemYuksekligi"];
                                                            }
                                                            ?>" type="number" name="islemYuksekligi" class="form-control" required step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Dozaj Aç Komutu:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">M</span>
                                            <input value="<?php
                                                            if ($edit) {
                                                                echo $icerik["dozajAcKomutu"];
                                                            }
                                                            ?>" type="number" name="dozajAcKomutu" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Dozaj Kapat Komutu:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">M</span>
                                            <input value="<?php
                                                            if ($edit) {
                                                                echo $icerik["dozajKapatKomutu"];
                                                            }
                                                            ?>" type="number" name="dozajKapatKomutu" class="form-control" required>
                                        </div>
                                    </div>
                                    <!--<div class="col-6">
                                        <label class="form-label">G00 Hız:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">F</span>
                                            <input type="number" name="g00Hiz" class="form-control" required>
                                        </div>
                                    </div>-->
                                    <div class="col-12">
                                        <label class="form-label">G1 Hız:</label>
                                        <div class="input-group mb-3 col-6">
                                            <span class="input-group-text">F</span>
                                            <input value="<?php
                                                            if ($edit) {
                                                                echo $icerik["g01Hiz"];
                                                            }
                                                            ?>" type="number" name="g01Hiz" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Home X Kordinatı:</label>
                                        <input value="<?php
                                                        if ($edit) {
                                                            echo $icerik["homeXKordinati"];
                                                        }
                                                        ?>" type="number" name="homeXKordinati" class="form-control" required step="0.01">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Home Y Kordinatı:</label>
                                        <input value="<?php
                                                        if ($edit) {
                                                            echo $icerik["homeYKordinati"];
                                                        }
                                                        ?>" type="number" name="homeYKordinati" class="form-control" required step="0.01">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Home Z Kordinatı:</label>
                                        <input value="<?php
                                                        if ($edit) {
                                                            echo $icerik["homeZKordinati"];
                                                        }
                                                        ?>" type="number" name="homeZKordinati" class="form-control" required step="0.01">
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
            $aciklama = $_SESSION["bilgi"]["aciklama"] = $_POST["aciklama"];
            $x = $_SESSION["bilgi"]["x"] = str_replace(",", ".", $_POST["x"]);
            $y = $_SESSION["bilgi"]["y"] = str_replace(",", ".", $_POST["y"]);
            $emniyetliYukseklik = $_SESSION["bilgi"]["emniyetliYukseklik"] = str_replace(",", ".", $_POST["emniyetliYukseklik"]);
            //$g00Hiz = $_POST["g00Hiz"];
            $g01Hiz = $_SESSION["bilgi"]["g01Hiz"] = $_POST["g01Hiz"];
            if ($edit) {
                $veri_array = $icerik["veri_array"];
            } else {
                $veri_array = $_SESSION["bilgi"]["veri_array"] = $_SESSION["veri_array"];
            }
            if (isset($_SESSION["aci_degeri"]) && isset($_SESSION["uzunluk"])) {
                $aci_degeri = $_SESSION["aci_degeri"];
                $uzunluk = $_SESSION["uzunluk"];
            }
            $homeXKordinati = $_SESSION["bilgi"]["homeXKordinati"] = str_replace(",", ".", $_POST["homeXKordinati"]);
            $homeYKordinati = $_SESSION["bilgi"]["homeYKordinati"] = str_replace(",", ".", $_POST["homeYKordinati"]);
            $homeZKordinati = $_SESSION["bilgi"]["homeZKordinati"] = str_replace(",", ".", $_POST["homeZKordinati"]);

            $_SESSION["bilgi"]["emniyetliYukseklik"] = $_POST["emniyetliYukseklik"];
            $_SESSION["bilgi"]["dozajAcKomutu"] = $_POST["dozajAcKomutu"];
            $_SESSION["bilgi"]["dozajKapatKomutu"] = $_POST["dozajKapatKomutu"];
            $_SESSION["bilgi"]["islemYuksekligi"] = str_replace(",", ".", $_POST["islemYuksekligi"]);
            function a_ret($grupNo)
            {
                $emniyetliYukseklik = $_POST["emniyetliYukseklik"];
                $dozajAcKomutu = $_POST["dozajAcKomutu"];
                $dozajKapatKomutu = $_POST["dozajKapatKomutu"];
                $islemYuksekligi = str_replace(",", ".", $_POST["islemYuksekligi"]);
                $sure1 = $_SESSION["bilgi"]["sure1"] = $_SESSION['sure1'];
                $sure2 = $_SESSION["bilgi"]["sure2"] = $_SESSION['sure2'];
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
            function kordinatHesap($value, $x, $y, $emniyetliYukseklik, $gDurum)
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
                        global $veri_x, $veri_y, $gDurum;
                        $_SESSION["veri_x_baslangic"] = $veri_x_baslangic = $_SESSION["veri_x"] - ($uzunluk / 2);
                        $_SESSION["veri_x_bitis"] = $veri_x_bitis = $_SESSION["veri_x"] + ($uzunluk / 2);
                        echo "G" . $gDurum . "X" . $veri_x_baslangic . "Y" . $_SESSION["veri_y"] . "Z" . $emniyetliYukseklik . "<br>";
                    }
                }
                if (!function_exists('aci_90')) {
                    function aci_90($uzunluk, $emniyetliYukseklik)
                    {
                        global $veri_x, $veri_y, $gDurum;
                        $_SESSION["veri_y_baslangic"] = $veri_y_baslangic = $_SESSION["veri_y"] - ($uzunluk / 2);
                        $_SESSION["veri_y_bitis"] = $veri_y_bitis = $_SESSION["veri_y"] + ($uzunluk / 2);
                        echo "G" . $gDurum . "X" . $_SESSION["veri_x"] . "Y" . $veri_y_baslangic . "Z" . $emniyetliYukseklik . "<br>";
                    }
                }
                // echo "X" . $veri_x . "Y" . $veri_y . "Z" . $emniyetliYukseklik . "<br>";
            } ?>
            <a onclick="dosyayaYaz()" class="btn btn-outline-primary mb-3 col-sm-1" style="position: fixed;right: 5%;top: 16%;">İndir</a>
            <div class="col-sm-1" style="position: fixed;right: 5%;top: 22%;">
                <a onclick="sirala()" class="btn btn-outline-warning mb-3 col-12">Sırala</a>
                <div>
                    <p class="m-0">X Başlangıç:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="xBaslangic" id="xSol" checked>
                        <label class="form-check-label" for="xSol">
                            Sol
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="xBaslangic" id="xSag">
                        <label class="form-check-label" for="xSag">
                            Sağ
                        </label>
                    </div>
                </div>
                <hr>
                <div>
                    <p class="m-0">Y Başlangıç:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="yBaslangic" id="yAlt" checked>
                        <label class="form-check-label" for="yAlt">
                            Alt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="yBaslangic" id="yUst">
                        <label class="form-check-label" for="yUst">
                            Üst
                        </label>
                    </div>
                </div>
                <hr>
                <div>
                    <p class="m-0">Yön:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="yonSec" id="xYon" checked>
                        <label class="form-check-label" for="xYon">
                            X
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="yonSec" id="yYon">
                        <label class="form-check-label" for="yYon">
                            Y
                        </label>
                    </div>
                </div>
            </div>
            <button id="copy_btn" class="btn btn-outline-success col-sm-1" style="position: fixed;right: 5%;top: 10%;" onclick="metniKopyala()">Kopyala</button>
            <a href="?clear=true" class="btn btn-outline-secondary col-sm-1" style="position: fixed;left: 18%;top: 10%;">Temizle</a>
            <script>
                var siralanmis = false;

                function sirala() {
                    var cikarElemani = document.getElementById("cikar");
                    if (!cikarElemani) return;

                    var veri = cikarElemani.innerText.trim();
                    var satirlar = veri.split('\n');

                    var bloklar = [];
                    let geciciBlok = [];

                    // Blokları ayır
                    for (let satir of satirlar) {
                        satir = satir.trim();
                        if (satir === "") {
                            if (geciciBlok.length > 0) {
                                bloklar.push(geciciBlok);
                                geciciBlok = [];
                            }
                        } else {
                            geciciBlok.push(satir);
                        }
                    }
                    if (geciciBlok.length > 0) bloklar.push(geciciBlok);

                    // Değer çıkarıcı fonksiyonlar
                    function yDegeriAl(blok) {
                        var match = blok[0].match(/Y([0-9.]+)/);
                        return match ? parseFloat(match[1]) : 0;
                    }

                    function xDegeriAl(blok) {
                        var match = blok[0].match(/X([0-9.]+)/);
                        return match ? parseFloat(match[1]) : 0;
                    }

                    // Yön bilgilerini al
                    var yAlt = document.getElementById("yAlt").checked;
                    var xSol = document.getElementById("xSol").checked;

                    // Yönü kontrol et (X ya da Y)
                    var yonSecim = document.querySelector('input[name="yonSec"]:checked').id;

                    if (yonSecim === "xYon") {
                        // Y'ye göre sırala (yatayda ilerleyeceğiz, satırlar yukarı/ aşağı)
                        bloklar.sort((a, b) => {
                            return yAlt ? yDegeriAl(a) - yDegeriAl(b) : yDegeriAl(b) - yDegeriAl(a);
                        });
                    } else {
                        // X’e göre sırala (dikeyde ilerleyeceğiz, sütunlar sola/sağa)
                        bloklar.sort((a, b) => {
                            return xSol ? xDegeriAl(a) - xDegeriAl(b) : xDegeriAl(b) - xDegeriAl(a);
                        });
                    }

                    var sonuc = [];

                    if (yonSecim === "xYon") {
                        var ekle = "X";
                        // Y’ye göre sırala
                        bloklar.sort((a, b) => yAlt ? yDegeriAl(a) - yDegeriAl(b) : yDegeriAl(b) - yDegeriAl(a));

                        // Aynı Y'ye sahip blokları grupla
                        let gruplar = {};
                        for (let blok of bloklar) {
                            let y = yDegeriAl(blok);
                            if (!gruplar[y]) gruplar[y] = [];
                            gruplar[y].push(blok);
                        }


                        // Grupları sırayla işle
                        Object.keys(gruplar)
                            .sort((a, b) => yAlt ? a - b : b - a)
                            .forEach((y, index) => {
                                let grup = gruplar[y];
                                grup.sort((a, b) => xSol ? xDegeriAl(a) - xDegeriAl(b) : xDegeriAl(b) - xDegeriAl(a));
                                if (index % 2 !== 0) grup.reverse();
                                sonuc.push(...grup);
                            });

                    } else {
                        var ekle = "Y";
                        // X’e göre sırala
                        bloklar.sort((a, b) => xSol ? xDegeriAl(a) - xDegeriAl(b) : xDegeriAl(b) - xDegeriAl(a));

                        // Aynı X'e sahip blokları grupla
                        let gruplar = {};
                        for (let blok of bloklar) {
                            let x = xDegeriAl(blok);
                            if (!gruplar[x]) gruplar[x] = [];
                            gruplar[x].push(blok);
                        }

                        // Grupları sırayla işle
                        Object.keys(gruplar)
                            .sort((a, b) => xSol ? a - b : b - a)
                            .forEach((x, index) => {
                                let grup = gruplar[x];
                                grup.sort((a, b) => yAlt ? yDegeriAl(a) - yDegeriAl(b) : yDegeriAl(b) - yDegeriAl(a));
                                if (index % 2 !== 0) grup.reverse();
                                sonuc.push(...grup);
                            });
                    }


                    // HTML çıktısı oluştur
                    document.getElementById("cikar").innerHTML = "";
                    document.getElementById("cikar").style.whiteSpace = 'pre-wrap';

                    sonuc.forEach((blok, index) => {
                        var satirlar = blok.map((line, lineIndex) => {
                            if (index === 0 && lineIndex === 0) {
                                return line.replace(/^G1/, 'G0');
                            } else if (lineIndex === 0) {
                                return line.replace(/^G0/, 'G1');
                            }
                            return line;
                        });

                        var satirHtml = satirlar.map(s => s.replace(/,/g, ',<br>')).join('<br>') + '<br><br>';
                        document.getElementById("cikar").innerHTML += satirHtml;
                    });

                    // Tüm virgülleri en sonda sil
                    var finalHtml = document.getElementById("cikar").innerHTML.replace(/,/g, '');
                    document.getElementById("cikar").innerHTML = finalHtml;

                    siralanmis = true;

                    var xSecim = document.querySelector('input[name="xBaslangic"]:checked');
                    var ySecim = document.querySelector('input[name="yBaslangic"]:checked');

                    var xLabel = document.querySelector(`label[for="${xSecim.id}"]`).innerText.trim();
                    var yLabel = document.querySelector(`label[for="${ySecim.id}"]`).innerText.trim();

                    function turkceToIngilizce(str) {
                        return str
                            .replace(/ç/g, "c").replace(/Ç/g, "C")
                            .replace(/ğ/g, "g").replace(/Ğ/g, "G")
                            .replace(/ı/g, "i").replace(/İ/g, "I")
                            .replace(/ö/g, "o").replace(/Ö/g, "O")
                            .replace(/ş/g, "s").replace(/Ş/g, "S")
                            .replace(/ü/g, "u").replace(/Ü/g, "U");
                    }

                    xLabel = turkceToIngilizce(xLabel);
                    yLabel = turkceToIngilizce(yLabel);

                    var isim = `${ekle}_${xLabel}_${yLabel}_Siralanmis`;
                    // Sunucuya gönder
                    var baslik = document.getElementById("sonucAciklama").innerText;
                    gonder(baslik + "_" + isim);
                    console.log(sonuc);
                }

                function gonder(name = null) {
                    var yazi = document.getElementById("kopyala").innerText;
                    let body = "veri=" + encodeURIComponent(yazi);

                    if (name !== null) {
                        body += "&name=" + encodeURIComponent(name);
                    }

                    fetch("index.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: body
                        })
                        .then(response => response.text())
                        .then(data => {
                            //console.log("Session'a kaydedildi:", name ?? "(sadece veri)");
                        });
                }

                function dosyayaYaz() {
                    var icerik = document.getElementById("kopyala").innerText;

                    var blob = new Blob([icerik], {
                        type: "text/plain;charset=utf-8"
                    });
                    var url = URL.createObjectURL(blob);

                    if (siralanmis == true) {
                        var aciklama = "<?= $aciklama; ?>_Siralanmis";
                    } else {
                        var aciklama = "<?= $aciklama; ?>";
                    }
                    if (aciklama == "") {
                        aciklama = "gkod";
                    }

                    var a = document.createElement("a");
                    a.href = url;
                    a.download = aciklama + ".tap";
                    a.click();

                    URL.revokeObjectURL(url);
                }

                function metniKopyala() {
                    let metin = document.getElementById("kopyala").innerText;
                    let textarea = document.createElement("textarea");
                    textarea.value = metin;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand("copy");
                    document.body.removeChild(textarea);
                    document.getElementById("copy_btn").innerHTML = "Kopyalandı";
                    document.getElementById("copy_btn").classList.add("btn-outline-success");
                }
            </script>
        <?php
            echo "<pre class='container col-sm-5 fs-6 mt-5 pt-2 border rounded shadow-lg ps-4' id='kopyala' style='font-size: 0.8rem!important;'>";
            echo "(<span id='sonucAciklama'>$aciklama</span>)<br>";
            //echo "G0F$g00Hiz" . "<br>";
            echo "G1F" . $g01Hiz . "<br>";
            echo "G0X" . $homeXKordinati . "Y" . $homeYKordinati . "Z" . $homeZKordinati . "<br><br>";

            echo '<span id="cikar">';
            if ($edit) {
                $veri_array = $icerik["veri_array"];
            }
            foreach ($veri_array as $index => $item) {
                if ($index == 0) {
                    $gDurum = 0;
                } else {
                    $gDurum = 1;
                }
                foreach ($item as $key => $value) {
                    if ($key == "Location") {
                        kordinatHesap($value, $x, $y, $emniyetliYukseklik, $gDurum);
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
                                echo "G" . $gDurum . $_SESSION["d0_location"] . "Z" . $emniyetliYukseklik . "<br>";
                                a_ret(0);
                            }
                        }
                    }
                }
                echo "<br>";
            }
            echo '</span>';

            global $homeXKordinati, $homeYKordinati, $homeZKordinati;
            echo "G0X" . $homeXKordinati . "Y" . $homeYKordinati . "Z" . $homeZKordinati . "<br>";
            echo "M30";
            echo "</pre>";
        }
        ?>
    </div>
    <?php
    if (isset($_POST['veri'])) {
        $yeniVeri = $_POST['veri'];
        if (isset($_POST["name"])) {
            $_SESSION["bilgi"]["aciklama"] = $_POST["name"];
        }
        if (!isset($_SESSION['icerik']) || !is_array($_SESSION['icerik'])) {
            $_SESSION['icerik'] = [];
        }
        $_SESSION["bilgi"]["zaman"] = date("d.m.Y H:i:s");
        $bilgi = $_SESSION['bilgi'];
        $_SESSION['icerik'][] = array_merge(
            ['cikti' => $yeniVeri],
            $bilgi
        );

        //En son çıktıyı ekrenda gösterdiğimizde sessiondaki gerekli verileri siliyoruz
        $_SESSION["gizle"] = true;
        $temp = $_SESSION['icerik'] ?? null;
        if ($temp !== null) {
            $_SESSION['icerik'] = $temp;
        }
        //session_unset();
    }
    ?>
    <script>
        document.getElementById("home-collapse").classList.add("show");
        gonder();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>