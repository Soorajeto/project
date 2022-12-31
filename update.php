<?php

/************************
    Project
    Name: Sooraj Rajan 
    Date: december 2022
    Description: Website

************************/

    require('connect.php');

// update check and if true sanitize and update the row

    if ($_POST['update']) {


        $fid = filter_input(INPUT_POST,'update', FILTER_SANITIZE_NUMBER_INT);

        $query = "SELECT * FROM product WHERE id=:id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $fid, PDO::PARAM_INT);
        $statement->execute();
        $quotes = $statement->fetch();


    function file_upload_path($original_filename, $upload_subfolder_name = 'images') {
       $current_folder = dirname(__FILE__);
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    

    function file_is_an_image($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];

        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = mime_content_type($temporary_path);

        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);

        return $file_extension_is_valid && $mime_type_is_valid; }

    
    
    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

    


    if ($image_upload_detected) {
        $image_filename       = $_FILES['image']['name'];
        $temporary_image_path = $_FILES['image']['tmp_name'];
        $new_image_path       = file_upload_path($image_filename);

        if (file_is_an_image($temporary_image_path, $new_image_path)) {
            move_uploaded_file($temporary_image_path, $new_image_path); 
        }
    
    } else $image_filename  = "noimage.jpeg"
        
    
    $name = filter_input(INPUT_POST, 'name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if ($_POST && (strlen($comment) >1) && !empty($comment) && (strlen($name) >1) && !empty($name)) {
    
        $query = "UPDATE product SET name = :name, description = :comment, imagename = :imagename WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':comment', $comment); 
        $statement->bindValue(':name', $name);
        $statement->bindValue(':imagename', $image_filename);
        $statement->bindValue(':id', $fid);

        if($statement->execute()) {  header("Location:index.html"); } else {exit("Database Error");}

    } else { echo "Empty feilds detected. Please Fill and Retry"; }

    }   




// check if delete button is pressed, if true delete specific row
            

    if ($_POST['delete']) {

            $fid = filter_input(INPUT_POST,'delete', FILTER_SANITIZE_NUMBER_INT);
            $query = "DELETE FROM product WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $fid, PDO::PARAM_INT);
            $statement->execute();  

        header("Location:index.php"); 
        exit; }


?>