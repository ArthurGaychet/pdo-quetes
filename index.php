<?php
require __DIR__ . "/_connec.php";
$pdo = new \PDO(DSN, USER, PASS);

$statement = $pdo->query("SELECT * FROM friend");
$friends = $statement->fetchAll();


if (!empty($_POST)) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    $statement->execute();
    header('location: /');
    exit ();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <ul>
            <?php
            foreach ($friends as $friend);
            ?>
            <li>
                <?= $friend['firstname'] ?>
            </li>
            <li>
                <?= $friend['lastname'] ?>
            </li>
        </ul>
        <form action="" method='POST'>
            <label for="firstname">
                <input type="text" name="firstname" id="firstname">
            </label>
            <label for="lastname">
                <input type="text" name="lastname" id="lastname">
            </label>
            <button type="submit">Envoyer</button>
        </form>
    </main>
</body>

</html>