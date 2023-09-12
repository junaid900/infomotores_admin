<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">
		<tr>
		<th><?php echo get_msg('no'); ?></th>
			<th><?php echo get_msg('item_code'); ?></th>
			<th><?php echo get_msg('item_name'); ?></th>
			<th><?php echo get_msg('manu_name'); ?></th>
			<th><?php echo get_msg('model_name'); ?></th>
			<th><?php echo "Type"; ?></th>
			<th><?php echo "Expiry"; ?></th>

			<?php if ( $this->ps_auth->has_access( EDIT )): ?>

				<th><span class="th-title"><?php echo get_msg('btn_edit')?></span></th>

			<?php endif; ?>

			<?php if ( $this->ps_auth->has_access( DEL )): ?>

				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>

			<?php endif; ?>

		</tr>


	<?php $count = $this->uri->segment(4) or $count = 0; ?>


	<?php if ( !empty( $disables ) && count( $disables->result()) > 0 ): ?>

		<?php foreach($disables->result() as $disable): ?>

				<?php
			$manufacturer_name = '';
			$model_name = '';

			if($disable->manufacturer_id == -2){
            			     $manufacturer_name = $disable->service_area;
            			}else if($disable->manufacturer_id == -1){
            			    $manufacturer_name = $disable->manufacturer_name;
            			}else{
            			     $manufacturer_name = $this->Manufacturer->get_one( $disable->manufacturer_id )->name;
            			}

            			if($disable->model_id == -1){
            			    $model_name = $disable->model_name;



            			}else{
            			    $model_name = $this->Model->get_one( $disable->model_id )->name;
            			}

			?>

			<tr>
				<td><?php echo ++$count;?></td>
				<td><span style="" class="alert alert-success"><?php echo $disable->item_no;?></span></td>
				<td><?php echo $disable->title;?></td>
				<td><?php echo $manufacturer_name;
				// echo $this->Manufacturer->get_one( $disable->
				// manufacturer_id )->name;
				?></td>
				<td><?php echo $model_name;
				// echo $this->Model->get_one( $disable->model_id )->name;
				?></td>
				<td>
                					<?php
                						echo $this->Category->get_one( $disable->category_id )->category_name;
                					?>
                				</td>

				<td><div class="badge badge-success" style="font-size: 12px">

				    	<?php
					if (!empty($disable->expiry_date)) {
						echo date("M d, Y", strtotime($disable->expiry_date));
						}else{
						    echo "No Expiry";
						}
					?>
				</div>

				</td>

				<?php if ( $this->ps_auth->has_access( EDIT )): ?>

					<td>

						<a href='<?php echo $module_site_url .'/edit/'. $disable->id; ?>'>
							<i class='fa fa-pencil-square-o'></i>
						</a>
					</td>

				<?php endif; ?>

				<?php if ( $this->ps_auth->has_access( DEL )): ?>

					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo "$disable->id";?>">
							<i class='fa fa-trash-o'></i>
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