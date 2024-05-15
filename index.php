<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

$return = conectar();

if (!isset($_SESSION['iduser'])) {

    header('location: login.php');
}

$banners = listarTabela("id, nome, imagem", 'banner', 'id');
$products = listarTabela("id, nome, descricao, preco, imagem", 'produto', 'id');



?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DLS Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!--<div class="text-center fs-3">-->
    <!--    Dls Style-->
    <!--</div>-->
    <nav class="navbar navbar-expand-lg bg-black" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DLS Style</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Início</a>

                    </li>

                    <button class="nav-link active" aria-current="page" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Contato</button>


                    <a class="nav-link active" aria-current="page" href="api/sair.php">Sair</a>

                </ul>
                <a class="iconeCarrinho" href="index.php"><i class="bi bi-cart4"></i></a>

                <form class="d-flex" role="search">
                    <input class="form-control me-2 bg-light text-black" type="search" placeholder="Procurar"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </nav>


    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($banners as $key => $banner) { ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $key; ?>"
                    <?php if ($key === 0)
                        echo 'class="active"'; ?>></button>
            <?php } ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($banners as $key => $banner) { ?>
                <div class="carousel-item <?php if ($key === 0)
                    echo 'active'; ?>">
                    <img src="./img/<?php echo $banner->imagem; ?>" class="d-block w-100"
                        alt="<?php echo $banner->nome; ?>">
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="bg-black text-white fs-3 text-center">
        <div><i class="bi bi-truck"></i> <b>Frete grátis </b>na primeira compra</div>
    </div>

    <div class="container altContainer">
        <h4 class="mt-3">Mais vendidos</h4>
        <div class="row mb-3">
            <?php foreach ($products as $product) { ?>
                <div class="col-lg-3 col-md-6 mt-3 col-sm-6 col-6">
                    <div class="cardH">
                        <img src="./img/<?php echo $product->imagem; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product->nome; ?></h5>
                            <p class="card-text"><?php echo $product->descricao; ?></p>
                            <p class="card-text"><strong>R$
                                    <?php echo number_format($product->preco, 2, ',', '.'); ?></strong></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>








    <!--    container-->
    </div>

    <footer class="py-3 mt-5 bg-black text-white">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Início</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Política de privacidade</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Termos de serviço</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">SAC</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Sobre Nós</a></li>
        </ul>
        <p class="text-center text-body-white">© 2024 DLS Style, Inc. Todos os direitos reservados.</p>
    </footer>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">Contato</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="api/mandar.php" method="post">
                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome:</label>
                                                <input type="text" class="form-control" id="nome"
                                                    placeholder="Digite seu nome" name="nome" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="numero" class="form-label">Número:</label>
                                                <input type="text" class="form-control" id="numero"
                                                    placeholder="Digite seu número" name="numero" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mensagem" class="form-label">Mensagem:</label>
                                                <textarea class="form-control" id="mensagem"
                                                    placeholder="Digite sua mensagem" name="mensagem"
                                                    required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Ok</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15101.286325521192!2d-41.960903473217776!3d-18.87280965713444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xb1a7cab052879d%3A0xecfe53724776e092!2sBigmais%20Treze%20de%20Maio!5e0!3m2!1spt-BR!2sbr!4v1715623213511!5m2!1spt-BR!2sbr"
                                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#numero').mask('(00)00000-0000');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>