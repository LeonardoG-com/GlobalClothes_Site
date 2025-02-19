<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="/PAP/css/tabelas.css">
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">



</head>

<body>

    <div style="padding-right:100px;padding-left:100px; ">

        <?php
        include('admin_page.html');
        include('../conDB/con_db.php');

        // Verifica se a conexão foi estabelecida com sucesso
        if (!$con) {
            die("Falha na conexão com a base de dados: " . mysqli_connect_error());
        }

        // Seleciona todos os usuários da tabela
        $sql = "SELECT * FROM users";
        $result = mysqli_query($con, $sql);
        ?>
        <section class="content">
          

            <div class="row">
                <div class="col">
                    <?php
        // Verifica se há resultados
        if (mysqli_num_rows($result) > 0) {
            // Cria a tabela HTML
            // Cria o cabeçalho da tabela
            echo "<h2></h2>";
            echo "<table class='rTable table-bordered '>";
            echo "<h2 style ='text-align:center; padding:  30px;'> Tabela Utilizadores</h2>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nome</th>";
            echo "<th>Apelido</th>";
            echo "<th>E-mail</th>";
            echo "<th>Cargo</th>";
            echo "<th>Ações</th>";
            echo "</tr>";
            echo "</thead>";
            // Exibe os dados de cada linha da tabela
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["apelido"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>";
                echo "<select class='form-select form-select-sm' onchange='updateCargo(this)' data-user-id='" . $row['id'] . "'>";
            
                // Busca os cargos disponíveis na tabela 'users'
                $sql_cargos = "SELECT DISTINCT cargo FROM users";
                $result_cargos = mysqli_query($con, $sql_cargos);
            
                // Exibe as opções de cargo
                while ($row_cargos = mysqli_fetch_assoc($result_cargos)) {
                    $cargo = $row_cargos['cargo'];
                    $selected = ($row['cargo'] == $cargo) ? 'selected' : '';
                    echo "<option value='$cargo' $selected>$cargo</option>";
                }
            
                echo "</select>";
                echo "</td>";
                echo "<td>";
                echo "<a href='/PAP/admin/editarUsers.php' data-user-id='" . $row['id'] . "'><button type='button' class='btn btn-primary btn-sm'>Editar</button></a>";
                echo "</td>";
                
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum resultado encontrado.";
        }
        ?>
               


        </section>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
    <script>
function updateCargo(selectElement) {
  var userId = selectElement.getAttribute('data-user-id');
  var cargo = selectElement.value;
  var editButton = document.querySelector("a[data-user-id='" + userId + "']");

  var url = "/PAP/admin/editarUsers.php?id=" + userId + "&cargo=" + cargo;
  editButton.href = url;
}
</script>


</body>

</html>