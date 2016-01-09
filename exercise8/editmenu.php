<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            background-image: url(../images/bg.jpg);
            -moz-background-size: cover;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: top center !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed;
        }

        form, h3 {
            margin: 40px auto;
            width: 1150px;
        }

        table, td, tr {
            border: 10px hidden;
        }

        table {
            border-collapse: collapse;
        }

        td {
            color: white;
            font-family: "Roboto Thin", sans-serif;
            font-size: medium;
        }

        input, textarea {
            color: black;
            font-family: "Roboto Thin", sans-serif;
        }
    </style>
</head>
<body>

<form action="menu.php" method="post">

    <?php
    $o = htmlspecialchars($_GET['option']);
    $c = htmlspecialchars($_GET['content']);
    ?>

    <table>
        <tr>
            <td><label>
                    <textarea name="option" rows="1" cols="55"><?php echo htmlspecialchars($o); ?></textarea>
                </label></td>
        <tr>
            <td><label>
                    <textarea name="content" rows="8" cols="55"><?php echo htmlspecialchars($c); ?></textarea>
                </label></td>
        <tr>
            <td align="right">
                <button type="submit" name="submitEdit" class="btn btn-primary">Edit</button>
                <button type="submit" name="submitRemove" class="btn btn-danger">Remove</button>
            </td>
        </tr>
    </table>
    <input type="hidden" name="oldOpt" value="<?php echo $o; ?>"/>
</form>

</body>
</html>