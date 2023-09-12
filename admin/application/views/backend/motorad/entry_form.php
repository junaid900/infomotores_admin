<?php
$attributes = array('id' => 'motorad','enctype' => 'multipart/form-data');

echo form_open( '', $attributes);
// print_r($motorad);
// echo "11";
$data = $motorad->result();
$editData = $edit_motorad;
// echo "21";
// print_r($editData);
?>
<section class="content animated fadeInRight">
    
	<div class="card card-info">
		<div class="card-header">
	        <h3 class="card-title"><?php echo get_msg('motor_ad_info')?></h3>
	    </div>
	</div>

	<div class="card-body">
	   <div class = 'row'>
	       <div class = 'col-6'>
	           <input type="hidden" name="id" value='<?=@$editData->id?>'/>
	           <div>
	               <label>Name</label>
	               <input class='form-control' name='name' value='<?=@$editData->name?>' />
	           </div>
	           <div>
	               <label>Description</label>
	               <input class='form-control' name='description' value='<?=@$editData->description?>' />
	           </div>
	           <div>
	               <label>Link</label>
	               <input class='form-control' name='url' value='<?=@$editData->url?>' />
	           </div>
	           
	           <div>
	               <label>Image</label>
	               <input type='file' class='form-control' name='image' />
	           </div>
	             <?php
	                    if($editData){
                    		$conds = array( 'img_type' => 'motorad', 'img_parent_id' => @$editData->id );
                    		$_images = $this->Image->get_all_by( $conds )->result();
	                    
                				    ?>
                		<?php foreach($_images as $_image){ //print_r($image);?>
                				
                    		    <div>
                    				<img src="<?php echo $this->ps_image->upload_thumbnail_url . $_image->img_path; ?>">
                    			</div>	
                		<?php }} ?>
	           <div class='pt-2'>
	            <button type='submit' class='btn btn-primary'>Save</button>
	            <button type="button"  class='btn btn-secondary' onclick="location.href = '<?=site_url('/admin/motorad')?>'">Reset</button>
	           </div>
	           
	       </div>
	       <div class='col-6'>
	           <table class='table table-stripped'>
	               <thead>
	                   <tr>
	                       <td>
	                          Name 
	                       </td>
	                       <td>
	                           Image
	                       </td>
	                       <td>
	                           Action
	                       </td>
	                   </tr>
	               </thead>
	               <tbody>
	                   <?php foreach($data as $d){ ?>
    	                   <tr>
    	                       <td><?=$d->name?></td>
    	                       <td>  <?php
                					   $conds = array( 'img_type' => 'motorad', 'img_parent_id' => $d->id );
                					   $images = $this->Image->get_all_by( $conds )->result();
                				    ?>
                				<?php foreach($images as $image){ //print_r($image);?>
                				
                    				<div>
                    				    <img src="<?php echo $this->ps_image->upload_thumbnail_url . $image->img_path; ?>">
                    				</div>	
                				<?php } ?></td>
                				  <td><a href='<?=$module_site_url."/edit/".$d->id?>'>EDIT</a></td>
    	                       <td><a href='<?=$module_site_url."/deleteItem/".$d->id?>'>DELETE</a></td>
    	                     
    	                   </tr>
	                   <?php } ?>
	               </tbody>
	           </table>
	       </div>
	   </div>
    </div>
    <!-- /.card info-->
</section>
<?php echo form_close(); ?>