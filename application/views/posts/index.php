<?php if (count($posts) == 0) : ?>
    <h2>Nenhum post encontrado!</h2>
<?php else : ?>
    <?php foreach ($posts as $p) : ?>
        <h2>
            <?php echo anchor('post/' . $p->url, $p->titulo); ?>
        </h2>
        <p><?php echo word_limiter($p->texto, 10); ?></p>
        <p><small>Autor: <?php echo $p->autor; ?></small></p>
        <p><small>Publicação: <?php echo formatar_datahora_exibicao($p->publicacao); ?></small></p>
        <hr />
    <?php endforeach; ?>
<?php endif; ?>

<?php echo $paginacao; ?>