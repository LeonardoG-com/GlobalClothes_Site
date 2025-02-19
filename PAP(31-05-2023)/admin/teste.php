<?php
session_start();
@include('../conexao_bd.php');
// Verifique se o formulário foi enviado
if (isset($_POST['coluna1']) && isset($_POST['coluna2']) && isset($_POST['coluna3']) && isset($_POST['coluna4']) && isset($_POST['coluna5']) && isset($_FILES['coluna7'])) {
$coluna1 = mysqli_real_escape_string($db, $_POST['coluna1']);
 $coluna2 = mysqli_real_escape_string($db, $_POST['coluna2']);
 $coluna3 = mysqli_real_escape_string($db, $_POST['coluna3']);
 $coluna4 = mysqli_real_escape_string($db, $_POST['coluna4']);
 $coluna5 = mysqli_real_escape_string($db, $_POST['coluna5']);
 // $coluna6 = mysqli_real_escape_string($db, $_POST['coluna6']);
 $coluna7 = mysqli_real_escape_string($db, file_get_contents($_FILES['coluna7']['tmp_name']));

 // Atualize os dados da linha
 $query = "INSERT INTO `sapatilhas`(`marca`, `modelo`, `preco`, `imagem`) VALUES ('$coluna2','$coluna3','$coluna4', '$coluna7');";
 $verifica = mysqli_query($db, $query);

 $id_sapatilha = mysqli_insert_id($db);

 if ($verifica) {
  if (isset($_POST['tamanhos'])) {
   $tamanhos = $_POST['tamanhos'];

   print_r($tamanhos);

   foreach ($tamanhos as $id_tamanho) {
    $query2 = "INSERT INTO `sapatilhas_tamanhos`(`id_sapatilhas`, `id_tamanhos`, stock) VALUES ('$id_sapatilha','$id_tamanho', '$coluna5');";
    echo $query2;
    mysqli_query($db, $query2);
   }
  }
 } else {
  echo '<script>
  Swal.fire({
    icon: "error",
    title: "Erro!",
    text: "Erro ao inserir a sapatilha.",
  });
   </script>';
 }



 // Volte para a página da tabela
 header('Location: /PAP-Mix-Shoes-Simao_Vieira/sapatilhas/adicionar_sapatilhas.php');
}
?>
<html lang="en" dir="ltr">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="/PAP-Mix-Shoes-Simao_Vieira/css/admin.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 </style>
</head>

<body>
 <div style="margin-left: 40px;">
  <h1>Adicionar Sapatilhas</h1>
  <form action="adicionar_sapatilhas_cod.php" enctype="multipart/form-data" method="post">

   <input type="hidden" name="coluna1" value="<?php echo $row['id']; ?>">

   <div style="margin-top: 20px;">
    <span class="input-group-text">Marca: </span>
    <input type="text" class="form-control" name="coluna2" required>

   </div>

   <div style="margin-top: 20px;">
    <span class="input-group-text">Modelo</span>
    <input type="text" class="form-control" name="coluna3" required>
   </div>

   <div style="margin-top: 20px;">
    <span class="input-group-text">Preco</span>
    <input type="text" class="form-control" name="coluna4" required>

   </div>

   <div style="margin-top: 20px;">
    <span class="input-group-text">Stock: </span>
    <input type="text" class="form-control" name="coluna5" required>

   </div>

   <div class="col-md-5">
    <span class="input-group-text">Tamanho</span>
    <?php
    $query = "SELECT * FROM tamanhos";
    $result = mysqli_query($db, $query);

    while ($rowtamanhos = mysqli_fetch_assoc($result)) {
     $idtamanhos = $rowtamanhos['idtamanhos'];
     $tamanho = $rowtamanhos['tamanhos'];
     echo "<div>";
     echo '<input type="checkbox" name="tamanhos[]" value="' . $idtamanhos . '">';
     echo "<label for='tamanho-$idtamanhos'>$tamanho</label>";
     echo "</div>";
    }
    ?>
   </div>

   <div style="margin-top: 20px;">
    <span class="input-group-text">Imagem: </span>
    <input type="file" class="form-control" name="coluna7" accept="image/png, image/jpeg, image/gif" required>
   </div>

   <div style="margin-top: 20px;">
    <button type="submit" class="btn btn-secondary btn-lg">Adicionar</button>
   </div>
  </form>
 </div>

 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

<?php
// Feche a conexão com o banco de dados
mysqli_close($db);
?>
