<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Global Clothes</title>
    <link rel="stylesheet" href="/PAP/css/style.css" />
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php
    include('../conDB/con_db.php');


    if (isset($_POST['username'])) {

        $username = stripslashes($_POST['username']);
        $apelido = stripslashes($_POST['apelido']);
        $email = stripslashes($_POST['email']);
        $password = stripslashes($_POST['password']);

        if ($password) {
            $query = "INSERT into `users` (username, apelido,email, password)
                     VALUES ('$username','$apelido','$email','" . md5($password) . "')";
            $result = $con->query($query);

            if ($result) {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Registro bem-sucedido!",
                            text: "Parabéns, sua conta foi criada!",
                            confirmButtonText: "OK"
                        }).then(function() {
                            window.location.href = "login.php";
                        });
                      </script>';
            } else {
                $error = "Erro ao registrar";
            }
        } else {
            $error = "Password errada";
        }
    }
    ?>

    <form class="form" action="register.php" method="POST">
        <h1 class="login-title">Registo</h1>
        <input type="text" class="login-input" name="username" placeholder="Nome" required />
        <input type="text" class="login-input" name="apelido" placeholder="Apelido" required />
        <input type="text" class="login-input" name="email" placeholder="Email" required>
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="submit" name="submit" value="Resgitar" class="login-button">
        <p class="link"><a href="login.php">Clica aqui para dar login</a></p>
    </form>
</body>

</html>
