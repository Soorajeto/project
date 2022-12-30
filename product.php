<?php

/************************
    Project
    Name: Sooraj Rajan 
    Date: december 2022
    Description: Website

************************/
 

require('connect.php');

    if($_POST){

        if($_POST['ip']==='date'){
            $query = "SELECT * FROM product ORDER BY date";
            $statement = $db->prepare($query);
            $statement->execute();
            $quotes = $statement->fetchAll();}

        elseif($_POST['ip']==='name'){
            $query = "SELECT * FROM product ORDER BY name";
            $statement = $db->prepare($query);
            $statement->execute();
            $quotes = $statement->fetchAll(); }

    }else { 
        $query = "SELECT * FROM product";
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll();

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>FOGF Products</title>
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
    
    <main class="productmain">
        <section class="productheading">
            <h2>Our Products</h2>
        </section>
        <form id="inner" method="post" action="product.php">
            <fieldset>
                <legend>Sort By:</legend>
                    <div id="sortingorder">
                        <select id="ip" name="ip">
                            <option value="" selected disabled hidden>Select an Option</option>
                            <option value="date">Latest Product</option>
                            <option value="name">Product Name</option>
                        </select>
                        <button type="button" id="btn">Search</button>
                    </div>
            </fieldset>
        </form>
        <div class="productsection">
            <ol>
                <?php foreach ($quotes as $quote): ?>
                <li><img src="images/<?=$quote['imagename']?>" alt="<?=$quote['imagename']?>"><?= $quote['description'] ?></li>
                <?php endforeach ?>
            </ol>
        </div>
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