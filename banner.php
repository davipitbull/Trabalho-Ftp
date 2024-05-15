<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();

// Fetch banners from the database
$banners = listarTabela("id, nome, imagem", 'banner', 'id');
?>

<div class="container">
    <h2>Banners</h2>
    <div class="row">
        <?php if (is_array($banners) || is_object($banners)) {
            if (!empty($banners)) {
                foreach ($banners as $banner) { ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="./img/<?php echo $banner->imagem; ?>" class="card-img-top" alt="<?php echo $banner->nome; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $banner->nome; ?></h5>
                                <!-- No lugar onde deseja exibir o botão de editar banner -->
                                <input type="hidden" name="id" value="<?php echo $banner->id; ?>">
                                <button class="btn btn-warning btn-edit"
                                    onclick="editarBanner(<?php echo $banner->id; ?>, '<?php echo $banner->nome; ?>')"
                                    data-bs-toggle="modal" data-bs-target="#modalEdicao">Editar</button>
                                <form action="./api/excluirBanner.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $banner->id; ?>">
                                    <button class="btn btn-danger" type="submit" name="excluir">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="col-md-12">
                    <p>Nenhum banner encontrado.</p>
                </div>
            <?php }
        } else { ?>
            <div class="col-md-12">
                <p>Nenhum banner encontrado.</p>
            </div>
        <?php } ?>
    </div>
    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastro">Cadastrar Novo Banner</a>
</div>

<!-- Modal de Cadastro -->
<div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="api/cadastrarBanner.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem:</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="modalEdicao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="api/editarBanner.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="edit_nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_imagem" class="form-label">Nova Imagem:</label>
                        <input type="file" class="form-control" id="edit_imagem" name="imagem">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function editarBanner(id, nome) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nome').value = nome;
    }
</script>