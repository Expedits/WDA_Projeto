<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/login.css">
    <title>Login</title>
</head>
<body>
    <div>
        <h1>Login</h1>
        <form action="testelogin.php" method="POST">
            <input type="text" placeholder="nome" name="nome" id="" required>
            <br><br>
            <input type="password"  placeholder="Senha" name="senha" id="" autocomplete="off" required>
            <br><br>
            <input type="submit" name="submit" value="Entrar" class="submit">
        </form>
    </div>
</body>
</html>