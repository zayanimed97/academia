<?= view('admin/common/header',array('page_title'=>lang('app.title_page_profile_fattura'))) ?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                           <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>"><?php echo lang('app.menu_dashboard')?></a></li>
                                            <li class="breadcrumb-item"><?php echo lang('app.menu_profile_setting')?></li>
                                            <li class="breadcrumb-item active"><?php echo lang('app.menu_fattura')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_profile_fattura')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                        
                        <div class="row" x-data="{ private: '<?= (($user['type'] ?? "") == "private") ? 'private' : 'company' ?>'}">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                     	<div class="alert alert-danger" role="alert" id="error_alert" style="display:none"></div>   
										<?php $inf_profile=$user?>
                                        <form method="post" action="<?= base_url('admin/profile/'. $profile_menu) ?>"  id='add_ente_form'>
										<input type="hidden" name="profile_menu" value="<?php echo $profile_menu?>">
                                        
                                                        	<div class="row">
															<div class="col-12">
                                                                
                                                                        <div class="radio form-check-inline">
																			<input type="radio" name="type" id="type_private" value="private" onclick="return get_type('private')" <?php if($inf_profile['type']=='private') echo 'checked'?>>
																			<label for="type_private"> <?php echo lang('app.field_type_private')?> </label>
																		
																		</div>
																		<div class="radio form-check-inline">
																			<input type="radio" name="type" id="type_professional" value="professional"  onclick="return get_type('professional')"  <?php if($inf_profile['type']=='professional') echo 'checked'?>>
																			<label for="type_professional"> <?php echo lang('app.field_type_professional')?> </label>
																		
																		</div>
																		 <div class="radio form-check-inline">
																		<input type="radio" name="type" id="type_company" value="company" onclick="return get_type('company')"  <?php if($inf_profile['type']=='company') echo 'checked'?>>
																			<label for="type_company"> <?php echo lang('app.field_type_company')?> </label>
																		
																		</div>
															</div>
														</div>
														<div class="row">
															 <div class="col-4" id="div_company"  <?php if($inf_profile['type']!='company'){?>style="display:none" <?php } ?>>
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_company_name')?></label>
									<div class="col-md-9">
										<?php $val=$inf_profile['ragione_sociale']; 
										$input = [
												'type'  => 'text',
												'name'  => 'ragione_sociale',
												'id'    => 'ragione_sociale',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_company_name'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
								</div>
                                  <div class="col-4" id="div_piva" <?php if($inf_profile['type']=='private'){?>style="display:none" <?php } ?>>
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_piva')?></label>
                                   <div class="col-md-9">
								        <?php $val=$inf_profile['fattura_piva']; 
										$input = [
												'type'  => 'text',
												'name'  => 'fattura_piva',
												'id'    => 'fattura_piva',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_piva'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
								</div>
								<div class="col-4" id="div_cf" >
														 <div class="form-group row mb-3">
													<label class="col-md-5 col-form-label" for="acc-name"><?php echo lang('app.field_cf')?></label>
													<div class="col-md-7">
														<?php $val=$val=$inf_profile['fattura_cf']; 
														$input = [
																'type'  => 'text',
																'name'  => 'fattura_cf',
																'id'    => 'fattura_cf',
																'required' =>true,
																'value' => $val,
																'placeholder' =>lang('app.field_cf'),
																'class' => 'form-control'
																
														];

														echo form_input($input);
														?>
													</div>
												</div>
										</div>
									</div>
									<div class="row">
																  <div class="col-6">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_first_name')?></label>
									<div class="col-md-9">
										<?php $val=$inf_profile['fattura_nome']; 
										$input = [
												'type'  => 'text',
												'name'  => 'fattura_nome',
												'id'    => 'fattura_nome',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_first_name'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
								</div>
                                  <div class="col-6">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_last_name')?></label>
                                   <div class="col-md-9">
								        <?php $val=$inf_profile['fattura_cognome']; 
										$input = [
												'type'  => 'text',
												'name'  => 'fattura_cognome',
												'id'    => 'fattura_cognome',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_last_name'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
								</div>
                              
								
								<div class="col-4">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_country')?></label>
                                    <div class="col-md-9">
										<?php $input = [
												
												'name'  => 'fattura_stato',
												'id'    => 'fattura_stato',
												'placeholder' =>lang('app.field_country'),
												'class' => 'form-control'
										];
										$options=array();
										$options['']=lang('app.field_select');
										foreach($list_nazioni as $k=>$v){
											$options[$v['id']]=$v['nazione'];
										}
										$js = ' onChange="get_provincia(\'fattura_stato\',this.value);"';
										echo form_dropdown($input, $options,$inf_profile['fattura_stato'],$js);
										?>

									</div>
								</div>
                               </div>
                                   <div class="col-4" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_provincia')?></label>
                                    <div class="col-md-9" id="div_fattura_provincia">
										<?php $input = [
												
												'name'  => 'fattura_provincia',
												'id'    => 'fattura_provincia',
												'placeholder' =>lang('app.field_provincia'),
												'class' => 'form-control'
										];
										
											if($inf_profile['fattura_stato']==106){
										$options=array();
										$options['']=lang('app.field_select');
										if(!empty($list_provincia)){
										foreach($list_provincia as $k=>$v){
											$options[$v['id']]=$v['provincia'];
										}
										}
										$js = ' onChange="get_comune(\'fattura_provincia\',this.value);"';
										echo form_dropdown($input, $options,$inf_profile['fattura_provincia'],$js);
										}
										else{
											$input['value']=$inf_profile['fattura_provincia'];
											echo form_input($input);
										}
										
										?>
									</div>
								</div>
							</div>
                                   <div class="col-4" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_city')?></label>
									<div class="col-md-9" id="div_fattura_comune">
										<?php $input = [
												
												'name'  => 'fattura_comune',
												'id'    => 'fattura_comune',
												'placeholder' =>lang('app.field_city'),
												'class' => 'form-control'
										];
										
											if($inf_profile['fattura_stato']==106){
											$options=array();
											$options['']=lang('app.field_select');
											if(!empty($list_comuni)){
											foreach($list_comuni as $k=>$v){
												$options[$v['id']]=$v['comune'];
											}
											}
											echo form_dropdown($input, $options,$inf_profile['fattura_comune']);
										}
										else{
											$input['value']=$inf_profile['fattura_comune'];
											echo form_input($input);
										}
									
										?>
                                    </div>
								</div>
								</div>
                                 <div class="col-6" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_address')?></label>
                                    <div class="col-md-9">
										<?php $val=$inf_profile['fattura_indirizzo']; 
										$input = [
												'type'  => 'text',
												'name'  => 'fattura_indirizzo',
												'id'    => 'fattura_indirizzo',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_address'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
								</div>
                                   <div class="col-6" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_zip')?></label>
                                    <div class="col-md-9">
										<?php $val=$inf_profile['fattura_cap']; 
										$input = [
												'type'  => 'text',
												'name'  => 'fattura_cap',
												'id'    => 'fattura_cap',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_zip'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
                               </div>
							    <div class="col-4">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_phone')?></label>
                                    <div class="col-md-9">
										<?php $val=$inf_profile['fattura_phone']; 
										$input = [
												'type'  => 'text',
												'name'  => 'fattura_phone',
												'id'    => 'fattura_phone',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_phone'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
							</div>
								<div class="col-4" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_pec')?></label>
                                    <div class="col-md-9">
										<?php $val=$inf_profile['fattura_pec']; 
										$input = [
												'type'  => 'text',
												'name'  => 'fattura_pec',
												'id'    => 'fattura_pec',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_pec'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
                               </div>
<div class="col-4" >
														 <div class="form-group row mb-3" id="div_sdi" <?php if($inf_profile['type']=='private'){?>style="display:none" <?php } ?>>
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_sdi')?></label>
                                    <div class="col-md-9">
										<?php $val=$inf_profile['fattura_sdi']; 
										$input = [
												'type'  => 'text',
												'name'  => 'fattura_sdi',
												'id'    => 'fattura_sdi',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_sdi'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
                               </div>							   
								
								
								   
														</div>
                                                   
                                                
                                                  
                                                            <button type="button" name="submit" class="btn btn-secondary" onclick="save_ente();"><?php echo lang('app.btn_save')?></button>
                                                      

                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

                        </div> 
                        <!-- end row -->

                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                  <?php echo view('admin/common/footer_bar')?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

            <!-- Center modal content -->
            <div class="modal fade" id="loading" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered justify-content-center">
                    <div class="modal-content" style="width: auto; background: transparent">
                        <div class="spinner-border avatar-lg text-primary m-2" role="status"></div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

	<div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-success">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-checkmark h1 text-white"></i>
                                                            <h4 class="mt-2 text-white"><?php echo lang('app.success_add')?></h4>
                                                       
															<a href="#" class="btn btn-light my-2 "  data-dismiss="modal" aria-hidden="true"><?php echo lang('app.btn_continue')?></a>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
<?= view('admin/common/footer') ?>

        <script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script>
        
        <!-- Plugins js-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>

        <!-- Init js-->
        <script>
            // form repeater Initialization
            $('.repeater-email').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                }
            }
            });

            $('.repeater-phone').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                }
            }
            });
 /* 
            function handleCountry(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=residenza_provincia&selected=<?= $user['fattura_provincia'] ?>`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.provincia = res)
                }
                else {
                    this.provincia = '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control">'
                    this.comuni = '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control">'
                }
            }

            function handleCountryFattura(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=fattura_provincia&selected=<?= $user['fattura_provincia'] ?>`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.fattura_provincia = res)
                }
                else {
                    this.fattura_provincia = '<input type="text" id="fattura_provincia" name="fattura_provincia" class="form-control">'
                    this.fattura_comuni = '<input type="text" id="fattura_comune" name="fattura_comune" class="form-control">'
                }
            }

          function getResData(){
                return {
                    stato: '<?= $user['residenza_stato'] ?>', 
                    comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control">', 
                    provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control">',

                    fattura_stato: '<?= $user['fattura_stato'] ?>', 
                    fattura_comuni: '<input type="text" id="fattura_comune" name="fattura_comune" class="form-control">', 
                    fattura_provincia : '<input type="text" id="fattura_provincia" name="fattura_provincia" class="form-control">',
                    init(){
                        Promise.allSettled([
                            new Promise((resolve, reject) => {if ('<?= $user['residenza_stato'] ?>' == '106') {
                                // $('#loading').modal('show');

                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['residenza_provincia'] ?>&name=residenza_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.provincia = res; resolve()})
                            } return resolve();}),


                            new Promise((resolve, reject) => {if ('<?= $user['residenza_stato'] ?>' == '106' && '<?= $user['residenza_provincia'] ?>') {
                                // $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['residenza_provincia'] ?>&selected=<?= $user['residenza_comune'] ?>&name=residenza_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.comuni = res; resolve()})
                            } return resolve();}),

                            
                            new Promise((resolve, reject) => {if ('<?= $user['fattura_stato'] ?>' == '106') {
                                // $('#loading').modal('show');

                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['fattura_provincia'] ?>&name=fattura_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.fattura_provincia = res; resolve()})
                            } return resolve();}),

                            new Promise((resolve, reject) => {if ('<?= $user['fattura_stato'] ?>' == '106' && '<?= $user['fattura_provincia'] ?>') {
                                // $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['fattura_provincia'] ?>&selected=<?= $user['fattura_comune'] ?>&name=fattura_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.fattura_comuni = res; resolve()})
                            } return resolve();})
                        ])
                        
                        .then(() => {
                            // $('#loading').modal('hide');
                            console.log('complete');
                        })
                    }
                }
                }
				*/
function save_ente(){
	var fields = $( "#add_ente_form" ).serializeArray();
	console.log(fields);
	$.ajax({
				  url:"<?php echo base_url('ProfileController/update')?>",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				
				
				var obj=JSON.parse(data);
				if(obj.error==true){
					$("#error_alert").html(obj.validation);
					$("#error_alert").show('slow');
				
				}
				else{
					$("#error_alert").hide('slow');
					$( "#success-alert-modal" ).modal('show');
				//	return true;
				}
			});
}
function get_type(v){
	$("#div_company").hide(0);
	$("#div_cf").hide(0);
	$("#div_piva").hide(0);
	$("#div_sdi").hide(0);
	switch(v){
		case 'private':
			$("#div_cf").show(0);
		break;
		case 'professional':
			$("#div_cf").show(0);
			$("#div_piva").show(0);
			$("#div_sdi").show(0);
		break;
		case 'company':
			$("#div_cf").show(0);
			$("#div_piva").show(0);
			$("#div_company").show(0);
			$("#div_sdi").show(0);
		break;
	}
}

function get_provincia(t,v,selected=''){
	
			$.ajax({
				  url:"<?php echo base_url()?>/ajax/get_provincia_by_nazione",
				  method:"POST",
				  data:{id_nazione:v,t:t,selected:selected}
				  
			}).done(function(data){
				if(t=='residenza_stato'){
					$("#div_residenza_provincia").html(data);
				/*	var xxx="<label class='col-form-label col-sm-3'><?php echo lang('app.field_city')?></label><div class='col-sm-6'><input type='text' name='residenza_comune' id='residenza_comune' class='form-control form-control-sm'></div>";*/
					var xxx="<input type='text' name='residenza_comune' id='residenza_comune' class='form-control'>";
					$("#div_residenza_comune").html(xxx);
				}
				if(t=='fattura_stato'){
					$("#div_fattura_provincia").html(data);
					var xxx="<label class='col-form-label col-sm-3'><?php echo lang('app.field_city')?></label><div class='col-sm-6'><input type='text' name='fattura_comune' id='fattura_comune' class='form-control form-control-sm'></div>";
					$("#div_fattura_comune").html(xxx);
				}
			});
		}
function get_comune(t,v,selected=''){
	
			$.ajax({
				  url:"<?php echo base_url()?>/ajax/get_comune_by_provincia",
				  method:"POST",
				  data:{id_provincia:v,t:t,selected:selected}
				  
			}).done(function(data){
				console.log(data);
				if(t=='residenza_provincia'){
					$("#div_residenza_comune").html(data);
				}
				if(t=='fattura_provincia'){
					$("#div_fattura_comune").html(data);
				}
			});
		}
        </script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-wizard.init.js"></script>

<?= view('admin/common/endtag') ?>
