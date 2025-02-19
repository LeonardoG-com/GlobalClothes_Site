<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
include('../conDB/con_db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCand = $_POST['id_Cand'];
    
    // Atualizar os campos no banco de dados
    $query = "UPDATE juntar_equipa SET DataCand = NOW(), cargos = 'estagiario', estado = 'Fechado' WHERE id_user = '$idCand'";
    if (mysqli_query($con, $query)) {
        header("Location: CandEquipas.php");
    } else {
        echo "Erro ao atualizar o registro: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

</body>
</html>