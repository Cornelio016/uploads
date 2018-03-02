<?php


if(isset($_POST["submit"])) {
    if(is_array($_FILES)) {

    
        $file = $_FILES['image']['tmp_name']; 
        $sourceProperties = getimagesize($file);
        $fileNewName = time();
        $folderPath = "uploads/";
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];


        switch ($imageType) {

             

            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromgif($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagegif($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                break;


            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                break;


            default:
                echo "Invalid Image type.";
                exit;
                break;
        }


     
    
        
    }

  


}


function imageResize($imageResourceId,$width,$height) {


    $targetWidth =250;
    $targetHeight =173;


    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);


    return $targetLayer;
}   




       $files = glob("uploads/*.*");
        for ($i=0; $i<count($files); $i++)
        {
            $num = $files[$i];
            echo '<img src="'.$num.'" alt="random image">';
        }

           if ($_FILES["image"]["size"] > 200000) {
                $uploadOk = 0;
            }


?>