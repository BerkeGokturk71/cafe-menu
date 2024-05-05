<?php
    function readData(){
        $jsonData = file_get_contents("menu.json");
        $json = json_decode($jsonData,true);
        return $json;
    }
    function uploadImage(array $file){
        if(isset($file)){
            $dest_path = "./images/";
            $filename = $file["name"];
            $fileSourcePath = $file["tmp_name"];
            $fileDestPath = $dest_path.$filename;
    
            move_uploaded_file($fileSourcePath,$fileDestPath);
        }
    }
?>