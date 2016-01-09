<!DOCTYPE HTML>
<!--suppress ALL -->
<html>
<head>
    <style>

        table, th, td {
            border: 1px solid black;
            background-color: #E8E8E8;
            border-collapse: collapse;
        }

        .leaguetable {
            float: left;
        }

        .formdiv {
            margin-left: 600px;
        }
    </style>
</head>
<body>

<div class="leaguetable">
    <?php

    function showLeagueTable()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "premierleague";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM premierleague.premierleague order by points desc, wins desc";
        $result = $conn->query($sql);

        echo "<table><tr><th align='left'>CLUB</th><th>Played</th><th>Won</th><th>Drawn</th><th>Lost</th><th>Goals For</th><th>Goals Against</th><th>Points</th></tr>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["club"] . "</td><td>" . $row["played"] . "</td><td>" . $row["wins"] . "</td><td>" . $row["draws"] . "</td><td>" . $row["loses"] . "</td><td>" . $row["goals_for"] . "</td><td>" . $row["goals_against"] . "</td><td>" . $row["points"] . "</td></tr>";
            }
        }

        echo "</table>";
        $conn->close();
    }

    showLeagueTable();
    ?>
</div>
<div class="formdiv">

    <h2>Results:</h2>
    <form action="update_table.php" method="post">

        <?php populateCombos(); ?> <label>
            <input type="text" size='1' name='goals1'>
            -
        </label><input type="text" size='1'
                       name='goals2'> <?php populateCombos(); ?>
        <br>
        <?php populateCombos(); ?> <label>
            <input type="text" size='1' name='goals3'>
            -
        </label><input type="text" size='1'
                       name='goals4'> <?php populateCombos(); ?>
        <br>
        <?php populateCombos(); ?> <label>
            <input type="text" size='1' name='goals5'>
            -
        </label><input type="text" size='1'
                       name='goals6'> <?php populateCombos(); ?>
        <br>
        <?php populateCombos(); ?> <label>
            <input type="text" size='1' name='goals7'>
            -
        </label><input type="text" size='1'
                       name='goals8'> <?php populateCombos(); ?>
        <br>
        <?php populateCombos(); ?> <label>
            <input type="text" size='1' name='goals9'>
            -
        </label><input type="text" size='1'
                       name='goals10'> <?php populateCombos(); ?>
        <br>
        <?php populateCombos(); ?> <label>
            <input type="text" size='1' name='goals11'>
            -
        </label><input type="text" size='1'
                       name='goals12'> <?php populateCombos(); ?>
        <br>
        <?php populateCombos(); ?> <input type="text" size='1' name='goals13'> - <input type="text" size='1'
                                                                                        name='goals14'> <?php populateCombos(); ?>
        <br><br>
        <input type="submit" value="Send results">
    </form>

</div>

<?php

$contor = 1;

function populateCombos()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "premierleague";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT club FROM premierleague.premierleague";
    $result = $conn->query($sql);
    global $contor;

    $name = "club" . $contor;

    echo "<select name='" . $name . "''>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['club'] . "'>" . $row['club'] . "</option>";
    }
    $contor++;
    echo "</select>";
}

?>

</body>
</html>