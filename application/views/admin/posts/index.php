<?php echo anchor('admin/posts/novo', 'Novo post'); ?>
<br /><br />
<?php if (count($posts) == 0) : ?>
    <h2>Nenhum post encontrado!</h2>
<?php else : ?>
    <table width="50%">
        <tr>
            <td><strong>Post</strong></td>
            <td><strong>Autor</strong></td>
            <td><strong>Data</strong></td>
            <td><strong>Opções</strong></td>
        </tr>
        <?php foreach ($posts as $p) : ?>
            <tr>
                <td><?php echo $p->titulo; ?></td>
                <td><?php echo $p->autor; ?></td>
                <td><?php echo formatar_datahora_exibicao($p->publicacao); ?></td>
                <td>
                    <?php echo anchor('admin/posts/editar/' . $p->id, 'Editar'); ?> | 
					<?php echo anchor('', 'Apagar', 'onclick="pergunta('.$p->id.'); return false;"'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
	<?php echo $paginacao; ?>
<?php endif; ?>
<script>
function pergunta(id){
	var answer = confirm("Deseja apagar este Post ?")
	if (answer){
		window.location = '<?php echo base_url().'admin/posts/excluir/' ?>'+id;
	}
}
</script>