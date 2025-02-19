<?php
include('../admin/session.php');
include ('../conDB/con_db.php');
// Consulte a tabela de usuários para obter o nome de usuário do usuário atual

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/PAP/css/user.css" />
     <link rel="stylesheet" href="/PAP/css/slideshow.css" /> 


    <title>Global Clothes</title>

   
</head>

<body>

 <?php
include ('../users/navbar.php');
?>
    
   <section id="backgorund">
    <!-- <h4>trade-in-offer</h4> -->
    <?php
    if(isset($username)){
      ?>
       <h1 class="username">Olá, <?php echo $username; ?></h1><br>
    <?php
      } 
    ?>
   
    <h2>Bem-Vindo a loja</h2>
    <h1>Global Clothes</h1>
    <!-- <p>sasasasas asas saa </p> -->
    <button onclick="window.location.href='loja.html'">Compre Agora</button>
   </section>

   
<div>
   <section id="product1" class="section-p1">

    
        <h2>Novas Coleções!</h2>
        <p>Veja aqui as nossas novas coleções.</p>
    

        <div class="pro-container">
<?php
$query = "SELECT r.id_roupa, r.nome, r.preco, m.marcas, i.imagens
          FROM roupa AS r
          JOIN marca AS m ON r.id_marca = m.id_marcas
          JOIN imagens AS i ON r.id_imagens = i.id_imagens
          ORDER BY r.DataLanc DESC
          LIMIT 8";

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





            <!-- <div class="pro">
                <img src="/PAP/fotos/f2.jpg" alt="">
                <div class="des">
                    <span>Nike</span>
                    <h5>Nike tshitr ale</h5>
                    <h4>100€</h4>
                </div>
            </div>

            <div class="pro">
                <img src="/PAP/fotos/nikeT4.webp" alt="">
                <div class="des">
                    <span>Calções</span>
                    <h5>Jordan Essentials</h5>
                    <h4>100€</h4>
                </div>
            </div>

            <div class="pro">
                <img src="/PAP/fotos/nikeT2.webp" alt="">
                <div class="des">
                    <span>SweatShirt</span>
                    <h5>Jordan Brooklyn Fleece</h5>
                    <div>
                    <h4 class="discounted-price">38.97€</h4>
                     <h4 class="original-price">64.99€</h4>
  
</div>

                </div>
            </div>

            <div class="pro">
                <img src="/PAP/fotos/nikeT3.webp" alt="">
                <div class="des">
                    <span>Calções</span>
                    <h5>Nike Air Max Plus</h5>
                    <h4 class="discounted-price">139.97€</h4>
                     <h4 class="original-price">199.99€</h4>
                </div>
            </div>
             -->
            </div>      

        
            <div class="slideshow-container">
            <h3 style="padding-top:50px; text-align:center;">Veja aqui algumas das nossas marcas disponíveis!</h3>
            <div class="slides">
           

  <div class="mySlides" style="padding:40px">
    <!-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a> -->
    <!-- <a href="/marcas/R.html"><img src="/PAP/AlgMarcas/R.webp" style= "height:50px;"></a> -->
    <a href="/marcas/jordan.html"><img src="/PAP/AlgMarcas/jordan.png" style= "height:50px;"></a>
    <a href="/marcas/element.html"><img src="/PAP/AlgMarcas/element.png" style= "height:50px;"></a>
    <a href="/marcas/santa.html"><img src="/PAP/AlgMarcas/santa.png" style= "height:50px;"></a>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <a href="/marcas/jordan.html"><img src="/PAP/AlgMarcas/adidas.png" style= "height:50px;"></a>
    <a href="/marcas/element.html"><img src="/PAP/AlgMarcas/puma.png" style= "height:50px;"></a>
    <!-- <a href="/marcas/santa.html"><img src="/PAP/AlgMarcas/santa.png" style= "height:50px;"></a> -->
    <!-- <a class="next" onclick="plusSlides(1)">&#10095;</a> -->
  </div>
</div>

<div id="myCarousel" class="carousel slide" style="padding-bottom:5%" data-ride="carousel" data-interval="3000">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner carousel-fade">
    <div class="item active">
      <img src="/PAP/fotos/aa.jpg" alt="Los Angeles">
    </div>
    <div class="item">
      <img src="/PAP/fotos/bb.jpg" alt="Chicago">
    </div>
    <div class="item">
      <img src="/PAP/fotos/cc.jpg" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

      
        
    <!-- </div style="  display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-gap: 20px;">
    <div class="mySlides">
    <h3>Veja aqui todas as nossas marcas disponiveis!</h3><br>

    <div>
      <a class="prev" onclick="plusSlides(-1)" style="margin-top:auto; margin-bottom:auto">&#10094;</a>
    </div>

    <div>
<img src="/PAP/fotos/adidas.png" style= "height:50px;">
      <img src="/PAP/fotos/nike.png" style= "height:50px;">
      <img src="/PAP/fotos/puma.png" style= "height:50px;">
      <img src="/PAP/fotos/R.png" style= "height:50px;">
  
    </div>
    
  
     
   <div>
     <a class="next" onclick="plusSlides(1)">&#10095;</a>
   </div> -->





<!-- END OF FOOTER -->

<!-- <script>
let slideIndex = 1;
showSlides(slideIndex);

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";
}

function plusSlides(n) {
  showSlides(slideIndex += n);
}

</script> -->
</div>
</div>
<?php
include ('../users/footer.html');
?>
</body>

</html>