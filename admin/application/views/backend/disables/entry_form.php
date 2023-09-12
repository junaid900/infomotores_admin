<?php
	$attributes = array( 'id' => 'disable-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
?>

<section class="content animated fadeInRight">

  <div class="card card-info">
  	<div class="card-header">
    	<h3 class="card-title"><?php echo get_msg('prd_info')?></h3>
  	</div>

    <div class='d-flex justify-content-center'>
        <h1 ><span class='badge badge-danger'>Item # - <?= $disable->item_no ?></span></h1>
    </div>
    <form role="form">
      <div class="card-body">
      	<div class="row">
      		<div class="col-md-6">
            <div class="form-group">

              <!--title-->

              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_title_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'title',
                'value' => set_value( 'title', empty(show_data( @$disable->title))? 'No Title' :show_data( @$disable->title)),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_title_label'),
                'id' => 'title',
                'readonly' => "true"
              )); ?>

            </div>

<!--Color-->

            <?php if ($disable->manufacturer_id != "-2" && $disable->color_id != null): ?>

					<div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
              Color
              </label>


<?php

               $colorData = $this->db->get_where('bs_items_colors', array('status' => 1))->result();
                $options=array();
                $options[0]= 'Select Color';
                foreach($colorData as $color) {
                    $options[$color->id]=$color->color_value;
                }

                echo form_dropdown(
                  'color_value',
                  $options,
                  set_value( 'color_value', show_data( @$disable->color_id), false ),
                  'class="form-control form-control-sm mr-3"
                  id="color_value"'
                );

            //   echo form_input( array(
            //     'name' => 'color_value',
            //     'value' => set_value( 'color_value', show_data($data[0]->color_value), false ),
            //     'class' => 'form-control form-control-sm',
            //     'placeholder' => get_msg('color_value'),
            //     'id' => 'color_value',
            //     'readonly' => "true"
            //   ));
              ?>



              <!--transmission-->


               <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
              Transmission
              </label>
              <?php
             $transdata = $this->db->get_where('bs_items_transmissions', array('status' => 1)) ->result();
                $options=array();
                $options[0]= 'Select Transmission';
                foreach($transdata as $trans) {
                    $options[$trans->id]=$trans->name;
                }

                echo form_dropdown(
                  'transmissions',
                  $options,
                  set_value( 'transmissions', show_data( @$disable->transmission_id), false ),
                  'class="form-control form-control-sm mr-3"
                  id="transmissions"'
                );

            ?>




              <?php
            //   echo form_input( array(
            //     'name' => 'transmissions',
            //     'value' => set_value( 'transmissions', show_data($data[0]->name), false ),
            //     'class' => 'form-control form-control-sm',
            //     'placeholder' => get_msg('transmissions'),
            //     'id' => 'transmissions',
            //     'readonly' => "true"
            //   ));
              ?>

            </div>

            </div>

				<?php endif; ?>

            <?php if ($disable->manufacturer_id != "-2"): ?>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('model_search_manu')?>
              </label>

              <?php
              if($disable->manufacturer_id==-1){
                  echo "<br>";
                  echo "<p>" . $disable->manufacturer_name . "</p>";
              }
              else{
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
                  set_value( 'manufacturer_id', show_data( @$disable->manufacturer_id), false ),
                  'class="form-control form-control-sm mr-3"

                  id="manufacturer_id"'
                );
              }

              ?>
            </div>
            <?php endif; ?>

            <?php if ($disable->manufacturer_id != "-2"): ?>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('select_model')?>
              </label>

              <?php
                if(isset($disable)) {
                    if($disable->model_id==-1){
                         echo "<br>";
                  echo "<p>" . $disable->model_name . "</p>";
                    }else{
                        $options=array();
                   $options[0]=get_msg('select_model');
                  $conds['manufacturer_id'] = $disable->manufacturer_id;
                  $models = $this->Model->get_all_by($conds);
                  foreach($models->result() as $model) {
                    $options[$model->id]=$model->name;
                  }
                  echo form_dropdown(
                    'model_id',
                    $options,
                    set_value( 'model_id', show_data( @$disable->model_id), false ),
                    'class="form-control form-control-sm mr-3" id="model_id"'
                  );
                    }
                } else {
                  $conds['manufacturer_id'] = $selected_manufacturer_id;
                  $options=array();
                  $options[0]=get_msg('select_model');

                  echo form_dropdown(
                    'model_id',
                    $options,
                    set_value( 'model_id', show_data( @$disable->model_id), false ),
                    'class="form-control form-control-sm mr-3" id="model_id"'
                  );
                }

              ?>

            </div>
            <?php endif;?>

           <?php if ($disable->manufacturer_id != "-2"
        //   && $disable->item_type_id != null
           ): ?>

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
                  set_value( 'item_type_id', show_data( @$disable->item_type_id), false ),
                  'class="form-control form-control-sm mr-3" id="item_type_id"'
                );
              ?>
            </div>
            <?php endif ?>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_location')?>
              </label>

              <?php

                $options=array();
                $options[0]=get_msg('itm_select_location');
                $locations = $this->Itemlocation->get_all();
                foreach($locations->result() as $location) {
                    $options[$location->id]=$location->name;
                }

                echo form_dropdown(
                  'item_location_id',
                  $options,
                  set_value( 'item_location_id', show_data( @$disable->item_location_id), false ),
                  'class="form-control form-control-sm mr-3" id="item_location_id"'
                );
              ?>
            </div>


             <?php if ($disable->description != null): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('item_description_label')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'description',
                'value' => set_value( 'description', show_data( @$disable->description), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('item_description_label'),
                'id' => 'description',
                'rows' => "3",
                // 'readonly' => "true"
              )); ?>

            </div>
            <? endif; ?>

            <?php if ($disable->highlight_info != null): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('prd_high_info')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'highlight_info',
                'value' => set_value( 'info', show_data( @$disable->highlight_info), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('ple_highlight_info'),
                'id' => 'info',
                'rows' => "3",
                // 'readonly' => "true"
              )); ?>

            </div>
            <?php endif; ?>

            <div class="col-md-12">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
              <?php echo get_msg('Package Details')?>
              </label>
              <?php   if( $disable->package_detail){ ?>
              <div style="font-size:16px;"><?php

               $data_get =  json_decode(htmlspecialchars_decode($disable->package_detail));
               if(!empty($data_get)){
                   setlocale(LC_MONETARY,"en_Euro");
                   ?>
                    <table class='table table-bordered table-striped' class='width:100%'>
                        <thead>
                            <tr>
                                <th width = '30%'>Package</th>
                                <th width = '30%'>Amount</th>
                                <th width = '40%'>Month</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td><?php if($data_get->package_id == 'basic'){
                                echo "Basic";
                            }else if($data_get->package_id == 'pro'){
                                echo "Standard";
                            }else if($data_get->package_id == 'exc'){
                                echo "Executive";
                            }else if($data_get->package_id == 'vip'){
                                echo "VIP";
                            }?></td>
                            <td><?=number_format($data_get->amount,0)?></td>
                            <td><?=$data_get->month?> Months</td>
                        </tbody>

                    </table>
                <?php
               }
            //     var_dump($data_get);
            //     echo $disable->package_detail;
            //   print_r($data_get);

              ?></div>
               <?php  }else{ ?>
                <h3 style="color:red;">Not Avialable</h3>
               <?php } ?>
            </div>

          </div>
          <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo 'Request Expiry' ?>
              </label>

        <input type="datetime-local" class="form-control" name="expiry_date" required value="<?php echo isset($disable->expiry_date) ?
        // set_value(
        $disable->expiry_date
        // , date('Y-m-d', strtotime($disable->expiry_date)))
        : set_value('expiry_date'); ?>">


              <?php
            //   echo '<br><input type="datetime-local" id="expiry-date" name="expiry-date">';

              ?>

            </div>

          </div>

          <div class="col-md-6">
              <?php if ($disable->manufacturer_id != "-2"): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('price')?>
              </label>

              <?php echo form_input( array(
                'name' => 'price',
                'value' => set_value( 'price', show_data( @$disable->price), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('price'),
                'id' => 'price',
                // 'readonly' => "true"
              )); ?>

            </div>
            <?php endif; ?>
            <div class="col-md-6">

            <?php if ($disable->engine_power != null || true): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('Engine Power')?>
              </label>

              <?php echo form_input( array(
                'name' => 'power',
                'value' => set_value( 'power', show_data( @$disable->engine_power), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('power'),
                'id' => 'power',
                // 'readonly' => "true"
              )); ?>

            </div>
            <?php endif; ?>



            <?php if ($disable->item_price_type_id != null  || true): ?>
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
                  set_value( 'item_price_type_id', show_data( @$disable->item_price_type_id), false ),
                  'class="form-control form-control-sm mr-3" id="item_price_type_id"'
                );
              ?>
            </div>
            <?php endif; ?>


            <?php if ($disable->item_currency_id != null || true): ?>
            <!-- <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_currency')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('itm_select_currency');
                $currency = $this->Currency->get_all_by($conds);
                foreach($currency->result() as $curr) {
                    $options[$curr->id]=$curr->currency_short_form;
                }

                echo form_dropdown(
                  'item_currency_id',
                  $options,
                  set_value( 'item_currency_id', show_data( @$disable->item_currency_id), false ),
                  'class="form-control form-control-sm mr-3" id="item_currency_id"'
                );
              ?>
            </div> -->
            <?php endif; ?>

            <?php if ($disable->manufacturer_id != -2): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_condition_of_item')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('condition_of_item');
                $conditions = $this->Condition->get_all_by($conds);
                foreach($conditions->result() as $cond) {
                    $options[$cond->id]=$cond->name;
                }

                echo form_dropdown(
                  'condition_of_item_id',
                  $options,
                  set_value( 'condition_of_item_id', show_data( @$disable->condition_of_item_id), false ),
                  'class="form-control form-control-sm mr-3" id="condition_of_item_id"'
                );
              ?>
            </div>
            <?php endif; ?>




            <?php if ($disable->plate_number != null || true): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                Number Plate
              </label>

              <?php echo form_input( array(
                'name' => 'plate_number',
                'value' => set_value( 'plate_number', show_data( @$disable->plate_number), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => "Number Plate",
                'id' => 'plate_number',
                // 'readonly' => "true"
              )); ?>

            </div>
            <?php endif; ?>
            <?php if ($disable->manufacturer_id != "-2"
            // && $disable->mileage != null
            ): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                Kilometer (KM)
              </label>

              <?php echo form_input( array(
                'name' => 'mileage',
                'value' => set_value( 'mileage', show_data( @$disable->mileage), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('Mileage(KM)'),
                'id' => 'mileage',
                // 'readonly' => "true"
              )); ?>

            </div>
            <?php endif; ?>

            <?php if ($disable->fuel_type_id != null || true): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
               Fuel Type
              </label>
              <?php
            //  $data = $this->db->get_where('bs_items_fuel_types', array('id' => $disable->fuel_type_id)) ->result();
            // print_r($data[0]->fuel_name);
            ?>
              <?php


               $options=array();;
                $options[0]="Select Fuel Type";
                $fueltypes = $this->db->get_where('bs_items_fuel_types', array('status' => 1)) ->result();
                foreach($fueltypes as $fuel) {
                    $options[$fuel->id]=$fuel->fuel_name;
                }

                echo form_dropdown(
                  'fuel_type_id',
                  $options,
                  set_value( 'fuel_type_id', show_data( @$disable->fuel_type_id), false ),
                  'class="form-control form-control-sm mr-3" id="fuel_type_id"'
                );


            //   echo form_input( array(
            //     'name' => 'fuel_type',
            //     'value' => set_value( 'fuel_type', show_data($data[0]->fuel_name), false ),
            //     'class' => 'form-control form-control-sm',
            //     'placeholder' => get_msg('fuel_type'),
            //     'id' => 'fuel_type',
            //     // 'readonly' => "true"
            //   ));
              ?>

            </div>
            <?php endif; ?>


            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                Sell Type
              </label>

              <?php
              echo form_input( array(
                'name' => 'sell_type',
                'value' => set_value( 'sell_type', show_data( @$disable->sell_type), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('sell_type'),
                'id' => 'sell_type',
                'readonly' => "true"
              )); ?>

            </div>


            <?php if ($disable->manufacturer_id != "-2" && $disable->year != null): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                Year
              </label>

              <?php echo form_input( array(
                'name' => 'year',
                'value' => set_value( 'year', show_data( @$disable->year), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('year'),
                'id' => 'year',
                'readonly' => "true"
              )); ?>

            </div>
            <?php endif; ?>

            <?php if ($disable->manufacturer_id == "-2" && $disable->service_area != null): ?>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                Service Area:
              </label>

                <p><?php echo $disable->service_area; ?></p>

            </div>
            <?php endif; ?>


          </div>







          <!-- <div class="col-md-6">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('brand_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'brand',
                'value' => set_value( 'brand', show_data( @$disable->brand), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('brand_label'),
                'id' => 'brand',
                'readonly' => 'true'
              )); ?>

            </div>

          </div> -->

             <div class="col-md-6">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
              <?php echo get_msg('Phone Number')?>
              </label>
              <?php   if( $disable->phone_number){ ?>
              <h2 style="color:red;"><?php  echo  $disable->phone_number ?></h2>
               <?php  }else{ ?>
                <h3 style="color:red;">Not Avialable</h3>
               <?php } ?>
            </div>

          </div>

        <?php if ($disable->manufacturer_id != "-2"): ?>

          <div class="col-md-6">
            <div class="form-group">
              <div class="form-check">
                <label>

                <?php echo form_checkbox( array(
                  'name' => 'business_mode',
                  'id' => 'business_mode',
                  'value' => 'accept',
                  'checked' => set_checkbox('business_mode', 1, ( @$disable->business_mode == 1 )? true: false ),
                  'class' => 'form-check-input',
                  'onclick' => 'return false'
                )); ?>

                <?php echo get_msg( 'itm_business_mode' ); ?>
                <br><?php echo get_msg( 'itm_show_shop' ) ?>
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
                  'checked' => set_checkbox('is_sold_out', 1, ( @$disable->is_sold_out == 1 )? true: false ),
                  'class' => 'form-check-input',
                  'onclick' => 'return false'
                )); ?>

                <?php echo get_msg( 'itm_is_sold_out' ); ?>

                </label>
              </div>
            </div>
            <!-- form group -->
          </div>
          <?php endif ?>

            <?php if ($disable->address != null || true): ?>

          <div class="col-md-6">
             <br><br>
            <legend><?php echo get_msg('location_info_label'); ?></legend>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_address_label')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'address',
                'value' => set_value( 'address', show_data( @$disable->address), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_address_label'),
                'id' => 'address',
                'rows' => "5",
                // 'readonly' => 'true'
              )); ?>

            </div>
          </div>
          <?php endif; ?>


          <?php if (  @$disable->lat !='0' && @$disable->lng !='0' ):?>
          <div class="col-md-6">
            <div id="disable_map" style="width: 100%; height: 400px;"></div>
            <div class="clearfix">&nbsp;</div>
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
                  'value' => set_value( 'lat', show_data( @$disable->lat ), false ),
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
                  'value' =>  set_value( 'lat', show_data( @$disable->lng ), false ),
                  'readonly' => 'true'
                ));
              ?>
            </div>
            <!-- form group -->
          </div>

          <?php endif ?>

        </div>

        <div>
                <h3>Bank Slip</h3>
                <?php   if($disable->slip_url) {  ?>
                <img src="<?php echo base_url().$disable->slip_url  ?>" style="width:400px" alt="">
                <?php }else{?>
                  <h3 style="color:red;">Not Available</h3>

                <?php } ?>
                </div>
                </div>

        <!-- row -->
        <hr>
        <div class="form-group" style="background-color: #edbbbb; padding: 20px;">
          <label>
            <strong><?php echo get_msg('select_status')?></strong>
          </label>

          <select id="item_is_published" name="item_is_published" class="form-control">
             <option value="1" <?php if($disable->status == '1')echo("selected")?> >Approved</option>
             <option value="2" <?php if($disable->status == '2')echo("selected")?> >Disable</option>
             <option value="3" <?php if($disable->status == '3')echo("selected")?> >Reject</option>
          </select>
        </div>
      </div>

        <!-- Grid row -->
        <?php if ( isset( $disable )): ?>
        <div class="gallery" id="gallery" style="margin-left: 15px; margin-bottom: 15px;">
          <?php
              $conds = array( 'img_type' => 'item', 'img_parent_id' => $disable->id );
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
        <?php endif; ?>



      <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 3px;">
          <?php echo get_msg('btn_save')?>
        </button>

        <a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary" style="margin-top: 3px;">
          <?php echo get_msg('btn_cancel')?>
        </a>
      </div>
    </form>
  </div>
</section>