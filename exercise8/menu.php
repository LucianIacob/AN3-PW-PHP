<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style type="text/css">
        table {
            border-collapse: collapse;
            margin: 30px 30px 15px;
        }

        th, td {
            text-align: left;
            padding: 8px;
            font-family: "Roboto Medium", sans-serif;
            font-size: medium;
        }

        tr:nth-child(odd) {
            background-color: #adc1d4
        }

        tr:nth-child(even) {
            background-color: #d5ecff
        }

        tr:first-child td:first-child {
            border-top-left-radius: 10px;
        }

        tr:first-child td:last-child {
            border-top-right-radius: 10px;
        }

        tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }

        body {
            background-image: url(../images/bg.jpg);
            -moz-background-size: cover;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: top center !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed;
        }

        th {
            font-size: larger;
            font-family: "Roboto Light", sans-serif;
            color: gray;
            text-align: center;
        }

        .option {
            font-family: "Roboto Medium", sans-serif;
            color: rgba(0, 9, 39, 0.89);
            text-align: center;
        }

        .btn-success {
            margin-left: 30px;
            width: 108px;
        }
    </style>
</head>
<body>

<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "pw_users";

$sess = false;

if (isset($_POST['submit'])) {

    global $servername, $username, $password, $dbname, $sess;
    $usrname = $_POST['username'];
    $passwd = $_POST['password'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM pw_users.pw_users WHERE username = ? AND password = ?;");
    $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt->close();
    $conn->close();

    /** @noinspection PhpParamsInspection */
    if (count($result)) {
        $sess = true;
        loadMenu();
    } else {
        echo "User not found";
    }
}

if (isset($_POST['submitAdd'])) {
    global $servername, $username, $password, $dbname;

    $opt = $_POST['option'];
    $content = $_POST['content'];

    if (!(empty($opt) || empty($content))) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT into pw_users.menulist VALUE (?, ?);");
        $stmt->bind_param("ss", $opt, $content);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
    loadMenu();
}

if (isset($_POST['submitRemove'])) {
    global $servername, $username, $password, $dbname;

    $oldOpt = $_POST['oldOpt'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM pw_users.menulist WHERE opt = ?;");
    $stmt->bind_param("s", $oldOpt);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    loadMenu();
}

if (isset($_POST['submitEdit'])) {
    global $servername, $username, $password, $dbname;

    $oldOpt = $_POST['oldOpt'];
    $newOpt = $_POST['option'];
    $newCont = $_POST['content'];

    if (!(empty($newOpt) || empty($newCont))) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($stmt = $conn->prepare("UPDATE pw_users.menulist SET opt = ?, content = ? WHERE opt = ?;")) {
            $stmt->bind_param("sss", $newOpt, $newCont, $oldOpt);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        } else {
            echo "err prepare";
            $conn->close();
        }
    }
    loadMenu();
}

function loadMenu()
{
    global $servername, $password, $dbname, $username;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "<table ><tr><th>Option</th><th>Content</th></tr>";

    $sql = "SELECT * FROM pw_users.menulist";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $op = $row["opt"];
            $cont = $row["content"];
            echo "<tr><td class='option' width=100><a href='editmenu.php?option=$op&content=$cont'>$op</a></td><td>" . $cont . "</td></tr>";
        }
    }
    echo "</table>";
    $conn->close();
    showAddBtn();
}

function showAddBtn()
{
    ?>
    <button type="submit" class="btn btn-success" onclick="window.open('addnew.php', '_self')">Add New</button>
    <?php
}

?>

</body>
</html>