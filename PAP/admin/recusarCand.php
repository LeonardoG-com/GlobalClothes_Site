<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">

    <title>Document</title>
</head>
<body>

<?php
include('../conDB/con_db.php');

if (isset($_POST['id_Cand'])) {
    $id_Cand = $_POST['id_Cand'];

    // Obter o caminho do PDF e o ID da imagem associada a partir do banco de dados
    $query = "SELECT i.imagens, je.id_imagem FROM juntar_equipa AS je
              INNER JOIN imagens AS i ON je.id_imagem = i.id_imagens
              WHERE je.id_user = $id_Cand";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $caminho_pdf = $_SERVER['DOCUMENT_ROOT'] . $row['imagens'];
        $id_imagem = $row['id_imagem'];

        // Verificar se o arquivo PDF existe
        if (file_exists($caminho_pdf)) {
            // Excluir o arquivo PDF
            unlink($caminho_pdf);
        }

        // Excluir a linha da tabela juntar_equipa
        $query_delete_juntar_equipa = "DELETE FROM juntar_equipa WHERE id_user = $id_Cand";
        $result_delete_juntar_equipa = mysqli_query($con, $query_delete_juntar_equipa);

        // Excluir o registro da tabela imagens
        $query_delete_imagens = "DELETE FROM imagens WHERE id_imagens = $id_imagem";
        $result_delete_imagens = mysqli_query($con, $query_delete_imagens);

        if ($result_delete_juntar_equipa && $result_delete_imagens) {
            // Redirecionar para a página atual
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Erro ao recusar a candidatura.";
        }
    }
}
?>





</body>
</html>