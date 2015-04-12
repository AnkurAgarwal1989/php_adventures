<?php
$upload_errors = array(
    0                        => "There is no error, the file uploaded with success"
    ,UPLOAD_ERR_INI_SIZE    => "The uploaded file exceeds the upload_max_filesize directive in php.ini"
    ,UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"
    ,UPLOAD_ERR_PARTIAL        => "The uploaded file was only partially uploaded"
    ,UPLOAD_ERR_NO_FILE        => "No file was uploaded"
);

if(isset($_POST['submit'])){
    //process form data
    $tmp_file_name = $_FILES['file_upload']['tmp_name'];
    
    //we can give any target name..here we are just getting the file name and escaping it
    $target_file_name = basename($_FILES['file_upload']['name']);
    echo $target_file_name . PHP_EOL;
    $upload_dir = "uploads";
    
    //We would need to check if the file already exists so that we don't over write it
    if(move_uploaded_file($tmp_file_name, $upload_dir."/".$target_file_name)){
        $message = "File uploaded successfully";
    }else{
        $error = $_FILES['file_upload']['error'];
        $message = $upload_errors[$error];
    }
}
?>

<html>
    <head>
        <title>Upload</title>
    </head>
    <body>
        
        <?php if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
        
        <!-- This shows that this data will be sent in multiple parts..as we are uploading a file -->
        <!-- This uploads files to server..where they live in a temporary directory.-->
        <form action ="upload.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <!-- Input type for file upload -->
            <input type="file" name="file_upload" />
            
            <input type="submit" name="submit" value="Upload" />
    
        </form>
    </body>
</html>