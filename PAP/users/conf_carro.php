<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PAP/css/carrinho.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/PAP/css/user.css" />
    <title>Global Clothes</title>
    <style>
        .product-image {
            max-width: 100px;
            height: auto;
        }
        
    </style>
</head>
<body>
    
<?php
    include('../users/navbar.php');
    include ('../conDB/con_db.php');
    

    $exibirFormulario = true; // Variável de controle

    $id = $_POST['id'];
  
        echo "id:" . $id; 



    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['num_contri']) && isset($_POST['telemovel']) && isset($_POST['morada']) && isset($_POST['morada2']) && isset($_POST['codigo_postal']) && isset($_POST['cidade'])) {
        $nome = mysqli_real_escape_string($con, $_POST['nome']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $num_contri = mysqli_real_escape_string($con, $_POST['num_contri']);
        $telemovel = mysqli_real_escape_string($con, $_POST['telemovel']);
        $morada = mysqli_real_escape_string($con, $_POST['morada']);
        $morada2 = mysqli_real_escape_string($con, $_POST['morada2']);
        $codigo_postal = mysqli_real_escape_string($con, $_POST['codigo_postal']);
        $cidade = mysqli_real_escape_string($con, $_POST['cidade']);


        $queryCons = "SELECT id_user, id_roupa,id_tamanhos, quantidade FROM carrinho WHERE id_user = '$id'";
        $resultado = mysqli_query($con, $queryCons); // Supondo que você já tenha uma conexão com o banco de dados estabelecida
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            $idRoupa = $row['id_roupa'];
            $quantidade = $row['quantidade'];
            $tamanho = $row['id_tamanhos'];
            echo $idRoupa . "<br>";
            
            // Verificar se há estoque suficiente para a quantidade desejada
            $queryStock = "SELECT stock FROM tamanhos_roupa WHERE id_roupa = '$idRoupa'";
            $resultadoStock = mysqli_query($con, $queryStock);
            
            if ($resultadoStock) {
                $rowStock = mysqli_fetch_assoc($resultadoStock);
                $stock = $rowStock['stock'];
                
                if ($stock >= $quantidade) {
                    echo "e";
                    
                    // Inserir dados na tabela "encomenda"
                    $queryEncomenda = "INSERT INTO encomenda (id_user, id_roupa, quantidade, nome, email, num_contri, telemovel, morada, morada2, codigo_postal, cidade)
                        VALUES ('$id', '$idRoupa', '$quantidade', '$nome', '$email', '$num_contri', '$telemovel', '$morada', '$morada2', '$codigo_postal', '$cidade')";
                    mysqli_query($con, $queryEncomenda);
                    echo $queryEncomenda;
                
                    // Atualizar o estoque apenas para o tamanho específico na tabela "tamanhos_roupa"
                    $novoStock = $stock - $quantidade;
                    $queryUpdateStock = "UPDATE tamanhos_roupa SET stock = '$novoStock' WHERE id_roupa = '$idRoupa' AND id_tamanhos = '$tamanho'";
                    mysqli_query($con, $queryUpdateStock);
                    echo $queryUpdateStock;
                    
                    // Remover os dados do carrinho
                    $queryRemoverCarrinho = "DELETE FROM carrinho WHERE id_user = '$id' AND id_roupa = '$idRoupa'";
                    mysqli_query($con, $queryRemoverCarrinho);
                }else {
                    echo "Quantidade indisponível para a roupa com ID $idRoupa";
                }
            } else {
                echo "Erro na consulta de estoque para a roupa com ID $idRoupa";
            }
        }
            
        
        
        

        // Inserir dados na tabela "encomenda"
        
        
// echo "dsddsd";
//         $queryRoupas = "INSERT INTO encomenda (, )
//        VALUES ('$idRoupas', '$idUsuario')";

//         echo $queryRoupas;

    }
?>



        <h3 style="padding-left: 16%; padding-bottom: 20px; padding-top: 20px">Insira os dados de faturção</h3>

        <form class="row g-3 text-start" method="POST">

    <input type="hidden" class="form-control" name="id" value=" <?php echo $id; ?> ">
            <div class="col-md-3" style="padding-left:3%">
                <label for="inputEmail4" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome">
            </div>
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="col-md-2">
                <label for="inputEmail4" class="form-label">Número de Contribuinte</label>
                <input type="text" class="form-control" name="num_contri">
            </div>
            <div class="col-md-2">
                <label for="inputEmail4" class="form-label">Telemovel</label>
                <input type="text" class="form-control" name="telemovel">
            </div>
            <div class="col-md-3" style="padding-left:3%">
                <label for="inputMorada" class="form-label">Morada</label>
                <input type="text" class="form-control" name="morada" placeholder="Exemplo: 1234 Main St">
            </div>
            <div class="col-md-3"> 
                <label for="inputMorada2" class="form-label">Morada 2</label>
                <input type="text" class="form-control" name="morada2" placeholder="Exemplo: Apartment, studio, or floor">
            </div>
            <div class="col-md-2">
                <label for="inputCity" class="form-label">Código-Postal</label>
                <input type="text" class="form-control" name="codigo_postal">
            </div>
            <div class="col-md-2">
                <label for="inputCity" class="form-label">Cidade</label>
                <input type="text" class="form-control" name="cidade">
            </div>
            <div style="padding-bottom: 10%; padding-left:3%">
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </form>

        
        <aside>
            <div class="box">
                <header>Resumo da compra</header>
                <div class="info">
                    <?php
                    $sql = "SELECT c.id_carro, c.id_roupa, c.id_tamanhos, c.quantidade, s.nome, s.preco, s.id_imagens, m.id_marcas, j.TipoRoupa, i.imagens, t.id_tamanhos
                    FROM carrinho c 
                    INNER JOIN roupa s ON c.id_roupa = s.id_roupa 
                    INNER JOIN marca m ON s.id_marca = m.id_marcas 
                    INNER JOIN tamanhos t ON c.id_tamanhos = t.id_tamanhos 
                    INNER JOIN tiporoupa j ON s.id_tipoRoupa = j.id_tipoRoupas 
                    JOIN imagens AS i ON s.id_imagens = i.id_imagens 
                    WHERE c.id_user = $id";

                    $result2 = mysqli_query($con, $sql);

                    // Fetch and display the total from the query result
                    $total = 0;
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $total += $row['preco'] * $row['quantidade'];
                        // Display the "imagens" field
                        echo '<div class="image-container">';
                        echo '<img class="product-image" src="' . $row['imagens'] . '" alt="Imagem do produto">';
                        echo '<div class="info">';
                        echo '<div class="name">' . $row['nome'] . '</div>';
                        echo '<div class="category">' . $row['TipoRoupa'] . '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>   
                    <div><span>Transportes: Gratuito</span></div>
                </div>
                <footer>
                    <span>Total</span>
                    <?php
                    echo '<span>R$ ' . number_format($total, 2, ',', '.') . '</span>';
                    ?>
                </footer>
            </div>
            <td></td>
        </aside>
   

    <?php
    include('../users/footer.html');
    ?>
</body>
</html>