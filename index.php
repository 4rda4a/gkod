<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stajyer Mülakat Sorusu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .durumKutu {
            display: none;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    $veri_array = [];
    $aperture_degerleri = [];
    $grup_sayi = 0;

    if (isset($_SESSION['aperture_degerleri'])) {
        $aperture_degerleri = $_SESSION['aperture_degerleri'];
    }
    if (isset($_GET["clear"]) && $_GET["clear"] == true) {
        session_destroy();
        header("location: /");
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
        <form method="post" class="container col-sm-6 my-5">
            <h4>İçerik Girişi</h4>
            <textarea name="text" class="form-control" rows="10"></textarea>
            <button class="btn btn-primary mt-3 col-sm-3" type="submit" name="submit">Gönder</button>
        </form>
    <?php }
    if (isset($_POST['set_grup_sayi'])) {
        $grup_sayi = (int)$_POST['grup_sayi'];
    } ?>
    <?php if (!empty($aperture_degerleri) && isset($_POST["submit"])) { ?>
        <div class="container col-sm-6 mt-4">
            <h5>Aperture used Sayısı: <?= count($aperture_degerleri); ?></h5>
        </div>

        <form method="post" class="container col-sm-6 mt-3">
            <h5>Kaç grup oluşturmak istiyorsunuz?</h5>
            <input type="number" name="grup_sayi" class="form-control" min="1" max="<?= count($aperture_degerleri); ?>" autofocus>
            <button class="btn btn-primary mt-3" type="submit" name="set_grup_sayi">Grup Sayısını Belirle</button>
        </form>
    <?php }
    if ($grup_sayi > 0 && !empty($aperture_degerleri)) { ?>
        <div class="container col-sm-6 mt-4">
            <h5>Gruba ata:</h5>
            <form method="post">
                <div>
                    <h6>Grup D0 için süre seçimi:</h6>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Süre Girişi 1:</label>
                            <input type="number" name="sure1[0]" class="form-control" value="1000">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Süre Girişi 2:</label>
                            <input type="number" name="sure2[0]" class="form-control" value="2000">
                        </div>
                    </div>
                </div>
                <?php for ($i = 1; $i <= $grup_sayi; $i++) { ?>
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
                            <label class="form-check-label" for="grupDurum<?= $i; ?>">
                                Grup D<?= $i; ?> Durum:
                            </label>
                            <div class="form-check d-inline-block align-middle">
                                <input class="form-check-input" type="checkbox" name="grupDurum[<?= $i; ?>]" id="grupDurum<?= $i; ?>">
                            </div>
                        </div>
                        <div class="durumKutu" id="durumKutuId<?= $i; ?>">
                            <div class="row border-bottom pb-2">
                                <div class="col-6">
                                    <label for="" class="form-label">Veri: </label>
                                    <div>
                                        <input type="number" name="veriGrup[<?= $i; ?>]" class="form-control" max="4.99" min="0" step="0.01" value="0">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Açı Değeri:</label>
                                    <select name="aci_degeri[<?= $i; ?>]" class="form-select">
                                        <option value="0" selected>0</option>
                                        <option value="90">90</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Süre Girişi 1:</label>
                            <input type="number" name="sure1[<?= $i; ?>]" class="form-control" value="1000">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Süre Girişi 2:</label>
                            <input type="number" name="sure2[<?= $i; ?>]" class="form-control" value="2000">
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
                <?php } ?>
                <button class="btn btn-primary" type="submit" name="grupKaydet">Grupları Kaydet</button>
            </form>
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
        $_SESSION['d0_sure2'] = $_POST['sure2'][0];
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
        <div class="container col-sm-6 mt-4">
            <div class="mb-3">
                <h5>Kaydedilen Gruplar:</h5>
                <ul class="list-group">
                    <?php if (count($d0_) > 0) { ?>
                        <li class="list-group-item">Grup D0:
                            <?= implode(', ', $d0_); ?>
                            <br>
                            <?php if ($_POST['sure1'][0]) {
                            }  ?>
                            <?php if ($_POST['sure2'][0]) {
                            } ?>
                        </li>
                    <?php }
                    foreach ($seciliGrup as $grupNo => $grup) { ?>
                        <li class="list-group-item">
                            Grup D<?= $grupNo; ?>: <?= implode(', ', $grup); ?>
                            <br>
                            <?php if ($_POST['sure1'][$grupNo]) {
                                #echo "Süre1: " . $_POST['sure1'][$grupNo];
                            }  ?>
                            <?php if ($_POST['sure2'][$grupNo]) {
                                #echo " | Süre2: " . $_POST['sure2'][$grupNo];
                            } ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <form method="post" class="border-top">
                <h4 class="text-danger">Gerekli Bilgiler</h4>
                <div>
                    <label>Açıklama:</label>
                    <input type="text" name="aciklama" class="form-control" autofocus autocomplete="off" value="aciklama">
                </div>
                <div class="row">
                    <div class="col-6">
                        <label>X:</label>
                        <input type="number" name="x" class="form-control" required value="10">
                    </div>
                    <div class="col-6">
                        <label>Y:</label>
                        <input type="number" name="y" class="form-control" required value="-10">
                    </div>
                    <div class="col-6">
                        <label>Emniyetli Yükseklik:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Z</span>
                            <input type="number" name="emniyetliYukseklik" class="form-control" required value="10">
                        </div>
                    </div>
                    <div class="col-6">
                        <label>İşlem Yüksekliği:</label>
                        <div class="input-group mb-3 col-6">
                            <span class="input-group-text">Z</span>
                            <input type="number" name="islemYuksekligi" class="form-control" required value="15">
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Dozaj Aç Komutu:</label>
                        <div class="input-group mb-3 col-6">
                            <span class="input-group-text">M</span>
                            <input type="number" name="dozajAcKomutu" class="form-control" required value="102">
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Dozaj Kapat Komutu:</label>
                        <div class="input-group mb-3 col-6">
                            <span class="input-group-text">M</span>
                            <input type="number" name="dozajKapatKomutu" class="form-control" required value="202">
                        </div>
                    </div>
                    <div class="col-6">
                        <label>G00 Hız:</label>
                        <div class="input-group mb-3 col-6">
                            <span class="input-group-text">F</span>
                            <input type="number" name="g00Hiz" class="form-control" required value="10">
                        </div>
                    </div>
                    <div class="col-6">
                        <label>G01 Hız:</label>
                        <div class="input-group mb-3 col-6">
                            <span class="input-group-text">F</span>
                            <input type="number" name="g01Hiz" class="form-control" required value="10">
                        </div>
                    </div>
                    <div class="col-4">
                        <label>Home X Kordinatı:</label>
                        <input type="number" name="homeXKordinati" class="form-control" required value="10">
                    </div>
                    <div class="col-4">
                        <label>Home Y Kordinatı:</label>
                        <input type="number" name="homeYKordinati" class="form-control" required value="10">
                    </div>
                    <div class="col-4">
                        <label>Home Z Kordinatı:</label>
                        <input type="number" name="homeZKordinati" class="form-control" required value="10">
                    </div>
                    <div class="col-4 mt-3">
                        <button class="btn btn-primary col-12" name="bilgiKaydet">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    <?php
    }
    if (isset($_POST['bilgiKaydet'])) {
        if (isset($_SESSION["veri_array"])) {
            $veri_array = $_SESSION["veri_array"];
        }
        $aciklama = $_POST["aciklama"];
        $x = $_POST["x"];
        $y = $_POST["y"];
        $emniyetliYukseklik = $_POST["emniyetliYukseklik"];
        $g00Hiz = $_POST["g00Hiz"];
        function a_ret($grupNo)
        {
            $emniyetliYukseklik = $_POST["emniyetliYukseklik"];
            $dozajAcKomutu = $_POST["dozajAcKomutu"];
            $dozajKapatKomutu = $_POST["dozajKapatKomutu"];
            $homeXKordinati = $_POST["homeXKordinati"];
            $homeYKordinati = $_POST["homeYKordinati"];
            $islemYuksekligi = $_POST["islemYuksekligi"];
            $g01Hiz = $_POST["g01Hiz"];
            $homeZKordinati = $_POST["homeZKordinati"];

            // echo $value . "<br>";
            echo "G1Z$islemYuksekligi" . "F" . $g01Hiz . "<br>";
            echo "M$dozajAcKomutu<br>";
            echo "G4P" . $_SESSION['sure1'][$grupNo] . "<br>";
            echo "M$dozajKapatKomutu<br>";
            echo "G0Z$emniyetliYukseklik<br>";
            // echo "G4P" . $_SESSION['sure2'][$grupNo] . "<br>";
        }
        function kordinatHesap($value, $x, $y, $emniyetliYukseklik)
        {
            $kordinat = $value;
            preg_match('/X([\d.]+)Y([\d.]+)/', $kordinat, $cikti);
            $veri_x = $cikti[1];
            $veri_y = $cikti[2];
            $veri_x = floatval($veri_x) + floatval($x);
            $veri_y = floatval($veri_y) + floatval($y);
            echo "X" . $veri_x . "Y" . $veri_y . "Z" . $emniyetliYukseklik . "<br>";
        }
        echo "<div class='container col-sm-6'>";
        echo "($aciklama)<br>";
        echo "G0F$g00Hiz" . "<br><br>";
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
                            if (in_array($value, $grup)) {
                                a_ret($grupNo);
                                $bulundu = true;
                                break;
                            }
                        }

                        if (!$bulundu) {
                            a_ret(0);
                        }
                    }
                }
            }
            echo "<br><br>";
        }
        echo "</div>";
        // session_destroy();
    }
    ?>
    <div class="text-end container col-sm-6 mt-3">
        <a class="btn btn-danger" href="?clear=true">Temizle</a>
    </div>
</body>

</html>