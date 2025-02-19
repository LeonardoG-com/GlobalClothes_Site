<?php
include ('../admin/session.php');


// Verifica se os dados do produto foram recebidos via solicitação POST
if (isset($_POST['id_roupa']) && isset($_POST['id_tamanhos'])) {

    $id_roupa = $_POST['id_roupa'];
    $id_tamanhos = $_POST['id_tamanhos'];

    // Verifica se o produto já está no carrinho
    $sql = "SELECT * FROM carrinho WHERE id_roupa = $id_roupa AND id_tamanhos = $id_tamanhos";
 
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // Atualiza a quantidade do produto no carrinho
        $row = $result->fetch_assoc();
        $quantidade_atual = $row['quantidade'] + 1;
        $sql = "UPDATE carrinho SET quantidade = $quantidade_atual WHERE id_tamanhos = $id_tamanhos AND id_roupa = $id_roupa";
        $con->query($sql);

    
    } else {
        // Insere o produto no carrinho
        $quantidade = 1;
        $sql = "INSERT INTO carrinho (id_user, id_roupa, id_tamanhos, quantidade) VALUES ('$id', $id_roupa, $id_tamanhos, $quantidade)";
        $con->query($sql);
    }

    // Resposta de sucesso
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
    // Resposta de erro
    echo "Ocorreu um erro ao adicionar o produto apppppppppo carrinho.";
}

$con->close();
?>
