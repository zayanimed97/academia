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
														<h4>Server di posta elettronica</h4>
											<p>In questa sezione puoi configurare la posta elettronica in uscita dalla piattaforma direttamente con il tuo indirizzo mail, così che risulti il mittente del messaggio.</p>
									<div class="alert alert-info m-b-20" role="alert">Se non imposti nessun account di posta elettronica (oppure se i dati non saranno più validi) le e-mail verranno inviate dal nostro server con indirizzo no-reply@auledigitali.it e riporteranno la tua e-mail nel campo reply-to.</div>
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
														<div class="row">
															<div class="col-12">
																<a href="#testsmtp-modal-dialog"  class="btn btn-warning" data-toggle="modal"><?php echo lang('app.btn_test_smtp')?></a>	
															</div>
														</div>
                                                   <hr/>
                                                	<h4>Pagina contatti</h4>
											<p>In questa sezione puoi impostare una mail di destinazione quando quelcuno ti scrive dalla tua pagina contatti.</p>
                                                   <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-6 col-form-label" for="cognome"> <?php echo lang('app.field_receiver_email')?></label>
                                                                    <div class="col-md-6">
                                                                        <input placeholder="es.: mail@nomedominio.it" type="text" id="email" name="email" class="form-control" value="<?= $email ?? '' ?>">
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


<?php $attributes = ['class' => 'form-input-flat', 'id' => 'testsmtpform','method'=>'post'];
		echo form_open("", $attributes);?>
		
		<div class="modal fade"id="testsmtp-modal-dialog" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_test_smtp')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group">
                         <label>Email</label>
						  <input placeholder="es.: test@test.it" type="text" id="smtp_test_email" name="smtp_test_email" class="form-control" >
						  <div id="result_smtp">
						  
						  </div>
						  </div>
                            <div class="text-right">
                                <button type="button" data-dismiss="modal" class="btn btn-success waves-effect waves-light"><?php echo lang('app.btn_close')?></button>
                                <button type="button" onclick="return send_test_smtp()" class="btn btn-danger waves-effect waves-light" ><?php echo lang('app.btn_send')?></button>
                            </div>
                        
                    </div>
                </div><!-- /.modal-content -->
            </div>
		</div>
       <?php echo form_close();?>

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
  function send_test_smtp(){
	
	var fields = $( "#add_ente_form" ).serializeArray();
	var smtp_test_email=$("#smtp_test_email").val();
	fields.push({name: 'smtp_test_email', value: smtp_test_email});
	$.ajax({
				  url:"<?php echo base_url('ProfileController/send_test_smtp')?>",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				//console.log(data);
				$("#result_smtp").html(data);
			
			});
  }      
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
