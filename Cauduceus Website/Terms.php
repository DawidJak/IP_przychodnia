<!DOCTYPE html>
<html>
<head>
<title>Caduceus</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Caduceus";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql_doctor= mysqli_query($conn, "SELECT  `imie`, `nazwisko` FROM `Pracownik` WHERE `rodzajPracownika` = 'Lekarz'");
?>
<a href="Terms.php">
<button > Terms </button>
</a>
<H1> Reserving a term </H1>
<form action= "Form_Process.php" method="post">
Patient First Name: <input type="text" name=fname> <br>
Patient Last Name: <input type= text name=lname><br>
PESEL: <input type=text name=PESEL> <br>
Physician: <select name="doctor">
<?php
    while($row = mysqli_fetch_assoc($sql_doctor)){
       echo " <option value ='{$row['imie']},{$row['nazwisko']}'>{$row['imie']}  {$row['nazwisko']}</option> ";
    }
?>
</select>
<br>
Date: <input type="date" name=date> <br>
Time <input type="time" name=time> <br>
<button type= "sumbit"> Submit</button>
</form>
<?php
mysqli_close($conn);
?>
</body>
</html>
