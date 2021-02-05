<?php
    include("controller_tp3.php");
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<title>LA MANU - PARTIE 8 PHP - TP3 BONUS</title>
        <style type="text/css">
            body {
                background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
                background-repeat: no-repeat;
            }
            .alert {
                padding:.10rem 1.25rem;
            }
            #formul {
                background-color: white;
                border-radius: 10px;
            }
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            }
        </style>
	</head>
	<body>
        <div class="container justify-align-center p-4">
            <div class="row p-1">
                <div class="col-sm-2">    
                </div>
                <div class="col-sm-8 container justify-align-center p-4 shadow" id="formul">
                <form class="row g-3 needs-validation" novalidate action="index.php" method="POST" enctype="multipart/form-data">       
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                        <h3>TP3 BONUS</h3>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-6"> 
                        <label for="fichier" class="form-label">Seuls les fichiers JPEG, JPG, GIF et PNG sont autorisés<br>(5 Mo max)</label>
                        <input type="file" class="form-control <?php if($message_fichier!='' && $message_fichier!='1') echo 'is-invalid'; elseif($message_fichier=='1') echo 'is-valid';?>" id="fichier" name="fichier" required>
                        <?php
                        if($message_fichier!='' && $message_fichier!='1') echo $message_fichier;
                        if($message_fichier=='1') echo '<div class="valid-feedback">Fichier uploadé avec succès.</div>';
                        ?>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <input type="submit" value="Envoyer" name="envoi" id="envoi" class="btn btn-primary">
                    </div>
                    <div class="col-md-5"></div>
                </form></br>
                <?php
                // SI le fichier JSON existe
                if(file_exists('bd_json.json'))
                {
                ?>
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                    <?php
                    $lectureBDD = file_get_contents('bd_json.json');
                    $lectureBDD = json_decode($lectureBDD, true);
                    $i=1; 
                    foreach ($lectureBDD as $contenu) { 
                        if($i==1)
                        {
                            ?>
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="<?php echo $contenu; ?>" alt="Image 1">
                                </div>
                            <?php
                        }
                        else {
                        ?>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?php echo $contenu; ?>" alt="Image <?php echo $i; ?>">
                            </div>
                        <?php
                        }
                        $i++;
                    }
                    ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                    </div>
                   <?php
                }
                ?>
                </div>
                <div class="col-sm-2">    
                </div>

            </div>
        </div>                                             
	</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script>

        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
</html>
