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
        $itens_por_pagina = 7;

        // Pega o número total de resultados
        $sql_count = "SELECT COUNT(*) AS count FROM roupa";
        $result_count = mysqli_query($con, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count);
        $total_itens = $row_count['count'];
        
        // Define o número total de páginas
        $total_paginas = ceil($total_itens / $itens_por_pagina);
        
        // Pega o número da página atual
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        
        // Garante que o número da página está dentro dos limites válidos
        $page = max(1, min($page, $total_paginas));
        
        // Define o offset a ser usado na query
        $offset = ($page - 1) * $itens_por_pagina;
        
        // Seleciona os itens da página atual
        $sql = "SELECT roupa.*,    
            cor.cores, 
            marca.marcas, 
            genero.genero, 
            tiporoupa.TipoRoupa, 
            imagens.imagens 
            FROM roupa 
            JOIN cor ON roupa.id_cor = cor.id_cor 
            JOIN marca ON roupa.id_marca = marca.id_marcas 
            JOIN genero ON roupa.id_genero = genero.id_genero 
            JOIN tiporoupa ON roupa.id_tipoRoupa = tiporoupa.id_tipoRoupas 
            JOIN imagens ON roupa.id_imagens = imagens.id_imagens   
            ORDER BY id_roupa ASC 
            LIMIT $offset, $itens_por_pagina";
        $result = mysqli_query($con, $sql);
        
        // Cria a navegação entre as páginas
        $links = "";
        for ($i = 1; $i <= $total_paginas; $i++) {
            $active = $page == $i ? "active" : "";
            $links .= "<li class='page-item $active'><a class='page-link' href='pagina.php?page=$i'>$i</a></li>";
        }
        ?>

        <section class="content">



            <section class="content">
                <?php
                // Verifica se há resultados
                
                if (mysqli_num_rows($result) > 0) {
                    // Cria a tabela HTML
                    // Cria o cabeçalho da tabelay
                    
                    
                    echo "<h2></h2>";
                    echo "<table class='rTable table-bordered '>";
                    echo "<h2 style ='text-align:center; padding:  30px;'> Tabela das Roupas</h2>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "Quer inserir mais Roupas? Clique<a href='inserirRoupa.php'> aqui";
                    echo "<th>Id</th>";
                    echo "<th>Nome</th>";
                    echo "<th>Preço</th>";
                    echo "<th>Tamanhos/Stocks</th>";
                    echo "<th>Cor</th>";
                    echo "<th>Marca</th>";
                    echo "<th>Género</th>";
                    echo "<th>Tipo Roupa</th>";
                    echo "<th>Data Lançamento</th>";
                    echo "<th>Descrição</th>";
                    echo "<th>Imagem</th>";
                    echo "<th>Ações</th>";
                    echo "</tr>";
                    echo "</thead>";
                
                
                    
                    // Exibe os dados de cada linha da tabela
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["id_roupa"] . "</td>";
                        echo "<td>" . $row["nome"] . "</td>";
                        echo "<td>" . number_format($row["preco"], 2, ',', '.') . " €</td>";
  
                        
                        echo "<td>";
                        $query = "SELECT tr.id_roupa, t.tamanhos, tr.stock
                                  FROM tamanhos_roupa AS tr
                                  INNER JOIN tamanhos AS t ON tr.id_tamanhos = t.id_tamanhos
                                  WHERE tr.id_roupa = '" . $row["id_roupa"] . "'";
                        $result2 = mysqli_query($con, $query);
                        
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $tamanho = $row2["tamanhos"];
                                $stock = $row2["stock"];
                                echo "Tamanho: $tamanho, Stock: $stock<br>";
                            }
                        } else {
                            echo "N/A";
                        }
                        
                        echo "</td>";
                        
                        
                        echo "<td>" . $row["cores"] . "</td>";
                        echo "<td>" . $row["marcas"] . "</td>";
                        echo "<td>" . $row["genero"] . "</td>";
                        echo "<td>" . $row["TipoRoupa"] . "</td>";
                        echo "<td>" . $row["DataLanc"] . "</td>";
                        echo "<td>" . $row["descricao"] . "</td>";
                        echo '<td><img src="' . $row['imagens'] . '" alt="Imagem da T-shirt" width="50"></td>';
                        echo "</td>";
                        echo '<td><div class="btn-group">';
                        echo '<form style="margin-right:5px" action="editarRoupas.php" method="post">';
                        echo '<input type="hidden" name="id_roupa" value="' . $row['id_roupa'] . '">';
                        echo '<button type="submit" class="btn btn-primary btn-sm" style="color: white;">Editar</button>';
                        echo '</form>';
                        echo '<form action="eliminarRoupas.php" method="post">';
                        echo '<input type="hidden" name="id_roupa" value="' . $row['id_roupa'] . '">';
                        echo '<button name="id_roupa" value="' . $row['id_roupa'] . '" type="submit" class="btn btn-danger btn-sm">Apagar</button>';
                        echo '</form>';
                        echo '</div></td>';
                        
                    
                        echo "</tr>";
                        
                    }
                    echo "</table>";
                    
                } else {
                    
                    echo "<h1 style='text-align:center; padding-top:100px'>Nenhum resultado encontrado. Voce pode <a href='inserirRoupa.php'>adicionar nova Roupa</a></h1>";
                }
                
                ?>

<nav aria-label="bloco de páginas">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="roupas.php?page=1"><<</a></li>
        <li class="page-item"><a class="page-link" href="roupas.php?page=<?php echo max($page-1, 1); ?>"><</a></li>
        <?php
        // Exibe os links da paginação
        for ($i = 1; $i <= $total_paginas; $i++){
            $active = $i == $page ? "active" : "";
            echo "<li class='page-item $active'><a class='page-link' href='roupas.php?page=$i'>$i</a></li>";
        }
        ?>
        <li class="page-item"><a class="page-link" href="roupas.php?page=<?php echo min($page+1, $total_paginas); ?>">></a></li>
        <li class="page-item"><a class="page-link" href="roupas.php?page=<?php echo $total_paginas; ?>">>></a></li>
    </ul>
</nav>


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
                    crossorigin="anonymous">
                </script>
</body>

</html>