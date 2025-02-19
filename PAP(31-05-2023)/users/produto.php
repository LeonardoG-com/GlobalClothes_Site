<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Clothes</title>
    <link rel="stylesheet" href="/PAP/css/user.css" />
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="/PAP/css/produto.css" />

</head>
<body>

<?php
include ('../users/navbar.php');
?>

<main>

<!-- <div class="pro-container"> -->
<div style="display:grid;grid-template-columns:50% 50%;">
<?php
include ('../conDB/con_db.php');
if (isset($_GET['id_roupa'])) {
    $id_roupa = $_GET['id_roupa'];

    // Executar a query para obter os dados da roupa com base no id_roupa
    $query = "SELECT r.id_roupa, r.nome, r.preco, m.marcas, i.imagens, g.genero, s.TipoRoupa, descricao 
    FROM roupa AS r JOIN marca AS m ON r.id_marca = m.id_marcas 
    JOIN imagens AS i ON r.id_imagens = i.id_imagens
     JOIN genero AS g ON r.id_genero = g.id_genero 
     JOIN tiporoupa AS s ON r.id_tipoRoupa = s.id_tipoRoupas   WHERE r.id_roupa = " . $id_roupa;

    $result = mysqli_query($con, $query);

    // Verificar se a consulta retornou resultados
    if (mysqli_num_rows($result) > 0) {
        // Obter os dados da roupa
        $row = mysqli_fetch_assoc($result);
        $id_roupa = $row['id_roupa'];
        $nome = $row['nome'];
        $preco = $row['preco'];
        $marcas = $row['marcas'];
        $imagens = $row['imagens'];
        $genero = $row['genero'];
        $tipoRoupa = $row['TipoRoupa'];
        $descricao = $row['descricao'];

       
        // Exibir as informações da roupa no formato desejado
 
        echo "<div>";
        // echo "<a href='/PAP/users/produto.php?id_roupa=" . $id_roupa . "'>";
        echo "<img src='" . $imagens . "' alt='' style='max-width:100%;'>";
        echo "<p class='descricao' style='margin-top:15px'>Descrição: " . $descricao. "</p>";
        echo "</a>";
        echo "</div>";
        echo "<div>";
        echo "<h2 class='nome'>" . $nome . " (" . $genero . ")</h2>";
        echo "<p class='marcas'>" . $marcas . "</p>";
        echo "<div style='text-align: center;'>";
        echo "<p class='quantidade-label' style='display: inline;'>Quantidade: </p>";
        echo "<input type='text' name='quantidade' class='quantidade-input-small' style='display: inline;'>";
        echo "</div>";
        
                echo "<h4 class='preco'>" . number_format($preco, 2, ',', '.') . " €</h4>";
        
        echo "<div class='btn-toolbar d-flex justify-content-center align-items-center' role='toolbar' aria-label='Toolbar with button groups'>";
        echo "<div class='btn-group mr-2' role='group' aria-label='First group'>";


if ($tipoRoupa == "Sapatilhas") {
    $tamanhoInicio = 1;
    $tamanhoFim = 11;
} else {
    $tamanhoInicio = 12;
    $tamanhoFim = 17;
}

$query2 = "SELECT t.id_tamanhos, t.tamanhos,stock
    FROM tamanhos AS t
    INNER JOIN tamanhos_roupa AS tr ON tr.id_tamanhos = t.id_tamanhos
    WHERE tr.id_roupa = '" . $row["id_roupa"] . "'
    AND t.id_tamanhos BETWEEN " . $tamanhoInicio . " AND " . $tamanhoFim . "
    AND stock > 0";

$result2 = mysqli_query($con, $query2);

if (mysqli_num_rows($result2) > 0) {
    echo "<div class='d-flex align-items-center justify-content-center'>"; // Div para centralizar o texto e os botões

    echo "<p class='mr-2 mb-0'>Tamanhos:    </p>"; // Texto "Tamanhos:" com margem à direita

    $tamanhosDisponiveis = array(); // Array para armazenar os tamanhos disponíveis

    while ($row2 = mysqli_fetch_assoc($result2)) {
        $tamanhoId = $row2['id_tamanhos'];
        $tamanho = $row2['tamanhos'];

        // Define a classe CSS para o botão
        $classeBotao = "btn btn-custom btn-subtle-border";

        echo "<button type='button' name='tamanhos' class='" . $classeBotao . "' onclick='highlightOption(this)'>";
        echo "<span class='button-text'>" . $tamanho . "</span>";
        echo "</button>";

    }

    echo "</div>"; // Fechamento da div
}

echo "</div>"; // Fechamento da div
echo "</div>"; // Fechamento da div

echo "<form onsubmit='event.preventDefault(); adicionarAoCarrinho(" . $id_roupa . ", " . $tamanhoId . ")'>";
echo "<input type='hidden' name='id_roupa' value='" . $id_roupa . "'>"; // Adiciona o campo id_roupa como um campo oculto
echo "<div class='text-center' style='margin-top: 20px;'>";
echo "<input type='submit' id='btn-submit' class='btn btn-primary btn-lg btn-success'>";
echo "</div>";
echo "</form>";



    } else {
        echo "Nenhum resultado encontrado.";
    }
    
}    
// Fechar a conexão com o banco de dados
mysqli_close($con);
?>
</main>

