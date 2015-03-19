
<?php
$tipo = $_SESSION['tipo'];


?>
<!-- Sidebar Column -->
<div class="col-md-3">
    <div class="list-group">
        <a href="services.html" class="list-group-item">Transações</a>
        <?php
        if($tipo){ ?>
            <a href="index.html" class="list-group-item">Meus Veículos</a>
        <?php
        }else{ ?>
            <a href="about.html" class="list-group-item">Minhas Encomendas</a>
        <?php } ?>
        <a href="#" class="list-group-item">Notícias</a>
        <a href="#" class="list-group-item">Alertas</a>
        <a href="contact.html" class="list-group-item">Editar Perfil</a>
    </div>
</div>
