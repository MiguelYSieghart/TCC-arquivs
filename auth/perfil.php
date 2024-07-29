<?php
require_once "../includes/funcoes.php";

if (!App\Support\Auth::check()) {
    header("Location: login.php");
    exit;
}

$tituloPagina = "Meu perfil";
$userRepository = new App\Repositories\UserRepository();
$favoriteRepository = new App\Repositories\FavoriteRepository();
$historyRepository = new App\Repositories\ReadingHistoryRepository();

$usuario = $userRepository->find(App\Support\Auth::id());
$historico = $historyRepository->recent(8);
$totalFavoritos = $favoriteRepository->countForCurrentUser();
$totalLeituras = $historyRepository->countForCurrentUser();
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Meu perfil')
);

include "../includes/header.php";
?>

<section class="row g-4 align-items-stretch">
    <div class="col-lg-4">
        <div class="mr-profile-panel h-100">
            <div class="mr-avatar mb-3">
                <i class="bi bi-person-fill"></i>
            </div>
            <h1 class="h3 mb-1"><?php echo e($usuario['nome']); ?></h1>
            <p class="text-secondary mb-4"><?php echo e($usuario['email']); ?></p>

            <div class="d-grid gap-3">
                <div class="mr-stat-card">
                    <span>Favoritos</span>
                    <strong><?php echo $totalFavoritos; ?></strong>
                </div>
                <div class="mr-stat-card">
                    <span>Leituras</span>
                    <strong><?php echo $totalLeituras; ?></strong>
                </div>
                <div class="mr-stat-card">
                    <span>Perfil</span>
                    <strong><?php echo e(permissao_usuario_label($usuario['permissao'])); ?></strong>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="h4 mb-1">Histórico de leitura</h2>
                <p class="text-secondary mb-0">Capítulos abertos recentemente por você.</p>
            </div>
            <a class="btn btn-outline-primary" href="../crud_mangas/favoritos.php"><i class="bi bi-heart-fill"></i> Coleção</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 mr-table">
                <thead>
                    <tr>
                        <th>Obra</th>
                        <th>Capítulo</th>
                        <th class="text-end">Lido em</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historico as $item) { ?>
                        <tr>
                            <td>
                                <a class="fw-bold" href="../crud_mangas/visualizar.php?id_obra=<?php echo $item['obras_id_obra']; ?>">
                                    <?php echo e($item['titulo']); ?>
                                </a>
                            </td>
                            <td>
                                <a href="../crud_mangas/ler.php?id_cap=<?php echo $item['capitulo_id_cap']; ?>">
                                    Cap. <?php echo e($item['numero_cap']); ?> <?php echo e($item['titulo_cap']); ?>
                                </a>
                            </td>
                            <td class="text-end"><?php echo e($item['data_leitura']); ?></td>
                        </tr>
                    <?php } ?>

                    <?php if (count($historico) == 0) { ?>
                        <tr>
                            <td colspan="3" class="text-center text-secondary py-4">Nenhuma leitura registrada ainda.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include "../includes/footer.php"; ?>