</div>
<?php
include ('../users/footer.html');
?>

<script>
function highlightOption(clickedButton) {
    var buttons = document.getElementsByClassName("btn-custom");
    for (var i = 0; i < buttons.length; i++) {
        if (buttons[i] === clickedButton) {
            buttons[i].classList.add("active");
        } else {
            buttons[i].classList.remove("active");
        }
    }
}
</script>
<script>
var selectedButton = null;

function highlightOption(button) {
  if (selectedButton !== null) {
    selectedButton.classList.remove('selected');
  }
  
  if (selectedButton === button) {
    selectedButton = null;
  } else {
    button.classList.add('selected');
    selectedButton = button;
  }
}
</script>


<script>
document.getElementById('btn-submit').addEventListener('click', function(event) {
  var buttons = document.getElementsByClassName('btn-custom');
  var optionSelected = false;

  for (var i = 0; i < buttons.length; i++) {
    if (buttons[i].classList.contains('active')) {
      optionSelected = true;
      break;
    }
  }

  if (!optionSelected) {
    event.preventDefault();

    for (var i = 0; i < buttons.length; i++) {
      buttons[i].style.border = '2px solid red';
    }
  }
});

var buttons = document.getElementsByClassName('btn-custom');
for (var i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener('click', function() {
    this.classList.add('active');

    for (var j = 0; j < buttons.length; j++) {
      if (buttons[j] !== this) {
        buttons[j].classList.remove('active');
        buttons[j].style.border = ''; // Remove a borda personalizada
      }
    }
  });
}
</script>


<script>
  document.getElementById('btn-submit').addEventListener('click', function(event) {
  var buttons = document.getElementsByClassName('btn-custom');
  var optionSelected = false;

  for (var i = 0; i < buttons.length; i++) {
    if (buttons[i].classList.contains('active')) {
      optionSelected = true;
      document.getElementById('selectedTamanhoInput').value = buttons[i].value; // Definir o valor do campo tamanhos
      break;
    }
  }

  if (!optionSelected) {
    event.preventDefault();

    for (var i = 0; i < buttons.length; i++) {
      buttons[i].style.border = '2px solid red';
    }
  }
});

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

<script>
  function adicionarAoCarrinho(id_roupa, id_tamanhos) {
    $.ajax({
      url: "/PAP/users/adicionar_carrinho.php",
      method: "POST",
      data: {
        id_roupa: id_roupa,
        id_tamanhos: id_tamanhos
      },
      success: function(response) {
        Swal.fire(
          'Adicionado!',
          'A sua roupa foi adicionado com sucesso!',
          'success'
        );
      },
      error: function() {
        alert("Ocorreu um erro ao adicionar o produto ao carrinho.");
      }
    });
  }
</script>



</div> 


</body>
</html>