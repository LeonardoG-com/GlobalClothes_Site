<?php
if (session_status() === PHP_SESSION_NONE) {
    include('../admin/session.php');
}
?>

<section id="header">
    <a href="user_page.php">
        <img src="/PAP/fotos/t.png" class="logo" alt="" style="max-width: 150px;">
    </a>

    <div>
        <ul id="navbar">
            <li><a href="user_page.php">Inicio</a></li>
            <li class="dropdown">
                <a href="homem.php" class="dropbtn">Homem</a>
                <div class="dropdown-content">
                    <a href="homem_sapatilha.php">Sapatilhas</a>
                    <a href="homem_tshirt.php">Tshirts</a>
                    <a href="homem_sweatshirt.php">SweatShirts</a>
                    <a href="homem_calcas.php">Calças</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="mulher.php" class="dropbtn">Mulher</a>
                <div class="dropdown-content">
                    <a href="mulher_sapatilha.php">Sapatilhas</a>
                    <a href="mulher_tshirt.php">Tshirts</a>
                    <a href="mulher_sweatshirt.php">SweatShirts</a>
                    <a href="mulher_calcas.php">Calças</a>
                </div>
            </li>
            <!-- <li><a href="sobre.html">Sobre nós</a></li> -->
            <!-- <li><a href="contacto.html">Contacte-nos</a></li> -->
            <li>
  <a href="carro.php">
    <i class="fa-solid fa-bag-shopping" style="width: min-content;"></i>
    <?php
    // Consulta SQL para obter o número de roupas no carrinho do usuário
    $query_count = "SELECT COUNT(*) AS count FROM carrinho WHERE id_user = $id";
    $result_count = mysqli_query($con, $query_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $count = $row_count['count'];

    // Exibe o número de roupas apenas se for maior que zero
    if ($count > 0) {
      echo '<span>' . $count . '</span>';
    }
    ?>
  </a>
</li>
            <li><a href="/PAP/admin/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
        </ul>
    </div>
</section>
