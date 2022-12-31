<?php

/*************************
    Project
    Name: Sooraj Rajan 
    Date: december 2022
    Description: Website

************************/

require('connect.php');


    function verifyid(){ return filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); }

    if(verifyid()){

				$fid = filter_input(INPUT_GET,'id', FILTER_SANITIZE_NUMBER_INT);

				$query = "SELECT * FROM product WHERE id=:id";
			    $statement = $db->prepare($query);
			    $statement->bindValue(':id', $fid, PDO::PARAM_INT);
			    $statement->execute();
			    $quotes = $statement->fetch(); }

    else {  exit("Invalid Parameter");  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>FOGF View</title>
</head>
<body>

	<header id="commonheader">
	<img src="images/logo.jpg" alt="Logo"><h1>Feast On Gluten-Free</h1>
	</header>
	
	<nav id="commonnav">
		<ul>
			<li><a href="index.html">Home Page</a></li>
			<li><a href="product.php">Our Products</a></li>
			<li><a href="admin.php">Admin</a></li>
		</ul>
	</nav>

	
	<main class="contentmain">
		<section class="contentsection">
			<img id="show" src="images/<?=$quotes['imagename']?>" alt="<?=$quotes['imagename']?>" />
		</section>
    	<aside class="contentaside">
    	</br>
    		<h3 class="name"><?= $quotes['name'] ?></h3>
    	</br>
        	<p class="fancy">" <?= $quotes['description']?> "</p>
        </br>
        	<p class="light">Posted on <?= date_format((date_create($quotes['date'])),"F d, Y, h:i a") ?></p>
        	<p><a class="light" href="edit.php?id=<?=$quotes['id']?>">Edit this Item (Admin Only)</a></p>
    	</aside>
	</main>

    <footer id="commonfooter">
        <nav>
            <ul>
				<li><a href="index.html">Home Page</a></li>
				<li><a href="product.php">Our Products</a></li>
				<li><a href="admin.php">Admin</a></li>
			</ul>
        </nav>
        <p>Feast On Gluten-Free Home Bakery Edmonton Alberta T6L4W1</p>
    </footer>	

</body>
</html>