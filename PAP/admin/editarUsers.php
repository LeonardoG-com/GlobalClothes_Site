<?php
include('../conDB/con_db.php');
        // Supondo que você já tenha uma conexão estabelecida com o banco de dados ($con)

// Recebe os valores enviados via GET
$id = $_GET['id'];
$cargo = $_GET['cargo'];

// Atualiza o cargo do usuário no banco de dados
$sql_update_cargo = "UPDATE users SET cargo='$cargo' WHERE id=$id";
$result_update_cargo = mysqli_query($con, $sql_update_cargo);

// Verifica se a atualização foi bem-sucedida
if ($result_update_cargo) {
    // Atualização bem-sucedida, redireciona para a página de visualização de usuários
    header("Location: /PAP/admin/User.php");
    exit();
} else {
    // Erro na atualização, exibe uma mensagem de erro ou realiza outra ação necessária
    echo "Erro ao atualizar o cargo do usuário.";
}

?>