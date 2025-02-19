    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
        <title>Inserir nova tshirt</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <?php
    include('../conDB/con_db.php');

    if (isset($_POST['nome']) && isset($_POST['id_tipoRoupa']) && isset($_POST['id_cor']) && isset($_POST['id_genero']) && isset($_POST['id_marca']) && isset($_POST['preco']) && isset($_FILES['id_imagem']) && isset($_POST['descricao'])) {

        $nome = mysqli_real_escape_string($con, $_POST['nome']);
        $tipoRoupa = mysqli_real_escape_string($con, $_POST['id_tipoRoupa']);
        $cor = mysqli_real_escape_string($con, $_POST['id_cor']);
        $genero = mysqli_real_escape_string($con, $_POST['id_genero']);
        $marca = mysqli_real_escape_string($con, $_POST['id_marca']);
        $preco = mysqli_real_escape_string($con, $_POST['preco']);
        $descricao = mysqli_real_escape_string($con, $_POST['descricao']);



        // Salvar a imagem na pasta "/PAP/db_fotos"
        $imagem = $_FILES['id_imagem']['name'];
        $imagem_temp = $_FILES['id_imagem']['tmp_name'];
        $caminho_imagem = '/PAP/db_fotos/' . $imagem;

        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/PAP/db_fotos')) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . '/PAP/db_fotos', 0777, true); // Cria o diretório "db_fotos" se ele não existir
        }

        if (is_writable($_SERVER['DOCUMENT_ROOT'] . '/PAP/db_fotos')) {
            move_uploaded_file($imagem_temp, $_SERVER['DOCUMENT_ROOT'] . $caminho_imagem);
        } else {
            echo "O diretório '/PAP/db_fotos' não tem permissão de gravação.";
        }

        // Inserir o caminho da imagem no banco de dados
        $query3 = "INSERT INTO imagens (id_imagens, imagens) VALUES ('', '$caminho_imagem')";
        $con->query($query3);


        $query4 = $con->query("SELECT id_imagens FROM imagens ORDER BY id_imagens DESC LIMIT 1");
        $result = $query4->fetch_all();
        $imagem = $result[0][0];


        $query = "INSERT INTO roupa (nome, preco, id_cor, id_marca, id_genero, id_tipoRoupa, id_imagens, descricao)
                VALUES ('$nome', '$preco', '$cor', '$marca', '$genero', '$tipoRoupa', '$imagem', '$descricao')";

    $verifica = mysqli_query($con, $query);
    $id_roupa = mysqli_insert_id($con);

    if ($verifica) {
        if (isset($_POST['tamanhos']) && isset($_POST['stock'])) {
            $tamanhos = $_POST['tamanhos'];
            $stocks = $_POST['stock'];
            // print_r ($tamanhos);
            // print_r ($stocks);
        
            if (count($tamanhos) === count($stocks)) {
                for ($i = 0; $i < count($tamanhos); $i++) {
                    $id_tamanho = $tamanhos[$i];
                    $stock_tamanho = $stocks[$i];
                    $query2 = "INSERT INTO `tamanhos_roupa`(`id_roupa`, `id_tamanhos`, `stock`) VALUES ('$id_roupa', '$id_tamanho', '$stock_tamanho')";
                    // echo $query2;

                    mysqli_query($con, $query2);
                }
            }
        }
        
    }

  header("Location: roupas.php");
    }
    ?>
        <div style="padding-right:200px;padding-left:200px; ">
            <h1 style="text-align: center; padding: 40px; font-size:40px">Inserir nova Roupa</h1>
            <form class="row g-3" method="post" enctype="multipart/form-data" action="<?= $_SERVER["PHP_SELF"]  ?>">
                <div style="display: none;">

                </div>
                <div class="col-md-4">
                    <label for="inputNome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" name="nome" required>
                </div>

                <div class="col-md-3">
                    <label for="inputTamanho" class="form-label">Tipo Roupa:</label><br>
                    <select class="form-select" name="id_tipoRoupa" id="tipoRoupaSelect" required>
                        <option value="">Selecione o Género</option>
                        <?php
                $query = "SELECT * FROM tiporoupa;";
                $result = mysqli_query($con, $query);
                while ($rowtiporoupa = mysqli_fetch_assoc($result)) {
                    $id_tiporoupa = $rowtiporoupa['id_tipoRoupas'];
                    $tiporoupa = $rowtiporoupa['TipoRoupa'];
                    echo "<option value=\"$id_tiporoupa\">$tiporoupa</option>";
                }
            ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="inputTamanho" class="form-label">Cor:</label><br>
                    <select class="form-select" name="id_cor" id="tipoRoupaSelect" required>
                        <option value="">Selecione a Cor</option>
                        <?php
                $query = "SELECT * FROM cor;";
                $result = mysqli_query($con, $query);
                while ($rowcor = mysqli_fetch_assoc($result)) {
                    $id_cor = $rowcor['id_cor'];
                    $cor = $rowcor['cores'];
                    echo "<option value=\"$id_cor\">$cor</option>";
                }
            ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="inputMarca" class="form-label">Género:</label>
                    <select class="form-select" name="id_genero" required>
                        <option value="">Selecione o Género</option>
                        <?php
                        $query = "SELECT id_genero, genero FROM genero ORDER BY genero ASC";
                        $result = mysqli_query($con, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $id_genero = $row['id_genero'];
                            $genero = $row['genero'];
                            echo "<option value='$id_genero'>$genero</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-5" id="tamanhosDiv" style="display: none;">
                    <?php
                    $query = "SELECT * FROM tamanhos;";
                    $result = mysqli_query($con, $query); 
                    ?>
                </div>

                <div class="row">
                    <div class="col-md-3" id="tamanhosDiv">
                        <label for="inputMarca" class="form-label">Marcas:</label>
                        <select class="form-select" name="id_marca" required>
                            <option value="">Selecione a Marca</option>
                            <?php
                            $query = "SELECT * FROM marca";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id_marcas = $row['id_marcas'];
                                $marcas = $row['marcas'];
                                echo "<option value='$id_marcas'>$marcas</option>";
                            }
                          ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inputPreco" class="form-label">Preço:</label>
                        <input type="text" class="form-control" name="preco" required>
                    </div>

                    <div class="form-floating" style="padding-top: 50px;">
                        <textarea class="form-control" name="descricao" placeholder="Leave a comment here"
                            id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputImagem" class="form-label">Imagem:</label>
                            <input type="file" class="form-control" name="id_imagem"
                                accept="image/png, image/jpeg, image/jpg, image/gif" required>
                        </div>
                    </div>
                </div>

                <div class="col-12" style="padding-left:15px;">
                    <button type="submit" class="btn btn-primary">Inserir</button>
                    <a href="roupas.php" class="btn btn-primary">Voltar</a>
                </div>

            </form>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
            $(document).ready(function() {
                $('#tipoRoupaSelect').change(function() {
                    var tipoRoupaId = $(this).val();
                    if (tipoRoupaId == 1) {
                        $.ajax({
                            url: 'get_tamanhos.php',
                            data: {
                                tipoRoupaId: tipoRoupaId,
                                minId: 1,
                                maxId: 11
                            },
                            type: 'POST',
                            success: function(response) {
                                $('#tamanhosDiv').html(response);
                                $('#tamanhosDiv').show();
                            }
                        });
                    } else if (tipoRoupaId == 2 || tipoRoupaId == 3 || tipoRoupaId == 4) {
                        $.ajax({
                            url: 'get_tamanhos.php',
                            data: {
                                tipoRoupaId: tipoRoupaId,
                                minId: 12,
                                maxId: 17
                            },
                            type: 'POST',
                            success: function(response) {
                                $('#tamanhosDiv').html(response);
                                $('#tamanhosDiv').show();
                            }
                        });
                    } else {
                        $('#tamanhosDiv').hide();
                    }
                });

                // Verifica se nenhum tipo de roupa foi selecionado inicialmente
                if ($('#tipoRoupaSelect').val() == '') {
                    $('#tamanhosDiv').hide();
                }
            });
            </script>

    </body>

    </html>