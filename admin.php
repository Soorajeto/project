<?php

/*******************************************************************************
    Project
    Name: Sooraj Rajan 
    Date: december 2022
    Description: Website

*******************************************************************************/

// require('connect.php');
require('authenticate.php');



?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>FOGF Admin</title>
</head>
<body>
	<header id="commonheader">
		<img src="images/logo.jpg" alt="Logo"><h1>Feast On Gluten-Free</h1>
	</header>
	
	<nav id="commonnav">
		<ul>
			<li><a href="index.html">Home Page</a></li>
			<li><a href="product.html">Our Products</a></li>
			<li><a href="admin.php">Admin</a></li>
		</ul>
	</nav>
	
	<main class="contactmain">
		<h3>Add a new product</h3>
		<form id="contactform" method="post" action="index.html">

			<ol>
				<li>
					<label for="name">Product Name:</label>
					<input type="text" autofocus id="name" name="name" />
				</li>
				<li>
					<div class="error" id="name_error">Please Enter a Name</div>
				</li>
				<li>
					<label for="comment">Description:</label>
					<textarea id="comment" name="comment" placeholder=""></textarea>
				</li>
				<li>
					<div class="error" id="comment_error">Please fill the Queries Section</div>
				</li>
			</ol>	
			<div>
				<p class="contactbuttons">
					<button type="submit" id="submit">Submit</button>
					<button type="reset" id="clear">Reset</button>
				</p>
			</div>
		</form>
	</main>

    <footer id="commonfooter">
        <nav>
            <ul>
				<li><a href="index.html">Home Page</a></li>
				<li><a href="product.html">Our Products</a></li>
				<li><a href="admin.php">Admin</a></li>
			</ul>
        </nav>
        <p>Feast On Gluten-Free Home Bakery Edmonton Alberta T6L4W1</p>
    </footer>	

</body>
</html>