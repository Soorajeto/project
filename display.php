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

    <section class="displayed">
        <h3><?= $quotes['name'] ?></h3>
        <img src="images/<?=$quotes['imagename']?>" alt="<?=$quotes['imagename']?>">                                     
        <p><?= $quotes['description']?></p>
        <p><a href="edit.php?id=<?=$quotes['id']?>">Edit this Item (Admin Only)</a></p>
    </section>


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