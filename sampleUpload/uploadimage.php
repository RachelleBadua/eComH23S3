<html>
    <body>
        <!-- 1. HTML fom with file upload control -->
        <form action="" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>


</html>

<?php

    if(isset($_POST["submit"])){
    // 2. Read the uploaded file and move it to the target location
    
    //Specify wher ethe uploaded file will be put 
    $target_dir = "uploads/";

    
    // Specify the name of the uploaded file
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    // Move uploaded file to target location
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    }

?>