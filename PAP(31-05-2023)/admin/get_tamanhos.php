<label for="inputTamanho" class="form-label">Tamanho:</label><br>
<?php
include('../conDB/con_db.php');

$tipoRoupaId = $_POST['tipoRoupaId'];

if ($tipoRoupaId == 1) {
    $minId = 1;
    $maxId = 11;
} else {
    $minId = 12;
    $maxId = 17;
}

$query = "SELECT * FROM tamanhos WHERE id_tamanhos BETWEEN $minId AND $maxId;";

$result = mysqli_query($con, $query);

while ($rowtamanho = mysqli_fetch_assoc($result)) {
    $id_tamanho = $rowtamanho['id_tamanhos'];
    $tamanho = $rowtamanho['tamanhos'];
    echo '<div class="form-check form-check-inline">';
    echo '<input class="form-check-input" type="checkbox" name="tamanhos[]" value="' . $id_tamanho . '" onchange="toggleStockInput(this)">';
    echo "<label class='form-check-label' for='tamanho-$id_tamanho'>$tamanho</label>";
    echo '</div>';
    echo "<div class='col-md-2' id='stockInput-$id_tamanho' style='display: none;'>";
    echo "<label for='inputstock' class='form-label'>Stock para $tamanho:</label>";
    echo "<input  type='number' placeholder='0'    class='form-control' name='stock[]' >";
    echo '</div>';
}
?>

<script>
function toggleStockInput(checkbox) {
    var stockInputDiv = document.getElementById("stockInput-" + checkbox.value);
    var stockInput = stockInputDiv.querySelector("input[name='stock[]']");

    if (checkbox.checked) {
        stockInputDiv.style.display = "block";
    } else {
        stockInputDiv.style.display = "none";
        stockInput.value = 0; // Define o valor do estoque como 0
    }
}
</script>