<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PAP/css/carrinho.css">
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/PAP/css/user.css" />
    <title>Global Clothes</title>
</head>

<style>
    .product-image {
      max-width: 100px; /* Defina o tamanho máximo desejado */
      height: auto; /* Mantém a proporção original */
    }
    .table-header {
    padding: 0 10px; /* Adicione o espaçamento desejado nas laterais */
  }
  .table-header-array{
        padding: 0 10px;
        padding-left: 30px
  }
  .enviar-id-roupa {
    padding: 15px 20px;
  background: #3bc55b;
  font-size: 18px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  }
  
</style>

<body>
<?php
include('../admin/session.php');
include('../users/navbar.php');

// Executar a consulta SQL
$query = "SELECT c.id_carro, c.id_user, c.id_roupa, c.id_tamanhos, c.quantidade, s.nome, s.preco, s.id_imagens, m.id_marcas, j.TipoRoupa, i.imagens, t.id_tamanhos, c.quantidade
 FROM carrinho c INNER JOIN roupa s ON c.id_roupa = s.id_roupa 
 INNER JOIN marca m ON s.id_marca = m.id_marcas 
 INNER JOIN tamanhos t ON c.id_tamanhos = t.id_tamanhos 
 INNER JOIN tiporoupa j ON s.id_tipoRoupa = j.id_tipoRoupas JOIN imagens AS i ON s.id_imagens = i.id_imagens 
 WHERE c.id_user = $id";


$result = mysqli_query($con, $query);

// Inicializar a variável $totalRoupas com o valor zero
$totalRoupas = 0;

?>

<main>
  <div class="page-title">Seu Carrinho</div>
  <div class="content">
    <section>
      <table>
        <thead>
          <tr>
            <th class="table-header">Produto</th>
            <th class="table-header">Preço</th>
            <th class="table-header">Tamanhos</th>
            <th class="table-header">Quantidade</th>
            <th class="table-header-array">Total</th>
            <th class="table-header">Apagar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            $nome = $row['nome'];
            $tipoRoupa = $row['TipoRoupa'];
            $preco = $row['preco'];
            $imagem = $row['imagens'];
          ?>
            <tr>
              <td>
                <div class="product">
                  <img class="product-image" src="<?php echo $imagem; ?>" alt="" />
                  <div class="info">
                    <div class="name"><?php echo $nome; ?></div>
                    <div class="category"><?php echo $tipoRoupa; ?></div>
                  </div>
                </div>
              </td>

              <td>
                <?php
                $preco = $row['preco'];
                echo $preco . '€';
                ?>
              </td>

              <td>
              <?php
$roupa_id = $row['id_roupa'];
// $tamanho_id = $row['id_tamanhos'];
$query_tamanho = "SELECT t.tamanhos
                  FROM tamanhos_roupa tr
                  INNER JOIN tamanhos t ON tr.id_tamanhos = t.id_tamanhos
                  WHERE tr.id_roupa = '$roupa_id'
                  AND tr.id_tamanhos = '$tamanho_id'";
                  echo $query_tamanho;


$result_tamanho = mysqli_query($con, $query_tamanho);

if ($row_tamanho = mysqli_fetch_assoc($result_tamanho)) {
  $tamanho = $row_tamanho['tamanhos'];
  echo $tamanho;
}
?>


              </td>

              <td>
                <div class="qty">
                  <span><?php echo $row['quantidade']; ?></span>
                </div>
              </td>

              <td>
                <?php
                $quantidade = $row['quantidade'];
                $preco = $row['preco'];
                $total = $quantidade * $preco;

                $totalRoupas += $total; // Acumula o total de cada roupa na variável $totalRoupas

                // Resto do seu código para exibir os detalhes de cada roupa
                $formattedTotal = number_format($total, 2, ',', '.') . '€';
                $spacedTotal = str_pad($formattedTotal, strlen($formattedTotal) + 1, ' ', STR_PAD_RIGHT);
                echo $spacedTotal;
                ?>
              </td>

              <td>
                <form action="remover_carro.php" method="POST">
                 <input type="hidden" name="id_carro" value="<?php echo $row['id_carro']; ?>">
                 <button type="submit" class="remove"><i class="fa-solid fa-xmark"></i></button>
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </section>
    <aside>
      <div class="box">
        <header>Resumo da compra</header>
        <div class="info">
          <div><span>Sub-total</span><span><?php echo '<span>' . number_format($totalRoupas, 2, ',', '.') . '€</span>';?></span></div>
          <div><span>Transportes</span><span>Gratuito</span></div>
          <div>
            <button>
              Adicionar cupom de desconto
              <i class="bx bx-right-arrow-alt"></i>
            </button>
          </div>
        </div>
        <footer>
          <span>Total</span>
          <?php
          echo '<span>' . number_format($totalRoupas, 2, ',', '.') . '€</span>';
          ?>
        </footer>
      </div>
      <td>
      <form action="conf_carro.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <?php
    // Executar a consulta SQL
    $query = "SELECT c.*, r.* FROM carrinho c JOIN roupa r ON c.id_roupa = r.id_roupa WHERE c.id_user = $id";
    $result = mysqli_query($con, $query);
    
    // Verificar se a consulta retornou resultados
    if (mysqli_num_rows($result) > 0) {
        // Loop pelos resultados da consulta
        while ($row = mysqli_fetch_assoc($result)) {
            echo 'ID: ' . $id;
            echo 'ID Roupa: ' . $row['id_roupa'];
        }
    }
    ?>
    <button type="submit" class="enviar-id-roupa">Finalizar Compra</button>
</form>

</td>


  
    </aside>
  </div>
</main>

<?php
include('../users/footer.html');
?>

</body>
</html>
