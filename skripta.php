<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php

if(isset($_POST['naziv'])){
    $naslov = $_POST['naziv'];
}
if(isset($_POST['kratkisadrzaj'])){
    $kratkisadrzaj = $_POST['kratkisadrzaj'];
}
if(isset($_POST['sadrzaj'])){
    $sadrzaj = $_POST['sadrzaj'];
}
if(isset($_POST['slika'])){
    $slika = $_FILES['slika'];
    $slikaime = $_FILES['slika']['name'];
    $slikatmpime = $_FILES['slika']['tmp_name'];
    $slikavel = $_FILES['slika']['size'];
    $sliketip = $ $_FILES['slika']['type'];

    $dest = 'upload/'.$slikaime;

    move_uploaded_file($slikatmpime, $dest);


}
if(isset($_POST['kategorija'])){
    $kategorija = $_POST['kategorija'];
    
}




include('connect.php');

if(isset($_POST['spremi']) && isset($_POST['kratkisadrzaj']) && isset($_POST['sadrzaj']) && isset($_POST['naziv'])){
$picture = $_FILES['slika']['name'];
$title=$_POST['naziv'];
$about=$_POST['kratkisadrzaj'];
$content=$_POST['sadrzaj'];
$category=$_POST['kategorija'];
if(isset($_POST['arhiva'])){
 $archive=1;
}else{
 $archive=0;
}
$target_dir = 'upload/'.$picture;
move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir);
$query = "INSERT INTO vijesti (naslov, sazetak, tekst, slika, kategorija, 
arhiva ) VALUES ('$title', '$about', '$content', '$picture', 
'$category', '$archive')";
$result = mysqli_query($dbc, $query);

mysqli_close($dbc);

}


?>


<body>
<nav class="navbar">
        <div class="navbar-logo">
           <a href="index.php"> <img src="slike/th.png" alt="Logo"></a>
        </div>
        <div class="navbar-links">
        <a href="index.php">Početna</a>
        <a href="kategorija.php?kategorija=sport">Sport</a>
        <a href="kategorija.php?kategorija=politika">Politika</a>
        <a href="login.php">Admin</a>
        </div>
    </nav>
    <hr>
    <div class="clanak">
        <div class="clanakkategorija">
    <?php echo "$kategorija"?>
</div>
        <div class="tekstclanka">
            <h1>
                <?php 
                echo "$naslov";
                ?>
            </h1>            
            <img src="<?php $dest ?>" alt="">
            <h2>
                
            <?php 
                echo "$kratkisadrzaj";
                ?>
            </h2>
            <br><br>
            <p>
            <?php 
                echo "$sadrzaj";
                ?>
            </p>
        </div>
    </div>
</body>
</html>