<?php
include('session.php');
if ($cargo=='admin'){
    ?>
    <html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../PAP/css/tabelas.css">

</head>

<body>

    <?php
    include('admin_page.html');
    ?>
     <?php
    if(isset($username)){
      ?>
       <h1 class="username"  style="text-align: center; padding: 60px;">Bem-vindo <?php echo $username; ?>, a pagina admin</h1><br>
    <?php
      } 
    ?>

    <div style="text-align:center; margin:0 80px 0 80px; font-size:20px">
        <h3>Aqui consegue aceder a todos as opções como: </h3>

        <h3><a href="roupas.php"><span style='color:black;text-decoration: underline; text-decoration-color: black;'>
                    Alterar tabelas das Roupas
                   </h3>
        <h3><a href="User.php"><span style='color:black;text-decoration: underline; text-decoration-color: black;'>Visualizar tabelas dos Users</h3>
        <h3><a href="CandEquipas.php"><span style='color:black;text-decoration: underline; text-decoration-color: black;'>Visualizar Candidaturas</h3>

    </div>
    </section>



</body>

</html>
<?php
}else{
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Falha ao entrar!',
                text: 'Não tens permissões de Admin.',
                confirmButtonText: 'OK'
            });
        </script>";
}
?>
