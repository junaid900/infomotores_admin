<style>
    .mimg{
        width: 40px;
        height: 40px;
    }
</style>
<div class="table-responsive animated fadeInRight">

	<table class="table m-0 table-striped" >
		<tr>
			<th><?php echo get_msg('no'); ?></th>
			<th><?php echo get_msg('category_image'); ?></th>
			<th><?php echo get_msg('category_name'); ?></th>
			<th><?php echo get_msg('status_label'); ?></th>
			
			<?php if ( $this->ps_auth->has_access( EDIT )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_edit')?></span></th>
			
			<?php endif; ?>
			
			<?php if ( $this->ps_auth->has_access( DEL )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>
			
			<?php endif; ?>

			
			<?php if ( $this->ps_auth->has_access( PUBLISH )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_duplicate')?></span></th>
			
			<?php endif; ?>
			
		</tr>
		
	
<!--	--><?php //$count = $this->uri->segment(4) or $count = 0; ?>

	<?php if ( !empty( $categories ) && count( $categories) > 0 ): ?>
        <?php// echo "<pre>";print_r($items->result());exit;?>
		<?php foreach($categories as $item): ?>
			
			<tr>
				<td><?php echo ++$count;?></td>
				<td><img src = '<?php echo base_url().$item->category_image;?>' class = "mimg" /></td>
				<td><?php echo $item->category_name;?></td>
<!--				<td>--><?php //echo $this->Manufacturer->get_one( $item->manufacturer_id )->name; ?><!--</td>-->
<!--				<td>--><?php //echo $this->Model->get_one( $item->model_id )->name; ?><!--</td>-->
<!--				<td>--><?php //echo $this->User->get_one( $item->added_user_id )->user_name; ?><!--</td>-->
				<td>
					<?=$item->status?>
				</td>

				<?php if ( $this->ps_auth->has_access( EDIT )): ?>
			
					<td>
						<a href='<?php echo $module_site_url .'/edit/'. $item->category_id; ?>'>
							<i class='fa fa-pencil-square-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				
				<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo "$item->category_id";?>">
							<i class='fa fa-trash-o'></i>
						</a>
					</td>
				
				<?php endif; ?>

				<?php if ( $this->ps_auth->has_access( PUBLISH )): ?>
					
					<td>
						
						<a href="<?php echo site_url('/admin/categories/duplicate_item_save/'.$item->category_id); ?>" class="btn btn-sm btn-primary">
							<?php echo get_msg('btn_duplicate')?>
						</a>
						
					</td>
				
				<?php endif; ?>
				
			</tr>

		<?php endforeach; ?>

	<?php else: ?>
			
		<?php $this->load->view( $template_path .'/partials/no_data' ); ?>

	<?php endif; ?>

</table>
</div>

