<?php
include("db/db.php");

$diller = $db->query("
SELECT l.languageName FROM language l
")->fetchAll(5);

if (isset($_POST['submit_button'])) { 

    $params = [
        $_POST['languageName']
    ];

    $sql = "INSERT INTO language (languageName) 
    VALUES (?)";
    $stmt= $db->prepare($sql);
    $stmt->execute($params);

    header("Location: ./diller");
    die();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tez Merkezi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>
    <header class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./index.php">Anasayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./tezler.php">Tezler</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Kategoriler</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./universiteler.php">Üniversiteler</a></li>
                            <li><a class="dropdown-item" href="./fakulteler.php">Fakülteler</a></li>
                            <li><a class="dropdown-item" href="./kisiler.php">Kişiler</a></li>
                            <li><a class="dropdown-item" href="./konular.php">Konular</a></li>
                            <li><a class="dropdown-item" href="./etiketler.php">Anahtar Kelimeler</a></li>
                            <li><a class="dropdown-item" href="./diller.php">Diller</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <nav class="container" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./index.php">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="./tezler.php">Kategoriler</a></li>
            <li class="breadcrumb-item active" aria-current="page">Diller</li>
        </ol>
    </nav>
    <main class="container">
        <h1>Diller</h1>
        <table id="tbl_language" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Dil Adı</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($diller as $dil): ?>
                <tr>
                    <td><?php echo $dil->languageName ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <p class="d-inline-flex gap-1"> 
            <a class="btn btn-primary btn-lg" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
            Yeni Dil Ekle
            </a>
        </p>
        <div class="collapse" id="collapseExample" style="">
            <div class="card card-body">
                <form method="POST">
                    <label class="form-label">Dil Adı</label>
                    <input type="text" class="form-control" placeholder="Lütfen giriniz" name="languageName" value="" required>
                    <br>
                    <button type="submit" name= "submit_button" class="btn btn-primary">Ekle</button>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
    
    <script>
    $( document ).ready(function() {
        new DataTable('#tbl_language', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json',
            },
        });
    });      
    </script>
</body>

</html>