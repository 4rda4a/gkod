<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G KOD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div>
        <div class="col-sm-3">
            <?php
            date_default_timezone_set('Europe/Istanbul');
            session_start();
            include "navbar.php";
            ?>
        </div>
        <div id="main" class="col-sm-10 ps-3 float-end mt-4">
            <div class="container col-sm-11 mt-5 pt-5">
                <h4>G Kod Geçmişi</h4>
                <div class="accordion accordion-flush" id="gecmis">
                    <?php
                    if (isset($_SESSION["icerik"])) {
                        foreach ($_SESSION["icerik"] as $key => $value) {
                    ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item<?= $key ?>"
                                        aria-expanded="false" aria-controls="item<?= $key ?>">
                                        <?= !empty($value["aciklama"]) ? $value["aciklama"] : "G-Kod"; ?>
                                        <?=  " - " . $value["zaman"]; ?>
                                    </button>
                                </h2>
                                <div id="item<?= $key ?>" class="accordion-collapse collapse" data-bs-parent="#gecmis">
                                    <div class="accordion-body">
                                        <a class="btn btn-outline-success col-sm-2" href="index.php?edit=<?= $key; ?>">Düzenle</a>
                                        <a onclick="dosyayaYaz(<?= $key; ?>, '<?= $value['aciklama']; ?>')" class="btn btn-outline-primary col-sm-2">İndir</a>
                                        <pre class="d-none" id="kopyala_<?= $key; ?>"><?= $value['cikti']; ?></pre>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else {
                        echo 'Daha önce G Kod oluşturulmamıştır.';
                        echo '<p><a class="btn btn-outline-primary" href="./">G Kod Oluştur</a></p>';
                    } ?>
                </div>
            </div>
        </div>
        <script>
            function dosyayaYaz(id, aciklama) {
                const icerik = document.getElementById("kopyala_" + id).innerText;

                const blob = new Blob([icerik], {
                    type: "text/plain;charset=utf-8"
                });
                const url = URL.createObjectURL(blob);

                if (aciklama == "") {
                    aciklama = "gkod";
                }

                const a = document.createElement("a");
                a.href = url;
                a.download = aciklama + ".tap";
                a.click();

                URL.revokeObjectURL(url);
            }
            document.getElementById("home-collapse").classList.add("show");
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>