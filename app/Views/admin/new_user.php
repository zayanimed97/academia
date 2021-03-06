<?php if($role=='doctor'){
	$page_title=lang('app.title_page_new_doctor');
	$menu=lang('app.menu_doctors');
	$menu_new=lang('app.new_doctor');
}
else{
	$page_title=lang('app.title_page_new_participant');
	$menu=lang('app.menu_participant');
	$menu_new=lang('app.new_participant');
	
}?>
<?= view('admin/common/header',array('page_title'=>$page_title)) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
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
											
											  <li class="breadcrumb-item"><a href="<?php echo base_url('admin/user_list?role='.$role)?>"><?php echo $menu?></a></li>
                                            <li class="breadcrumb-item active"><?php echo $menu_new?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?= $page_title ?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                        
                        <div class="row" x-data="{ private: '<?= (($user['type'] ?? "") == "private") ? 'private' : 'company' ?>'}">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<div class="alert alert-danger" id="error_alert" style="display:none"></div>
                                   

                                        <form method="post" id="add_user_form" action="<?= base_url() ?>/admin/createUser"  x-data="getResData()" enctype="multipart/form-data" >
                                        <input type="hidden" name="role" value="<?= $role ?>">
                                            <div id="basicwizard">
                                                <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
                                                    <li class="nav-item">
                                                        <a href="#basictab1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2"> 
                                                            <i class="mdi mdi-account-circle mr-1"></i>
                                                            <span class="d-none d-sm-inline"><?php echo lang('app.menu_account')?></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#basictab2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-face-profile mr-1"></i>
                                                            <span class="d-none d-sm-inline"><?php echo lang('app.menu_profile')?></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#basictab3" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-folder-multiple-image mr-1"></i>
                                                            <span class="d-none d-sm-inline"><?php echo lang('app.menu_media')?></span>
                                                        </a>
                                                    </li>
                                                   <?php /* <li class="nav-item">
                                                        <a href="#basictab4" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                            <span class="d-none d-sm-inline">Contacts</span>
                                                        </a>
                                                    </li> */?>
                                                </ul>

                                                <div class="tab-content b-0 mb-0 pt-0" x-data="{password : '', confirm: ''}">
                                                    <div class="tab-pane" id="basictab1">
                                                        <div class="row">
                                                        <template x-if="password != confirm">
                                                            <div class="alert alert-warning bg-warning text-white border-0 col-12" role="alert">
                                                                <?php echo lang('app.error_mismatch_password')?>
                                                            </div>
                                                        </template>
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="Email">Email <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="Email" name="email" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="password"> <?php echo lang('app.field_password')?> <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="password" x-model="password" id="password" name="Password" class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="confirm"><?php echo lang('app.field_confirm_password')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="password" x-model="confirm" id="confirm" name="confirm" class="form-control" value="">
                                                                    </div>
                                                                </div>
																<div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="active"><?php echo lang('app.field_active_status')?></label>
                                                                    <div class="col-md-9">
																	
                                                                       <input type="checkbox" name="active" id="active" value="yes" checked>
																	  
                                                                    </div>
                                                                </div>
																  
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
                                                    <div class="tab-pane" id="basictab2" >
                                                        <div class="row" >
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name"> <?php echo lang('app.field_first_name')?> <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="name" name="nome" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> <?php echo lang('app.field_last_name')?> <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="cognome" name="cognome" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->
                                                        


                                                        <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="email_profile"> email </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="email_profile" name="email_profile" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="telefono"> <?php echo lang('app.field_phone')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="telefono" name="telefono" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                 <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="mobile"> <?php echo lang('app.field_mobile')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="mobile" name="mobile" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end row -->

                                                        <!-- <template x-if="private == 'private'"> -->
                                                            <div class="row" >
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="cf"> <?php echo lang('app.field_cf')?> </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="cf" name="cf" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="ruolo"> <?php echo lang('app.field_ruolo')?> </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="ruolo" name="ruolo" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end row -->
															
															    <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_stato"> <?php echo lang('app.field_country')?></label>
                                                                    <div class="col-md-9">
                                                                        <select x-model="stato" @change="handleCountry" type="text" id="residenza_stato" name="residenza_stato" class="form-control">
                                                                            <option value="0"> <?php echo lang('app.field_select')?> </option>
                                                                            <?php foreach($nazioni as $naz) { ?>
                                                                                <option value="<?= $naz['id'] ?>"> <?= $naz['nazione'] ?> </option>
                                                                            <?php } ?>
                                                                            <!-- <option value="estero"> Estero </option> -->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_provincia"><?php echo lang('app.field_provincia')?></label>
                                                                    <div class="col-md-9" x-html="provincia">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                

                                                            <!-- <div class="row"> -->
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_comune"><?php echo lang('app.field_city')?></label>
                                                                    <div class="col-md-9" x-html="comuni">
                                                                        <!-- <input type="text" id="residenza_comune" name="residenza_comune" class="form-control" > -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_cap"> <?php echo lang('app.field_zip')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="residenza_cap" name="residenza_cap" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                       
                                                            <div class="col-12 col-md-8">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-2 col-form-label" for="residenza_indirizzo"> <?php echo lang('app.field_address')?></label>
                                                                    <div class="col-md-10">
                                                                        <input type="text" id="residenza_indirizzo" name="residenza_indirizzo" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="description"> <?php echo lang('app.field_description')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="description" name="description" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
															
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="qualifica"> <?php echo lang('app.field_qualifica')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="qualifica" name="qualifica" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
															<?php if($role=='participant'){?>
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="prof_albo"> <?php echo lang('app.field_prof_albo')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="prof_albo" name="prof_albo" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div>
															
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="prof_albo"> <?php echo lang('app.field_professione_city')?></label>
                                                                    <div class="col-md-9">
                                                                      <?php  $val=$inf_profile['professione_citta'] ?? '';
																			$input = [
																					'type'  => 'text',
																					'name'  => 'professione_citta',
																					'id'    => 'professione_citta',
																					
																					'value' => $val,
																					'placeholder' =>lang('app.field_professione_city'),
																					'class' => 'form-control'
																					
																			];

																			echo form_input($input);
																			?>
                                                                    </div>
                                                                </div>
                                                            </div>
															
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="prof_albo"> <?php echo lang('app.field_code_abo')?></label>
                                                                    <div class="col-md-9">
                                                                       <?php $val=$inf_profile['abo'] ?? '';
												$input = [
														'type'  => 'text',
														'name'  => 'abo',
														'id'    => 'abo',
														'required' =>true,
														'value' => $val,
														'placeholder' =>lang('app.field_code_abo'),
														'class' => 'form-control'
														
												];

												echo form_input($input);
												?>
                                                                    </div>
                                                                </div>
                                                            </div>
															
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="prof_albo"> <?php echo lang('app.field_del')?></label>
                                                                    <div class="col-md-9">
                                                                        <?php  $val=$inf_profile['del'] ?? '';
												$input = [
														'type'  => 'text',
														'name'  => 'del',
														'id'    => 'del',
														'required' =>true,
														'value' => $val,
														'placeholder' =>lang('app.field_del'),
														'class' => 'form-control'
														
												];

												echo form_input($input);
												?>
                                                                    </div>
                                                                </div>
                                                            </div>
															
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="prof_albo"> <?php echo lang('app.field_posizion')?></label>
                                                                    <div class="col-md-9">
                                                                       <?php $input = [
												
												'name'  => 'posizione',
												'id'    => 'posizione',
												'placeholder' =>lang('app.field_posizion'),
												'class' => 'form-control'
										];
										$options=array();
										$options['']=lang('app.field_select');
										$options['Libero Professionista']='Libero Professionista';
										$options['Dipendente']='Dipendente';
										$options['Convenzionato']='Convenzionato';
										echo form_dropdown($input, $options);
										?>
                                                                    </div>
                                                                </div>
                                                            </div>
															<?php } ?>
                                                        </div> <!-- end row -->
															
															
                                                        <!-- </template> -->


                                                        <!-- <h3>Residenza</h3>
                                                        <hr class="mb-4" /> -->


                                                        <!-- <template x-if="private == 'private'">

                                                        <div>
                                                            <h3>nascita</h3>
                                                            <hr class="mb-4" />


                                                            <div class="row">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="nascita_data"> nascita data</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="nascita_data" name="nascita_data" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="nascita_stato"> nascita stato</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="nascita_stato" name="nascita_stato" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    
                                                            </div> end row

                                                            <div class="row">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="nascita_provincia"> nascita provincia</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                    
                                                            </div> end row
                                                        </div>
                                                        </template> -->
                                                    </div>

                                                    <div class="tab-pane" id="basictab3">
														<div class="row">
														<div class="col-md-6">
														  <div class="form-group">
															<label class="col-form-label " for="logo"><?php echo lang("app.field_image")?> </label>
															
																<input class="form-control" type="file" id="logo" name="logo"  />
															
															</div>
														 </div>
														 <div class="col-md-6">
													<?php if($role=='doctor'){?>

                                            <div class="form-group">
                                               <label class="col-form-label " for="prima"><?php echo lang('app.field_signature')?></label>
													<input class="form-control" type="file" id="prima" name="prima"  />
                                            </div>
                                                <?php } ?>
                                        </div>
													</div>
													<?php if($role=='doctor'){?>
													<div class="row">
													    <div class="col-12 col-md-12">
															<div class="form-group row mb-3">
																<label class="col-md-3 col-form-label" for="cv_titolo"><?php echo lang('app.field_cv_title')?></label>
																<div class="col-md-9">
																	<input type="text" id="cv_titolo" name="cv_titolo" class="form-control" >
																</div>
															</div>
														</div>
													 <div class="col-md-12">
                                            <div class="form-group required-field">
                                                <label for="acc-name"><?php echo lang('app.field_cv')?></label>
													 <?php $val=""; 
										$input = [
												'rows'=>3,
												'name'  => 'cv',
												'id'    => 'cv',
												'value' => $val,
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?></div></div>
													</div>
													<?php } ?>
                                                    </div>
<?php /*
                                                    <div class="tab-pane" id="basictab4">
                                                            
                                                        
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <!-- <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_stato"> stato </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="nascita_stato" name="nascita_stato" class="form-control" >
                                                                    </div>
                                                                </div> -->
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_stato">stato</label>
                                                                    <div class="col-md-9">
                                                                        <select x-model="nascita_stato" @change="handleCountryNascita" type="text" id="nascita_stato" name="nascita_stato" class="form-control">
                                                                            <option value="0"> select option </option>
                                                                            <?php foreach($nazioni as $naz) { ?>
                                                                                <option value="<?= $naz['id'] ?>"> <?= $naz['nazione'] ?> </option>
                                                                            <?php } ?>
                                                                            <!-- <option value="estero"> Estero </option> -->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_provincia"> provincia</label>
                                                                    <div class="col-md-9" x-html="nascita_provincia">
                                                                        <!-- <input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control" > -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->

                                                        <div class="row" >
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_piva"> data </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="basic-datepicker" name="nascita_data" class="form-control" placeholder="Basic datepicker" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_cf"> cf</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="nascita_cf" name="nascita_cf" class="form-control" >
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                                
                                                        </div> <!-- end row -->
                                                                
                                                    </div>
*/?>
                                                    <ul class="list-inline wizard mb-0">
                                                        <!-- <li class="previous list-inline-item">
                                                            <a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                                                        </li> -->
                                                        <li class="list-inline-item float-right">
                                                            <button type="button" class="btn btn-secondary" onclick="return valid_user();"><?php echo lang('app.btn_save')?></button>
                                                        </li>
                                                        <!-- <li class="next list-inline-item float-right">
                                                            <a href="javascript: void(0);" class="btn btn-secondary">Next</a>
                                                        </li> -->
                                                    </ul>

                                                </div> <!-- tab-content -->
                                            </div> <!-- end #basicwizard-->
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


<?= view('admin/common/footer') ?>

        <script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script>
        
        <!-- Plugins js-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>

        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-pickers.init.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.js"></script>
		<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/lang/summernote-it-IT.min.js"></script>

        <!-- Init js-->
        <script>
            // form repeater Initialization
            // $('.repeater-email').repeater({
            // show: function () {
            //     $(this).slideDown();
            // },
            // hide: function (deleteElement) {
            //     if (confirm('Are you sure you want to delete this element?')) {
            //     $(this).slideUp(deleteElement);
            //     }
            // }
            // });

            // $('.repeater-phone').repeater({
            // show: function () {
            //     $(this).slideDown();
            // },
            // hide: function (deleteElement) {
            //     if (confirm('Are you sure you want to delete this element?')) {
            //     $(this).slideUp(deleteElement);
            //     }
            // }
            // });
$('#cv').summernote({
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
            function handleCountry(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=residenza_provincia`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.provincia = res)
                }
                else {
                    this.provincia = '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control">'
                    this.comuni = '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control">'
                }
            }

            function handleCountryNascita(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=nascita_provincia`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.nascita_provincia = res)
                }
                else {
                    this.nascita_provincia = '<input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control">'
                }
            }

            function getResData(){
                return {
                    stato: '', 
                    comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control">', 
                    provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control">',

                    nascita_stato: '', 
                    nascita_provincia : '<input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control">',
                    // init(){
                    //     Promise.allSettled([
                    //         new Promise((resolve, reject) => setTimeout(() => {if ('' == '106') {
                    //             $('#loading').modal('show');
                                
                    //             return fetch(`<?php echo base_url()?>/getProv?country=106&name=residenza_provincia`, 
                    //                 {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                    //                 .then( el => el.text() ).then(res => {this.provincia = res; resolve()})
                    //         } resolve();})) ,


                    //         new Promise((resolve, reject) => setTimeout(() => {if ('') {
                    //             $('#loading').modal('show');

                    //             return fetch(`<?php echo base_url()?>/getComm?prov=&name=residenza_comune`, 
                    //                 {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                    //                 .then( el => el.text() ).then(res => {this.comuni = res; resolve()})
                    //         } resolve();})),

                            
                    //         new Promise((resolve, reject) => setTimeout(() => {if ('' == '106') {
                    //             $('#loading').modal('show');

                                
                    //             return fetch(`<?php echo base_url()?>/getProv?country=106&name=nascita_provincia`, 
                    //                 {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                    //                 .then( el => el.text() ).then(res => {this.nascita_provincia = res; resolve()})
                    //         } resolve();})),

                            
                    //     ])
                        
                    //     .then(() => { $('#loading').modal('hide'); })
                    // }
                }
                }
				
function valid_user(){
	var fields = $( "#add_user_form" ).serializeArray();
		$(".nav-link").removeClass('text-danger');
$("#error_alert").hide('slow');
	$.ajax({
				  url:"<?php echo base_url('Ajax/valid_user')?>",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				
				
				var obj=JSON.parse(data);
				console.log(obj);
				if(obj.error==true){
					$("#error_alert").html(obj.validation);
					$("#error_alert").show('slow');
					$("a[href='#"+obj.tabs_error+"']").addClass('text-danger');
					return false;
				}
				else{
					$( "#add_user_form" ).submit();
				
				}
			});
	
}
        </script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-wizard.init.js"></script>

<?= view('admin/common/endtag') ?>
