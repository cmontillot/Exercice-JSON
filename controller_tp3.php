<?php
    function convertImage($source, $dst, $width, $height, $quality){
        $imageSize = getimagesize($source) ;
        $imageRessource= imagecreatefromjpeg($source) ;
        $imageFinal = imagecreatetruecolor($width, $height) ;
        $final = imagecopyresampled($imageFinal, $imageRessource, 0,0,0,0, $width, $height, $imageSize[0], $imageSize[1]) ;
        imagejpeg($imageFinal, $dst, $quality) ;
    } 

    $message_fichier = '';
    if(isset($_FILES['fichier']))
    {
        $nomOrigine = $_FILES['fichier']['name'];
        $fichier = basename($_FILES['fichier']['name']);
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];
        $taille = filesize($_FILES['fichier']['tmp_name']);
        $extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
        $taille_maxi = 5000000;
        if (!(in_array($extensionFichier, $extensionsAutorisees))) {
            $message_fichier = '<div class="invalid-feedback">Le fichier n\'a pas l\'extension attendue.</div>';
            
        } elseif ($taille > $taille_maxi) {
            $message_fichier = '<div class="invalid-feedback">Le fichier est trop volumineux.</div>';
        }
        else
        {    
            // Upload du fichier après renommage
            $repertoireDestination = 'image/';
            $nomDestination = "fichier_du_".date("dmYHis").".".$extensionFichier;
            if(move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoireDestination.$nomDestination)) {
                // Réduction taille de l'image par 4
                list($width, $height, $type, $attr) = getimagesize($repertoireDestination.$nomDestination);
                convertImage($repertoireDestination.$nomDestination, 'image_final/'.$nomDestination, $width/4, $height/4, 100);

                // Création / Ecriture du fichier JSON
                $repertoireDestination = 'image_final/';
                $ecritureBDD = array($repertoireDestination.$nomDestination);

                if(!file_exists('bd_json.json')) $bytes = file_put_contents('bd_json.json', json_encode($ecritureBDD)); 
                else 
                {
                    $lectureBDD = file_get_contents('bd_json.json');
                    $lectureBDD = json_decode($lectureBDD, true);
                    array_push($lectureBDD, stripslashes($repertoireDestination.$nomDestination));
                    file_put_contents('bd_json.json', json_encode($lectureBDD)); 
                }

                $message_fichier = '1';
            }
            else{
                $message_fichier = '<div class="invalid-feedback">Problème lors de l\'UPLOAD du fichier.</div>';
            }

        }
    }
?>