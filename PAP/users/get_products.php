<?php
// Conexão com o banco de dados (seu código de conexão aqui)
include('../conDB/con_db.php');

// Recupere o valor do parâmetro de gênero enviado via AJAX
$genero = $_GET['genero'];

// Construa a consulta SQL com base no gênero
$query = "SELECT r.id_roupa, r.nome, r.preco, m.marcas, i.imagens, g.genero
          FROM roupa AS r
          JOIN marca AS m ON r.id_marca = m.id_marcas
          JOIN imagens AS i ON r.id_imagens = i.id_imagens
          JOIN genero AS g ON r.id_genero = g.id_genero";

// Verifique se um gênero específico foi especificado
if ($genero !== '') {
  $query .= " WHERE g.genero = '$genero'";
}

$query .= " ORDER BY r.DataLanc DESC LIMIT 8";

$result = mysqli_query($con, $query);

// Verifique se a consulta retornou resultados
if (mysqli_num_rows($result) > 0) {
  // Loop pelos resultados e construção do HTML dos produtos
  while ($row = mysqli_fetch_assoc($result)) {
    $id_roupa = $row['id_roupa'];
    $id_imagens = $row['imagens'];
    $id_marcas = $row['marcas'];
    $nome = $row['nome'];
    $preco = $row['preco'];

    // Construa o HTML do produto
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

// Feche a conexão com o banco de dados
mysqli_close($con);
?>
