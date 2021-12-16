<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8" />
       <title>Admin | <?php echo $settings['meta_title']?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('UBold_v4.1.0')?>/assets/images/favicon.ico">

		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
      
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
		 
		<!-- App css -->
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
  
        <!-- icons -->
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
		<style>
		.ms-container { width:100%;
			max-width: 700px;
		}
		</style>

    </head>

    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">

           <?php echo view('superadmin/header')?>

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
                                             <li class="breadcrumb-item"><a href="<?php echo base_url('superadmin/dashboard')?>"><?php echo lang('app.menu_dashboard')?></a></li>
											 <li class="breadcrumb-item"><a href="<?php echo base_url('superadmin/ente')?>"><?php echo lang('app.menu_ente')?></a></li>
											  <li class="breadcrumb-item active"><?php echo lang('app.menu_new')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_edit_ente')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                             <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                  	<div class="alert alert-danger" role="alert" id="error_alert" style="display:none"></div>    
<?php $attributes = ['class' => 'form-input-flat', 'id' => 'add_ente_form','method'=>'post'];
													echo form_open('', $attributes);?>
													<input type="hidden" name="id" value="<?php echo $inf['id']?>">
													<input type="hidden" name="id_profile" value="<?php echo $inf_profile['id']?>">
													<input type="hidden" name="id_package" value="<?php echo $inf_package['id']?>">
                                        <div id="rootwizard">
                                            <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                                                <li class="nav-item" data-target-form="#accountForm">
                                                    <a href="#first" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-account-circle mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_account')?></span>
                                                    </a>
                                                </li>
												
                                                <li class="nav-item" data-target-form="#profileForm">
                                                    <a href="#third" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-face-profile mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_profile')?></span>
                                                    </a>
                                                </li>
												<li class="nav-item" data-target-form="#packageForm">
                                                    <a href="#second" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-package-variant-closed mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_package')?></span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" data-target-form="#profileForm">
                                                    <a href="#fourth" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-file-excel-outline mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_fattura')?></span>
                                                    </a>
                                                </li>
                                               
                                            </ul>

                                            <div class="tab-content mb-0 b-0 pt-0">

                                                <div class="tab-pane" id="first">
                                                    <div id="accountForm" >
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="email">Email <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="email" class="form-control" id="email" name="email" required value="<?php echo $inf['email']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="domain_ente"> <?php echo lang('app.field_server_name')?> <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="domain_ente" name="domain_ente" class="form-control" value="<?php echo $inf['domain_ente']?>" placeholder="<?php echo lang('app.help_server_name')?>" required>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
                                                </div>
											<div class="tab-pane fade" id="second">
                                                    <div id="packageForm" >
                                                        <div class="row">
														<div class="col-12">
														   <div class="form-group row mb-3">
																<label class="col-md-3 col-form-label" for="name3"><?php echo lang('app.field_expired_date')?> <span class="text-danger">*</span></label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="expired_date" id="expired_date" >
																</div>
															</div>
														</div>
														<?php $tab=json_decode($inf_package['package'],true);
														if(!isset($tab['extra'])) $tab['extra']=array();
														?>
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name3"><?php echo lang('app.field_type_cours')?> <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <div class="checkbox form-check-inline">
																			<input type="checkbox" name="type_cours[]" id="aula" value="aula" <?php if(in_array('aula',$tab['type_cours'])) echo 'checked'?>>
																			<label for="aula"> aula </label>
																		</div>
																		<div class="checkbox form-check-inline">
																			<input type="checkbox" name="type_cours[]" id="online" value="online" <?php if(in_array('online',$tab['type_cours'])) echo 'checked'?>>
																			<label for="online"> online </label>
																		</div>
																		<div class="checkbox form-check-inline">
																			<input type="checkbox" name="type_cours[]" id="webinar" value="webinar" <?php if(in_array('webinar',$tab['type_cours'])) echo 'checked'?>>
																			<label for="webinar"> webinar </label>
																		</div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <!-- end col -->
															 <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name3"><?php echo lang('app.field_package_extra')?></label>
                                                                    <div class="col-md-9">
                                                                        <div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="test" value="test"  <?php if(in_array('test',$tab['extra'])) echo 'checked'?>>
																			<label for="test"> <?php echo lang('app.field_test')?> </label>
																		</div>
																		 <div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="test_quality" value="test_quality" <?php if(in_array('test_quality',$tab['extra'])) echo 'checked'?>>
																			<label for="test_quality"> <?php echo lang('app.field_test_quality')?> </label>
																		</div>
																		 <div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="certificat" value="certificat" <?php if(in_array('certificat',$tab['extra'])) echo 'checked'?>>
																			<label for="certificat"> <?php echo lang('app.field_attesto')?> </label>
																		</div>
																		 <div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="coupon" value="coupon" <?php if(in_array('coupon',$tab['extra'])) echo 'checked'?>>
																			<label for="coupon"> <?php echo lang('app.field_coupon')?> </label>
																		</div>
																		<div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="fatturecloud" value="fatturecloud" <?php if(in_array('fatturecloud',$tab['extra'])) echo 'checked'?>>
																			<label for="fatturecloud"> <?php echo lang('app.field_fatture_cloud')?> </label>
																		</div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <!-- end row -->
											
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="third">
                                                    <div id="profileForm" >
														
                                                       			<div class="row">
																  
                                  
																  <div class="col-6">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_first_name')?></label>
									<div class="col-md-9">
										<?php $val=$inf_profile['nome']; 
										$input = [
												'type'  => 'text',
												'name'  => 'nome',
												'id'    => 'nome',
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
								        <?php $val=$inf_profile['cognome']; 
										$input = [
												'type'  => 'text',
												'name'  => 'cognome',
												'id'    => 'cognome',
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
                               <div class="col-6">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_phone')?></label>
                                    <div class="col-md-9">
										<?php $val=$inf_profile['telefono']; 
										$input = [
												'type'  => 'text',
												'name'  => 'telefono',
												'id'    => 'telefono',
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
								<div class="col-6">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_mobile')?></label>
                                    <div class="col-md-9">
										<?php $val=$inf_profile['mobile']; 
										$input = [
												'type'  => 'text',
												'name'  => 'mobile',
												'id'    => 'mobile',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_mobile'),
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
										<?php 
										$val=$inf_profile['residenza_stato']; 
										$input = [
												
												'name'  => 'residenza_stato',
												'id'    => 'residenza_stato',
												'placeholder' =>lang('app.field_country'),
												
												'class' => 'form-control'
										];
										$options=array();
										$options['']=lang('app.field_select');
										foreach($list_nazioni as $k=>$v){
											$options[$v['id']]=$v['nazione'];
										}
										$js = ' onChange="get_provincia(\'residenza_stato\',this.value);"';
										echo form_dropdown($input, $options,$val,$js);
										?>

									</div>
								</div>
                               </div>
                                   <div class="col-4" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_provincia')?></label>
                                    <div class="col-md-9" id="div_residenza_provincia">
										<?php $input = [
												
												'name'  => 'residenza_provincia',
												'id'    => 'residenza_provincia',
												'placeholder' =>lang('app.field_provincia'),
												'class' => 'form-control'
										];
										
											if($inf_profile['residenza_stato']==106){
										$options=array();
										$options['']=lang('app.field_select');
										if(!empty($list_provincia)){
										foreach($list_provincia as $k=>$v){
											$options[$v['id']]=$v['provincia'];
										}
										}
										$js = ' onChange="get_comune(\'residenza_provincia\',this.value);"';
										echo form_dropdown($input, $options,$inf_profile['residenza_provincia'],$js);
										}
										else{
											$input['value']=$inf_profile['residenza_provincia'];
											echo form_input($input);
										}
											
										
										?>
									</div>
								</div>
							</div>
                                   <div class="col-4" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_city')?></label>
									<div class="col-md-9" id="div_residenza_comune">
										<?php $input = [
												
												'name'  => 'residenza_comune',
												'id'    => 'residenza_comune',
												'placeholder' =>lang('app.field_city'),
												'class' => 'form-control'
										];
										
											if($inf_profile['residenza_stato']==106){
											$options=array();
											$options['']=lang('app.field_select');
											if(!empty($list_comuni)){
											foreach($list_comuni as $k=>$v){
												$options[$v['id']]=$v['comune'];
											}
											}
											echo form_dropdown($input, $options,$inf_profile['residenza_comune']);
										}
										else{
											$input['value']=$inf_profile['residenza_comune'];
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
										<?php $val=$inf_profile['residenza_indirizzo']; 
										$input = [
												'type'  => 'text',
												'name'  => 'residenza_indirizzo',
												'id'    => 'residenza_indirizzo',
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
										<?php $val=$inf_profile['residenza_cap']; 
										$input = [
												'type'  => 'text',
												'name'  => 'residenza_cap',
												'id'    => 'residenza_cap',
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
<div class="col-6">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_website')?></label>
                                    <div class="col-md-9">
										<?php $val=$inf_profile['site_web']; 
										$input = [
												'type'  => 'text',
												'name'  => 'site_web',
												'id'    => 'site_web',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_website'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
									</div>
								</div>
                               </div>	
<div class="col-12">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_note')?></label>
                                    <div class="col-md-9">
										<?php $val=$inf_profile['note']; 
										$input = [
												'type'  => 'textarea',
												'name'  => 'note',
												'id'    => 'note',
												'rows' =>3,
												'value' => $val,
												'placeholder' =>lang('app.field_note'),
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?>
									</div>
								</div>
                               </div>									   
								   		
														</div>
                                                        <!-- end row -->
                                                    </div>
                                                </div>

                                              	<div class="tab-pane fade" id="fourth">
                                                    <div id="profileForm" >
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
																  <div class="col-6"  id="div_fattura_nome" <?php if($inf_profile['type']=='company'){?>style="display:none" <?php } ?>>
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
                                  <div class="col-6"  id="div_fattura_cognome" <?php if($inf_profile['type']=='company'){?>style="display:none" <?php } ?>>
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
													</div>
												</div>

                                                <ul class="list-inline wizard mb-0">
                                                    <li class="previous list-inline-item"><a href="javascript: void(0);" class="btn btn-secondary"><?php echo lang('app.btn_prev');?></a>
                                                    </li>
                                                    <li class="next list-inline-item float-right"><a href="javascript: void(0);" class="btn btn-secondary btn-next"><?php echo lang('app.btn_next');?></a></li>
													 <li class="next list-inline-item float-right"><a href="javascript: void(0);" onclick="save_ente();" class="btn btn-success btn-finish"><?php echo lang('app.btn_finish');?></a></li>
                                                </ul>

                                            </div> <!-- tab-content -->
                                        </div> <!-- end #rootwizard-->
									<?php echo form_close()?>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <!-- end row-->
						 
                        <div class="row">
                    
                        </div> <!-- end row -->
                    </div> <!-- container -->

                </div> <!-- content -->
	
	
	<div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-success">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-checkmark h1 text-white"></i>
                                                            <h4 class="mt-2 text-white"><?php echo lang('app.success_add')?></h4>
                                                           
															<a href="<?php echo base_url('superadmin/ente')?>" class="btn btn-light my-2" ><?php echo lang('app.btn_continue')?></a>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
		   
                <!-- Footer Start -->
               <?php echo view('superadmin/footer');?> 
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
       
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
         <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/vendor.min.js"></script>

        <!-- plugin js -->
		   <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
		   <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/l10n/it.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/moment/min/moment.min.js"></script>
        
		
		 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/mohithg-switchery/switchery.min.js"></script>
       <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/js/select2.min.js"></script>
        <!--script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
		  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Todo app -->
        
    <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <!-- Sweet alert init js-->
     <script>
		$(document).ready(function(){
			"use strict";
			$("#expired_date").flatpickr({
				dateFormat: "Y-m-d",
				 altFormat: "F j, Y",
				 defaultDate:"<?php echo $inf_package['expired_date']?>",
				 altInput:!0,
				 locale: "it",
			});
			/*$("#basicwizard").bootstrapWizard(),
			$("#progressbarwizard").bootstrapWizard({onTabShow:function(t,r,a){var o=(a+1)/r.find("li").length*100;$("#progressbarwizard").find(".bar").css({width:o+"%"})}}),
			$("#btnwizard").bootstrapWizard({nextSelector:".button-next",previousSelector:".button-previous",firstSelector:".button-first",lastSelector:".button-last"}),*/
			$("#rootwizard").bootstrapWizard({
				onTabShow: function(tab, navigation, index) {
					
					var $total = navigation.find('li').length;
					
					var $current = index+1;

					var wizard = navigation.closest('#rootwizard');

					// If it's the last tab then hide the last button and show the finish instead
					if($current >= $total) {
						$(wizard).find('.btn-next').hide();
						$(wizard).find('.btn-finish').show();
					} else {
						$(wizard).find('.btn-next').show();
						$(wizard).find('.btn-finish').hide();
					}
				},
				/*onNext:function(t,r,a){
					var o=$($(t).data("targetForm"));
					if(o&&(o.addClass("was-validated"),!1===o[0].checkValidity()))return event.preventDefault(),event.stopPropagation(),!1
				}*/
			})
		});
function save_ente(){
	var fields = $( "#add_ente_form" ).serializeArray();
	$.ajax({
				  url:"<?php echo base_url('Ente/edit_form_submit')?>",
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
	$("#div_fattura_cognome").hide(0);
	$("#div_fattura_nome").hide(0);
	switch(v){
		case 'private':
			$("#div_cf").show(0);
			$("#div_fattura_cognome").show(0);
			$("#div_fattura_nome").show(0);
		break;
		case 'professional':
			$("#div_cf").show(0);
			$("#div_piva").show(0);
			$("#div_sdi").show(0);
			$("#div_fattura_cognome").show(0);
			$("#div_fattura_nome").show(0);
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
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/app.min.js"></script>
    </body>
</html>