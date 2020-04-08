<?php
session_start();
//Including Database configuration file.
include 'classes/Database.class.php';
include 'classes/User.class.php';
//Getting value of "search" variable from "script.js".
if (empty($_POST['search']) === false) {
    //Search box value assigning to $Name variable.
    $Name = $_POST['search'];
    //Search query.
    $Query = "SELECT * FROM users WHERE Pseudo LIKE '%$Name%' ORDER BY Pseudo, Status";
    //Query execution
    $ExecQuery = MySQLi_query($con, $Query);
    //Creating unordered list to display result.
    echo '
<ul class="list">
';
    //Fetching result from database.
    while ($Result = MySQLi_fetch_array($ExecQuery)) {
?>
        <!-- Creating unordered list items.
        Calling javascript function named as "fill" found in "script.js" file.
        By passing fetched result as parameter. -->
            <li class="clearfix">
                <?php if ($Result['Id'] !== $_SESSION['id']) { ?>
                    <div class="about">
                        <div class="regroup">
                            <div class="name">
                                <?= $Result['Pseudo'] ?>
                            </div>
                            <div class="status">
                                <i class="fa fa-circle online"></i> <?= $Result['Status'] ?>
                            </div>
                        </div>
                        <div class="infos hide">
                            <ul>
                                <li>Prénom: <?= $Result['FirstName'] ?></li>
                                <li>Nom: <?= $Result['LastName'] ?></li>
                                <li>Email: <?= $Result['Email'] ?></li>
                            </ul>
                            <button class="button-close">Fermer</button>
                        </div>
                    </div>
                <?php } ?>
            </li>
        <script src="js/api.js"></script>
        <!-- Below php code is just for closing parenthesis. Don't be confused. -->
    <?php
    }
    echo '</ul>';
} else if (empty($_POST['search']) === true || $_POST['search'] === "") {
    //Search box value assigning to $Name variable.
    $Name = $_POST['search'];
    //Search query.
    $Query = "SELECT * FROM users ORDER BY Pseudo, Status";
    //Query execution
    $ExecQuery = MySQLi_query($con, $Query);
    //Creating unordered list to display result.
    echo '
<ul class="list">
';
    //Fetching result from database.
    while ($Result = MySQLi_fetch_array($ExecQuery)) {
    ?>
        <!-- Creating unordered list items.
        Calling javascript function named as "fill" found in "script.js" file.
        By passing fetched result as parameter. -->
        <div id="users">
            <li class="clearfix">
                <?php if ($Result['Id'] !== $_SESSION['id']) { ?>
                    <div class="about">
                        <div class="regroup">
                            <div class="name">
                                <?= $Result['Pseudo'] ?>
                            </div>
                            <div class="status">
                                <i class="fa fa-circle online"></i> <?= $Result['Status'] ?>
                            </div>
                        </div>
                        <div class="infos hide">
                            <ul>
                                <li>Prénom: <?= $Result['FirstName'] ?></li>
                                <li>Nom: <?= $Result['LastName'] ?></li>
                                <li>Email: <?= $Result['Email'] ?></li>
                            </ul>
                            <button class="button-close">Fermer</button>
                        </div>
                    </div>
                <?php } ?>
            </li>
        </div>
        <script src="js/api.js"></script>
        <!-- Below php code is just for closing parenthesis. Don't be confused. -->
<?php
    }
    echo '</ul>';
} ?>