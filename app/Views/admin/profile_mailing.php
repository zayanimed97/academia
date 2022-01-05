<?= view('admin/common/header',array('page_title'=>lang('app.title_page_profile_mailing'))) ?>

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
                                            <li class="breadcrumb-item active"><?php echo lang('app.menu_mailing')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_profile_mailing')?></h4>
									<p>Configurazione manuale della posta in uscità (SMTP).<br>Per default, tutte le email verrano inviate tramite il server di posta in uscita di Auledigitali: no-reply@auledigitali.it</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" x-data="{ private: '<?= (($user['type'] ?? "") == "private") ? 'private' : 'company' ?>'}">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                     	<div class="alert alert-danger" role="alert" id="error_alert" style="display:none"></div>   
										<?php $smtp=json_decode($SMTP,true);?>
                                        <form method="post" action="<?= base_url('admin/profile/'. $profile_menu) ?>"  id='add_ente_form'>
										<input type="hidden" name="profile_menu" value="<?php echo $profile_menu?>">
														<h4>Configurazione manuale</h4>
                                                        <div class="row" >
                                                          <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name"> <?php echo lang('app.field_smtp_host')?></label>
                                                                    <div class="col-md-9">
                                                                        <input placeholder="es.: nomedominio.it" type="text" id="host" name="host" class="form-control" value="<?= $smtp['host'] ?? ""?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> <?php echo lang('app.field_smtp_username')?></label>
                                                                    <div class="col-md-9">
                                                                        <input placeholder="es.: mail@nomedominio.it" type="text" id="username" name="username" class="form-control" value="<?= $smtp['username'] ?? ""?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                         
														 <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> <?php echo lang('app.field_smtp_password')?></label>
                                                                    <div class="col-md-9">
                                                                        <input placeholder="password della tua email" type="text" id="password" name="password" class="form-control" value="<?= $smtp['password'] ?? ""?>">
                                                                    </div>
                                                                </div>
                                                            </div>
															
															<div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> <?php echo lang('app.field_smtp_port')?></label>
                                                                    <div class="col-md-9">
                                                                        <input placeholder="es.: 995 o 465" type="text" id="port" name="port" class="form-control" value="<?= $smtp['port'] ?? '25' ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                              
															  <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> <?php //echo lang('app.field_sender_email')?>Da</label>
                                                                    <div class="col-md-9">
                                                                        <input placeholder="es.: mail@nomedominio.it" type="text" id="sender_email" name="sender_email" class="form-control" value="<?= $smtp['sender_email'] ?? '25' ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
															
															<div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> <?php //echo lang('app.field_sender_name')?>Nome mittente</label>
                                                                    <div class="col-md-9">
                                                                        <input placeholder="es.: nomedominio.it" type="text" id="sender_name" name="sender_name" class="form-control" value="<?= $smtp['sender_name'] ?? '25' ?>">
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
        
function save_ente(){
	var fields = $( "#add_ente_form" ).serializeArray();
	
	$.ajax({
				  url:"<?php echo base_url('ProfileController/update')?>",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				console.log(data);
				
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

        </script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-wizard.init.js"></script>

<?= view('admin/common/endtag') ?>
