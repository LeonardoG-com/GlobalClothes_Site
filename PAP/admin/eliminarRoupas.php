<?php
session_start();
include('../conDB/con_db.php');

if (isset($_POST['id_roupa'])) {
    $id = $_POST['id_roupa'];

    $query_select_imagem = "SELECT id_imagens FROM roupa WHERE id_roupa = ?";
    $stmt_select_imagem = mysqli_prepare($con, $query_select_imagem);
    mysqli_stmt_bind_param($stmt_select_imagem, "i", $id);
    mysqli_stmt_execute($stmt_select_imagem);
    $result_select_imagem = mysqli_stmt_get_result($stmt_select_imagem);
    $row_select_imagem = mysqli_fetch_assoc($result_select_imagem);

    if ($row_select_imagem !== null) {
        $id_imagem = $row_select_imagem['id_imagens'];

        // Obter o caminho da imagem
        $query_select_caminho_imagem = "SELECT imagens FROM imagens WHERE id_imagens = ?";
        $stmt_select_caminho_imagem = mysqli_prepare($con, $query_select_caminho_imagem);
        mysqli_stmt_bind_param($stmt_select_caminho_imagem, "i", $id_imagem);
        mysqli_stmt_execute($stmt_select_caminho_imagem);
        $result_select_caminho_imagem = mysqli_stmt_get_result($stmt_select_caminho_imagem);
        $row_select_caminho_imagem = mysqli_fetch_assoc($result_select_caminho_imagem);

        if ($row_select_caminho_imagem !== null) {
            $caminho_imagem = $row_select_caminho_imagem['imagens'];

            // Excluir os registros relacionados na tabela tamanhos_roupa
            $query_delete_tamanhos = "DELETE FROM tamanhos_roupa WHERE id_roupa = ?";
            $stmt_delete_tamanhos = mysqli_prepare($con, $query_delete_tamanhos);
            mysqli_stmt_bind_param($stmt_delete_tamanhos, "i", $id);
            mysqli_stmt_execute($stmt_delete_tamanhos);

            // Excluir o registro da tabela roupa
            $query_delete_roupa = "DELETE FROM roupa WHERE id_roupa = ?";
            $stmt_delete_roupa = mysqli_prepare($con, $query_delete_roupa);
            mysqli_stmt_bind_param($stmt_delete_roupa, "i", $id);
            mysqli_stmt_execute($stmt_delete_roupa);

            // Excluir os dados da tabela imagens
            $query_delete_imagem = "DELETE FROM imagens WHERE id_imagens = ?";
            $stmt_delete_imagem = mysqli_prepare($con, $query_delete_imagem);
            mysqli_stmt_bind_param($stmt_delete_imagem, "i", $id_imagem);
            mysqli_stmt_execute($stmt_delete_imagem);

            // Excluir a imagem associada
            // Certifique-se de ajustar o caminho correto para o arquivo de imagem específico
            $caminho_completo_imagem = $_SERVER['DOCUMENT_ROOT'] . $caminho_imagem;
            if (is_file($caminho_completo_imagem)) {
                unlink($caminho_completo_imagem);
            }
        }
    }
}

header('location:/PAP/admin/roupas.php');
?>
