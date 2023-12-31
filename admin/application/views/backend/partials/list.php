<?php $this->load->view( $template_path .'/partials/nav' ); ?>

 <div class="container-fluid">
  <div class="content-wrapper">
	<div class="row">
		<div class="col-12 col-md-3 sidebar teamps-sidebar-open">
			
			<?php $this->load->view( $template_path .'/partials/sidebar' ); ?>
		</div>
		
		<div class="col-12 col-md-12 main teamps-sidebar-push">

			
		
			<?php show_breadcrumb( ( isset( $action_title ))? $action_title: '' ); ?>

			<?php flash_msg(); ?>

			<?php 
				$search_form = $template_path .'/'. $module_path .'/search_form';
				// echo $search_form;
				if ( is_view_exists( $search_form )) $this->load->view( $search_form ); 
			?>

			<br/>

			
				
			<div class="card">
				<?php $this->load->view( $template_path .'/'. $module_path .'/list'); ?>
			</div>

			<?php $this->load->view( $template_path .'/partials/pag' ); ?>
			<?php show_ads(); ?>
			

		</div>
	</div>
</div>
</div>

<?php 
	$list_script_path = $template_path .'/'. $module_path .'/list_script';
	
	if ( is_view_exists( $list_script_path )) $this->load->view( $list_script_path ); 
?>