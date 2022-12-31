<?php

/************************
    Project
    Name: Sooraj Rajan 
    Date: december 2022
    Description: Website

************************/
 
require('authenticate.php');
require('connect.php');

    function verifyid(){ return filter_input(INPUT_POST, 'editbutton', FILTER_VALIDATE_INT); }

    if(verifyid()){

                $fid = filter_input(INPUT_POST,'id', FILTER_SANITIZE_NUMBER_INT);

                $query = "SELECT * FROM product WHERE id=:id";
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $fid, PDO::PARAM_INT);
                $statement->execute();
                $quotes = $statement->fetch(); }

    else {  exit("Invalid Parameter");  }

    $query = "SELECT * FROM product";
    $statement = $db->prepare($query);
    $statement->execute();
    $list = $statement->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>FOGF Edit</title>
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

        <form id="inner" method="post" action="edit.php">
            <p>Choose a different item : </p>
                <div id="sortingorder">
                    <select id="editbutton" name="editbutton">
                        <option value="" selected disabled hidden>Select an Option</option>
                        <?php foreach ($list as $item): ?>
                            <option value="<?=$item['id']?>"><?=$item['name']?></option>
                        <?php endforeach ?>
                    </select>
                    <button type="submit" id="btn">Go!</button>
                </div>
        </form>
        <div class="productsection">
            <ol>
                <?php foreach ($quotes as $quote): ?>
                <li><a href="display.php?id=<?=$quote['id']?>"> <img src="images/<?=$quote['imagename']?>" alt="<?=$quote['imagename']?>"></a><?= $quote['name'] ?></li>
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