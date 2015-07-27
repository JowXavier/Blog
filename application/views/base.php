<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $titulo; ?></title>
        
        <?php echo link_tag('assets/css/blog.css'); ?> 
    </head>
    <body>
        <?php echo img(array(
            'src' => 'assets/img/topo.jpg',
            'alt' => 'Blog',
            'style' => 'float: left;'
        )); ?>
        <h1>BLOG CODEIGNITER</h1>
        <hr style="clear: both;" />
        
        <div id="conteudo">
            
            <?php if ($this->session->flashdata('mensagem')) : ?>
                <div class="mensagens">
                    <?php echo $this->session->flashdata('mensagem'); ?>
                </div>
            <?php endif; ?>
            
            <?php $this->load->view($view); ?>
        </div>
        
        <div id="rodape">
			<p><small>Desenvolvido com CodeIgniter &copy; <?php echo date('Y'); ?></small></p>
        </div>
    </body>
</html>