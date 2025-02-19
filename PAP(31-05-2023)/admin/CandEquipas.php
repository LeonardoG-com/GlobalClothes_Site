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
$sql = "SELECT * FROM juntar_equipa";
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
    echo "<h2 style ='text-align:center; padding:  30px;'> Tabela das Candidaturas</h2>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nome do Utilizador</th>";
    echo "<th>Dia da submição da Candidatura </th>";
    echo "<th>CV</th>";
    echo "<th>Cargo</th>";
    echo "<th>Estado</th>";
    echo "<th>Ações</th>";
    echo "</tr>";
    echo "</thead>";
    // Exibe os dados de cada linha da tabela
    while ($row = mysqli_fetch_assoc($result)) {
        $query = "SELECT je.id_Cand, je.id_user, je.id_imagem, je.DataCand, u.username
                  FROM juntar_equipa AS je
                  INNER JOIN users AS u ON je.id_user = u.id
                  INNER JOIN imagens AS i ON je.id_imagem = i.id_imagens
                  WHERE je.id_user = " . $row["id_user"];

        echo "<tr>";
        echo "<td>" . $row["id_Cand"] . "</td>";

        $result_user = mysqli_query($con, $query);

        if ($result_user && mysqli_num_rows($result_user) > 0) {
            $rowUser = mysqli_fetch_assoc($result_user);
            echo "<td>" . $rowUser["username"] . "</td>";
        }

        echo "<td>" . $row["DataCand"] . "</td>";

        if (isset($_GET['id'])) {
            $idImagem = $_GET['id'];

            // Definir o caminho para o PDF
            $caminhoPdf = "/PAP/candidaturas/" . $idImagem . ".pdf";

            // Verificar se o PDF existe
            if (file_exists($caminhoPdf)) {
                // Configurar o cabeçalho para exibir o PDF no navegador
                header("Content-Type: application/pdf");
                header("Content-Disposition: inline; filename=\"" . basename($caminhoPdf) . "\"");

                // Exibir o PDF no navegador
                readfile($caminhoPdf);
                exit;
            } else {
                echo "<p>O PDF não está disponível.</p>";
            }
        }
        echo "<td><a href='/PAP/candidaturas/?id=" . $row["id_imagem"] . "'>Visualizar PDF</a></td>";
        echo "<td>" . $row["cargos"] . "</td>";
        echo "<td>" . $row["estado"] . "</td>";


        echo '<td>';
echo '<div class="btn-group">';
echo '<form style="margin-right:5px" action="aceitarCand.php" method="post">';
echo '<input type="hidden" name="id_Cand" value="' . $row['id_user'] . '">';
echo '<button type="submit" class="btn btn-success accept-btn" style="color: white;">Aceitar</button>';
echo '</form>';
echo '<form style="margin-right:5px" action="recusarCand.php" method="post">';
echo '<input type="hidden" name="id_Cand" value="' . $row['id_user'] . '">';
echo '<button type="submit" class="btn btn-danger" style="color: white;">Recusar</button>';
echo '</form>';
echo '</div>';
echo '</td>';

        


        echo "</tr>";
    }


    echo "</table>";
} else {
    echo "<h1 style='text-align:center; padding-top:100px'>Nenhuma candidatura encontrada.</h1>";
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.accept-btn').click(function () {
            $(this).closest('td').find('.btn-group').hide();
        });
    });
</script>


</body>
</html>
