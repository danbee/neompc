<?php /* Smarty version 2.6.26, created on 2010-01-13 14:03:23
         compiled from default/index.html */ ?>
<!DOCTYPE html>
<html>

	<head>
		<title>NeoMPC <?php echo $this->_tpl_vars['version']; ?>
</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=320, user-scalable=no"/>

		<style>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/styles.css", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</style>
		
		<script type="text/javascript" src="lib/js/jquery-min.js"></script>
		<script type="text/javascript" src="lib/js/jquery-ui-custom-min.js"></script>
		<script type="text/javascript">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../lib/js/neompc.js", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</script>
		
	</head>

	<body>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/menu.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<div id="page">

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/".($this->_tpl_vars['page']).".html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		</div>

		<?php echo $this->_tpl_vars['refresh']; ?>


	</body>

</html>