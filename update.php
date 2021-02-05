<?php include ('index.php')?>
<?php

$id = $_GET['id'] ?? null;
if (!$id) {
    header('location: home.php');

}


    $pdo = new PDO('mysql:host=localhost;port:3306;dbname=user', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $statement = $pdo->prepare("SELECT * FROM test.user WHERE id = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    $persons = $statement->fetch(PDO::FETCH_ASSOC);




$name = $persons['name'];
$mail = $persons['mail'];
$birth_date = $persons['birth_date'];



if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $birth_date = $_POST['birth_date'];
    if(!$name) {
        $errors[] = 'User name is required';
    }
    if(!$mail) {
        $errors[] = 'User email is required';
    }
    if(empty($errors)){
        $statment = $pdo->prepare("UPDATE  test.user SET name = :name,
                    mail = :mail,
                     birth_date = :birth_date WHERE id = :id");
        $statment->bindValue(':name', $name);
        $statment->bindValue(':mail', $mail);
        $statment->bindValue(':birth_date', $birth_date);
        $statment->bindValue(':id', $id);

        $statment->execute();
        header('Location: home.php ');
    }


}

?>

<body>

<!--#error in UI-->

<?php if(!empty($errors)): ?>
    <div class="alert alert-danger" >
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error?></div>

        <?php endforeach; ?>
    </div>
<?php endif; ?>



<!--#form-->
<form style="margin-left: 200px; width: 200%; " method="post">
    <div class="form-row align-items-center">
        <div class="col-sm-3 my-1">
            <label class="sr-only" for="inlineFormInputName">Name</label>
            <input type="text" class="form-control" id="inlineFormInputName" placeholder="<?php echo $name?>" name="name">
        </div>
        <div class="col-sm-3 my-1">
            <label class="sr-only" for="inlineFormInputGroupUsername">E-mile</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                </div>
                <input type="text" name="mail" class="form-control" id="inlineFormInputGroupUsername" placeholder="<?php echo $mail?>">
            </div>
        </div>
        <div class="col-sm-3 my-1">
            <label class="sr-only" for="inlineFormInputName">Birth date</label>
            <input type="text" name= "birth_date" class="form-control" id="inlineFormInputName" placeholder="<?php echo $birth_date?>">
        </div>
        <div class="col-auto my-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="autoSizingCheck2">
                <label class="form-check-label" for="autoSizingCheck2">
                    Are you Sure?
                </label>
            </div>
        </div>
        <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
</body>
