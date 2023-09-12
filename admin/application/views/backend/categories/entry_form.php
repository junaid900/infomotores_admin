<?php
//$attributes = array('id' => 'item-form', 'enctype' => 'multipart/form-data');
//echo form_open('', $attributes);
?>

<section class="content animated fadeInRight">

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?php echo get_msg('prd_info') ?></h3>
        </div>
        <?php if($type == "edit"){?>
            <form role="form" method="post" action="<?= base_url()."index.php/admin/categories/save_data/update/".$item['category_id']?>" enctype="multipart/form-data">
            <?php
            $attributes = array( 'id' => 'color-form', 'enctype' => 'multipart/form-data');
            echo form_open( '', $attributes);
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">


                        <legend><?php echo get_msg('other_info_lable') ?></legend>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> <span style="font-size: 17px; color: red;">*</span>
                                    <?php echo get_msg('itm_title_label') ?>
                                </label>

                               <input class="form-control" name="title" placeholder="<?=get_msg("title")?>"
                                    value = "<?=$item['category_name']?>"/>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> <span style="font-size: 17px; color: red;">*</span>
                                    <?php echo get_msg('category_image') ?>
                                </label>

                                <input type="file" class="form-control" name="mimage" placeholder="<?=get_msg("title")?>"/>

                            </div>
                        </div>
                         <div class="col-md-6" style = "display:none">
                            <div class="form-group">
                                <label> <span style="font-size: 17px; color: red;">*</span>
                                    <?php echo get_msg('itm_title_label') ?>
                                </label>

                               <input class="form-control" name="pre_image" placeholder="<?=get_msg("title")?>"
                                    value = "<?=$item['category_image']?>"/>

                            </div>
                        </div>


                        <!-- Grid row -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 3px;">
                                <?php echo get_msg('btn_save') ?>
                            </button>
<!---->
<!--                            <button type="submit" name="gallery" id="gallery" class="btn btn-sm btn-primary"-->
<!--                                    style="margin-top: 3px;">-->
<!--                                --><?php //echo get_msg('btn_save_gallery') ?>
<!--                            </button>-->

<!--                            <button type="submit" name="promote" id="promote" class="btn btn-sm btn-primary"-->
<!--                                    style="margin-top: 3px;">-->
<!--                                --><?php //echo get_msg('btn_promote') ?>
<!--                            </button>-->
<!---->
<!--                            <a href="--><?php //echo $module_site_url; ?><!--" class="btn btn-sm btn-primary"-->
<!--                               style="margin-top: 3px;">-->
<!--                                --><?php //echo get_msg('btn_cancel') ?>
<!--                            </a>-->
                        </div>
        </form>
        <?php }else{ ?>
        <form role="form" method="post" action="<?= base_url()."index.php/admin/categories/save_data"?>" enctype="multipart/form-data">
            <?php
            $attributes = array( 'id' => 'color-form', 'enctype' => 'multipart/form-data');
            echo form_open( '', $attributes);
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">


                        <legend><?php echo get_msg('other_info_lable') ?></legend>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> <span style="font-size: 17px; color: red;">*</span>
                                    <?php echo get_msg('itm_title_label') ?>
                                </label>

                               <input class="form-control" name="title" placeholder="<?=get_msg("title")?>"/>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> <span style="font-size: 17px; color: red;">*</span>
                                    <?php echo get_msg('category_image') ?>
                                </label>

                                <input type="file" class="form-control" name="mimage" placeholder="<?=get_msg("title")?>"/>

                            </div>
                        </div>


                        <!-- Grid row -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 3px;">
                                <?php echo get_msg('btn_save') ?>
                            </button>
<!---->
<!--                            <button type="submit" name="gallery" id="gallery" class="btn btn-sm btn-primary"-->
<!--                                    style="margin-top: 3px;">-->
<!--                                --><?php //echo get_msg('btn_save_gallery') ?>
<!--                            </button>-->

<!--                            <button type="submit" name="promote" id="promote" class="btn btn-sm btn-primary"-->
<!--                                    style="margin-top: 3px;">-->
<!--                                --><?php //echo get_msg('btn_promote') ?>
<!--                            </button>-->
<!---->
<!--                            <a href="--><?php //echo $module_site_url; ?><!--" class="btn btn-sm btn-primary"-->
<!--                               style="margin-top: 3px;">-->
<!--                                --><?php //echo get_msg('btn_cancel') ?>
<!--                            </a>-->
                        </div>
        </form>
        <?php } ?>
    </div>
</section>