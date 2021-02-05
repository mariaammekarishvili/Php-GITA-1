<?php include('index.php'); ?>
<?php include('sql.php'); ?>

<?php
$statement = $pdo->prepare('SELECT * FROM test.user');
$statement->execute();
$persons = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<body>

<!--#table-->
<table style="margin-top: 50px" class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Birth Date</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
    <tbody>
    <?php $today = date("Y-m-d ");?>

    <?php foreach ($persons as $i => $person) { ?>
        <?php $date = $person['birth_date']?>
<!--      <?php //$date = date_format($date,"Y-m-d") ?> -->

        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $person['name'] ?></td>
            <td><?php echo $person['mail'] ?></td>
            <td><?php echo $person['birth_date'] ?></td>
<!--            <td>--><?php //echo  $date->diff($today) ?><!--<td>-->
            <td>
                <a href="update.php?id=<?php echo $person['id'] ?>"  class="btn btn-primary">Edit</a>
                <a href="delite.php?id=<?php echo $person['id'] ?>" type="button" class="btn btn-danger">Delite</a>
            </td>
        </tr>

    <?php } ?>
    </tbody>


</table>
</body>