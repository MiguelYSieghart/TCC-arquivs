<?php
if (!isset($tituloPagina)) {
    $tituloPagina = 'Manga Reader';
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$temaAtual = isset($_COOKIE['mangareader_tema']) ? $_COOKIE['mangareader_tema'] : 'escuro';
if ($temaAtual != 'claro') {
    $temaAtual = 'escuro';
}
$temaDestino = $temaAtual == 'claro' ? 'escuro' : 'claro';
$iconeTema = $temaAtual == 'claro' ? 'bi-moon-fill' : 'bi-sun-fill';
$voltarTema = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : base_url('home.php');
$paginaAtual = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '';
$homeAtivo = (strpos($paginaAtual, '/home.php') !== false || strpos($paginaAtual, '/index.php') !== false) ? ' active' : '';
$titulosAtivo = (strpos($paginaAtual, '/crud_mangas/') !== false && strpos($paginaAtual, '/favoritos.php') === false) ? ' active' : '';
$favoritosAtivo = strpos($paginaAtual, '/crud_mangas/favoritos.php') !== false ? ' active' : '';
$maisAtivo = (strpos($paginaAtual, '/crud_capitulos/') !== false || strpos($paginaAtual, '/crud_artistas/') !== false || strpos($paginaAtual, '/crud_usuarios/') !== false || strpos($paginaAtual, '/auth/') !== false) ? ' active' : '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($tituloPagina); ?> - Manga Reader</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png'); ?>">
    <link href="<?php echo base_url('assets/CSS/styles.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/CSS/mangareader-dark.css'); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="mr-theme-<?php echo e($temaAtual); ?>">
    <header class="mr-navbar mb-4">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a class="navbar-brand d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none" href="<?php echo base_url('home.php'); ?>">
                    <img class="mr-logo me-2" src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Manga Reader Logo">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="<?php echo base_url('home.php'); ?>" class="nav-link px-2 mr-nav-link<?php echo $homeAtivo; ?>"><i class="bi bi-list"></i> Lançamentos</a></li>
                    <li><a href="<?php echo base_url('crud_mangas/listar.php'); ?>" class="nav-link px-2 mr-nav-link<?php echo $titulosAtivo; ?>"><i class="bi bi-book-fill"></i> Títulos</a></li>
                    <li><a href="<?php echo base_url('crud_mangas/favoritos.php'); ?>" class="nav-link px-2 mr-nav-link<?php echo $favoritosAtivo; ?>"><i class="bi bi-bookmark-fill"></i> Favoritos</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link px-2 mr-nav-link dropdown-toggle<?php echo $maisAtivo; ?>" id="dropdownMais" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-info-circle-fill"></i> Mais</a>
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

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-flex" action="<?php echo base_url('crud_mangas/listar.php'); ?>" method="get">
                    <input type="search" name="busca" class="form-control mr-search" placeholder="Pesquisa rápida" aria-label="Buscar">
                    <button class="btn mr-search-btn" type="submit"><i class="bi bi-search"></i></button>
                </form>

                <a class="btn mr-icon-btn me-2" href="<?php echo base_url('tema.php?tema=' . $temaDestino . '&voltar=' . urlencode($voltarTema)); ?>" title="Alternar tema">
                    <i class="bi <?php echo $iconeTema; ?>"></i>
                </a>

                <div class="dropdown text-end">
                    <a href="#" class="d-block mr-nav-link text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill"></i>
                        <?php echo isset($_SESSION['nome']) ? e($_SESSION['nome']) : 'Visitante'; ?>
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
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
    </header>

    <main class="container-fluid mr-main">
