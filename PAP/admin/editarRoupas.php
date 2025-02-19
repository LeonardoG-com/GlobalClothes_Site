<?php
@include('session.php');

// Definindo a variável com valor padrão
if (isset($_POST["id_roupa"])) {
  $id = mysqli_real_escape_string($con, $_POST['id_roupa']);

  $sql = "SELECT * FROM roupa WHERE id_roupa = '$id'";
  $result = mysqli_query($con, $sql);

  $query2 = "SELECT * FROM tamanhos_roupa WHERE id_roupa = '$id'";
  $result2 = mysqli_query($con, $query2);
  $tamanho_roupa = array();
  while ($rowTamanho_roupa = mysqli_fetch_assoc($result2)) {
    $id_tamanho = $rowTamanho_roupa['id_tamanhos'];
    array_push($tamanho_roupa, $id_tamanho);
  }

  $row = mysqli_fetch_array($result);
}







if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['id_cor']) && isset($_POST['id_marca']) && isset($_POST['id_genero']) && isset($_POST['id_tipoRoupa']) && isset($_POST['descricao']) && isset($_FILES['id_imagem'])) {
  $id_roupa = mysqli_real_escape_string($con, $_POST['id']);
  $preco = mysqli_real_escape_string($con,$_POST['preco']);
  $cor = mysqli_real_escape_string($con,$_POST['id_cor']);
  $marca = mysqli_real_escape_string($con,$_POST['id_marca']);
  $genero = mysqli_real_escape_string($con,$_POST['id_genero']);
  $tipoRoupa = mysqli_real_escape_string($con,$_POST['id_tipoRoupa']);
  $descricao = mysqli_real_escape_string($con,$_POST['descricao']);
  $preco = mysqli_real_escape_string($con,$_POST['preco']);

}

