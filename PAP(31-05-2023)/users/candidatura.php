<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/PAP/css/user.css" />
    <title>Global Clothes</title>
</head>


<body>
<?php
include ('../users/navbar.php');
?>
<div style="padding-left:25%; paddin-top:10px">
<h3 style="padding-top:40px">Junta te a nossa equipa!</h3>
<p style="margin-bottom: -11px;">Desde a abertura desta loja a mesma não para de crescer e isto tudo</p>
<p style="margin-bottom: -11px;">graças a ti! Com isto, gostaríamos de te propor para tu te juntares</p>
<p style="">à nossa equipa. Achas que tens o necessário para ser parte de algo grande?</p><br>
<p>Para fazeres o pedido, so precisas de enviar o teu CV no botao abaixo. </p><br>

<form method="POST" enctype="multipart/form-data">
    <div class="col-md-4">
        <div class="form-group">
            <label for="inputImagem" class="form-label">CV:</label>
            <input type="file" class="form-control" name="id_imagem" accept=".pdf" required><br>
        </div>
    </div>

    <?php
    include('../conDB/con_db.php');
    
    $login_session = $_SESSION['login_session'];
    
    $query = $con->query("SELECT * FROM users WHERE id = '$login_session'");
    $result = $query->fetch_all();
    
    $id = $result[0][0];
    $username = $result[0][1];
    $cargo = $result[0][5];
    
    if (!isset($_SESSION['login_session'])) {
        header("location:login.php");
        die();
    }
    
    // Verificar se o usuário já inseriu uma resposta
    $query6 = "SELECT * FROM juntar_equipa WHERE id_user = '$id'";
    $result6 = $con->query($query6);
    if ($result6->num_rows > 0) {
        echo "<p>Não podes responder novamente.</p>";
    } else {
        if (isset($_FILES['id_imagem'])) {
            // Verificar se o arquivo é um PDF
            if ($_FILES['id_imagem']['type'] !== 'application/pdf') {
                echo "<p>Apenas arquivos PDF são permitidos.</p>";
            } else {
                // Salvar o PDF na pasta "/PAP/candidaturas"
                // Salvar o PDF na pasta "/PAP/candidaturas"
                $pdf = $username . '_cv.pdf'; // Concatena o nome do usuário com '_cv.pdf'
                $pdf_temp = $_FILES['id_imagem']['tmp_name'];
                $caminho_pdf = '/PAP/candidaturas/' . $pdf;

        
                if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/PAP/candidaturas')) {
                    mkdir($_SERVER['DOCUMENT_ROOT'] . '/PAP/candidaturas', 0777, true); // Cria o diretório "candidaturas" se ele não existir
                }
        
                if (is_writable($_SERVER['DOCUMENT_ROOT'] . '/PAP/candidaturas')) {
                    move_uploaded_file($pdf_temp, $_SERVER['DOCUMENT_ROOT'] . $caminho_pdf);
                } else {
                    echo "O diretório '/PAP/candidaturas' não tem permissão de gravação.";
                }
        
                // Inserir o caminho do PDF no banco de dados
                $query = "INSERT INTO imagens (id_imagens, imagens) VALUES ('', '$caminho_pdf')";
                $con->query($query);
        
                // Obter o ID do PDF recém-inserido
                $id_pdf = $con->insert_id;
        
                // Inserir os dados na tabela "juntar_equipa"
                $dataCand = date("Y-m-d"); // Obtém a data atual
                $query = "INSERT INTO juntar_equipa (id_Cand, id_user, id_imagem, DataCand) VALUES ('', '$id', '$id_pdf', '$dataCand')";
                $con->query($query);
        
                echo "<p>O teu CV foi inserido com sucesso! Agora, aguarda pela resposta.</p>";
            }
        }
        
        
        
    }
    ?>

    <div class="col-12" style="padding-bottom:3%;">
        <button type="submit" class="btn btn-primary">Inserir</button>
    </div>
</form>
</div>


<?php
include ('../users/footer.html');
?>
</body>
</html>