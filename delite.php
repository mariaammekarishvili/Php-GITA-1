<?php
$pdo = new PDO('mysql:host=localhost;port:3306;dbname=user','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$statement = $pdo->prepare( "DELETE FROM test.user WHERE id = :id");

$id = $_GET['id'] ?? null;
if (!$id){
    header('location: home.php');
    exit;
}

$statement->bindValue(':id',$id);
$statement->execute();




header('location: home.php');

?>
