<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <style>
        .col-sm-2 {
            padding: 10px;
        }

        .card {
            height: 15rem;
            margin: 0;
        }

        .no1 {
            padding-top: 2%;
        }

        .card-title {
            vertical-align: middle;
        }
    </style>

    <?php
    $mysqli = new mysqli("localhost", "root", "", "webdesignWebsite");

    //echo $mysqli->host_info . "\n";

    $query = "SELECT * FROM File ";

    $check2 = "";
    $check3 = "";
    $check4 = "";


    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ordina e filtra i contenuti:</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ordina per: <?php echo $_GET['radiocheck'] ?>
                        </a>
                        
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <form method="get">
                            <li><b class="dropdown-item-text font-weight-bold">Data:</b></li>
                            <li>
                                <div class="container">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radiocheck" id="radiocheck" onClick="submit();" value="dal piu recente">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            dal più recente
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radiocheck" id="radiocheck" onClick="submit();" value="dal meno recente" >
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            dal meno recente
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><b class="dropdown-item-text">Lettere:</b></li>
                            <li>
                                <div class="container">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radiocheck" id="radiocheck" onClick="submit();" value="daAaZ" >
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            dalla A alla Z
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radiocheck" id="radiocheck" onClick="submit();" value="daZaA">
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            dalla Z alla A
                                        </label>
                                    </div>
                                </div>
                            </li>
                            </form>

                            <?php 
                            if(isset($_GET['radiocheck'])) {
                                if($_GET['radiocheck'] == 'dal piu recente') {
                                    $query .= "ORDER BY DataCreazione ASC";
                                    $check1 = "checked";
                                }
                                if($_GET['radiocheck'] == 'dal meno recente') {
                                    $query .= "ORDER BY DataCreazione DESC";
                                }
                                if($_GET['radiocheck'] == 'daAaZ') {
                                    $query .= "ORDER BY Nome ASC";
                                }
                                if($_GET['radiocheck'] == 'daZaA') {
                                    $query .= "ORDER BY Nome DESC";
                                }
                                $scelte = $_get['radiocheck'];
                            }
                            ?>

                        </ul>
 
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Ricerca per titolo" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><? echo $valore ?></button>
                </form>
            </div>
        </div>
    </nav>

    <!-- <div class="container">
        <select name="fetchval" id="fetchval">
            <option value="dal più recente">dal più recente</option>
            <option value="dal meno recente">dal meno recente</option>
        </select>
    </div> -->


    <div class="container no1">
        <?php

        $result = $mysqli->query($query);

        if ($result = mysqli_query($mysqli, $query)) {
            //echo "Le righe sono: " . mysqli_num_rows($result) . "\n";

            $count = 0;
            $outputHTML = "<div class='row'>";

            while ($row = mysqli_fetch_assoc($result)) {
                $path = $row['URL'];
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                if ($extension == 'docx') {
                    $image_icon = 'Immagini icone/docx.jpg';
                }
                $nome = $row['Nome'];
                $nome = pathinfo($nome, PATHINFO_FILENAME);
                $outputHTML .= "<div class='col-sm-2'><div class='card' style='width: 12rem'>";
                $outputHTML .= "<img src='" . $image_icon . "' class='card-img-top' alt='...'><div class='card-body'><a data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
                <h5 class='card-title'></a>" . $nome . "</h5></div></div>";
                //$outputHTML.="<img class='img-fluid' src='" . $row['URL']."'>";
                $count++;
                if ($count % 6 == 0)
                    $outputHTML .= "</div></div><div class='row'>";
                else
                    $outputHTML .= "</div>";
            }
            echo $outputHTML . "</div>";
        }

        ?>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>


    <!--
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="card" >
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->




    <!-- Optional JavaScript; choose one of the two! 
    <script type="text/javascript">
        $(document).ready(function() {
                $("#fetchval").on('change', function() {
                    var value = $(this).val();
                    alert(value);
                })
            }
        );
    </script>

     Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
