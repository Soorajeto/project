<?php

require('connect.php');

// Image Upload coding - Only image files gif,jpg,jpeg,png are allowed

    function image_resize($source,$width,$height) {
        $new_width =300;
        $new_height =300;
        $thumbImg=imagecreatetruecolor($new_width,$new_height);
        imagecopyresampled($thumbImg,$source,0,0,0,0,$new_width,$new_height,$width,$height);
        return $thumbImg;}


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

    	return $file_extension_is_valid && $mime_type_is_valid;	}
	    

	    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

    if ($image_upload_detected) {
        $image_filename       = $_FILES['image']['name'];    
        $temporary_image_path = $_FILES['image']['tmp_name'];
        $new_image_path       = file_upload_path($image_filename);

        if (file_is_an_image($temporary_image_path, $new_image_path)) {

                $image = $temporary_image_path;
                $imgProperties = getimagesize($image);
                $imageName = $image_filename;
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $img_type = $imgProperties[2];
                 
            if( $img_type == IMAGETYPE_JPEG ) {
                $sourcea = imagecreatefromjpeg($image);
                
                $resizeImga = image_resize($sourcea,$imgProperties[0],$imgProperties[1]);
                imagejpeg($resizeImga,$new_image_path); 
            }
            elseif ($img_type == IMAGETYPE_PNG ) {
                $sourcea = imagecreatefrompng($image);
                
                $resizeImga = image_resize($sourcea,$imgProperties[0],$imgProperties[1]);
                imagepng($resizeImga,$new_image_path);
            }
            elseif ($img_type == IMAGETYPE_GIF ) {
                $sourcea = imagecreatefromgif($image);
                
                $resizeImga = image_resize($sourcea,$imgProperties[0],$imgProperties[1]);
                imagegif($resizeImga,$new_image_path);
            }

        } else exit("Unsupported Image format. Please use jpeg, gif or png types and Retry");

    } else $image_filename  = "none";


//Input feilds for content to database. Sanitization and insert into table

    $name = filter_input(INPUT_POST, 'name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    	if ($_POST && (strlen($comment) >0) && !empty($comment) && (strlen($name) >0) && !empty($name)) {
            $query = "INSERT INTO product (name, description, imagename) VALUES (:name, :comment, :imagename )";
            $statement = $db->prepare($query);
            $statement->bindValue(':comment', $comment); 
            $statement->bindValue(':name', $name);
            $statement->bindValue(':imagename', $image_filename);
            
            if($statement->execute()) {  header("Location:index.html"); } else echo "error with database"; }

           else {  exit("Cannot leave feilds Empty when Creating Product Page. Please Retry"); }


?>