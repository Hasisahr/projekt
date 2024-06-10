<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="style.css">
</head>

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
    <div class="main">
    <?php
include 'connect.php';
define('UPLPATH', 'upload/');
?>
<section class="sport">
    <div class="clanakkategorija">Sport</div>
<?php
$query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='sport' LIMIT 3";
$result = mysqli_query($dbc, $query);
 $i=0;
 while($row = mysqli_fetch_array($result)) {
    echo '<article>
    <div class="slika">
        <img src="' . UPLPATH . $row['slika'] . '" alt="">
    </div>
    <div class="tekst">
        <h2>
            <a href="clanak.php?id='.$row['id'].'">'
      .$row['naslov'];
        echo "</a> 
        <br><br>
        </h2>
        <p>"
        .$row['sazetak'];
        echo "</p>
    </div>
    
</article>";
echo '<hr class="obican">';
 }?> 
</section>
<br><br>
<section class="sport">
    <div class="clanakkategorija">Politika</div>
<?php
$query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='politika' LIMIT 3";
$result = mysqli_query($dbc, $query);
 $i=0;
 while($row = mysqli_fetch_array($result)) {
    echo '<article>
    <div class="slika">
        <img src="' . UPLPATH . $row['slika'] . '" alt="">
    </div>
    <div class="tekst">
        <h2>
            <a href="clanak.php?id='.$row['id'].'">'
      .$row['naslov'];
        echo "</a> 
        <br><br>
        </h2>
        <p>"
        .$row['sazetak'];
        echo "</p>
    </div>
</article>";
echo '<hr class="obican">';
 }?> 
</section>
</div>
<footer>
    <div class="info">
        Antonio Hren
    <br>
ahren@tvz.hr
<br>
2024
</div>
</footer>

</body>

</html>