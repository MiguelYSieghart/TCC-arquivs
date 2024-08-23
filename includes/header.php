<?php
if (!isset($tituloPagina)) {
    $tituloPagina = 'Manga Reader';
}

$temaAtual = App\Support\Theme::current();
$temaBootstrap = App\Support\Theme::bootstrapMode();
$temaDestino = App\Support\Theme::next();
$iconeTema = App\Support\Theme::icon();
$voltarTema = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : base_url('home.php');
$paginaAtual = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '';
$homeAtivo = (strpos($paginaAtual, '/home.php') !== false || strpos($paginaAtual, '/index.php') !== false) ? ' active' : '';
$titulosAtivo = (strpos($paginaAtual, '/crud_mangas/') !== false && strpos($paginaAtual, '/favoritos.php') === false) ? ' active' : '';
$favoritosAtivo = strpos($paginaAtual, '/crud_mangas/favoritos.php') !== false ? ' active' : '';
$maisAtivo = (strpos($paginaAtual, '/crud_capitulos/') !== false || strpos($paginaAtual, '/crud_artistas/') !== false || strpos($paginaAtual, '/crud_usuarios/') !== false || strpos($paginaAtual, '/auth/') !== false) ? ' active' : '';
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($tituloPagina); ?> - Manga Reader</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png'); ?>">
    <link href="<?php echo base_url('assets/vendor/bootstrap/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/bootstrap-icons/bootstrap-icons.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/CSS/mangareader-dark.css'); ?>" rel="stylesheet">
</head>

<body class="mr-theme-<?php echo e($temaAtual); ?>" data-bs-theme="<?php echo e($temaBootstrap); ?>">
    <header class="navbar navbar-expand-xl sticky-top mr-navbar">
        <div class="container-fluid px-3 px-xl-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo base_url('home.php'); ?>">
                <img class="mr-logo" src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Manga Reader Logo">
                <span>Manga Reader</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                <div class="row g-2 align-items-xl-center w-100 mr-navbar-grid">
                    <div class="col-xl">
                        <ul class="navbar-nav mb-2 mb-xl-0">
                            <li class="nav-item"><a href="<?php echo base_url('home.php'); ?>" class="nav-link mr-nav-link<?php echo $homeAtivo; ?>"><i class="bi bi-list-ul"></i> Lançamentos</a></li>
                            <li class="nav-item"><a href="<?php echo base_url('crud_mangas/listar.php'); ?>" class="nav-link mr-nav-link<?php echo $titulosAtivo; ?>"><i class="bi bi-book-half"></i> Títulos</a></li>
                            <li class="nav-item"><a href="<?php echo base_url('crud_mangas/favoritos.php'); ?>" class="nav-link mr-nav-link<?php echo $favoritosAtivo; ?>"><i class="bi bi-bookmark-heart"></i> Favoritos</a></li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link mr-nav-link dropdown-toggle<?php echo $maisAtivo; ?>" id="dropdownMais" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-grid-3x3-gap"></i> Mais</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMais">
                                    <li><a class="dropdown-item" href="<?php echo base_url('crud_capitulos/listar.php'); ?>">Capítulos</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('crud_artistas/listar.php'); ?>">Artistas</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('crud_usuarios/listar.php'); ?>">Usuários</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <?php if (isset($_SESSION['id_usuario'])) { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('auth/logout.php'); ?>">Sair</a></li>
                                    <?php } else { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('auth/login.php'); ?>">Login</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xl-auto">
                        <form class="d-flex mr-search-form" action="<?php echo base_url('crud_mangas/listar.php'); ?>" method="get">
                            <input type="search" name="busca" class="form-control mr-search" placeholder="Pesquisa rápida" aria-label="Buscar">
                            <button class="btn mr-search-btn" type="submit" title="Buscar"><i class="bi bi-search"></i></button>
                        </form>
                    </div>

                    <div class="col-xl-auto">
                        <div class="d-flex flex-column flex-sm-row gap-2 mr-header-actions">
                            <a class="btn mr-icon-btn" href="<?php echo base_url('tema.php?tema=' . $temaDestino . '&voltar=' . urlencode($voltarTema)); ?>" title="Alternar tema">
                                <i class="bi <?php echo $iconeTema; ?>"></i>
                            </a>

                            <div class="dropdown">
                                <a href="#" class="btn mr-user-btn dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i>
                                    <span><?php echo e(App\Support\Auth::name()); ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-xl-end text-small" aria-labelledby="dropdownUser1">
                                    <?php if (isset($_SESSION['id_usuario'])) { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('auth/perfil.php'); ?>">Meu perfil</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                    <?php } ?>
                                    <li><a class="dropdown-item" href="<?php echo base_url('crud_mangas/cadastrar.php'); ?>">Cadastrar mangá</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('crud_capitulos/cadastrar.php'); ?>">Cadastrar capítulo</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('crud_artistas/cadastrar.php'); ?>">Cadastrar artista</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('crud_usuarios/listar.php'); ?>">Usuários</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <?php if (isset($_SESSION['id_usuario'])) { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('auth/logout.php'); ?>">Sair</a></li>
                                    <?php } else { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('auth/login.php'); ?>">Login</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container-fluid mr-main py-4">
        <?php if (isset($breadcrumbs)) { mr_breadcrumb($breadcrumbs); } ?>
