<?= view('admin/common/header',array('page_title'=>lang('app.title_page_settings_remember_emails_add'))) ?>
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
                                              <li class="breadcrumb-item"><?php echo lang('app.menu_settings')?></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/remember_emails')?>"><?php echo lang('app.menu_setting_remember_emails')?></a></li>
											<li class="breadcrumb-item active"><?php echo lang('app.menu_setting_remember_email_add')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_settings_remember_emails_add')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      
                                        <?php //echo $validation->listErrors()
										 if(isset($validation)){?>
										 <div class="alert alert-danger m-b-20" role="alert">
											 <?php echo $validation->listErrors()?>
											</div>
										 <?php }?>
							 <?php //echo $validation->listErrors()
							 
										 if(isset($error)){?>
										 <div class="alert alert-danger m-b-20" role="alert">
											 <?php echo $error?>
											</div>
										 <?php }?>
										  <?php //echo $validation->listErrors()
										 if(isset($success)){?>
										 <div class="alert alert-success m-b-20" role="alert">
											 <?php echo $success?>
											</div>
										 <?php }?>
										
									
                                        <div class="row">
										
											<div class="col-lg-8">
											
												<?php $attributes = ['class' => 'form-input-flat', 'id' => 'add-form','method'=>'post'];
										//echo form_open( base_url().'/admin/remember_emails/add/', $attributes);
										
										?>
												<form method="post" onsubmit="return test();" id="form_add">
												<div class="row">
												
												<div class="col-md-6">
														<div class="form-group required-field">
															<label for="acc-mname"><?php echo lang('app.field_days')?> <span class="text-danger">*</span></label>
														 <input class="form-control" type="number" min="1" step="1" max="90" id="nb_days" name="nb_days" value="<?php echo $inf['nb_days'] ?? '7'?>" />
														</div>
													</div>
													<div class="col-md-6">
													<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_type_days')?></label>
														 <?php $input = [
												
																'name'  => 'type_days',
																'id'    => 'type_days',
																'placeholder' =>lang('app.field_type_days'),
																'class' => 'form-control'
														];
														$options=array();
														
														$options['before']=lang('app.field_before');
														$options['after']=lang('app.field_after');
														$js='';
														echo form_dropdown($input, $options,'before',$js);
														?>
													
														</div>
													</div>
													
										</div>		
									<div class="row">
									<div class="col-md-12">
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_type_cours')?></label>
														 <?php $input = [
												
																'name'  => 'tipologia_corsi',
																'id'    => 'tipologia_corsi',
																'placeholder' =>lang('app.field_type_cours'),
																'class' => 'form-control'
														];
														$options=array();
														$options['']=lang('app.field_select');
														foreach($ente_package['type_cours'] as $k=>$v){
																$options[$v]=$type_cours[$v] ?? $v;
															}
														$js='';
														echo form_dropdown($input, $options,'aula',$js);
														?>
													
														</div>
													</div>
										
									</div>
									<div class="row">
												
												<div class="col-md-12">
														<div class="form-group required-field">
															<label for="acc-mname"><?php echo lang('app.field_subject')?> <span class="text-danger">*</span></label>
														 <?php $val=""; 
													$input = [
															'type'  => 'text',
															'name'  => 'subject',
															'id'    => 'subject',
															'required'=>true,
															'value' => $val,
															'placeholder' =>lang('app.field_subject'),
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
													
													
										</div>		
									<div class="row">
									<div class="col-md-12">
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_content')?></label>
														 <?php $val=""; 
													$input = [
															
															'name'  => 'html',
															'id'    => 'summernote-basic',
														
															'value' => $val,
															'placeholder' =>lang('app.field_content'),
															'class' => 'form-control'
															
													];

													echo form_textarea($input);
													?>
														</div>
													</div>
										
									</div>
										 <div class="checkbox form-check-inline">
																			<input type="checkbox" name="enable" id="enable" value="yes" checked>
																			<label for="enable"> <?php echo lang('app.field_active_status')?> </label>
																		</div>

							
												<input type="submit" name="submit" value="<?php echo lang('app.btn_save')?>"  class="btn btn-success width-xs">
												<button type="button" name="send_test" class="btn btn-warning width-xs" onclick="send_test_form();"><?php echo lang('app.btn_send_test')?></button>
					  <?php echo form_close();?>		
											</div>
											
                                    				<div class="col-4">
														<div class="card text-white bg-info text-xs-center">
															<div class="card-body">
															<h5 class="card-title text-white"><?php echo lang('app.title_section_help_email')?></h5>
																<blockquote class="card-bodyquote">
																	<small>{CORSI_SOTTO_TITOLO}</small> <small>{CORSI_URL}</small> <small>{DATA_INIZIO}</small> <small>{PARTICIPAZIONI}</small> <small>{DOCENTI}</small> <small>{SEDE}</small> <small>{HOTEL}</small>  <small>{CONFIRMA_PARTICIPAZIONE}</small> <small>{EMAIL}</small> <small>{PASSWORD}</small>
																</blockquote>
															</div>
														</div> <!-- end card-box-->
													</div>		  
											
                                        </div>
										
                                        <!-- end row-->
									
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php echo view('admin/common/footer_bar')?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

<?= view('admin/common/footer') ?>

        <!-- Vendor js -->
      
        <!-- App js -->
	<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/mohithg-switchery/switchery.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/multiselect/js/jquery.multi-select.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/js/select2.min.js"></script>
      
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.js"></script>
		<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/lang/summernote-it-IT.min.js"></script>
		 <script>
		
		 $(function(){
			 $("#add-form").parsley().on("field:validated",function(){
			 var e=0===$(".parsley-error").length;$(".alert-info").toggleClass("d-none",!e),$(".alert-warning").toggleClass("d-none",e)
			 }).on("form:submit",function(){return true});
			
		});
		 </script>
	
   
       
     <script>
	 !function(n){
		 "use strict";function e(){this.$body=n("body")}
		 e.prototype.init=function(){
			 n("#summernote-basic").summernote({lang: 'it-IT',placeholder:"Write something...",height:230,callbacks:{onInit:function(e){n(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")}}})
			  }
			 ,n.Summernote=new e,n.Summernote.Constructor=e}
			 (window.jQuery),function(){"use strict";window.jQuery.Summernote.init()}();
			 
	function test(){ 
			var nb_days=$("#nb_days").val();
			var tipologia_corsi=$("#tipologia_corsi").val();
			var subject=$("#subject").val();
			var text=$('#summernote-basic').summernote('code');
			
			if(nb_days=="" || tipologia_corsi=="" || subject=="" || text==""){
				alert("<?php echo lang('app.error_required')?>");
				return false;
			}
			else return true;
		}
		function send_test_form(){
			var fields = $( "#form_add" ).serializeArray();
			
			$.ajax({
				  url:"<?php echo base_url()?>/admin/remember_emails/remember_emails_send_test",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				
				alert("<?php echo lang('app.msg_send_mail_test')?>");
				
			});
		}
	 </script>
		
     <?= view('admin/common/endtag') ?>