if(isset($_POST['atualizar'])){
  $id_roupa = mysqli_real_escape_string($con, $_POST['id']);

  $nome = mysqli_real_escape_string($con, $_POST['nome']);
  $preco = mysqli_real_escape_string($con,$_POST['preco']);
  $cor = mysqli_real_escape_string($con,$_POST['id_cor']);
  $marca = mysqli_real_escape_string($con,$_POST['id_marca']);
  $genero = mysqli_real_escape_string($con,$_POST['id_genero']);
  $tipoRoupa = mysqli_real_escape_string($con,$_POST['id_tipoRoupa']);
  $descricao = mysqli_real_escape_string($con,$_POST['descricao']);
  $preco = mysqli_real_escape_string($con,$_POST['preco']);

 // Verificar se uma imagem foi enviada
//  if (isset($_FILES['id_imagem']) && $_FILES['id_imagem']['error'] === UPLOAD_ERR_OK) {  // Obter o nome e o caminho temporário da nova imagem
//   $nova_imagem = $_FILES['id_imagem']['name'];
//   $nova_imagem_temp = $_FILES['id_imagem']['tmp_name'];
//   $novo_caminho_imagem = '/PAP/db_fotos/' . $nova_imagem;

//   // Verificar se o diretório de destino existe
//   if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/PAP/db_fotos')) {
//       mkdir($_SERVER['DOCUMENT_ROOT'] . '/PAP/db_fotos', 0777, true); // Cria o diretório "db_fotos" se ele não existir
//   }

//   // Verificar se o diretório de destino é gravável
//   if (is_writable($_SERVER['DOCUMENT_ROOT'] . '/PAP/db_fotos')) {
//       // Apagar a imagem antiga da base de dados
//       $query1 = "SELECT imagens FROM imagens ORDER BY id_imagens DESC LIMIT 1";
// $result1 = mysqli_query($con, $query1);
// $rowImagens = mysqli_fetch_assoc($result1);
// $imagem_antiga = $rowImagens['imagens'];

//       unlink($_SERVER['DOCUMENT_ROOT'] . $imagem_antiga);

//       // Apagar a imagem antiga do arquivo
//       unlink($_SERVER['DOCUMENT_ROOT'] . $imagem_antiga);

//       // Mover a nova imagem para o diretório de destino
//       move_uploaded_file($nova_imagem_temp, $_SERVER['DOCUMENT_ROOT'] . $novo_caminho_imagem);

//       // Inserir o caminho da nova imagem no banco de dados
//       $query2 = "UPDATE imagens SET imagens='$novo_caminho_imagem' ORDER BY id_imagens DESC LIMIT 1";
//       $con->query($query2);
//   } else {
//       echo "O diretório '/PAP/db_fotos' não tem permissão de gravação.";
//   }
// } else {
//   echo "Nenhuma nova imagem foi enviada.";
// }



// $query3 = "INSERT INTO imagens (id_imagens, imagens) VALUES ('', '$caminho_imagem')";
//         $con->query($query3);

        

//   $query4 = $con->query("SELECT id_imagens FROM imagens ORDER BY id_imagens DESC LIMIT 1");

// $verifica =  $query4->fetch_all();
// $id_roupa = mysqli_insert_id($con);
// $imagem = $result[0][0];

  // UPDATE statement
  $sql = "UPDATE roupa SET 
  nome = '$nome', 
  id_tipoRoupa = '$tipoRoupa', 
  id_cor = '$cor', 
  id_genero = '$genero', 
  id_marca = '$marca', 
  preco = '$preco' ,
  descricao = '$descricao' 
WHERE id_roupa = '$id_roupa'";
    $verifica = mysqli_query($con, $sql);


  //   if (($verifica)) {
  //     echo "d";
  //     if (isset($_POST['tamanhos'])) {
  //       echo "sss";
  //       $tamanhos = $_POST['tamanhos'];
  //       // print_r ($tamanhos);
  //       // print_r ($stocks);
    
  //       foreach ($tamanhos as $id_tamanho) {
  //         echo"sdsd";
  //         $query2 = "UPDATE tamanhos_roupa SET id_roupa = '$id_roupa', id_tamanhos = '$id_tamanho', stock = '$stock';";
  //         echo $query2;    
  //         mysqli_query($con, $query2);
  //       }
  //     }
  //   } else {
  //     echo 'Erro a atualizar o tamanho da sapatilha';
  // }
    
  
    
    if (isset($_POST['tamanhos']) && isset($_POST['stocks']) && !empty($_POST['stocks'])) {
      $tamanhos = $_POST['tamanhos'];
      $stocks = $_POST['stocks'];
    
      foreach ($tamanhos as $index => $id_tamanho) {
        $stock = mysqli_real_escape_string($con, $stocks[$index]); // Corrigido para $stocks em vez de $stock
        $query2 = "UPDATE tamanhos_roupa SET stock = '$stock' WHERE id_roupa = '$id_roupa' AND id_tamanhos = '$id_tamanho';";
        mysqli_query($con, $query2);
      }
    }
    
}
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
  <title>Editar Roupa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<input type="hidden" name="id" value="<?php echo $row['id_roupa']; ?>">

  <div style="padding-right:200px;padding-left:200px; ">
    <h1 style="text-align: center; padding: 100px;">Alterar Roupa</h1>
    <form class="row g-3" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
      <div style="display: none;">
        <input readonly name="id" value='<?php echo $id ?>' />
      </div>

      <div class="col-md-2">
        <label for="inputNome" class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" required value="<?php echo $row['nome'] ?>">
      </div>

      <div class="col-md-3">
    <label for="inputTamanho" class="form-label">Tipo Roupa:</label><br>
    <select class="form-select" name="id_tipoRoupa" id="tipoRoupaSelect" required>
        <option value="">Selecione o Tipo de Roupa</option>
        <?php
            $query = "SELECT * FROM tiporoupa;";
            $result = mysqli_query($con, $query);
            
            $selectedValue = $row['id_tipoRoupa']; // Valor inserido no campo "id_tipoRoupa"
            
            while ($rowtiporoupa = mysqli_fetch_assoc($result)) {
                $id_tiporoupa = $rowtiporoupa['id_tipoRoupas'];
                $tiporoupa = $rowtiporoupa['TipoRoupa'];
                $selected = ($id_tiporoupa == $selectedValue) ? 'selected' : '';
                echo "<option value=\"$id_tiporoupa\" $selected>$tiporoupa</option>";
            }
        ?>
    </select>
</div>


<div class="col-md-3">
    <label for="inputcor" class="form-label">Cor</label>
    <select class="form-select" name="id_cor" required>
        <option value="">Selecione a Cor</option>
        <?php
            $query_cor = "SELECT * FROM cor;";
            $result_cor = mysqli_query($con, $query_cor);
            $selectedValue_cor = $row['id_cor']; // Valor inserido no campo "id_cor"
            
            while ($rowcor = mysqli_fetch_assoc($result_cor)) {
                $id_cor = $rowcor['id_cor'];
                $cor = $rowcor['cores'];
                $selected_cor = ($id_cor == $selectedValue_cor) ? 'selected' : '';
                echo "<option value=\"$id_cor\" $selected_cor>$cor</option>";
            }
        ?>
    </select>
