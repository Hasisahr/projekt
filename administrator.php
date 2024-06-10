<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
<div class="unos">
    <form action="" method="post">
    <button type="submit" name="odjava">
    Odjava
    </button>
    </form>
</div>
    <?php
    
session_start();
include 'connect.php';

$uspjesnaPrijava = false;
// Provjera da li je korisnik došao s login forme
if (isset($_POST['prijava'])) {
 // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
 $prijavaImeKorisnika = $_POST['username'];
 $prijavaLozinkaKorisnika = $_POST['lozinka'];
 $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik
 WHERE korisnicko_ime = ?";
 $stmt = mysqli_stmt_init($dbc);
 if (mysqli_stmt_prepare($stmt, $sql)) {
 mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_store_result($stmt);
 }
 mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika,
$levelKorisnika);
 mysqli_stmt_fetch($stmt);
 //Provjera lozinke
 if (password_verify($_POST['lozinka'], $lozinkaKorisnika) &&
mysqli_stmt_num_rows($stmt) > 0) {
 $uspjesnaPrijava = true;
  // Provjera da li je admin
  if($levelKorisnika == 1) {
    $admin = true;
    }
    else {
    $admin = false;
    }
    //postavljanje session varijabli
    $_SESSION['$username'] = $imeKorisnika;
    $_SESSION['$level'] = $levelKorisnika;
    } else {
    $uspjesnaPrijava = false;
    }
   
   }

   ?>
    
    <?php
 // Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je
 if (($uspjesnaPrijava == true && $admin == true) ||
(isset($_SESSION['$username'])) && $_SESSION['$level'] == 1) {
    define('UPLPATH', 'upload/');
 $query = "SELECT * FROM vijesti";
 $result = mysqli_query($dbc, $query);
 echo '<div class="poruka">Dobrodošli ' . $_SESSION['$username'] . '! Uspješno ste
 prijavljeni kao administrator.</div><br>';
 echo '<div class="unos">
 
 <p>Za unos sadrzaja pritisnite ovdje</p>
 <button><a href="unos.html">Unos</a></button>
 </div><br>';
 while($row = mysqli_fetch_array($result)) {

    echo '<form enctype="multipart/form-data" action="" method="POST">
    <div class="form-item">
    <label for="title">Naslov vjesti:</label>
    <div class="form-field">
    <input type="text" name="naziv" class="form-field-textual"
   value="'.$row['naslov'].'">
    </div>
    </div>
    <div class="form-item">
    <label for="about">Kratki sadržaj vijesti (do 50
   znakova):</label>
    <div class="form-field">
    <textarea name="kratkisadrzaj" id="" cols="30" rows="10" class="formfield-textual">'.$row['sazetak'].'</textarea>
    </div>
    </div>
    <div class="form-item">
    <label for="content">Sadržaj vijesti:</label>
    <div class="form-field">
    <textarea name="sadrzaj" id="" cols="30" rows="10" class="formfield-textual">'.$row['tekst'].'</textarea>
    </div>
    </div>
    <div class="form-item">
    <label for="pphoto">Slika:</label>
    <div class="form-field">
    <input type="file" class="input-text" id="slika"
   value="'.$row['slika'].'" name="slika"/> <br><img src="' . UPLPATH .
   $row['slika'] . '" width=100px>
    </div>
    </div>
    <div class="form-item">
    <label for="category">Kategorija vijesti:</label>
    <div class="form-field">
    <select name="kategorija" id="" class="form-field-textual"
   value="'.$row['kategorija'].'">
    <option value="sport">Sport</option>
    <option value="kultura">Politika</option>
    </select>
    </div>
    </div>
    <div class="form-item">
    <label>Spremiti u arhivu:
    <div class="form-field">';
    if($row['arhiva'] == 0) {
    echo '<input type="checkbox" name="arhiva" id="archive"/>
   Arhiviraj?';
    } else {
    echo '<input type="checkbox" name="archive" id="archive"
   checked/> Arhiviraj?';
    }
    echo '</div>
    </label>
    </div>
    </div>
    <div class="form-item">
    <input type="hidden" name="id" class="form-field-textual"
   value="'.$row['id'].'">
    <button type="reset" value="Poništi">Poništi</button>
    <button type="submit" name="update" value="Prihvati">
   Izmjeni</button>
    <button type="submit" name="delete" value="Izbriši">
   Izbriši</button>
    </div>
    </form>';
   }
   
   if(isset($_POST['delete'])){
       $id=$_POST['id'];
       $query = "DELETE FROM vijesti WHERE id=$id ";
       $result = mysqli_query($dbc, $query);
      }
   
   
   if(isset($_POST['update'])){
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
   $id=$_POST['id'];
   $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content',
   slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id ";
   $result = mysqli_query($dbc, $query);
 }
 
 // Pokaži poruku da je korisnik uspješno prijavljen, ali nije administrator
 } else if ($uspjesnaPrijava == true && $admin == false) {

    echo '<div class="poruka">Dobrodošli ' . $_SESSION['$username'] . '! Uspješno ste
    prijavljeni, ali niste administrator.</div>';
 } else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
    echo '<div class="poruka">Dobrodošli ' . $_SESSION['$username'] . '! Uspješno ste
prijavljeni, ali niste administrator.</div>';
 } else if ($uspjesnaPrijava == false) {
 ?>
 <!-- Forma za prijavu -->
 <script type="text/javascript">
    alert("Neuspjesna prijava, registrirajte se!");
     window.location = "registracija.php";
     
 </script>

 <?php
 }
if(isset($_POST['odjava'])){
    session_unset();
    session_destroy();
    echo '<script>
    window.location = "login.php";
</script>';
}
 ?>

</body>


</html>