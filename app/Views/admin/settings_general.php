<?= view('admin/common/header',array('page_title'=>lang('app.title_page_profile_settings'))) ?>

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
                                            <li class="breadcrumb-item active"><?php echo lang('app.menu_settings')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_profile_settings')?></h4>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" >
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                     	<div class="alert alert-danger" role="alert" id="error_alert" style="display:none"></div>   
                                        <form method="post" action="<?= base_url('admin/profile/'. $profile_menu) ?>"  id='add_ente_form'>
										<input type="hidden" name="profile_menu" value="<?php echo $profile_menu?>">
														<h4>General Settings</h4>
											<p>Instructions to get app ID</p>
									<div class="alert alert-info m-b-20" role="alert">Se non imposti nessun account di posta elettronica (oppure se i dati non saranno più validi) le e-mail verranno inviate dal nostro server con indirizzo no-reply@auledigitali.it e riporteranno la tua e-mail nel campo reply-to.</div>
                                                        <div class="row">
															  <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> <?php //echo lang('app.field_sender_email')?>APP ID</label>
                                                                    <div class="col-md-9">
                                                                        <input placeholder="123123123123" type="text" id="sender_email" name="id" class="form-control" value="<?= $facebook_id ?? '' ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
															
															<div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> <?= lang('app.field_amount')?></label>
                                                                    <div class="col-md-9">
                                                                        <input placeholder="10" type="text" id="sender_name" name="discount" class="form-control" value="<?= $facebook_discount ?? '10' ?>">
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