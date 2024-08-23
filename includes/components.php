<?php

function mr_breadcrumb($itens)
{
    if (!is_array($itens) || count($itens) == 0) {
        return;
    }
    ?>
    <nav class="mr-breadcrumb-wrap" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <?php foreach ($itens as $index => $item) { ?>
                <?php $ativo = $index == count($itens) - 1; ?>
                <li class="breadcrumb-item <?php echo $ativo ? 'active' : ''; ?>" <?php echo $ativo ? 'aria-current="page"' : ''; ?>>
                    <?php if (!$ativo && !empty($item['url'])) { ?>
                        <a href="<?php echo e($item['url']); ?>"><?php echo e($item['label']); ?></a>
                    <?php } else { ?>
                        <?php echo e($item['label']); ?>
                    <?php } ?>
                </li>
            <?php } ?>
        </ol>
    </nav>
<?php }

function mr_page_header($kicker, $titulo, $descricao = '', $acao = null)
{
    ?>
    <section class="mr-page-heading card mb-4">
        <div class="card-body">
            <div>
                <span class="mr-kicker"><?php echo $kicker; ?></span>
                <h1><?php echo e($titulo); ?></h1>
                <?php if ($descricao != '') { ?>
                    <p><?php echo e($descricao); ?></p>
                <?php } ?>
            </div>
            <?php if (is_array($acao)) { ?>
                <a class="btn btn-primary" href="<?php echo e($acao['url']); ?>">
                    <?php echo isset($acao['icon']) ? $acao['icon'] . ' ' : ''; ?><?php echo e($acao['label']); ?>
                </a>
            <?php } ?>
        </div>
    </section>
<?php }

function mr_delete_button($modalId)
{
    ?>
    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#<?php echo e($modalId); ?>" title="Excluir">
        <i class="bi bi-trash-fill"></i>
    </button>
<?php }

function mr_delete_modal($modalId, $titulo, $mensagem, $urlConfirmacao)
{
    ?>
    <div class="modal fade" id="<?php echo e($modalId); ?>" tabindex="-1" aria-labelledby="<?php echo e($modalId); ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="<?php echo e($modalId); ?>Label"><?php echo e($titulo); ?></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <?php echo e($mensagem); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger" href="<?php echo e($urlConfirmacao); ?>">Excluir</a>
                </div>
            </div>
        </div>
    </div>
<?php }
