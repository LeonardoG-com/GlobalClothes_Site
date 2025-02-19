<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Global Clothes</title>
    <link rel="stylesheet" href="/PAP/css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">

    
</head>
<style>
        .logo-image {
            width: 300px; /* Defina a largura desejada para a imagem */
        }
    </style>
<body>
    <?php
    include('../conDB/con_db.php');
    session_start();
    // Quando clicarmos em "login" ele vai a base de dados e vai ver se existe esse user e cria uma sessao para o user
    if (isset($_POST['username'])) {

    // EmailUser and PasswordUser sent from form 
    $Username = ($_POST['username']);
    $PasswordUser = md5($_POST['password']);
    

    $row = $con->query("SELECT * FROM users WHERE username = '$Username' and password = '$PasswordUser'");

    $result = $row->fetch_all();
    $count = $row->num_rows;

    // If result matched $EmailUser and $PasswordUser, table row must be 1 row
    if ($count == 1) {

        $IdUser = $result[0][0];
        $cargo = $result[0][5];
        $_SESSION["login_session"] = $IdUser;

        if($cargo=='admin'){
             header("location:/PAP/admin/inicio.php");    
        }else{
             header("location:/PAP/users/user_page.php");
        }
        
    } else {
        $error = "Nome ou Palavra-passe errada!";
    }
    }


    ?>
    <?php
    if (isset($_GET['registado'])) {
        echo '<span> Conta criada </span>';
    }
    ?>
    <form class="form" method="post" name="login">
    <img src="/PAP/fotos/t.png" alt="Logo" class="logo-image" />
        <input type="text" class="login-input" name="username" placeholder="Nome" autofocus="true" required />
        <input type="password" class="login-input" name="password" placeholder="Password" required />
        <input type="submit" value="Login" id="botao" name="submit" class="login-button" />
        <p class="link">Não tens conta?<a href="register.php">Regista te</a></p>
        <?php
        if (isset($error)) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Login falhou!',
                text: 'Nome ou password incorretos.',
                confirmButtonText: 'OK'
            });
        </script>";
            
        }
        ?>
    </form>
  
  
</body>

</html>