</div>

<div class="col-md-3">
    <label for="inputgenero" class="form-label">Género</label>
    <select class="form-select" name="id_genero" required>
        <option value="">Selecione o Género</option>
        <?php
            $query_genero = "SELECT * FROM genero;";
            $result_genero = mysqli_query($con, $query_genero);
            $selectedValue_genero = $row['id_genero']; // Valor inserido no campo "id_genero"
            
            while ($rowgenero = mysqli_fetch_assoc($result_genero)) {
                $id_genero = $rowgenero['id_genero'];
                $genero = $rowgenero['genero'];
                $selected_genero = ($id_genero == $selectedValue_genero) ? 'selected' : '';
                echo "<option value=\"$id_genero\" $selected_genero>$genero</option>";
            }
        ?>
    </select>
</div>

<div class="col-md-3" id="marcasDiv">
    <label for="inputMarca" class="form-label">Marcas:</label>
    <select class="form-select" name="id_marca" required>
        <option value="">Selecione a Marca</option>
        <?php
        $query = "SELECT * FROM marca";
        $result = mysqli_query($con, $query);
        $selectedValue_marca = $row['id_marca']; // Valor inserido no campo "id_marca"

        while ($rowmarca = mysqli_fetch_assoc($result)) {
            $id_marca = $rowmarca['id_marcas'];
            $marca = $rowmarca['marcas'];
            $selected_marca = ($id_marca == $selectedValue_marca) ? 'selected' : '';
            echo "<option value=\"$id_marca\" $selected_marca>$marca</option>";
        }
        ?>
    </select>
</div>



<div class="col-md-2">
  <label for="inputtamanhos" class="form-label">Tamanhos/Stocks:</label>
  <form method="post" action="atualizar_tamanhos.php">
    <?php
    $query = "SELECT * FROM tamanhos_roupa WHERE id_roupa = '$id'";
    $result2 = mysqli_query($con, $query);
    $tamanhos_roupa = array();
    while ($rowTamanhosRoupa = mysqli_fetch_assoc($result2)) {
      $id_tamanho = $rowTamanhosRoupa['id_tamanhos'];
      $stock = $rowTamanhosRoupa['stock'];
      $tamanhos_roupa[$id_tamanho] = $stock;
  }

  $query2 = "SELECT * FROM tamanhos";
$result3 = mysqli_query($con, $query2);

if (mysqli_num_rows($result3) > 0) {
  while ($row2 = mysqli_fetch_assoc($result3)) { // Correção feita aqui
    $id_tamanho = $row2["id_tamanhos"];
    $tamanho = $row2["tamanhos"];
    $stock = isset($tamanhos_roupa[$id_tamanho]) ? $tamanhos_roupa[$id_tamanho] : '';

    ?>
    <div class="form-group">
      <label name="tamanhos[]" for="tamanho-<?php echo $id_tamanho; ?>">Tamanho: <?php echo $tamanho; ?></label>
      <input type="number" class="form-control" name="stocks[<?php echo $id_tamanho; ?>]" value="<?php echo $stock; ?>">
    </div>
    <?php
  }
}

    ?>
</div>

    <div class="col-md-4">
       <div class="form-group">
         <label for="inputImagem" class="form-label">Imagem:</label>
         <input type="file" class="form-control" name="id_imagem" accept="image/png, image/jpeg, image/jpg, image/gif" >
       </div>
     </div>

      <div class="col-2">
        <label for="inputPreco" class="form-label">Preço</label>
        <input type="text" class="form-control" name="preco"  required value=<?php echo $row['preco'] ?>>
      </div>

      <div class="form-floating" style="padding-top: 50px;">
  <?php
  $query = "SELECT descricao FROM roupa WHERE id_roupa = " . $row['id_roupa'];
  $result = mysqli_query($con, $query);
  $descricao = mysqli_fetch_assoc($result)['descricao'];
  ?>
  <textarea class="form-control" name="descricao" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"><?php echo $descricao; ?></textarea>
  <label for="floatingTextarea2">Comments</label>
</div>



      <div class="col-12">
        <button type="submit" name="atualizar" class="btn btn-primary">Alterar</button>  
        <a href="roupas.php" class="btn btn-primary">Voltar</a>
      </div>
    </form>
  </div>
</body>

</html>