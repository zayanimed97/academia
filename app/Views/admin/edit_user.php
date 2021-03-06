<?php 
$role=$user['role'];
if($role=='doctor'){
	$page_title=lang('app.title_page_edit_doctor');
	$menu=lang('app.menu_doctors');
	$menu_new=lang('app.edit_doctor');
}
else{
	$page_title=lang('app.title_page_edit_participant');
	$menu=lang('app.menu_participant');
	$menu_new=lang('app.edit_participant');
	
}?>
<?= view('admin/common/header',array('page_title'=>$page_title)) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                                        <form method="post" id="add_user_form" action="<?= base_url() ?>/admin/updateUser"  x-data="getResData()" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $id ?>">
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
                                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                            <span class="d-none d-sm-inline"><?php echo lang('app.menu_media')?></span>
                                                        </a>
                                                    </li>
													
                                                   <?php if($role=='participant'){?>
												    <li class="nav-item">
                                                        <a href="#basictab5" data-toggle="tab" id="basic5" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-file-pdf mr-1"></i>
                                                            <span class="d-none d-sm-inline"><?php echo lang('app.menu_fattura')?></span>
                                                        </a>
                                                    </li>
												    <li class="nav-item">
                                                        <a href="#basictab4" data-toggle="tab" id="basic4" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-cart mr-1"></i>
                                                            <span class="d-none d-sm-inline"><?php echo lang('app.menu_corsi')?></span>
                                                        </a>
                                                    </li>
												   <?php } ?>
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
                                                                    <label class="col-md-3 col-form-label" for="Email">Email</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="Email" name="email" value="<?= $user['user_email'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="password">  <?php echo lang('app.field_password')?> </label>
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
																	
                                                                       <input type="checkbox" name="active" id="active" value="yes" <?php if($user['active']=='yes') echo 'checked'?>>
																	  
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
                                                    <div class="tab-pane" id="basictab2" >
                                                        <div class="row" >
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name"> <?php echo lang('app.field_first_name')?> </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="name" name="nome" class="form-control" value="<?= $user['nome'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> <?php echo lang('app.field_last_name')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="cognome" name="cognome" class="form-control" value="<?= $user['cognome'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->
                                                        


                                                        <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="email_profile"> email</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="email_profile" name="email_profile" class="form-control" value="<?= $user['email'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="telefono"> <?php echo lang('app.field_phone')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?= $user['telefono'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                               <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="mobile"> <?php echo lang('app.field_mobile')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="mobile" name="mobile" class="form-control" value="<?= $user['mobile'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div> <!-- end row -->

                                                        <!-- <template x-if="private == 'private'"> -->
                                                            <div class="row" >
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="cf"> <?php echo lang('app.field_cf')?>  </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="cf" name="cf" class="form-control" value="<?= $user['cf'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="ruolo"> <?php echo lang('app.field_ruolo')?> </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="ruolo" name="ruolo" class="form-control" value="<?= $user['ruolo'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div> <!-- end row -->
                                                      <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_stato"><?php echo lang('app.field_country')?></label>
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
                                                                    <label class="col-md-3 col-form-label" for="residenza_comune"> <?php echo lang('app.field_city')?></label>
                                                                    <div class="col-md-9" x-html="comuni">
                                                                        <!-- <input type="text" id="residenza_comune" name="residenza_comune" class="form-control" value="<?= $user['user_email'] ?>"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_cap"> <?php echo lang('app.field_zip')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="residenza_cap" name="residenza_cap" class="form-control" value="<?= $user['residenza_cap'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                      
                                                            <div class="col-12 col-md-8">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_indirizzo"> <?php echo lang('app.field_address')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="residenza_indirizzo" name="residenza_indirizzo" class="form-control" value="<?= $user['residenza_indirizzo'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="description"> <?php echo lang('app.field_description')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="description" name="description" class="form-control" value="<?= $user['description'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
															
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="qualifica"> <?php echo lang('app.field_qualifica')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="qualifica" name="qualifica" class="form-control" value="<?= $user['qualifica'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
															
															<?php if($role=='participant'){?>
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="prof_albo"> <?php echo lang('app.field_prof_albo')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="prof_albo" name="prof_albo" class="form-control"  value="<?= $user['prof_albo'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
															
															 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="prof_albo"> <?php echo lang('app.field_professione_city')?></label>
                                                                    <div class="col-md-9">
                                                                      <?php  $val=$user['professione_citta'] ?? '';
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
                                                                       <?php $val=$user['abo'] ?? '';
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
                                                                        <?php  $val=$user['del'] ?? '';
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
										echo form_dropdown($input, $options,$user['posizione']);
										?>
                                                                    </div>
                                                                </div>
                                                            </div>
															<?php } ?>
                                                        </div> <!-- end row -->
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
													<input type="hidden" name="delete_foto" id="delete_foto" value="no">
													<input type="hidden" name="delete_prima" id="delete_prima" value="no">
												<div class="row" >
												<div class="col-md-6">
													<?php if($user['logo']!=""){?>
														<div class="row" id="div_foto">
															<div class="col-sm-4">
																<img src="<?php echo base_url('uploads/users/'.$user['logo'])?>" alt="image" class="img-fluid img-thumbnail" width="100%">
																<button class="btn btn-danger btn-xs" onclick="del_foto();"><i class="fa fa-trash"></i></button>
															</div>
														</div>
													<?php } ?>
												</div>
												<div class="col-md-6">
												<?php if($user['prima']!=""){?>
														<div class="row" id="div_prima">
															<div class="col-sm-4">
																<img src="<?php echo base_url('uploads/users/'.$user['prima'])?>" alt="image" class="img-fluid img-thumbnail" width="100%">
																<button class="btn btn-danger btn-xs" onclick="del_prima();"><i class="fa fa-trash"></i></button>
															</div>
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
																	<input type="text" id="cv_titolo" name="cv_titolo" class="form-control" value="<?= $user_cv['titolo'] ?>">
																</div>
															</div>
														</div>
													 <div class="col-md-12">
                                            <div class="form-group required-field">
                                                <label for="acc-name"><?php echo lang('app.field_cv')?></label>
													 <?php 
										$input = [
												'rows'=>3,
												'name'  => 'cv',
												'id'    => 'cv',
												'value' =>  $user_cv['cv'],
												'rows' =>6,
												'class' => 'form-control'
												
										];

										echo form_textarea($input);
										?></div></div>
													</div>
													<?php } ?>
                                                    </div>
												 <div class="tab-pane" id="basictab4">
												  
														
															<table id="basic-datatable" class="table dt-responsive nowrap w-100">
																<thead>
																	<th><?php echo lang('app.field_corsi')?></th>
																	<th><?php echo lang('app.field_date')?></th>
																	<th><?php echo lang('app.field_amount')?></th>
																</thead>
																<tbody>
																	<?php if(!empty($list_achat)){
																		foreach($list_achat as $k=>$v){?>
																			<tr>
																				<td><?php echo $v['corsi']?></td>
																				<td><?php echo $v['date']?></td>
																				<td><?php echo $v['quota']?></td>
																			</tr>
																	<?php } } ?>
																</tbody>
																</table>
														
												 </div>
                                                    <div class="tab-pane" id="basictab5">
													<div class="row">
																<div class="col-12 mb-3">
                                                                	<div class="alert alert-warning help_type text-primary" role="alert"><b>La fattura verr?? intestata:</b></div>
                                                                        <div class="radio form-check-inline">
																			<input type="radio" name="type" id="type_private" value="private" onclick="return get_type('private')" <?php if($user['type']=='private') echo 'checked'?>>
																			<label for="type_private"> <?php echo lang('app.field_type_private')?> </label>
																		
																		</div>
																		<div class="radio form-check-inline">
																			<input type="radio" name="type" id="type_professional" value="professional"  onclick="return get_type('professional')"  <?php if($user['type']=='professional') echo 'checked'?>>
																			<label for="type_professional"> <?php echo lang('app.field_type_professional')?> </label>
																		
																		</div>
																		 <div class="radio form-check-inline">
																		<input type="radio" name="type" id="type_company" value="company" onclick="return get_type('company')"  <?php if($user['type']=='company') echo 'checked'?>>
																			<label for="type_company"> <?php echo lang('app.field_type_company')?> </label>
																		
																		</div>
															</div>
														</div>

														<div class="row">
															 <div class="col-6" id="div_company"  <?php if($user['type']!='company'){?>style="display:none" <?php } ?>>
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_company_name')?></label>
									<div class="col-md-9">
										<?php $val=$user['ragione_sociale']; 
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
                                  <div class="col-6" id="div_piva" <?php if($user['type']=='private'){?>style="display:none" <?php } ?>>
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_piva')?></label>
                                   <div class="col-md-9">
								        <?php $val=$user['fattura_piva']; 
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
								<div class="col-6" id="div_cf" >
														 <div class="form-group row mb-3">
													<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_cf')?></label>
													<div class="col-md-9">
														<?php $val=$val=$user['fattura_cf']; 
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
																  <div class="col-6" id="div_fattura_nome" <?php if($user['type']=='company'){?>style="display:none" <?php } ?>>
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_first_name')?></label>
									<div class="col-md-9">
										<?php $val=$user['fattura_nome']; 
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
                                  <div class="col-6" id="div_fattura_cognome" <?php if($user['type']=='company'){?>style="display:none" <?php } ?>>
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_last_name')?></label>
                                   <div class="col-md-9">
								        <?php $val=$user['fattura_cognome']; 
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
                              
								
								<div class="col-6">
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
										echo form_dropdown($input, $options,$user['fattura_stato'],$js);
										?>

									</div>
								</div>
                               </div>
                                   <div class="col-6" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_provincia')?></label>
                                    <div class="col-md-9" id="div_fattura_provincia">
										<?php $input = [
												
												'name'  => 'fattura_provincia',
												'id'    => 'fattura_provincia',
												'placeholder' =>lang('app.field_provincia'),
												'class' => 'form-control'
										];
										
											if($user['fattura_stato']==106){
										$options=array();
										$options['']=lang('app.field_select');
										if(!empty($list_provincia)){
										foreach($list_provincia as $k=>$v){
											$options[$v['id']]=$v['provincia'];
										}
										}
										$js = ' onChange="get_comune(\'fattura_provincia\',this.value);"';
										echo form_dropdown($input, $options,$user['fattura_provincia'],$js);
										}
										else{
											$input['value']=$user['fattura_provincia'];
											echo form_input($input);
										}
										
										?>
									</div>
								</div>
							</div>
                                   <div class="col-6" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_city')?></label>
									<div class="col-md-9" id="div_fattura_comune">
										<?php $input = [
												
												'name'  => 'fattura_comune',
												'id'    => 'fattura_comune',
												'placeholder' =>lang('app.field_city'),
												'class' => 'form-control'
										];
										
											if($user['fattura_stato']==106){
											$options=array();
											$options['']=lang('app.field_select');
											if(!empty($list_comuni)){
											foreach($list_comuni as $k=>$v){
												$options[$v['id']]=$v['comune'];
											}
											}
											echo form_dropdown($input, $options,$user['fattura_comune']);
										}
										else{
											$input['value']=$user['fattura_comune'];
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
										<?php $val=$user['fattura_indirizzo']; 
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
										<?php $val=$user['fattura_cap']; 
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
							    <div class="col-6">
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_phone')?></label>
                                    <div class="col-md-9">
										<?php $val=$user['fattura_phone']; 
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
								<div class="col-6" >
														 <div class="form-group row mb-3">
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_pec')?></label>
                                    <div class="col-md-9">
										<?php $val=$user['fattura_pec']; 
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
<div class="col-6" >
														 <div class="form-group row mb-3" id="div_sdi" <?php if($user['type']=='private'){?>style="display:none" <?php } ?>>
									<label class="col-md-3 col-form-label" for="acc-name"><?php echo lang('app.field_sdi')?></label>
                                    <div class="col-md-9">
										<?php $val=$user['fattura_sdi']; 
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
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <!-- Init js-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-pickers.init.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.js"></script>
		<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/lang/summernote-it-IT.min.js"></script>

        <script>
        $('#basic4').click(()=>{
            if ( ! $.fn.DataTable.isDataTable( '#basic-datatable' ) ) {
                var table =$('#basic-datatable').DataTable({
                    responsive: false,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json'
                    },
                    scrollY:600,
                    scrollX:!0,
                    scrollCollapse:!0,
                    paging:!1,
		
          
                });
            }
        })
		
		
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

            function handleCountry(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=residenza_provincia&selected=<?= $user['nascita_provincia'] ?>`, 
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
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=nascita_provincia&selected=<?= $user['nascita_provincia'] ?>`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.nascita_provincia = res)
                }
                else {
                    this.nascita_provincia = '<input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control">'
                }
            }

            function getResData(){
                return {
                    stato: '<?= $user['residenza_stato'] ?>', 
                    comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control" value="<?= $user['residenza_comune'] ?>">', 
                    provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control" value="<?= $user['residenza_provincia'] ?>">',

                    nascita_stato: '<?= $user['nascita_stato'] ?>', 
                    nascita_provincia : '<input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control" value="<?= $user['nascita_provincia'] ?>">',
                    init(){
                        Promise.allSettled([
                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['residenza_stato'] ?>' == '106') {
                                // $('#loading').modal('show');
                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['residenza_provincia'] ?>&name=residenza_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.provincia = res; resolve()})
                            } resolve();})) ,


                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['residenza_stato'] ?>' == '106' && '<?= $user['residenza_provincia'] ?>') {
                                // $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['residenza_provincia'] ?>&selected=<?= $user['residenza_comune'] ?>&name=residenza_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.comuni = res; resolve()})
                            } resolve();})),

                            
                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['nascita_stato'] ?>' == '106') {
                                // $('#loading').modal('show');

                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['nascita_provincia'] ?>&name=nascita_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.nascita_provincia = res; resolve()})
                            } resolve();})),

                            
                        ])
                        
                        .then(() => { 
                            // $('#loading').modal('hide'); 
                            console.log('complete');
                        })
                    }
                }
                }
				function valid_user(){
	var fields = $( "#add_user_form" ).serializeArray();
		$(".nav-link").removeClass('text-danger');
$("#error_alert").hide('slow');
	$.ajax({
				  url:"<?php echo base_url('Ajax/valid_user_update')?>",
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
	
}function del_foto(){
	if(confirm("<?php echo lang('app.msg_delete_foto')?>")){
		$("#div_foto").remove();
		$("#delete_foto").val('yes');
	}
}

function del_prima(){
	if(confirm("<?php echo lang('app.msg_delete_foto')?>")){
		$("#div_prima").remove();
		$("#delete_prima").val('yes');
	}
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
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-wizard.init.js"></script>

<?= view('admin/common/endtag') ?>
