<?php
	$attributes = array( 'id' => 'pending-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
	$pending = $pending;
// 	print_r($pending);
?>
<?php
			$manufacturer_name = '';
			$model_name = '';
            $color_name = '';
            $fule_type = '';
            $transmission = '';
            $location = '';
            $condition = '';
			if($pending->manufacturer_id == -2){
            	$manufacturer_name = $pending->service_area;
            }else if($pending->manufacturer_id == -1){
            	$manufacturer_name = $pending->manufacturer_name;
            }else{
            	$manufacturer_name = $this->Manufacturer->get_one( $pending->manufacturer_id )->name;
            }
            if($pending->model_id == -1){
            	$model_name = $pending->model_name;
            }else{
            	$model_name = $this->Model->get_one( $pending->model_id )->name;
            }
            if($pending->color_id){
                $color_name = $this->Color->get_one( $pending->color_id )->color_value;
            }
            if($pending->transmission_id){
                $transmission = $this->Transmission->get_one( $pending->transmission_id )->name;
            }
            if($pending->item_location_id){
                $location = $this->Itemlocation->get_one( $pending->item_location_id )->name;
            }
            if($pending->condition_of_item_id){
                $condition = $this->Condition->get_one( $pending->condition_of_item_id )->name;
            }
            // item_location_id
            			

?>

<section class="content animated fadeInRight">
    
 <div class='d-flex justify-content-center'>
     <div class="card w-100">
        <h1><span class='badge badge-danger'>Item # - <?= $pending->item_no ?></span></h1>
        <div class="card-body">
          	<div class="row">
          	    
          	    <div class="col-md-6">
          	        Name: <b><?php 
          	            if(empty($pending->title)){
          	                echo $manufacturer_name . " $model_name ". $pending->year;
          	            }else{
          	                echo $pending->title;
          	            }
          	        ?></b>
          	    </div>
          	     <?php if(!empty($manufacturer_name)){ ?>
              	    <div class="col-md-6">
              	        Make: <b><?= $manufacturer_name ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($model_name)){ ?>
              	    <div class="col-md-6">
              	        Model: <b><?= $model_name ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->year)){ ?>
              	    <div class="col-md-6">
              	        Year: <b><?= $pending->year ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->year)){ ?>
              	    <div class="col-md-6">
              	        Year: <b><?= $pending->year ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->item_type)){ ?>
              	    <div class="col-md-6">
              	        Tipo de carro: <b><?= $pending->item_type ?></b>
              	    </div>
          	    <?php } ?><?php if(!empty($pending->mileage)){ ?>
              	    <div class="col-md-6">
              	        Quilômetros: <b><?= $pending->mileage ?> KM</b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($color_name)){ ?>
              	    <div class="col-md-6">
              	        Cor: <b><?= $color_name ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($fule_type)){ ?>
              	    <div class="col-md-6">
              	        Tipo de combustível: <b><?= $fule_type ?></b>
              	    </div>
          	    <?php } ?><?php if(!empty($transmission)){ ?>
              	    <div class="col-md-6">
              	        Caixa: <b><?= $transmission ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->plate_number)){ ?>
              	    <div class="col-md-6">
              	        Matricula: <b><?= $pending->plate_number ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->price)){ ?>
              	    <div class="col-md-6">
              	        Preço: <b><?= $pending->price ?>KZ</b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->engine_power)){ ?>
              	    <div class="col-md-6">
              	        Poder do motor: <b><?= $pending->engine_power ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($condition)){ ?>
              	    <div class="col-md-6">
              	        Estado: <b><?= $condition ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($location)){ ?>
              	    <div class="col-md-6">
              	        Provincia: <b><?= $location ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->phone_number)){ ?>
              	    <div class="col-md-6">
              	        Número de telefone: <b><?= $pending->phone_number ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->second_phone_number)){ ?>
              	    <div class="col-md-6">
              	        Segundo número de telefone: <b><?= $pending->second_phone_number ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->email)){ ?>
              	    <div class="col-md-6">
              	        Email: <b><?= $pending->email ?></b>
              	    </div>
          	    <?php } ?>
          	    <?php if(!empty($pending->engine_power)){ ?>
              	    <div class="col-md-6">
              	        Poder do motor: <b><?= $pending->engine_power ?></b>
              	    </div>
          	    <?php } ?>
          	     <?php if(!empty($pending->engine_power)){ ?>
              	    <div class="col-md-12">
              	        Informações de destaque
              	        <div><?= $pending->engine_power ?></div>
              	    </div>
          	    <?php } ?>
          	</div>
      	</div>
     </div>
 </div>

</section>