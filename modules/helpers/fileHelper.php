<?php 
    function searchFile($dir, $fileToSearch){
        
        $files = scandir($dir);

        foreach($files as $key => $value){

            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

            if(!is_dir($path)) {
                if($fileToSearch == $value){
                    return $path;
                }
            } else if($value != "." && $value != "..") {
                searchFile($path, $fileToSearch);
            }  
        } 
    }
?>