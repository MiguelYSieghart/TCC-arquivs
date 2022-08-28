<?php
require_once "includes/conecta.php";
require_once "includes/funcoes.php";

$tituloPagina = "Home";
$carrossel = mysqli_query($conexao, "SELECT * FROM obras ORDER BY RAND() LIMIT 5");
$ultimasObras = mysqli_query($conexao, "SELECT * FROM obras ORDER BY data_cadastro DESC, id_obra DESC LIMIT 20");
$ultimosCapitulos = mysqli_query($conexao, "SELECT c.*, o.titulo, o.demografia, o.capa_obra FROM capitulo c INNER JOIN obras o ON o.id_obra = c.obras_id_obra ORDER BY c.data_cadastro DESC LIMIT 10");

include "includes/header.php";
?>

<section class="mb-4">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div id="mangaCarousel" class="carousel slide mr-home-carousel" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                        <button type="button" data-bs-target="#mangaCarousel" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>"></button>
                    <?php } ?>
                </div>
                <div class="carousel-inner">
                    <?php $contador = 0; while ($obra = mysqli_fetch_assoc($carrossel)) { ?>
                        <div class="carousel-item <?php echo $contador == 0 ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('crud_mangas/visualizar.php?id_obra=' . $obra['id_obra']); ?>">
                                <img src="<?php echo caminho_capa($obra['capa_obra']); ?>" class="d-block w-100" alt="<?php echo e($obra['titulo']); ?>">
                                <div class="carousel-caption">
                                    <h5><?php echo e($obra['titulo']); ?></h5>
                                </div>
                            </a>
                        </div>
                    <?php $contador++; } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mangaCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mangaCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
        </div>

        <div class="col-lg-8">
            <h1 class="h3 mr-page-title">Novos Títulos</h1>
            <div class="table-responsive mr-scroll-table">
                <table class="table table-hover table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Capas</th>
                            <th>Tipos</th>
                            <th>Títulos</th>
                            <th class="text-end">Adicionado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($obra = mysqli_fetch_assoc($ultimasObras)) { ?>
                            <tr>
                                <td><img class="mr-thumb" src="<?php echo caminho_capa($obra['capa_obra']); ?>" alt="<?php echo e($obra['titulo']); ?>"></td>
                                <td><span class="badge bg-success"><?php echo e($obra['demografia']); ?></span></td>
                                <td>
                                    <a class="fw-bold" href="<?php echo base_url('crud_mangas/visualizar.php?id_obra=' . $obra['id_obra']); ?>">
                                        <i class="bi bi-bookmark-fill"></i> <?php echo e($obra['titulo']); ?>
                                    </a>
                                    <br>
                                    <a class="badge bg-primary text-decoration-none" href="<?php echo base_url('crud_mangas/editar.php?id_obra=' . $obra['id_obra']); ?>">
                                        <i class="bi bi-pencil-fill"></i> Editar título
                                    </a>
                                </td>
                                <td class="text-end"><?php echo e($obra['data_cadastro']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section>
    <h2 class="h3 mr-page-title">Novos Capítulos</h2>

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead>
                <tr>
                    <th>Capas</th>
                    <th>Tipos</th>
                    <th>Capítulo</th>
                    <th>Título do Capítulo</th>
                    <th>Mangá</th>
                    <th>Enviado por</th>
                    <th class="text-end">Adicionado em</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($capitulo = mysqli_fetch_assoc($ultimosCapitulos)) { ?>
                    <tr>
                        <td><img class="mr-thumb" src="<?php echo caminho_capa($capitulo['capa_obra']); ?>" alt="<?php echo e($capitulo['titulo']); ?>"></td>
                        <td><span class="badge bg-success"><?php echo e($capitulo['demografia']); ?></span></td>
                        <td><a href="<?php echo base_url('crud_mangas/ler.php?id_cap=' . $capitulo['id_cap']); ?>">Vol. 1 Cap. <?php echo e($capitulo['numero_cap']); ?></a></td>
                        <td>
                            <?php echo e($capitulo['titulo_cap']); ?>
                            <a class="badge bg-primary text-decoration-none" href="<?php echo base_url('crud_capitulos/editar.php?id_cap=' . $capitulo['id_cap']); ?>">
                                <i class="bi bi-pencil-fill"></i> Editar capítulo
                            </a>
                        </td>
                        <td><a href="<?php echo base_url('crud_mangas/visualizar.php?id_obra=' . $capitulo['obras_id_obra']); ?>"><?php echo e($capitulo['titulo']); ?></a></td>
                        <td><?php echo isset($_SESSION['nome']) ? e($_SESSION['nome']) : 'Izayoi'; ?></td>
                        <td class="text-end"><?php echo e($capitulo['data_cadastro']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php include "includes/footer.php"; ?>
