<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();
?>

<?php
$teste1 = listarTabela("id, nome, numero, mensagem", 'contato', 'id');

if (is_array($teste1) || is_object($teste1)) {
    if (!empty($teste1)) {
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Número</th>
                        <th>Mensagem</th>
                        <th>Controle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($teste1 as $row) {
                        $id = $row->id;
                        $nome = $row->nome;
                        $numero = $row->numero;
                        $mensagem = $row->mensagem;
                        ?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $nome ?></td>
                            <td><?php echo $numero ?></td>
                            <td><?php echo $mensagem ?></td>
                            <td class="text-center">
                                <form action="./api/excluirContato.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <button class="btn btn-danger" type="submit" name="excluir">Excluir</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        ?>
        <h1>Sem Resultado!</h1>
        <?php
    }
} else {
    ?>
    <h1>Sem Resultado!</h1>
    <?php
}
?>
