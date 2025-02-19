<?php
include('../admin/session.php');

if (isset($_POST['id_carro']) ) {
    $id_carro = $_POST['id_carro'];

    // Realize a lógica de remoção da sapatilha do carrinho, como excluir o registro correspondente da tabela 'carrinho'.

    // Exemplo de consulta para excluir a sapatilha do carrinho
    $delete_query = "DELETE FROM carrinho WHERE id_carro = '$id_carro'";
    echo $delete_query;
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
        // A sapatilha foi removida com sucesso do carrinho
        header("Location: /PAP/users/carro.php");
        exit();
    } else {
        // Ocorreu um erro ao remover a sapatilha do carrinho
        echo "Ocorreu um erro ao remover a sapatilha do carrinho.";
    }
} else {
    // O campo 'id_roupa' não está definido na solicitação POST
    echo "Ocorreu um erro ao remover a sapatilha do carrinho. O campo 'id_roupa' não está definido.";
}

$con->close();
?>
