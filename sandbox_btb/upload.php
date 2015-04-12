<?php
$upload_errors = array(
    0                        => "There is no error, the file uploaded with success"
    ,UPLOAD_ERR_INI_SIZE    => "The uploaded file exceeds the upload_max_filesize directive in php.ini"
    ,UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"
    ,UPLOAD_ERR_PARTIAL        => "The uploaded file was only partially uploaded"
    ,UPLOAD_ERR_NO_FILE        => "No file was uploaded"
);
//print_r(isset($_FILES['file_upload']) ? $_FILES['file_upload'] : null);
$message = isset($_FILES['file_upload']) ? $upload_errors[$_FILES['file_upload']['error']] : null;

//$message = $upload_errors[isset($error) ? $error : ""];
echo "<hr />";
?>

<html>
    <head>
        <title>Upload</title>
    </head>
    <body>
        
        <?php if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
        
        <!-- This shows that this data will be sent in multiple parts..as we are uploading a file -->
        <form action ="upload.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <!-- Input type for file upload -->
            <input type="file" name="file_upload" />
            
            <input type="submit" name="submit" value="Upload" />
    
        </form>
    </body>
</html>