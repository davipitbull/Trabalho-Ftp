<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();

// Fetch users from the database
$users = listarTabela("id, nome, email", 'usuario', 'id');
?>

<div class="container">
    <h2>Usuários</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($users) || is_object($users)) {
                    if (!empty($users)) {
                        foreach ($users as $user) { ?>
                            <tr>
                                <td><?php echo $user->id; ?></td>
                                <td><?php echo $user->nome; ?></td>
                                <td><?php echo $user->email; ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="3" class="text-center">Nenhum usuário encontrado</td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum usuário encontrado</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
