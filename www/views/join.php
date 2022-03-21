<html>
<head>
    <title>Join Page</title>
    <meta http-equiv="Content-Type" content="text/html" />
</head>
<body>
<form action="../models/joinModel.php" method="POST">
    <table>
        <tr>
            <td>ID</td>
            <td><input type="text" name="id"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="pw"></td>
        </tr>
        <tr>
            <td>Password Verify</td>
            <td><input type="password" name="pw2"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Join">
                <input type="reset" value="Reset";>
                <input type="button" name="Back" value="Back" onclick="location.href='index.php'" ;>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
