<?php include('index.php'); ?>
<?php include('sql.php'); ?>

<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
//    echo '<pre>';
//    var_dump($_POST);
//    echo '</pre>';
//
//    echo '<pre>';
//    var_dump($_SERVER);
//    echo '</pre>';
    echo $_SERVER['REQUEST_METHOD'].'<br>'; //which method we use

    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $birth_date = $_POST['birth_date'];

// Logic of errors
    if(!$name) {
        $errors[] = 'User name is required';
    }
    if(!$mail) {
        $errors[] = 'User email is required';
    }
    if(empty($errors)){
        $statment = $pdo->prepare("INSERT INTO test.user(name,mail,birth_date)
                    VALUES (:name, :mail, :birth_date)");
        $statment->bindValue(':name', $name);
        $statment->bindValue(':mail', $mail);
        $statment->bindValue(':birth_date', $birth_date);

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
            <input type="text" class="form-control" id="inlineFormInputName" placeholder="Jane Doe" name="name">
        </div>
        <div class="col-sm-3 my-1">
            <label class="sr-only" for="inlineFormInputGroupUsername">E-mile</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                </div>
                <input type="text" name="mail" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username@gmail.com">
            </div>
        </div>
        <div class="col-sm-3 my-1">
            <label class="sr-only" for="inlineFormInputName">Birth date</label>
            <input type="text" name= "birth_date" class="form-control" id="inlineFormInputName" placeholder="2020-07-01 10:38:36">
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