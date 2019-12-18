<?php
    $arrInfo=$_FILES['Filedata'];
    $fileName=$arrInfo['name'];
    $tmpName=$arrInfo['tmp_name'];
    $ext=explode(".",$fileName)[1];
    $baseName=md5(uniqid()).".$ext";
    $baseDir=date("Y/m/d/",time());
    if(!is_dir($baseDir)){
        mkdir($baseDir,0,777);
    }
    $filePath=$baseDir.$baseName;
    move_uploaded_file($tmpName,$filePath);
    echo $filePath;
?>