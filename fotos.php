<?php
  require_once 'admin/includes/init.php';
  include_once LIB_CONTROLLER . DS . 'MidiaController.class.php';
  $controller = new MidiaController();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Fotos</title>
    <?php include_once 'includes/metadados.php' ?>
</head>

<body>
    <?php include_once 'includes/navbar.php' ?>
    <main class="container text-center principal pt-3">

        <?php
          if (isset($_GET['ano'])):
            $ano = $_GET['ano'];
            $midias = $controller->getMidiaPorAno($ano);
        ?>

        <div id="carouselExampleDark" class="carousel carousel-dark slide overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                  for ($i = 0; $i < sizeof($midias); $i++):
                    if($i == 0):
                ?>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?= $i ?>" class="active"
                    aria-current="true" aria-label="<?php $i ?>"></button>
                <?php
                    else:
                ?>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?= $i ?>"
                    aria-label="<?php $i ?>"></button>
                <?php
                    endif;
                  endfor;
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                  $primeiro= true;
                foreach ($midias as $midia):
                  if($primeiro):
              ?>
                <div class="carousel-item active">
                    <img src="./imagens/fotos/<?= $ano?>/<?= $midia->getLink()?>" class="d-block w-100 img-carousel"
                        alt="Foto do evento <?= $midia->getIdMidia()?>">
                    <div class="carousel-caption d-none d-md-block">
                        <p><?= $midia->getTitulo()?></p>
                    </div>
                </div>
                <?php
                $primeiro= false;  
                else:
              ?>
                <div class="carousel-item">
                    <img src="./imagens/fotos/<?= $ano?>/<?= $midia->getLink()?>" class="d-block  w-100 img-carousel"
                        alt="Foto do evento <?= $midia->getIdMidia()?>">
                    <div class="carousel-caption d-none d-md-block">
                        <p><?= $midia->getTitulo()?></p>
                    </div>
                </div>
                <?php
                  endif;
                endforeach;
              ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <?php
    else:
      ?>
        <div class="row align-items-center">
            <?php
      $anos = $controller->getAnosMidia();
      $quantidadeEdicoes = sizeof($anos);
      $porcentagem = 1 / $quantidadeEdicoes;
      $opacidade = $porcentagem;
      foreach ($anos as $ano):

        ?>
            <div class="col-12 col-sm-6 col-md-3 py-2">
                <a href="fotos.php?ano=<?= $ano ?>" style="opacity:<?= $opacidade ?>"
                    class="mx-4 fs-2 btn rounded-4 botao-anais mx-10 w-45 h-45 text-center py-3 p-5">Fotos
                    <?= $ano ?>
                </a>
            </div>
            <?php
        $opacidade += $porcentagem;
      endforeach;
      ?>
        </div>
        <?php
    endif;
    ?>

    </main>


    <?php include_once 'includes/rodape.php' ?>
    <?php include_once 'includes/scripts.php' ?>
</body>

</html>