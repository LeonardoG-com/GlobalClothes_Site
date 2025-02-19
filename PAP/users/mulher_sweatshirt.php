<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/PAP/css/user.css" />
    <link rel="stylesheet" href="/PAP/css/slideshow.css" /> 
    <title>Document</title>
</head>
<body>
    
<?php
include ('../conDB/con_db.php');
include ('../users/navbar.php');
?>

<main>
    <section id="product1" class="section-p1">
        <div class="pro-container">
        <?php
        echo "<img src='/PAP/fotos/RoupaMulher.jpg' style='width: 100%; padding-bottom: 26px; alt='Descrição da Imagem'>";

        $query = "SELECT r.id_roupa, r.nome, r.preco, m.marcas, i.imagens, g.genero, tr.id_tipoRoupas
        FROM roupa AS r
        JOIN marca AS m ON r.id_marca = m.id_marcas
        JOIN imagens AS i ON r.id_imagens = i.id_imagens
        JOIN genero AS g ON r.id_genero = g.id_genero
        JOIN tiporoupa AS tr ON r.id_TipoRoupa = tr.id_tipoRoupas
        WHERE g.genero = 'Feminino' AND tr.TipoRoupa = 'SweatShirts'
        
        ORDER BY r.DataLanc DESC";


        $result = mysqli_query($con, $query);

        // Verificar se a consulta retornou resultados
        if (mysqli_num_rows($result) > 0) {
            // Loop pelos resultados e exibição das informações
            while ($row = mysqli_fetch_assoc($result)) {
                $id_roupa = $row['id_roupa'];
                $id_imagens = $row['imagens'];
                $id_marcas = $row['marcas'];
                $nome = $row['nome'];
                $preco = $row['preco'];

                // Exibir as informações no formato HTML
                echo "<div class='pro'>";
                echo "<a href='/PAP/users/produto.php?id_roupa=" . $id_roupa . "'>";
                echo "<img src='" . $id_imagens . "' alt=''>";
                echo "</a>";
                echo "<div class='des'>";
                echo "<span>" . $id_marcas . "</span>";
                echo "<h5>" . $nome . "</h5>";
                echo "<h4>" . number_format($preco, 2, ',', '.') . " €</h4>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "Nenhum resultado encontrado.";
        }

        // Fechar a conexão com o banco de dados
        mysqli_close($con);
        ?>
        </div>
    </section>
</main>

<?php
include ('../users/footer.html');
?>
</body>
</html>
