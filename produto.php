<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();

// Fetch products from the database
$products = listarTabela("id, nome, descricao, preco, imagem", 'produto', 'id');
?>

<div class="container">
    <h2>Produtos</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Controle</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($products) || is_object($products)) {
                    if (!empty($products)) {
                        foreach ($products as $product) { ?>
                            <tr>
                                <td><?php echo $product->id; ?></td>
                                <td><?php echo $product->nome; ?></td>
                                <td><?php echo $product->descricao; ?></td>
                                <td><?php echo $product->preco; ?></td>
                                <td><img src="./img/<?php echo $product->imagem; ?>" alt="<?php echo $product->nome; ?>"
                                        style="width: 100px;"></td>
                                <td class="text-center">
                                    <form action="./api/excluirProduto.php" method="post" style="display:inline-block;">
                                        <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                                        <button class="btn btn-danger" type="submit" name="excluir">Excluir</button>
                                    </form>
                                    <!-- No lugar onde deseja exibir o botão de editar produto -->
                                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                                    <button class="btn btn-warning btn-edit"
                                        onclick="editarProduto(<?php echo $product->id; ?>, '<?php echo $product->nome; ?>', '<?php echo $product->descricao; ?>', <?php echo $product->preco; ?>)"
                                        data-bs-toggle="modal" data-bs-target="#modalEdicao">Editar</button>


                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum produto encontrado</td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum produto encontrado</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastro">Cadastrar Novo
        Produto</a>
</div>


<!-- Modal de Cadastro -->
<div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="api/cadastrarProduto.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="descricao" name="descricao" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço:</label>
                        <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
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
                <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="api/editarProduto.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="edit_nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_descricao" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="edit_descricao" name="descricao" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_preco" class="form-label">Preço:</label>
                        <input type="number" step="0.01" class="form-control" id="edit_preco" name="preco" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_imagem" class="form-label">Imagem:</label>
                        <input type="file" class="form-control" id="edit_imagem" name="imagem">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    function editarProduto(id, nome, descricao, preco) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nome').value = nome;
        document.getElementById('edit_descricao').value = descricao;
        document.getElementById('edit_preco').value = preco;

        // Se desejar limpar o campo de imagem, descomente a linha abaixo
        // document.getElementById('edit_imagem').value = '';
    }
</script>