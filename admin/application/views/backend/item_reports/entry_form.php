<?php
  $attributes = array( 'id' => 'item-form', 'enctype' => 'multipart/form-data');
  echo form_open( '', $attributes);
?>

<section class="content animated fadeInRight">
      
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"><?php echo get_msg('prd_info')?></h3>
    </div>

    <form role="form">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_title_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'title',
                'value' => set_value( 'title', show_data( @$item->title), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_title_label'),
                'id' => 'title',
                'readonly' => "true"
                
              )); ?>

            </div>

              <div class="form-group">
              <label><span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('model_search_manu')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('model_search_manu');
                $manufacturers = $this->Manufacturer->get_all_by($conds);
                foreach($manufacturers->result() as $manu) {
                    $options[$manu->id]=$manu->name;
                }

                echo form_dropdown(
                  'manufacturer_id',
                  $options,
                  set_value( 'manufacturer_id', show_data( @$item->manufacturer_id), false ),
                  'class="form-control form-control-sm mr-3" id="manufacturer_id"'
                );
              ?>
            </div>
           
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_type')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_type');
                $types = $this->Itemtype->get_all();
                foreach($types->result() as $typ) {
                    $options[$typ->id]=$typ->name;
                }

                echo form_dropdown(
                  'item_type_id',
                  $options,
                  set_value( 'item_type_id', show_data( @$item->item_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="item_type_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('item_description_label')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'description',
                'value' => set_value( 'description', show_data( @$item->description), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('item_description_label'),
                'id' => 'description',
                'rows' => "3",
                'readonly' => "true"
              )); ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('prd_high_info')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'highlight_info',
                'value' => set_value( 'info', show_data( @$item->highlight_info), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => "Please Highlight Information",
                'id' => 'info',
                'rows' => "3",
                'readonly' => "true"
              )); ?>

            </div>
            <!-- form group -->
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('price')?>
              </label>

              <?php echo form_input( array(
                'name' => 'price',
                'value' => set_value( 'price', show_data( @$item->price), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('price'),
                'id' => 'price',
                'readonly' => 'true'
                
              )); ?>

            </div>

            <div class="form-group">
              <label><span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('select_model')?>
              </label>

              <?php
                if(isset($item)) {
                  $options=array();
                  $options[0]=get_msg('select_model');
                  $conds['manufacturer_id'] = $item->manufacturer_id;
                  $models = $this->Model->get_all_by($conds);
                  foreach($models->result() as $model) {
                    $options[$model->id]=$model->name;
                  }
                  echo form_dropdown(
                    'model_id',
                    $options,
                    set_value( 'model_id', show_data( @$item->model_id), false ),
                    'class="form-control form-control-sm mr-3" id="model_id"'
                  );

                } else {
                  $conds['manufacturer_id'] = $selected_manufacturer_id;
                  $options=array();
                  $options[0]=get_msg('select_model');

                  echo form_dropdown(
                    'model_id',
                    $options,
                    set_value( 'model_id', show_data( @$item->model_id), false ),
                    'class="form-control form-control-sm mr-3" id="model_id"'
                  );
                }
                
              ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_price')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('itm_select_price');
                $pricetypes = $this->Pricetype->get_all_by($conds);
                foreach($pricetypes->result() as $price) {
                    $options[$price->id]=$price->name;
                }

                echo form_dropdown(
                  'item_price_type_id',
                  $options,
                  set_value( 'item_price_type_id', show_data( @$item->item_price_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="item_price_type_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_currency')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('itm_select_currency');
                $currency = $this->Currency->get_all_by($conds);
                foreach($currency->result() as $curr) {
                    $options[$curr->item_currency_id]=$curr->name;
                }

                echo form_dropdown(
                  'item_currency_id',
                  $options,
                  set_value( 'item_currency_id', show_data( @$item->item_currency_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="item_currency_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('condition_of_item')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'condition_of_item_id',
                'value' => set_value( 'condition_of_item_id', show_data( @$item->condition_of_item_id), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('condition_of_item'),
                'id' => 'condition_of_item_id',
                'rows' => "3",
                'readonly' => 'true'
              )); ?>

            </div>

          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('brand_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'brand',
                'value' => set_value( 'brand', show_data( @$item->brand), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('brand_label'),
                'id' => 'brand',
                'readonly' =>'true'
                
              )); ?>

            </div>

            <label><?php echo get_msg('deal_option_id_label')?></label><br>
              <input type="radio" name="deal_option_id"
              <?php if (isset($item->deal_option_id) && $item->deal_option_id=="1") echo "checked";?>
              value="1" disabled><?php echo get_msg('meet_up_label');?>
              <input type="radio" name="deal_option_id"
              <?php if (isset($item->deal_option_id) && $item->deal_option_id=="2") echo "checked";?>
              value="2" disabled><?php echo get_msg('mailing_or_delivery_label');?>
              <br><br>
            <legend><?php echo get_msg('location_info_label'); ?></legend>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_address_label')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'address',
                'value' => set_value( 'address', show_data( @$item->address), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_address_label'),
                'id' => 'address',
                'rows' => "5",
                'readonly' => 'true'
              )); ?>

            </div>

          </div>

          <div class="col-md-6">
            <div class="form-group">
              <div class="form-check">
                <label>
                
                <?php echo form_checkbox( array(
                  'name' => 'business_mode',
                  'id' => 'business_mode',
                  'value' => 'accept',
                  'checked' => set_checkbox('business_mode', 1, ( @$item->business_mode == 1 )? true: false ),
                  'class' => 'form-check-input',
                  'onclick' => 'return false'
                )); ?>

                <?php echo get_msg( 'itm_business_mode' ); ?>

                </label>
              </div>
            </div>

            <div class="form-group">
              <div class="form-check">
                <label>
                
                <?php echo form_checkbox( array(
                  'name' => 'is_sold_out',
                  'id' => 'is_sold_out',
                  'value' => 'accept',
                  'checked' => set_checkbox('is_sold_out', 1, ( @$item->is_sold_out == 1 )? true: false ),
                  'class' => 'form-check-input',
                  'onclick' => 'return false'
                )); ?>

                <?php echo get_msg( 'itm_is_sold_out' ); ?>

                </label>
              </div>
            </div>
            <!-- form group -->
          </div>
          <?php if (  @$item->lat !='0' && @$item->lng !='0' ):?>
          <div class="col-md-6">
            <div id="report_map" style="width: 100%; height: 300px;"></div>
            <div class="clearfix">&nbsp;</div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label><?php echo get_msg('itm_lat_label') ?>
                <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('city_lat_label')?>">
                  <span class='glyphicon glyphicon-info-sign menu-icon'>
                </a>
              </label>

              <br>

              <?php 
                echo form_input( array(
                  'type' => 'text',
                  'name' => 'lat',
                  'id' => 'lat',
                  'class' => 'form-control',
                  'placeholder' => '',
                  'value' => set_value( 'lat', show_data( @$item->lat ), false ),
                  'readonly' => 'true'
                ));
              ?>
            </div>

            <div class="form-group">
              <label><?php echo get_msg('itm_lng_label') ?>
                <a href="#" class="tooltip-ps" data-toggle="tooltip" 
                  title="<?php echo get_msg('city_lng_tooltips')?>">
                  <span class='glyphicon glyphicon-info-sign menu-icon'>
                </a>
              </label>

              <br>

              <?php 
                echo form_input( array(
                  'type' => 'text',
                  'name' => 'lng',
                  'id' => 'lng',
                  'class' => 'form-control',
                  'placeholder' => '',
                  'value' =>  set_value( 'lng', show_data( @$item->lng ), false ),
                  'readonly' => 'true'
                ));
              ?>
            </div>
            <!-- form group -->
          </div>
          <?php endif ?>
           
        </div>
        <!-- row -->
      </div>

        <!-- Grid row -->
        <div class="gallery" id="gallery" style="margin-left: 15px; margin-bottom: 15px;">
          <?php
              $conds = array( 'img_type' => 'item', 'img_parent_id' => $item->id );
              $images = $this->Image->get_all_by( $conds )->result();
          ?>
          <?php $i = 0; foreach ( $images as $img ) :?>
            <!-- Grid column -->
            <div class="mb-3 pics animation all 2">
              <a href="#<?php echo $i;?>"><img class="img-fluid" src="<?php echo img_url('/' . $img->img_path); ?>" alt="Card image cap"></a>
            </div>
            <!-- Grid column -->
          <?php $i++; endforeach; ?>

          <?php $i = 0; foreach ( $images as $img ) :?>
            <a href="#_1" class="lightbox trans" id="<?php echo $i?>"><img src="<?php echo img_url('/' . $img->img_path); ?>"></a>
          <?php $i++; endforeach; ?>
        </div>
        <!-- Grid row -->
        <!-- start check paid item  -->
        <div class="form-group">
        <?php 
          // load history
          $conds_paid['item_id'] = $item->id;
         
          // get paid history
          $paid_histories = $this->Paid_item->get_all_by( $conds_paid );

          $today_date = date('Y-m-d H:i:s');
          foreach ($paid_histories->result() as $history){
           
            if ($today_date >= $history->start_date && $today_date <= $history->end_date) {
        ?>
          <label> <span style="padding-left: 10px;font-size: 17px; color: red;"><?php echo get_msg('itm_promote_alert')?></span></label>
          <?php } ?>
        <?php } ?>
        </div>
        <!-- end check paid item  -->  
        
      <div class="card-footer">
        <button type="submit" name="submit" value="submit" class="btn btn-sm btn-primary">
          <?php echo get_msg('btn_disable')?>
        </button>

        <a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
          <?php echo get_msg('btn_cancel')?>
        </a>
      </div>
    </form>
  </div>
</section>