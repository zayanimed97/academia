<?= view('admin/common/header',array('page_title'=>lang('app.title_page_cours_modulo_edit'))) ?>
 <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
		  <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
		  	<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
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
											 <li class="breadcrumb-item"><a href="<?php echo base_url('admin/corsi')?>"><?php echo lang('app.menu_corsi')?></a></li>
											  <li class="breadcrumb-item"><a href="<?php echo base_url('admin/corsi/'.$inf_corsi['id'].'/modulo')?>"><?php echo lang('app.menu_corsi_modulo')?></a></li>
											  <li class="breadcrumb-item active"><?php echo lang('app.edit_modulo')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.title_page_cours_modulo_edit') ?></h4>:&nbsp;  <h5><?php echo $inf_corsi['sotto_titolo']?></h5>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                     <div class="row">
                             <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                  	<div class="alert alert-danger" role="alert" id="error_alert" style="display:none"></div>    
<?php $attributes = ['class' => 'form-input-flat', 'id' => 'add_corsi_form','method'=>'post'];
													echo form_open_multipart('', $attributes);?>
													<input type="hidden" name="id_corsi" value="<?php echo $inf_corsi['id']?>">
													<input type="hidden" name="id_modulo" value="<?php echo $inf_modulo['id']?>">
                                        <div id="rootwizard">
                                            <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                                                <li class="nav-item" data-target-form="#accountForm">
                                                    <a href="#tab_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-format-list-bulleted mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi_info')?></span>
                                                    </a>
                                                </li>
												 <li class="nav-item" data-target-form="#packageForm">
                                                    <a href="#tab_details" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-information-variant mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi_details')?></span>
                                                    </a>
                                                </li>
												
												 <li class="nav-item" data-target-form="#packageForm">
                                                    <a href="#tab_price" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-currency-eur mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi_price')?></span>
                                                    </a>
                                                </li>
												<?php switch($inf_corsi['tipologia_corsi']){
													case 'aula':?>
												<li class="nav-item" data-target-form="#aulaDateForm">
                                                    <a href="#tab_aula_date" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-calendar mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi_date')?></span>
                                                    </a>
                                                </li>
												<?php break;
												case 'webinar':?>
												<li class="nav-item" data-target-form="#webinarDateForm">
                                                    <a href="#tab_webinar_date" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-calendar mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi_date')?></span>
                                                    </a>
                                                </li>
												<?php break;
												case 'online':?>
												<li class="nav-item" data-target-form="#onlineForm">
                                                    <a href="#tab_vimeo" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-video mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi_vimeo')?></span>
                                                    </a>
                                                </li>
												<?php break;
												}?>
												 <li class="nav-item" data-target-form="#packageForm">
                                                    <a href="#tab_gallery" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-folder-multiple-image mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi_gallery')?></span>
                                                    </a>
                                                </li>
												 <li class="nav-item" data-target-form="#packageForm">
                                                    <a href="#tab_attachment" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-link mr-1"></i>
														<span class="d-none d-sm-inline"><?php echo $inf_corsi['tipologia_corsi'] == 'eBook' ? 'eBook' : lang('app.menu_corsi_attachment')?></span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" data-target-form="#profileForm">
                                                    <a href="#tab_seo" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-monitor-eye mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi_seo')?></span>
                                                    </a>
                                                </li>
                                               <?php if(in_array('test',$ente_package['extra']) && $inf_corsi['test_required']=='per_modulo'){?>
											   <li class="nav-item" data-target-form="#profileForm">
                                                    <a href="#tab_test" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-format-list-checks mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi_test')?></span>
                                                    </a>
                                                </li>
												<?php } ?>
                                            </ul>

                                            <div class="tab-content mb-0 b-0 pt-0">

                                                <div class="tab-pane" id="tab_info">
                                                    <div id="accountForm" >
                                                        <div class="row">
														<div class="col-md-2">
																<div class="form-group required-field">
																	<label for="acc-name"><?php echo lang('app.field_sort')?> <span class="text-danger">*</span></label>
																	<?php $val=$inf_modulo['ord'];
															$input = [
																	'type'  => 'number',
																	'name'  => 'ord',
																	'id'    => 'ord',
																	'required' =>true,
																	'value' => $val,
																	'min'=>1,
																	'placeholder' =>lang('app.field_title'),
																	'class' => 'form-control'
																	
															];

															echo form_input($input);
															?>
																  
																</div>
															</div>
															<div class="col-md-5">
																<div class="form-group required-field">
																	<label for="acc-name">Titolo della lezione <span class="text-danger">*</span></label>
																	<?php $val=$inf_modulo['sotto_titolo'];
															$input = [
																	'type'  => 'text',
																	'name'  => 'sotto_titolo',
																	'id'    => 'sotto_titolo',
																	'required' =>true,
																	'value' => $val,
																	'placeholder' =>lang('app.field_subtitle'),
																	'class' => 'form-control'
																	
															];

															echo form_input($input);
															?>
																  
																</div>
															</div>
															<div class="col-md-5">
																<div class="form-group required-field">
																	<label for="acc-name"><?php echo lang('app.field_subtitle')?> <span class="text-danger">*</span></label>
																	<?php $val=$inf_modulo['titolo'];
															$input = [
																	'type'  => 'text',
																	'name'  => 'titolo',
																	'id'    => 'titolo',
																	'required' =>true,
																	'value' => $val,
																	'placeholder' =>lang('app.field_title'),
																	'class' => 'form-control'
																	
															];

															echo form_input($input);
															?>
																  
																</div>
															</div>
                                                          <div class="col-md-3">
																<div class="form-group required-field">
																	<label for="acc-name"><?php echo lang('app.field_doctors')?>  <span class="text-danger">*</span></label>
																	<?php $val=""; 
														
															$input = [
																	
																	'id'    => 'ids_doctors',
																	'placeholder' =>lang('app.field_doctors'),
																	'data-allow-clear'=>'1',
																	'class' => 'form-control',
																	'data-toggle'=>"select2",
																	
															];
															$options=array();
														
															foreach($list_doctors as $k=>$v){
																$options[$v['id']]=$v['display_name'];
															}
															//var_dump($options);
															echo form_dropdown('instructor', $options,$inf_modulo['instructor'],$input);
															?>
																	
																</div>
															</div>
															
															<div class="col-md-3">
																<div class="form-group required-field">
																	<label for="acc-name"><?php echo lang('app.field_edition')?></label>
																	<?php $val=$inf_modulo['edition'];
															$input = [
																	'type'  => 'text',
																	'name'  => 'edition',
																	'id'    => 'edition',
																	'required' =>true,
																	'value' => $val,
																	'placeholder' =>lang('app.field_edition'),
																	'class' => 'form-control'
																	
															];

															echo form_input($input);
															?>
																  
																</div>
															</div>
															<?php if($inf_corsi['tipologia_corsi'] != 'eBook'){ ?>
															<div class="col-md-3">
																<div class="form-group required-field">
																	<label for="acc-name"><?php echo lang('app.field_crediti')?></label>
																	<?php $val=$inf_modulo['crediti'];
																		$input = [
																		'type'  => 'text',
																		'name'  => 'crediti',
																		'id'    => 'crediti',
																		'required' =>true,
																		'value' => $val,
																		'placeholder' =>lang('app.field_crediti'),
																		'class' => 'form-control'
																		
																		];

																		echo form_input($input);
																	?>
																
																</div>
															</div>
															<?php } ?>
															<div class="col-md-3">
																<div class="form-group required-field">
																	<label for="acc-name"><?php echo lang('app.field_code')?></label>
																	<?php $val=$inf_modulo['codice'];
															$input = [
																	'type'  => 'text',
																	'name'  => 'codice',
																	'id'    => 'codice',
																	'required' =>true,
																	'value' => $val,
																	'placeholder' =>lang('app.field_code'),
																	'class' => 'form-control'
																	
															];

															echo form_input($input);
															?>
																  
																</div>
															</div>
															<?php if($inf_corsi['tipologia_corsi']!="online" && $inf_corsi['tipologia_corsi']!="eBook"){?>
															<div class="col-md-2" id="div_inscrizione_aula" >
											 <div class="form-group">
                                                <label for="acc-mname"><?php echo lang('app.field_inscrizione_aula')?></label>
                                             <?php $val=""; 
										

										$input = [
												
												'name'  => 'inscrizione_aula',
												'id'    => 'inscrizione_aula',
												'placeholder' =>lang('app.field_inscrizione_aula'),
												'class' => 'form-control'
										];
										$options=array();
										$options['']=lang('app.field_select');
										$options['si']='si';
										$options['no']='no';
										
										
										echo form_dropdown($input, $options,$inf_modulo['inscrizione_aula']);
										?>
                                            </div>
										 </div>
										  <div class="col-md-2" id="div_nb_person_aula" >
											 <div class="form-group">
                                                <label for="acc-mname"><?php echo lang('app.field_nb_person_aula')?></label>
                                             <?php $val=$inf_modulo['nb_person_aula'];
										$input = [
												'type'  => 'number',
												'name'  => 'nb_person_aula',
													'min'  => '1',
												'id'    => 'nb_person_aula',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_nb_person_aula'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
                                            </div>
										 </div>
															<?php } ?>
										
											<?php if($inf_corsi['tipologia_corsi']!="eBook"){?>
										  		<div class="col-md-4">
																<div class="form-group required-field">
																	<label for="acc-name"><?php echo lang('app.field_duration')?> </label>
																	<?php $val=$inf_modulo['duration'];
															$input = [
																	'type'  => 'text',
																	'name'  => 'duration',
																	'id'    => 'duration',
																	
																	'value' => $val,
																	'placeholder' =>lang('app.field_duration'),
																	'class' => 'form-control'
																	
															];

															echo form_input($input);
															?>
																  
																</div>
															</div>
															<?php } ?>
											<div class="col-md-4">
													<div class="form-group required-field">
														<label for="acc-lastname">difficolt?? </label>
														<?php $input = [
														
														'name'  => 'difficulte',
														'id'    => 'difficulte',
														'placeholder' =>lang('app.field_type_formation'),
														'class' => 'form-control'
												];
												$options=array();
												$options['']=lang('app.field_select');
												$options['Base']='Base';
												$options['Intermedia']='Intermedia';
												$options['Avanzata']='Avanzata';
											
												echo form_dropdown($input, $options,$inf_modulo['difficulte'] ?? '');
												?>

													</div>
											</div>
										 <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                   
                                                                    <div class="col-md-9">
                                                                        <div class="checkbox form-check-inline">
																			<input type="checkbox" name="enable" id="enable" value="yes" <?php if($inf_modulo['status']=='si') echo 'checked'?>>
																			<label for="enable"> <?php echo lang('app.field_active_status')?> </label>
																		</div>
																		
																		
																		<?php /*if(in_array('test',$ente_package['extra'])){?>
																		<div class="checkbox form-check-inline">
																			<input type="checkbox" name="test_required" id="test_required" value="yes">
																			<label for="test_required"> <?php echo lang("app.field_test_required")?> </label>
																		
																		</div>
																		<?php }*/ ?>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div>
                                                </div>
											<div class="tab-pane fade" id="tab_details">
                                                    <div id="packageForm" >
                                                       <div class="row">
									 <div class="col-lg-12">
									    <!-- begin panel -->
                        <div class="panel">
                            <ul class="nav nav-tabs">
                              
                                <li class="nav-item"><a class="nav-link active" href="#default-tab-2" data-toggle="tab"><?php echo lang('app.field_descizione')?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#default-tab-3" data-toggle="tab"><?php echo lang('app.field_obiettivi')?></a></li>
								
								<li class="nav-item"><a class="nav-link" href="#default-tab-4" data-toggle="tab"><?php echo lang('app.field_programa')?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#default-tab-5" data-toggle="tab"><?php echo lang('app.field_note')?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#default-tab-6" data-toggle="tab"><?php echo lang('app.field_riferimenti')?></a></li>
								
								 <li class="nav-item"><a class="nav-link" href="#default-tab-7" data-toggle="tab"><?php echo lang('app.field_indrizzato_a')?></a></li>
								 <li class="nav-item"><a class="nav-link" href="#default-tab-8" data-toggle="tab"><?php echo lang('app.field_avvisi')?></a></li>
								 
                            </ul>
                            <div class="tab-content m-b-0">
                               
								 <div class="tab-pane fade show active" id="default-tab-2">
								 <?php $val=$inf_modulo['description'];
										$input = [
												'rows'=>3,
												'name'  => 'descizione',
												'id'    => 'descizione',
												'value' => $val,
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?>
												
								 </div>
								 <div class="tab-pane fade" id="default-tab-3">
								 <?php $val=$inf_modulo['obiettivi'];
										$input = [
												'rows'=>3,
												'name'  => 'obiettivi',
												'id'    => 'obiettivi',
												'value' => $val,
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?>
								 </div>
								 <div class="tab-pane fade" id="default-tab-4">
								  <?php $val=$inf_modulo['programa'];
										$input = [
												'rows'=>3,
												'name'  => 'programa',
												'id'    => 'programa',
												'value' => $val,
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?>
								 </div>
								 <div class="tab-pane fade" id="default-tab-5">
								  <?php $val=$inf_modulo['note'];
										$input = [
												'rows'=>3,
												'name'  => 'note',
												'id'    => 'note',
												'value' => $val,
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?>
								 </div>
								 <div class="tab-pane fade" id="default-tab-6">
								  <?php $val=$inf_modulo['riferimenti'];
										$input = [
												'rows'=>3,
												'name'  => 'riferimenti',
												'id'    => 'riferimenti',
												'value' => $val,
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?>
								 </div>
								 <div class="tab-pane fade" id="default-tab-7">
								  <?php $val=$inf_modulo['indrizzato_a'];
										$input = [
												'rows'=>3,
												'name'  => 'indrizzato_a',
												'id'    => 'indrizzato_a',
												'value' => $val,
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?>
								 </div>
								 <div class="tab-pane fade" id="default-tab-8">
								  <?php $val=$inf_modulo['avvisi'];
										$input = [
												'rows'=>3,
												'name'  => 'avvisi',
												'id'    => 'avvisi',
												'value' => $val,
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?>
								 </div>
								  
							</div>
						</div>
						
						</div><!-- end col -->
						
									
									 
										
									</div>
                                                        <!-- end row -->
											
                                                    </div>
                                                </div>
												
                                                <div class="tab-pane fade" id="tab_price">
                                                    <div id="profileForm" >
													<?php if($inf_corsi['buy_type']=='date' ){?>
															<div class="alert alert-info"><?php echo lang('app.help_tabprice_buy_type_date')?></div>
														<?php } ?>			   
													<?php if($inf_corsi['buy_type']!='cours' && $inf_corsi['free']=='no'){?>	 
													 <div class="row">
															
															 <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name3"><?php echo lang('app.field_free_modulo')?></label>
                                                                    <div class="col-md-9">
                                                                
                                                                        <div class="radio form-check-inline">
																			<input type="radio" name="free" id="free_no" value="no" <?php if($inf_modulo['free']=='no') echo 'checked'?> >
																			<label for="free_no"> <?php echo lang('app.no')?> </label>
																		
																		</div>
																		 <div class="radio form-check-inline">
																		<input type="radio" name="free" id="free_yes" value="yes" <?php if($inf_modulo['free']=='yes') echo 'checked'?> >
																			<label for="free_yes"> <?php echo lang('app.yes')?> </label>
																		
																		</div>
															</div>
														</div>
													</div>
														</div>	
												<div id="div_not_free" <?php if($inf_modulo['free']=='yes'){?>style="display:none"<?php }?>>						
											 <div class="row">
										 <div class="col-md-4">
										  <div class="form-check form-check-inline m-t-20">
											<?php 
											if($inf_modulo['have_def_price']=='yes') $chk=true; else $chk=false;
											
											$data = [
											'name'    => "have_def_price",
											'id'      => 'have_def_price',
											'value'   =>'enable',
											'checked' => $chk,
											'class' => 'form-check-input',
											'onchange'=>'check_def_price()'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_have_def_price")?></label>
											</div>
										 </div>
										 <div class="col-md-6" id="div_prezzo" <?php if($inf_modulo['have_def_price']=='no'){?> style="display:none"<?php }?>>
                                             <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="email"><?php echo lang('app.field_price')?></label>
												<div class="col-md-9">
												<?php $val=$inf_modulo['prezzo'];
										$input = [
												'type'  => 'text',
												'name'  => 'prezzo',
												'id'    => 'prezzo',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_price'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
                                              </div>
                                            </div>
                                        </div>
									
									</div>
									<div class="row m-b-10"  >
											
												  
													<h4 class="panel-title"><?php echo lang('app.title_section_modulo_prezzo_prof')?></h4>
												
													<div class="repeater-prezzo-prof m-t-30 col-md-12">
														<div data-repeater-list="prezzo_prof">
														<?php if(!empty($list_prezzo_prof)){
															foreach($list_prezzo_prof as $k=>$v){?>
																<div data-repeater-item="">
															<div class="row">
																 <div class="col-md-3">
																		<div class="form-group required-field">
																			<label for="acc-name"><?php echo lang('app.field_price')?></label>
																			<?php $val=$v['prezzo']; 
																				$input = [
																						'type'  => 'text',
																						'name'  => 'prezzo_prof',
																						'id'    => 'prezzo_prof',
																						'required' =>true,
																						'value' => $val,
																					
																						'placeholder' =>lang('app.field_price'),
																						'class' => 'form-control'
																						
																				];

																				echo form_input($input);
																				?>
																		  
																		</div>
																	</div>
																	 
																	<div class="col-md-3">
																		<div class="form-group required-field">
																			<label for="acc-name"><?php echo lang('app.field_professione')?></label>
																			<?php $val=$v['id_professione']; 
																
																	$input = [
																			'name'    => 'prezzo_prof_id',
																			'id'    => 'prezzo_prof_id',
																			'placeholder' =>lang('app.field_professione'),
																			'data-allow-clear'=>'1',
																			'class' => 'form-control prezzo_prof_id'
																	];
																	$options=array();
																
																	foreach($list_prof as $k=>$v){
																		$options[$v['idprof']]=$v['professione'];
																	}
																	//var_dump($options);
																	echo form_dropdown($input, $options,$val);
																	?>
																			
																		</div>
																	</div>
																 <div class="col-md-4 m-t-25" >
																	 <input class="btn btn-danger" data-repeater-delete type="button" value="<?php echo lang('app.btn_delete')?>"/>
																</div>
															</div>
															</div>
															<?php }
														}else{?>
															<div data-repeater-item="">
															<div class="row">
																 <div class="col-md-3">
																		<div class="form-group required-field">
																			<label for="acc-name"><?php echo lang('app.field_price')?></label>
																			<?php $val=""; 
																				$input = [
																						'type'  => 'text',
																						'name'  => 'prezzo_prof',
																						'id'    => 'prezzo_prof',
																						'required' =>true,
																						'value' => $val,
																					
																						'placeholder' =>lang('app.field_price'),
																						'class' => 'form-control'
																						
																				];

																				echo form_input($input);
																				?>
																		  
																		</div>
																	</div>
																	 
																	<div class="col-md-3">
																		<div class="form-group required-field">
																			<label for="acc-name"><?php echo lang('app.field_professione')?></label>
																			<?php $val=""; 
																
																	$input = [
																			'name'    => 'prezzo_prof_id',
																			'id'    => 'prezzo_prof_id',
																			'placeholder' =>lang('app.field_professione'),
																			'data-allow-clear'=>'1',
																			'class' => 'form-control prezzo_prof_id'
																	];
																	$options=array();
																
																	foreach($list_prof as $k=>$v){
																		$options[$v['idprof']]=$v['professione'];
																	}
																	//var_dump($options);
																	echo form_dropdown($input, $options);
																	?>
																			
																		</div>
																	</div>
																 <div class="col-md-4 m-t-25" style="margin-top:25px">
																	 <input class="btn btn-danger" data-repeater-delete type="button" value="<?php echo lang('app.btn_delete')?>"/>
																</div>
															</div>
															</div>
														<?php } ?>
														</div>
														<input data-repeater-create class="btn btn-warning" type="button" value="<?php echo lang('app.btn_add')?>"/>
													</div>
									</div>
									</div>
									<?php }
										elseif($inf_corsi['free']=='yes'){?>
										<div class="row">
											<div class="alert alert-warning"><?php echo lang('app.help_tabprice_is_free_cours')?></div>
										</div>
										<?php }
											else{?>
										<div class="row">
											<div class="alert alert-warning"><?php echo lang('app.help_tabprice_buy_type')?></div>
										</div>
									<?php } ?>
                                                    </div>
                                                </div>
												
												<?php switch($inf_corsi['tipologia_corsi']){
												case 'aula':?>
													<div class="tab-pane fade" id="tab_aula_date">
                                                    <div id="aulaDateForm" >
													<div class="row">
														<div class="repeater-corsidate m-t-30 col-md-12">
														<div data-repeater-list="corsidate">
														<?php if(!empty($corsi_date)){
															
															foreach($corsi_date as $k=>$v){
																?>
															<div data-repeater-item="">
															
															<div class="row">
														<input type="hidden" name="ids_update" value="<?php echo $v['id']?>">
																  <div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_incontro')?></label>
															<input type="number" name="incontro" class="form-control" value="<?php echo $v['incontro']?>" min="1">
														</div>
													</div>
													 <div class="col-md-2" >
																	<div class="form-group">
																		<label for="acc-mname"><?php echo lang('app.field_date')?></label>
																		<input type="text" name="date" class="form-control corsidate_date_input" value="<?php  echo $v['date']?>">
																	</div>
																</div>
																<div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_start_time')?></label>
															<input type="text" class="form-control corsidate_time_input" placeholder="HH:mm"  name="start_time" value="<?php echo $v['start_time']?>"/> 
														</div>
													</div>
													<div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_end_time')?></label>
															<input type="text" class="form-control corsidate_time_input" placeholder="HH:mm"  name="end_time"  value="<?php echo $v['end_time']?>"/>	
														</div>
													</div>
													
																 <div class="col-md-1" style="margin-top:25px">
																	 <input class="btn btn-danger" data-repeater-delete type="button" value="<?php echo lang('app.btn_delete')?>"/>
																</div>
															</div>
															</div>
															<?php }
														}
														else{?>
															<div data-repeater-item="">
															<div class="row">
																  <div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_incontro')?></label>
															<input type="number" name="incontro" class="form-control" value="1" min="1">
														</div>
													</div>
													 <div class="col-md-2" >
																	<div class="form-group">
																		<label for="acc-mname"><?php echo lang('app.field_date')?></label>
																		<input type="text" name="date" class="form-control corsidate_date_input">
																	</div>
																</div>
																<div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_start_time')?></label>
															<input type="text" class="form-control corsidate_time_input" placeholder="HH:mm"  name="start_time"/> 
														</div>
													</div>
													<div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_end_time')?></label>
															<input type="text" class="form-control corsidate_time_input" placeholder="HH:mm"  name="end_time" />	
														</div>
													</div>
													
																 <div class="col-md-1" style="margin-top:25px">
																	 <input class="btn btn-danger" onclick="del_corsi_date('<?php echo $v['id']?>')" data-repeater-delete type="button" value="<?php echo lang('app.btn_delete')?>"/>
																</div>
															</div>
															</div>
														<?php } ?>
														</div>
														<input data-repeater-create class="btn btn-warning" type="button" value="<?php echo lang('app.btn_add')?>"/>
													</div>
													</div>
													
                                                    </div>
                                                </div>
												<?php break;
												case 'webinar':?>
												<div class="tab-pane fade" id="tab_webinar_date">
                                                    <div id="aulaDateForm" >
													<div class="row">
														<div class="repeater-corsidate m-t-30 col-md-12">
														<div data-repeater-list="corsidate">
														<?php if(!empty($corsi_date)){
															foreach($corsi_date as $k=>$v){?>
																<div data-repeater-item="">
																	<input type="hidden" name="ids_update" value="<?php echo $v['id']?>">
															<div class="row">
																  <div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_incontro')?></label>
															<input type="number" name="incontro" class="form-control" value="<?php echo $v['incontro']?>" min="1">
														</div>
													</div>
													 <div class="col-md-2" >
																	<div class="form-group">
																		<label for="acc-mname"><?php echo lang('app.field_date')?></label>
																		<input type="text" name="date" class="form-control corsidate_date_input" value="<?php echo $v['date']?>">
																	</div>
																</div>
																<div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_start_time')?></label>
															<input type="text" class="form-control corsidate_time_input" placeholder="HH:mm"  name="start_time" value="<?php echo $v['start_time']?>"/> 
														</div>
													</div>
													<div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_end_time')?></label>
															<input type="text" class="form-control corsidate_time_input" placeholder="HH:mm"  name="end_time" value="<?php echo $v['end_time']?>"/>	
														</div>
													</div>
													<div class="col-md-3" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_zoom_url')?></label>
															<input type="text" name="zoom_url" class="form-control" value="<?php echo $v['zoom_url']?>">
														</div>
													</div>
																 <div class="col-md-1" style="margin-top:25px">
																	 <input class="btn btn-danger" onclick="del_corsi_date('<?php echo $v['id']?>')" data-repeater-delete type="button" value="<?php echo lang('app.btn_delete')?>"/>
																</div>
															</div>
															</div>
															<?php }
														}
														else{?>
															<div data-repeater-item="">
															<div class="row">
																  <div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_incontro')?></label>
															<input type="number" name="incontro" class="form-control" value="1" min="1">
														</div>
													</div>
													 <div class="col-md-2" >
																	<div class="form-group">
																		<label for="acc-mname"><?php echo lang('app.field_date')?></label>
																		<input type="text" name="date" class="form-control corsidate_date_input">
																	</div>
																</div>
																<div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_start_time')?></label>
															<input type="text" class="form-control corsidate_time_input" placeholder="HH:mm"  name="start_time"/> 
														</div>
													</div>
													<div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_end_time')?></label>
															<input type="text" class="form-control corsidate_time_input" placeholder="HH:mm"  name="end_time" />	
														</div>
													</div>
													<div class="col-md-3" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_zoom_url')?></label>
															<input type="text" name="zoom_url" class="form-control">
														</div>
													</div>
																 <div class="col-md-1" style="margin-top:25px">
																	 <input class="btn btn-danger" data-repeater-delete type="button" value="<?php echo lang('app.btn_delete')?>"/>
																</div>
															</div>
															</div>
														<?php } ?>
														</div>
														<input data-repeater-create class="btn btn-warning" type="button" value="<?php echo lang('app.btn_add')?>"/>
													</div>
													</div>
													
                                                    </div>
                                                </div>
												<?php break;
												case 'online':?>
												<div class="tab-pane fade" id="tab_vimeo">
                                                    <div id="aulaDateForm" >
													<div class="row">
														<div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                   
                                                                    <div class="col-md-9">
                                                                        <div class="checkbox form-check-inline">
																			<input type="checkbox" name="cuepoint_block" id="cuepoint_block" value="yes" <?php if($inf_modulo['cuepoint_block']=='yes') echo 'checked'?>>
																			<label for="cuepoint_block"> <?php echo lang('app.field_cuepoint_block')?> </label>
																		</div>
																		
																		
																		                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
													</div>
													<div class="row">
													
														<div class="repeater-corsivimeo m-t-30 col-md-12">
														<div data-repeater-list="corsivimeo">
														<?php if(!empty($corsi_vimeo)){
															foreach($corsi_vimeo as $k=>$v){?>
															<div data-repeater-item="">
															<div class="row">
																  <div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_sort')?></label>
															<input type="number" name="ord" class="form-control" value="<?php echo $v['ord']?>" min="1">
														</div>
													</div>
													 <div class="col-md-3" >
																	<div class="form-group">
																		<label for="acc-mname"><?php echo lang('app.field_vimeo')?></label>
																		<input type="text" name="vimeo" class="form-control" value="<?php echo $v['vimeo']?>">
																	</div>
																</div>
																
													<div class="col-md-2">
													  <div class="form-check form-check-inline m-t-20" style="margin-top:25px">
														<?php 
														if($v['enable']=='yes') $chk=true; else $chk=false;
														
														$data = [
														'name'    => "vimeo_enable",
														'id'      => 'vimeo_enable',
														'value'   =>'enable',
														'checked' => $chk,
														'class' => 'form-check-input',
														
															];

															echo form_checkbox($data);
															?>
														  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_enable")?></label>
														</div>
													 </div>
													
																 <div class="col-md-1" style="margin-top:25px">
																	 <input class="btn btn-danger" data-repeater-delete type="button" value="<?php echo lang('app.btn_delete')?>"/>
																</div>
															</div>
															</div>
															<?php }
														} else{?>
															<div data-repeater-item="">
															<div class="row">
																  <div class="col-md-2" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_sort')?></label>
															<input type="number" name="ord" class="form-control" value="1" min="1">
														</div>
													</div>
													 <div class="col-md-3" >
																	<div class="form-group">
																		<label for="acc-mname"><?php echo lang('app.field_vimeo')?></label>
																		<input type="text" name="vimeo" class="form-control">
																	</div>
																</div>
																
													<div class="col-md-2">
													  <div class="form-check form-check-inline m-t-20" style="margin-top:25px">
														<?php 
														$chk=true;
														
														$data = [
														'name'    => "vimeo_enable",
														'id'      => 'vimeo_enable',
														'value'   =>'enable',
														'checked' => $chk,
														'class' => 'form-check-input',
														
															];

															echo form_checkbox($data);
															?>
														  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_enable")?></label>
														</div>
													 </div>
													
																 <div class="col-md-1" style="margin-top:25px">
																	 <input class="btn btn-danger" data-repeater-delete type="button" value="<?php echo lang('app.btn_delete')?>"/>
																</div>
															</div>
															</div>
														<?php } ?>
														</div>
														<input data-repeater-create class="btn btn-warning" type="button" value="<?php echo lang('app.btn_add')?>"/>
													</div>
													</div>
													
                                                    </div>
                                                </div>
												<?php break;
												}?>
												
												
												
												<div class="tab-pane fade" id="tab_gallery">
                                                    <div id="profileForm" >
													<div class="row">
														<div class="col-md-6">
														  <div class="form-group">
															<label class="col-form-label " for="logo"><?php echo lang("app.field_image")?> (dimensione consigliate: 400x227 jpg o png)</label>
															
																<input class="form-control" type="file" id="logo" name="logo"  />
															
															</div>
														 </div>
														 <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="acc-name"><?php echo lang('app.field_video_promo')?></label>
												<div class="input-group mb-3">
													  <div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon3">https://www.youtube.com/embed/</span>
													  </div>
																<?php $val=$inf_modulo['video_promo'];; 
														$input = [
																'type'  => 'text',
																'name'  => 'video_promo',
																'id'    => 'video_promo',
																'required' =>true,
																'value' => $val,
																'placeholder' =>lang('app.field_video_promo'),
																'class' => 'form-control'
																
														];

														echo form_input($input);
														?>
                                              </div>
                                            </div>
                                        </div>
													</div>
													<input type="hidden" name="delete_foto" id="delete_foto" value="no">
													<?php if($inf_modulo['foto']!=""){?>
														<div class="row" id="div_foto">
															<div class="col-sm-2">
																<img src="<?php echo base_url('uploads/corsi/'.$inf_modulo['foto'])?>" alt="image" class="img-fluid img-thumbnail" width="100%">
																<button class="btn btn-danger btn-xs" onclick="del_foto();"><i class="fa fa-trash"></i></button>
															</div>
														</div>
													<?php } ?>
													<?php /*
													<div class="row">
								<div class="col-sm-11">
										  <h4> <?php echo lang('app.title_section_gallery')?></h4>
								</div>
								<div class="col-md-12">
										  <div class="form-group">
											<label class="col-form-label " for="logo"><?php echo lang("app.field_many_images")?> </label>
											
												<input class="form-control" type="file" id="logo" name="gallery[]" multiple />
											
											</div>
										 </div>
										
								</div>			*/?>			
                                                    </div>
                                                </div>
												<div class="tab-pane fade" id="tab_attachment">
                                                    <div id="profileForm" >
															<div class="row">
																  <div class="col-sm-11">
																 
																	<a href="#add-modal-dialog" data-toggle="modal"  name="add" class="btn btn-success float-right" style="margin-left:10px"><?php echo  lang('app.btn_add')?></a>&nbsp;
																	<?php if($inf_corsi['tipologia_corsi']!="eBook"){?>
																		<a href="#list-modal-dialog" data-toggle="modal"  name="list" class="btn btn-warning float-right"><?php echo  lang('app.btn_list')?></a>
																	<?php } ?>
																  
																  <div class="row m-t-20" style="margin-top:20px">
																	<div class="table-responsive">
																		<table class="table table-td-valign-middle m-b-0">
																			
																			<tbody id="list_pdf">
																			<?php if(!empty($corsi_pdf)){
																				foreach($corsi_pdf as $v){?>
																			<tr>
																				<td><div class="form-check form-check-inline">
																					<?php 
																					
																				
																					$data = [
																					'name'    => "ids_pdf[]",
																					'id'      => 'ids_pdf_list_'.$v['id'],
																					'value'   => $v['id'],
																					'checked' => true,
																					'class' => 'form-check-input'
																						];

																						echo form_checkbox($data);
																						?>
																					  <label class="form-check-label" for="inlineCheckbox1"><?php echo $v['pdfname']?></label>
																			</div></td>
																				
																				<td class="text-center"><a target="_blank" href="<?= base_url('user/getFile/'.$v['id']) ?>" class="btn btn-default btn-xs btn-rounded p-l-10 p-r-10"><i class="fa fa-download"></i> <?php echo lang('app.action_download')?></a></td>
																			</tr>
																			<?php } }?>
																			</tbody>
																		</table>
																	</div>
																  </div>
															</div>
														 </div>
                                                    </div>
                                                </div>
                                               <div class="tab-pane fade" id="tab_seo">
                                                    <div id="profileForm" >
														<div class="row">
									 <div class="col-md-12">
                                             <div class="form-group required-field">
                                                <label for="acc-name"><?php echo lang('app.field_seo_title')?></label>
												<?php $val=$inf_modulo['seo_title']; 
										$input = [
												'type'  => 'text',
												'name'  => 'seo_title',
												'id'    => 'seo_title',
												'required' =>true,
												'value' => $val,
												'placeholder' =>lang('app.field_seo_title'),
												'class' => 'form-control'
												
										];

										echo form_input($input);
										?>
                                              
                                            </div>
											 
										</div>
										
										 <div class="col-md-12">
                                            <div class="form-group ">
											<label for="acc-mname"><?php echo lang('app.field_seo_description')?></label>
											 <?php $val=$inf_modulo['seo_description']; 
										$input = [
												'rows'=>3,
												'name'  => 'seo_description',
												'id'    => 'seo_description',
												'value' => $val,
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?>
												
											</div>
										</div>
									
									</div>
                                                    </div>
                                                </div>
												 <?php if(in_array('test',$ente_package['extra']) && $inf_corsi['test_required']=='per_modulo'){?>
												 <div class="tab-pane fade" id="tab_test">
													<div id="profileForm" >
														<div class="row">
														<div class="col-12">
														   <div class="form-group row mb-3">
																<label class="col-md-3 col-form-label" for="name3"><?php echo lang('app.field_min_points')?> <span class="text-danger">*</span></label>
																<div class="col-md-6">
																	<input type="number" value="<?php echo $inf_modulo['min_points']?>" min="1" max="100" class="form-control" name="min_points" id="min_points" placeholder="<?php echo lang('app.help_min_points')?>">
																</div>
															</div>
														</div>
														<div class="col-12">
																
																	<h4><?php echo lang('app.title_section_list_test')?></h4>
																	<a href="<?php echo base_url('admin/test/add')?>" target="_blank"  name="add" class="btn btn-success float-right" style="margin-left:10px"><?php echo  lang('app.btn_add')?></a>&nbsp;
																	<a href="#list-test-modal-dialog" data-toggle="modal"  name="list" class="btn btn-warning float-right" onclick="get_list_test();"><?php echo  lang('app.btn_list')?></a>
																  
																  <div class="row m-t-20" style="margin-top:20px">
																	<div class="table-responsive">
																		<table class="table table-td-valign-middle m-b-0">
																			
																			<tbody id="list_test">
																			<?php if(!empty($corsi_test)){
																			foreach($corsi_test as $pdf_id){
			
																			
																				?>
																				<tr>
																					<td><div class="form-check form-check-inline">
																						<?php 
																						
																					
																						$data = [
																						'name'    => "ids_test[]",
																						'id'      => 'ids_test_'.$pdf_id['id'],
																						'value'   => $pdf_id['id'],
																						'checked' => true,
																						'class' => 'form-check-input'
																							];

																							echo form_checkbox($data);
																							?>
																						  <label class="form-check-label" for="inlineCheckbox1"><?php echo $pdf_id['title']?></label>
																				</div></td>
																					
																					<td class="text-center"><?php echo $pdf_id['type']?></td>
																				</tr>
																		<?php } }?>
																			</tbody>
																		</table>
																	</div>
																 
															</div>
														 </div>
														</div>
													</div>
												</div>
												<?php } ?>
                                                <ul class="list-inline wizard mb-0" style="margin-top:10px">
                                                    <li class="previous list-inline-item"><a href="javascript: void(0);" class="btn btn-secondary"><?php echo lang('app.btn_prev');?></a>
                                                    </li>
													 <li class="list-inline-item float-right ml-1"><a href="javascript: void(0);" onclick="save_corsi();" class="btn btn-success btn-finish"><?php echo lang('app.btn_finish');?></a></li>
                                                    <li class="next list-inline-item float-right"><a href="javascript: void(0);" class="btn btn-secondary btn-next"><?php echo lang('app.btn_next');?></a></li>
													
                                                </ul>

                                            </div> <!-- tab-content -->
                                        </div> <!-- end #rootwizard-->
									<?php echo form_close()?>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
    
                    </div> <!-- container -->

                </div> <!-- content -->
 <?php $attributes = ['class' => '', 'id' => 'pdf_form_add','method'=>'post'];
				echo form_open_multipart( base_url('admin/PDFlib'), $attributes);?>
		<input type="hidden" name="action" value="add_pdf">
	
		<div class="modal fade" id="add-modal-dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						
						<h4 class="modal-title"><?php echo lang('app.modal_title_add_pdflib')?></h4>
					</div>
					<div class="modal-body" id="">
					 <div class="alert alert-danger " id="add_pdf_error_alert" role="alert" style="display:none">
											 <?php if(isset($error)) echo $error?>
											</div>
						<div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_doc_title')?></label>
							<?php $val="";
							$input = [
									'type'  => 'text',
									'name'  => 'pdfname',
									'id'    => 'pdfname',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_doc_title'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 
						
							<label class="col-form-label " for="filename"><?php echo lang("app.field_doc")?> </label>
							<div class="col-sm-12">
								<input class="form-control" type="file" id="filename" name="filename"  />
							</div>
							<div class="row col-md-12">
							 <div class="form-check form-check-inline">
											<?php 
											$chk=true;
											
											$data = [
											'name'    => "accesso",
											'id'      => 'accesso_public',
											'value'   =>'public',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_radio($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_access_public")?></label>
											</div>
											 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "accesso",
											'id'      => 'accesso_private',
											'value'   =>'private',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_radio($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_access_private")?></label>
											</div>
							</div>
						<div class="row  col-md-12">
						 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "status",
											'id'      => 'pdf_status',
											'value'   =>'enable',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="pdf_status"><?php echo lang("app.field_active_status")?></label>
											</div>
											 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "featured",
											'id'      => 'featured',
											'value'   =>'enable',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox11"><?php echo lang("app.field_featured")?></label>
											</div>
											
								</div>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal"><?php echo lang('app.btn_cancel')?></a>
						<?php $data=["name"=>"save",
											"value"=>lang('app.btn_save'),
											'class' => 'btn btn-success'
								];
								$js = 'onClick="pdf_add()"';
								echo form_button($data,lang('app.btn_save'),$js);?>
						
					</div>
				</div>
			</div>
		</div>
           <?php echo form_close();?>	
		   
 <?php $attributes = ['class' => '', 'id' => 'pdf_form_list','method'=>'post'];
				echo form_open_multipart( base_url('admin/PDFlib'), $attributes);?>
		<input type="hidden" name="action" value="list_pdf">
	
		<div class="modal fade" id="list-modal-dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						
						<h4 class="modal-title"><?php echo lang('app.modal_title_list_pdflib')?></h4>
					</div>
					<div class="modal-body" id="" style="overflow: scroll; height:450px">
					<table class="table table-td-valign-middle m-b-0">
								
								<tbody id="list_modal_pdf">
								<?php foreach($list_pdf as $kk=>$one_customer){?>
									<tr>
										<td><div class="form-check form-check-inline">
											<?php 
											
										
											$data = [
											'name'    => "ids_pdf_list[]",
											'id'      => 'ids_pdf_list_'.$one_customer['id'],
											'value'   => $one_customer['id'],
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo $one_customer['pdfname']?></label>
									</div></td>
										
										<td class="text-center"><a target="_blank" href="<?= base_url('user/getFile/'.$one_customer['id']) ?>" class="btn btn-default btn-xs btn-rounded p-l-10 p-r-10"><i class="fa fa-download"></i> <?php echo lang('app.action_download')?></a></td>
									</tr>
								<?php }?>	
								</tbody>
							</table>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal"><?php echo lang('app.btn_cancel')?></a>
						<?php $data=["name"=>"save",
											"value"=>lang('app.btn_save'),
											'class' => 'btn btn-success'
								];
								$js = 'onClick="pdf_add_from_list()"';
								echo form_button($data,lang('app.btn_save'),$js);?>
						
					</div>
				</div>
			</div>
		</div>
           <?php echo form_close();?>		        
	
<?php $attributes = ['class' => '', 'id' => 'test_form_list','method'=>'post'];
				echo form_open_multipart( base_url('admin/PDFlib'), $attributes);?>
		<input type="hidden" name="action" value="list_test">
	
		<div class="modal fade" id="list-test-modal-dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						
						<h4 class="modal-title"><?php echo lang('app.modal_title_list_pdflib')?></h4>
					</div>
					<div class="modal-body" id="div_list_test" style="overflow: scroll; height:450px">
					
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal"><?php echo lang('app.btn_cancel')?></a>
						<?php $data=["name"=>"save",
											"value"=>lang('app.btn_save'),
											'class' => 'btn btn-success'
								];
								$js = 'onClick="test_add_from_list()"';
								echo form_button($data,lang('app.btn_save'),$js);?>
						
					</div>
				</div>
			</div>
		</div>
           <?php echo form_close();?>		 	

<div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-success">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-checkmark h1 text-white"></i>
                                                            <h4 class="mt-2 text-white"><?php echo lang('app.success_add')?></h4>
                                                           <a href="<?php echo base_url('admin/corsi/'.$inf_corsi['id'].'/modulo')?>" class="btn btn-light my-2" ><?php echo lang('app.menu_corsi_modulo')?></a>
															<a href="<?php echo base_url('admin/corsi/'.$inf_corsi['id'].'/modulo/add')?>" class="btn btn-primary my-2 " ><?php echo lang('app.new_modulo')?></a>
															<button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger my-2 ">Continua a modificare</button>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                <!-- Footer Start -->
                   <?php echo view('admin/common/footer_bar')?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

          
<?= view('admin/common/footer') ?>


<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/mohithg-switchery/switchery.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/multiselect/js/jquery.multi-select.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/js/select2.min.js"></script>
      
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.js"></script>
		<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/lang/summernote-it-IT.min.js"></script>
	<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>
	 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
		   <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/l10n/it.js"></script>
        <!-- Sweet alert init js-->
     <script>
		$(document).ready(function(){
			"use strict";
		/*	$("#expired_date").flatpickr({
				dateFormat: "Y-m-d",
				 altFormat: "F j, Y",
				 altInput:!0,
				 locale: "it",
			});*/
			$("#rootwizard").bootstrapWizard({
				onTabShow: function(tab, navigation, index) {
					
					var $total = navigation.find('li').length;
					
					var $current = index+1;

					var wizard = navigation.closest('#rootwizard');

					// If it's the last tab then hide the last button and show the finish instead
					/*if($current >= $total) {
						$(wizard).find('.btn-next').hide();
						$(wizard).find('.btn-finish').show();
					} else {
						$(wizard).find('.btn-next').show();
						$(wizard).find('.btn-finish').hide();
					}*/
				},
				/*onNext:function(t,r,a){
					var o=$($(t).data("targetForm"));
					if(o&&(o.addClass("was-validated"),!1===o[0].checkValidity()))return event.preventDefault(),event.stopPropagation(),!1
				}*/
			});
			$("input[name='free']").change(function(){
				var v=$(this).val();
				if(v=='yes'){
					$("#div_not_free").hide(0);
				}
				else $("#div_not_free").show(0);
			});
		});
</script>

<script>
		!function(t){
			"use strict";
			function e(){
				
			}
			e.prototype.initSelect2=function(){t('[data-toggle="select2"]').select2()},
				e.prototype.init=function(){this.initSelect2()/*this.initMaxLength(),this.initSelectize(),this.initSwitchery(),this.initMultiSelect(),this.initTouchspin()*/},
			t.FormAdvanced=new e,t.FormAdvanced.Constructor=e}
			(window.jQuery),function(){
				"use strict";
				window.jQuery.FormAdvanced.init()}(),
			$(function(){
				"use strict";
				var o=$.map(countries,function(e,a){return{value:e,data:a}});
				$.mockjax({url:"*",responseTime:2e3,response:function(e){
					var a=e.data.query,i=a.toLowerCase(),
					n=new RegExp("\\b"+$.Autocomplete.utils.escapeRegExChars(i),"gi"),
					t={query:a,suggestions:$.grep(o,function(e){return n.test(e.value)})};
					this.responseText=JSON.stringify(t)}})
				,$("#autocomplete-ajax").autocomplete({
					lookup:o,lookupFilter:function(e,a,i){
						return new RegExp("\\b"+$.Autocomplete.utils.escapeRegExChars(i),"gi").test(e.value)},onSelect:function(e){$("#selction-ajax").html("You selected: "+e.value+", "+e.data)},
						onHint:function(e){$("#autocomplete-ajax-x").val(e)},
						onInvalidateSelection:function(){
							$("#selction-ajax").html("You selected: none")}});
						var e=$.map(["Anaheim Ducks","Atlanta Thrashers","Boston Bruins","Buffalo Sabres","Calgary Flames","Carolina Hurricanes","Chicago Blackhawks","Colorado Avalanche","Columbus Blue Jackets","Dallas Stars","Detroit Red Wings","Edmonton OIlers","Florida Panthers","Los Angeles Kings","Minnesota Wild","Montreal Canadiens","Nashville Predators","New Jersey Devils","New Rork Islanders","New York Rangers","Ottawa Senators","Philadelphia Flyers","Phoenix Coyotes","Pittsburgh Penguins","Saint Louis Blues","San Jose Sharks","Tampa Bay Lightning","Toronto Maple Leafs","Vancouver Canucks","Washington Capitals"],
						function(e){return{value:e,data:{category:"NHL"}}}),
						a=$.map(["Atlanta Hawks","Boston Celtics","Charlotte Bobcats","Chicago Bulls","Cleveland Cavaliers","Dallas Mavericks","Denver Nuggets","Detroit Pistons","Golden State Warriors","Houston Rockets","Indiana Pacers","LA Clippers","LA Lakers","Memphis Grizzlies","Miami Heat","Milwaukee Bucks","Minnesota Timberwolves","New Jersey Nets","New Orleans Hornets","New York Knicks","Oklahoma City Thunder","Orlando Magic","Philadelphia Sixers","Phoenix Suns","Portland Trail Blazers","Sacramento Kings","San Antonio Spurs","Toronto Raptors","Utah Jazz","Washington Wizards"],
						function(e){return{value:e,data:{category:"NBA"}}}),
						i=e.concat(a);$("#autocomplete").devbridgeAutocomplete({lookup:i,minChars:1,onSelect:function(e){$("#selection").html("You selected: "+e.value+", "+e.data.category)}
						,showNoSuggestionNotice:!0,noSuggestionNotice:"Sorry, no matching results",groupBy:"category"}),
						$("#autocomplete-custom-append").autocomplete({lookup:o,appendTo:"#suggestions-container"}),
						$("#autocomplete-dynamic").autocomplete({lookup:o})});
						var countries={AD:"Andorra",A2:"Andorra Test",AE:"United Arab Emirates",AF:"Afghanistan",AG:"Antigua and Barbuda",AI:"Anguilla",AL:"Albania",AM:"Armenia",AN:"Netherlands Antilles",AO:"Angola",AQ:"Antarctica",AR:"Argentina",AS:"American Samoa",AT:"Austria",AU:"Australia",AW:"Aruba",AX:"??land Islands",AZ:"Azerbaijan",BA:"Bosnia and Herzegovina",BB:"Barbados",BD:"Bangladesh",BE:"Belgium",BF:"Burkina Faso",BG:"Bulgaria",BH:"Bahrain",BI:"Burundi",BJ:"Benin",BL:"Saint Barth??lemy",BM:"Bermuda",BN:"Brunei",BO:"Bolivia",BQ:"British Antarctic Territory",BR:"Brazil",BS:"Bahamas",BT:"Bhutan",BV:"Bouvet Island",BW:"Botswana",BY:"Belarus",BZ:"Belize",CA:"Canada",CC:"Cocos [Keeling] Islands",CD:"Congo - Kinshasa",CF:"Central African Republic",CG:"Congo - Brazzaville",CH:"Switzerland",CI:"C??te d???Ivoire",CK:"Cook Islands",CL:"Chile",CM:"Cameroon",CN:"China",CO:"Colombia",CR:"Costa Rica",CS:"Serbia and Montenegro",CT:"Canton and Enderbury Islands",CU:"Cuba",CV:"Cape Verde",CX:"Christmas Island",CY:"Cyprus",CZ:"Czech Republic",DD:"East Germany",DE:"Germany",DJ:"Djibouti",DK:"Denmark",DM:"Dominica",DO:"Dominican Republic",DZ:"Algeria",EC:"Ecuador",EE:"Estonia",EG:"Egypt",EH:"Western Sahara",ER:"Eritrea",ES:"Spain",ET:"Ethiopia",FI:"Finland",FJ:"Fiji",FK:"Falkland Islands",FM:"Micronesia",FO:"Faroe Islands",FQ:"French Southern and Antarctic Territories",FR:"France",FX:"Metropolitan France",GA:"Gabon",GB:"United Kingdom",GD:"Grenada",GE:"Georgia",GF:"French Guiana",GG:"Guernsey",GH:"Ghana",GI:"Gibraltar",GL:"Greenland",GM:"Gambia",GN:"Guinea",GP:"Guadeloupe",GQ:"Equatorial Guinea",GR:"Greece",GS:"South Georgia and the South Sandwich Islands",GT:"Guatemala",GU:"Guam",GW:"Guinea-Bissau",GY:"Guyana",HK:"Hong Kong SAR China",HM:"Heard Island and McDonald Islands",HN:"Honduras",HR:"Croatia",HT:"Haiti",HU:"Hungary",ID:"Indonesia",IE:"Ireland",IL:"Israel",IM:"Isle of Man",IN:"India",IO:"British Indian Ocean Territory",IQ:"Iraq",IR:"Iran",IS:"Iceland",IT:"Italy",JE:"Jersey",JM:"Jamaica",JO:"Jordan",JP:"Japan",JT:"Johnston Island",KE:"Kenya",KG:"Kyrgyzstan",KH:"Cambodia",KI:"Kiribati",KM:"Comoros",KN:"Saint Kitts and Nevis",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KY:"Cayman Islands",KZ:"Kazakhstan",LA:"Laos",LB:"Lebanon",LC:"Saint Lucia",LI:"Liechtenstein",LK:"Sri Lanka",LR:"Liberia",LS:"Lesotho",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",LY:"Libya",MA:"Morocco",MC:"Monaco",MD:"Moldova",ME:"Montenegro",MF:"Saint Martin",MG:"Madagascar",MH:"Marshall Islands",MI:"Midway Islands",MK:"Macedonia",ML:"Mali",MM:"Myanmar [Burma]",MN:"Mongolia",MO:"Macau SAR China",MP:"Northern Mariana Islands",MQ:"Martinique",MR:"Mauritania",MS:"Montserrat",MT:"Malta",MU:"Mauritius",MV:"Maldives",MW:"Malawi",MX:"Mexico",MY:"Malaysia",MZ:"Mozambique",NA:"Namibia",NC:"New Caledonia",NE:"Niger",NF:"Norfolk Island",NG:"Nigeria",NI:"Nicaragua",NL:"Netherlands",NO:"Norway",NP:"Nepal",NQ:"Dronning Maud Land",NR:"Nauru",NT:"Neutral Zone",NU:"Niue",NZ:"New Zealand",OM:"Oman",PA:"Panama",PC:"Pacific Islands Trust Territory",PE:"Peru",PF:"French Polynesia",PG:"Papua New Guinea",PH:"Philippines",PK:"Pakistan",PL:"Poland",PM:"Saint Pierre and Miquelon",PN:"Pitcairn Islands",PR:"Puerto Rico",PS:"Palestinian Territories",PT:"Portugal",PU:"U.S. Miscellaneous Pacific Islands",PW:"Palau",PY:"Paraguay",PZ:"Panama Canal Zone",QA:"Qatar",RE:"R??union",RO:"Romania",RS:"Serbia",RU:"Russia",RW:"Rwanda",SA:"Saudi Arabia",SB:"Solomon Islands",SC:"Seychelles",SD:"Sudan",SE:"Sweden",SG:"Singapore",SH:"Saint Helena",SI:"Slovenia",SJ:"Svalbard and Jan Mayen",SK:"Slovakia",SL:"Sierra Leone",SM:"San Marino",SN:"Senegal",SO:"Somalia",SR:"Suriname",ST:"S??o Tom?? and Pr??ncipe",SU:"Union of Soviet Socialist Republics",SV:"El Salvador",SY:"Syria",SZ:"Swaziland",TC:"Turks and Caicos Islands",TD:"Chad",TF:"French Southern Territories",TG:"Togo",TH:"Thailand",TJ:"Tajikistan",TK:"Tokelau",TL:"Timor-Leste",TM:"Turkmenistan",TN:"Tunisia",TO:"Tonga",TR:"Turkey",TT:"Trinidad and Tobago",TV:"Tuvalu",TW:"Taiwan",TZ:"Tanzania",UA:"Ukraine",UG:"Uganda",UM:"U.S. Minor Outlying Islands",US:"United States",UY:"Uruguay",UZ:"Uzbekistan",VA:"Vatican City",VC:"Saint Vincent and the Grenadines",VD:"North Vietnam",VE:"Venezuela",VG:"British Virgin Islands",VI:"U.S. Virgin Islands",VN:"Vietnam",VU:"Vanuatu",WF:"Wallis and Futuna",WK:"Wake Island",WS:"Samoa",YD:"People's Democratic Republic of Yemen",YE:"Yemen",YT:"Mayotte",ZA:"South Africa",ZM:"Zambia",ZW:"Zimbabwe",ZZ:"Unknown or Invalid Region"
						};
						
						
						
		$('#ids_disciplina').select2({
	
  placeholder: "Loading remote data",
    ajax: {
        url: "<?php echo base_url()?>/ajax/get_discipline_by_professioneSelect2",
        dataType: 'json',
        delay: 250,
        data: function(params) {
			console.log($("#ids_professione").val());
            return {
                q: params.term, // search term
				ids_professione:$("#ids_professione").val()
              //  page: params.page
            };
        },
        processResults: function(data, params) {
			
			console.log(data);
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
          //  params.page = params.page || 1;

            return {
                results: data,
               /* pagination: {
                    more: (params.page * 30) < data.total_count
                }*/
            };
        },
        cache: true
    },
	
      placeholder: $(this).attr('placeholder'),
      allowClear: 1,
   
});
				
$('#descizione').summernote({
	   disableDragAndDrop: true,
	    lang: "it-IT",
		 height: 200,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true,
	   toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
	  ['insert',['link']],
    ['height', ['height']]
  ]
  });

$('#obiettivi').summernote({
	   disableDragAndDrop: true,
	    lang: "it-IT",
		 height: 200,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true,
	   toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
	  ['insert',['link']],
    ['height', ['height']]
  ]
  });
  
  $('#programa').summernote({
	   disableDragAndDrop: true,
	    lang: "it-IT",
		 height: 200,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true,
	   toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
	  ['insert',['link']],
    ['height', ['height']]
  ]
  });
	
$('#note').summernote({
	   disableDragAndDrop: true,
	    lang: "it-IT",
		 height: 200,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true,
	   toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
	  ['insert',['link']],
    ['height', ['height']]
  ]
  });
  
  $('#riferimenti').summernote({
	   disableDragAndDrop: true,
	    lang: "it-IT",
		 height: 200,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true,
	   toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
	  ['insert',['link']],
    ['height', ['height']]
  ]
  });
   $('#indrizzato_a').summernote({
	   disableDragAndDrop: true,
	    lang: "it-IT",
		 height: 200,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true,
	   toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
	  ['insert',['link']],
    ['height', ['height']]
  ]
  });
   $('#avvisi').summernote({
	   disableDragAndDrop: true,
	    lang: "it-IT",
		 height: 200,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true,
	   toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
	  ['insert',['link']],
    ['height', ['height']]
  ]
  });	

$('.repeater-prezzo-prof').repeater({
            isFirstItemUndeletable: false,
            show: function () {
				
				
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if(confirm("<?php echo lang('app.alert_msg_delete_price_prof')?>")) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function (setIndexes) {

            }
        });  
		$('.repeater-corsivimeo').repeater({
            isFirstItemUndeletable: false,
            show: function () {
				
				
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if(confirm("<?php echo lang('app.alert_msg_delete_row')?>")) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function (setIndexes) {

            }
        });  

$('.repeater-corsidate').repeater({
            isFirstItemUndeletable: false,
            show: function () {
				
				
                $(this).slideDown();
				  var selfRepeaterItem = this;
                  

                    var repeaterItems = $("div[data-repeater-item] > div.panel");
                    $(selfRepeaterItem).attr('data-index', repeaterItems.length - 1);
                    $(selfRepeaterItem).find('.corsidate_date_input').flatpickr({
						dateFormat: "Y-m-d",
						 altFormat: "d/m/Y",
						 altInput:!0,
						 locale: "it",
					});	
					 $(selfRepeaterItem).find('.corsidate_time_input').flatpickr({
						 enableTime:!0,
						noCalendar:!0,
						dateFormat:"H:i",
						time_24hr:!0,
						locale: "it",
					});
			
            },
            hide: function (deleteElement) {
                if(confirm("<?php echo lang('app.alert_msg_delete_row')?>")) {
                    $(this).slideUp(deleteElement);

                }
				else{
					$( "input[name='ids_delete_date[]']" ).last().remove();
				}
            },
            ready: function (setIndexes) {
				
            }
        });

$(".corsidate_date_input").flatpickr({
				dateFormat: "Y-m-d",
				 altFormat: "d/m/Y",
				 altInput:!0,
				 locale: "it",
			});	
$(".corsidate_time_input").flatpickr({
					 enableTime:!0,
					  noCalendar:!0,
					  dateFormat:"H:i",
					  time_24hr:!0,
					 locale: "it",
				});				
		</script>
<script>
   function get_sottoargomenti(id_argomenti){
		
		$.ajax({
				  url:"<?php echo base_url()?>/ajax/get_sottoargomenti",
				  method:"POST",
				  data:{id_argomenti:id_argomenti}
				  
			}).done(function(data){
				$("#div_sottoargomenti").html(data);
				
					$('#sottoargomenti').select2();
				
			});
	}
	function type_cours(v){
		var crediti=$("#crediti").val();
		$("#div_crediti").show();
		$("#div_vimeo").hide(0);
		if(v=='aula'){
			$("#div_inscrizione_aula").show(0);
			$("#div_nb_person_aula").show(0);
			
		} 
		else{
			$("#div_inscrizione_aula").hide(0);
			$("#div_nb_person_aula").hide(0);
		}
	}
	function check_def_price(){
		
		var ck=$("#have_def_price").is(":checked");
		if(ck==true) $("#div_prezzo").show(0); else $("#div_prezzo").hide(0);
	}
	function pdf_add(){
		 
		var file_data = $('#filename').prop('files')[0];
		var myForm = document.getElementById('pdf_form_add');
		var form_data = new FormData(myForm);
		//form_data.append('file', file_data);
		$.ajax({
			url: '<?php echo base_url()?>/Ajax/add_pdf', // point to server-side controller method
			//dataType: 'text', // what to expect back from the server
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post'
			
		}).done(function(data){
				
				var obj=JSON.parse(data);
				if(obj.error==true){
					$("#add_pdf_error_alert").html(obj.validation);
					$("#add_pdf_error_alert").show('slow');
					
				}
				else{
					$("#add_pdf_error_alert").hide('slow');
					//$("#list_pdf").append(obj.tr);
					$("#list_modal_pdf").append(obj.tr);
					pdf_add_from_list();
					$("#add-modal-dialog").modal('hide');
				}
			});
                
	}
	
	function pdf_add_from_list(){
		
		var myForm = document.getElementById('pdf_form_list');
		var form_data = new FormData(myForm);
		$.ajax({
			url: '<?php echo base_url()?>/Ajax/pdf_add_from_list', // point to server-side controller method
			//dataType: 'text', // what to expect back from the server
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post'
			
		}).done(function(data){
				
				$("#list_pdf").html(data);
				$("#list-modal-dialog").modal('hide');
			});
	}
	
	function test_add_from_list(){
		var myForm = document.getElementById('test_form_list');
		var form_data = new FormData(myForm);
		$.ajax({
			url: '<?php echo base_url()?>/Ajax/test_add_from_list', // point to server-side controller method
			//dataType: 'text', // what to expect back from the server
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post'
			
		}).done(function(data){
				
				$("#list_test").html(data);
				$("#list-test-modal-dialog").modal('hide');
			});
	}
	
	function get_list_test(){
		$.ajax({
			url: '<?php echo base_url()?>/Ajax/get_list_test', // point to server-side controller method
			//dataType: 'text', // what to expect back from the server
			cache: false,
			contentType: false,
			processData: false,
			
			type: 'post'
			
		}).done(function(data){
				
				$("#div_list_test").html(data);
				
			});
	}
	
	
function save_corsi(){
	$(".nav-link").removeClass('text-danger');

	$.ajax({
				  url:"<?php echo base_url('Corsi/modulo_edit_form_submit')?>",
				  method:"POST",
				  data: new FormData($("#add_corsi_form")[0]),
				  //dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
			}).done(function(msg){

				var obj=JSON.parse(msg);
				
			if(obj.error==true){
					$("#error_alert").html(obj.validation);
					$("#error_alert").show('slow');
					$("a[href='#"+obj.tabs_error+"']").addClass('text-danger');
				}
				else{
					$("#error_alert").hide('slow');
					$(".btn-continue-modulo").attr('href',obj.redirect_url);
					$( "#success-alert-modal" ).modal('show');
				//	return true;
				}
			});
}
function del_foto(){
	if(confirm("<?php echo lang('app.msg_delete_foto')?>")){
		$("#div_foto").remove();
		$("#delete_foto").val('yes');
	}
}

function del_corsi_date(id){
	$("#add_corsi_form").append("<input type='hidden' name='ids_delete_date[]' value='"+id+"'>");
}
</script>
<?= view('admin/common/endtag') ?>