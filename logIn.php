<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <style type="text/css">
        form, h3 {
            margin: 40px auto;
            width: 350px;
        }

        body {
            background-image: url(images/bg.jpg);
            -moz-background-size: cover;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: top center !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed;
        }

        table, td, tr {
            border: 10px hidden;
        }

        table {
            border-collapse: collapse;
        }

        h3 {
            color: white;
            font-family: "Roboto Thin", sans-serif;
        }

        td {
            color: white;
            font-family: "Roboto Thin", sans-serif;
            font-size: medium;
        }

        input {
            color: black;
            font-family: "Roboto Thin", sans-serif;
        }
    </style>
</head>
<body>

<h3>My Personalised Menu</h3>

<form action="menu.php" method="post">

    <table>
        <tr>
            <td><span style="color: white; ">Username:</span></td>
            <td><label>
                    <input type="text" size='20' name='username'>
                </label></td>
        <tr>
            <td><span style="color: white; ">Password:</span></td>
            <td><label>
                    <input type="password" size='20' name='password'>
                </label></td>
        <tr>
            <td colspan="2" align="right">
                <button type="submit" class="btn btn-success" name='submit'>Log In</button>
            </td>
        </tr>
    </table>

</form>

</body>
</html>