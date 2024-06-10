
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clanak</title>
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
    <?php 
    include 'connect.php';
    define('UPLPATH', 'upload/');
    $id=$_GET['id'];
    $query = "SELECT * FROM vijesti WHERE id='$id'";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    ?>
    <div class="mainclanak">
    <div class="clanak">
    <div class="clanakkategorija"><?php
    echo "<span>".$row['kategorija']."</span>";
    ?>
    </div>
    
        <div class="tekstclanka">
            <h1>
            <?php
    echo $row['naslov'];
    ?>
    <br>
            </h1>    
<br>
            <?php
    echo '<img src="' . UPLPATH . $row['slika'] . '">';
    ?>

    <br>
            <h2>
                
            <?php
 echo "<i>".$row['sazetak']."</i>";
 ?>

            </h2>
            <br><br>
            <p>
            <?php
echo $row['tekst'];
 ?>
            </p>
        </div>
</div>

    </div>
</body>
<footer>
        <div class="info">
            Antonio Hren
            <br>
            ahren@tvz.hr
            <br>
            2024
        </div>
    </footer>
</html>