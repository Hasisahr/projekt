<?php
 // Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je
 if (($uspjesnaPrijava == true && $admin == true) ||
(isset($_SESSION['$username'])) && $_SESSION['$level'] == 1) {
 $query = "SELECT * FROM vijesti";
 $result = mysqli_query($dbc, $query);
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
   $target_dir = 'upload'.$picture;
   move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir);
   $id=$_POST['id'];
   $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content',
   slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id ";
   $result = mysqli_query($dbc, $query);
 }
 
 // Pokaži poruku da je korisnik uspješno prijavljen, ali nije administrator
 } else if ($uspjesnaPrijava == true && $admin == false) {

 echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali
niste administrator.</p>';
 } else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
    echo '<p>Bok ' . $_SESSION['$username'] . '! Uspješno ste
prijavljeni, ali niste administrator.</p>';
 } else if ($uspjesnaPrijava == false) {
 ?>
 <!-- Forma za prijavu -->
 <script type="text/javascript">

 //javascript validacija forme

 </script>

 <?php
 }
 ?>
