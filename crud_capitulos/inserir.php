<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$obras_id_obra = (int) $_POST['obras_id_obra'];
$numero_cap = (int) $_POST['numero_cap'];
$titulo_cap = mysqli_real_escape_string($conexao, $_POST['titulo_cap']);
$slug = mysqli_real_escape_string($conexao, gerar_slug("obra-$obras_id_obra-capitulo-$numero_cap"));

$sql = "INSERT INTO capitulo (titulo_cap, slug, numero_cap, obras_id_obra, tipo) VALUES ('$titulo_cap', '$slug', $numero_cap, $obras_id_obra, 'strip')";
$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    echo "Erro ao cadastrar capítulo: " . mysqli_error($conexao);
    exit;
}

$id_cap = mysqli_insert_id($conexao);
$dirUpload = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'caps' . DIRECTORY_SEPARATOR;
if (!is_dir($dirUpload)) {
    mkdir($dirUpload, 0777, true);
}

if (isset($_FILES['imagens_cap'])) {
    for ($i = 0; $i < count($_FILES['imagens_cap']['name']); $i++) {
        if (is_uploaded_file($_FILES['imagens_cap']['tmp_name'][$i])) {
            $ext = strtolower(strrchr($_FILES['imagens_cap']['name'][$i], '.'));
            if (!in_array($ext, array('.jpg', '.jpeg', '.png', '.gif', '.webp'))) {
                continue;
            }

            $nome = md5(time() . $_FILES['imagens_cap']['name'][$i] . $i) . $ext;

            if (move_uploaded_file($_FILES['imagens_cap']['tmp_name'][$i], $dirUpload . $nome)) {
                $caminho = mysqli_real_escape_string($conexao, "assets/images/caps/" . $nome);
                $ordem = $i + 1;
                mysqli_query($conexao, "INSERT INTO imagem_cap (caminho, capitulo_id_cap, ordem) VALUES ('$caminho', $id_cap, $ordem)");
            }
        }
    }
}

header("Location: ../crud_mangas/visualizar.php?id_obra=$obras_id_obra");
exit;
