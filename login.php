<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <form action="administrator.php" method="post">
        <label for="username">Korisničko ime:</label>
        <br>
        <input type="text" name="username" id="username">
        <br>
        <label for="lozinka">Lozinka:</label>
        <br>
        <input type="password" name="lozinka" id="lozinka">
    <br>
        <button name="prijava" type="submit">Prijava</button>
        <span id="porukaPrijava"></span>
    </form>
    </div>

    
</body>
</html>