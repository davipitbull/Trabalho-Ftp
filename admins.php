<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();

// Fetch admins from the database
$admins = listarTabela("idadm, nome, email", 'adm', 'idadm');
?>

<div class="container">
    <h2>Administradores</h2>
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
                <?php if (is_array($admins) || is_object($admins)) {
                    if (!empty($admins)) {
                        foreach ($admins as $admin) { ?>
                            <tr>
                                <td><?php echo $admin->idadm; ?></td>
                                <td><?php echo $admin->nome; ?></td>
                                <td><?php echo $admin->email; ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="3" class="text-center">Nenhum administrador encontrado</td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum administrador encontrado</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>