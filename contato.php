<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();
?>



<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Número</th>
            <th>Controle</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $teste1 = listarTabela("id, nome, numero", 'contato', 'id');
        foreach ($teste1 as $row) {
            // Certifique-se de que $row é um objeto antes de acessar suas propriedades
            if (is_object($row)) {
                $id = $row->id;
                $nome = $row->nome;
                $numero = $row->numero;

        ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $nome ?></td>
                    <td><?php echo $numero ?></td>



                    <td class="text-center">
                        <form action="./api/excluirContato.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <button style="background-color: red;" type="submit" name="excluir">Excluir</button>
                        </form>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<!-- Modal de Edição -->


<!-- Modal de Cadastro -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
