<?= view('admin/common/header') ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
											 <li class="breadcrumb-item"><a href="<?php echo base_url('admin/test')?>"><?php echo lang('app.menu_corsi_test')?></a></li
											  <li class="breadcrumb-item active"><?php echo lang('app.new_test')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.title_page_cours_test_add') ?></h4>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									<?php if(isset($success)){?>
									<div class="alert alert-success" role="alert" id="" ><?php echo $success?></div>    
									<?php } ?>
										<div class="alert alert-danger" role="alert" id="error_alert" style="display:none"></div>    
                                        <?php $attributes = ['class' => '', 'id' => 'form_profile','method'=>'post'];
					echo form_open_multipart( base_url('admin/test/add'), $attributes);
				
					?>
						<div class="row">
							<div class="col-md-4">	
								<label><?php echo lang('app.field_type')?> <span class="text-danger">*</span></label>
								<select class="form-control" id="type" name="type" onchange="return get_type(this.value)">
									
									<option value="modulo" selected><?php echo lang('app.field_test')?></option>
									<option value="quality"><?php echo lang('app.field_test_quality')?></option>
									
								</select>
							</div>
							
							<div class="col-md-6">	
								<label><?php echo lang('app.field_title')?> <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="" id="title" name="title" placeholder="<?php echo lang('app.field_question')?>">
							</div>
							
							
							<div class="col-md-2">	
								<label><?php echo lang('app.field_sort')?> </label>
								<input type="number" step="1" min="1" class="form-control" value="1" id="ord" name="ord" placeholder="<?php echo lang('app.field_order')?>">
							</div>
						</div>
						<div class="row" id="div_modulo">
							<div class="col-md-4" style="margin-top:25px">
							<div class="form-check form-check-inline">
											<?php 
											 $chk=true;
										
											$data = [
											'name'    => "auto_score",
											'id'      => 'auto_score',
											'value'   => 'yes',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang('app.field_auto_score');?></label>
									</div>
							</div>
							<div class="col-md-4">	
								<label><?php echo lang('app.field_min_points')?> </label>
								<input type="number" step="1" min="1" class="form-control" value="1" id="min_points" name="min_points">
							</div>
							<div class="col-md-4">	
								<label><?php echo lang('app.field_nb_repeat')?> </label>
								<input type="number" step="1" min="0" class="form-control" value="0" id="nb_repeat" name="nb_repeat" >
							</div>
						</div>
                        <div class="repeater-default m-t-30">
                                    <div data-repeater-list="questions">
								
                                        <div data-repeater-item="">
                                         
                                                <div class="form-row">
                                                    <div class="col-12 col-lg-6">
														<div class="card">
															<div class="card-body">
																<div class="alert alert-danger alert-danger-question" role="alert" style="display:none"></div>
																<h4 class="card-title"><?php echo lang('app.field_title')?> <input type="hidden" name="question_index" value="1" style="width:60px"  disabled></h4>
															  
																<div class="row">	
																	<div class="col-md-12">	
																		<input type="text" class="form-control question" id="question_title" name="question_title" placeholder="<?php echo lang('app.field_question')?>">
																	</div>
																</div>
																<div class="row  m-t-10">	
																	<div class="col-md-6">	
																		<select class="form-control question" id="question_type" name="question_type">
																			<option value=""><?php echo lang('app.field_question_type')?></option>
																			<option value="unica">unica</option>
																			<option value="multipla">multipla</option>
																			<option value="aperta">aperta</option>
																		</select>
																	</div>
																	<div class="col-md-6">	
																		<select class="form-control question" id="question_time" name="question_time" >
																			<option value=""><?php echo lang('app.field_question_time')?></option>
																			<?php for($i=30;$i<=60;$i=$i+10){?>
																			<option value="<?php echo $i?>"><?php echo $i?></option>
																			<?php } ?>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-12 col-lg-6">
														<div class="card">
															<div class="card-body">
																
															   
																	<div class="">
																		
																		<div class="answer-repeater form-group">
																		<div class="alert alert-danger alert-danger-question-answer" role="alert" style="display:none"></div>
																			<div data-repeater-list="answers">
																				<div data-repeater-item class="row m-b-15">
																				<h4 class="card-title col-md-12"><?php echo lang('app.field_response')?><input type="hidden" name="answer_index" value="1" style="width:60px"  disabled></h4>
																					<div class="col-md-8">
																						<input type="text" class="form-control" id="answer_title" name="answer_title" placeholder="<?php echo lang('app.field_response_title')?>">
																					</div>
																					<div class="col-md-2">
																						<input type="text" class="form-control" id="answer_points" name="answer_points" placeholder="<?php echo lang('app.field_response_points')?>">
																					</div>
																					<div class="col-md-2 ">
																						<button data-repeater-delete=""  type="button" class="btn btn-danger waves-effect waves-light" type="button"><i class="fa fa-trash"></i>
																						</button>
																					</div>
																				</div>
																			</div>
																			<button type="button" data-repeater-create="" class="btn btn-warning waves-effect waves-light"><?php echo lang('app.btn_add_response')?>
																			</button>
																		</div>
																		
																	</div>
																
															</div>
														</div>
													</div>
												<div class="form-group col-md-12">
												   
													<button data-repeater-delete="" class="btn btn-danger waves-effect waves-light m-l-10" type="button"><?php echo lang('app.btn_delete_question')?>
													</button>
												</div>
											</div>
											
										
                                            <hr>
                                        </div>
									
                                    </div>
                                    <button data-repeater-create="" class="btn btn-success waves-effect waves-light" id="add_question_btn"  type="button"><?php echo lang('app.btn_add_question')?></button>
									
                                </div>
						     
                            <hr>
                          

                            <div class="mb-2"></div><!-- margin -->

                    
                                
                         
  
                         
                            <div class="form-footer">
                           

                                <div class="form-footer-right">
								<?php $data=["name"=>"save_profile",
											"value"=>lang('app.btn_save'),
											'class' => 'btn btn-primary'
								];
								$js = 'onClick="valid_profile()"';
								echo form_button($data,lang('app.btn_save'),$js);?>
                                  <div class="checkbox form-check-inline" style="margin-left:20px">
																			<input type="checkbox" name="enable" id="enable" value="yes" checked>
																			<label for="enable"> <?php echo lang('app.field_active_status')?> </label>
																		</div> 
                                </div>
								
                            </div><!-- End .form-footer -->
                        <?php echo form_close();?>
                                   
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
    
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                2015 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="">Coderthemes</a> 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

            <!-- add new modal content -->
         


        
<?= view('admin/common/footer') ?>


<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>
<script>
$('.repeater-default').repeater({
		isFirstItemUndeletable: false,
		repeaters: [{
                
                selector: '.answer-repeater',
				//isFirstItemUndeletable: true
				
				
            }],
			 ready: function (setIndexes) { 
				
				//console.log(setIndexes);
				
            },
		
		show: function() {
			//reset_indexes();
            $(this).slideDown();
		
        },
        hide: function(remove) {
			
            if (confirm("<?php echo lang('app.alert_msg_delete_question')?>")) {
				
                $(this).slideUp(remove);
				//$(this).remove();
            }
			
        }
	});
    function get_type(v){
       if(v=='quality') $("#div_modulo").hide(0);
       else $("#div_modulo").show(0);
    }
	function valid_profile(){ 
				var fields = $( "#form_profile" ).serializeArray();
			$(".alert-danger-question").hide('slow');
			$.ajax({
				  url:"<?php echo base_url()?>/Test/validation",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				console.log(data);
				var obj=JSON.parse(data);
				if(obj.error==true){
					if(obj.error_q_index!=""){
						let child = $("input[name='questions["+obj.error_q_index+"][question_index]']").parent().parent().children();
						$.each(child, function( index, value ) {
							if($(this).hasClass('alert-danger-question')){
								$(this).show(0);
								$(this).html(obj.validation);
							}
						});
					}
					else{
						$("#error_alert").show(0);
						$("#error_alert").html(obj.validation);
					}
					return false;
				}
				else{
					$(".alert-danger-question").hide('slow');
					$( "#form_profile" ).submit();
					//return true;
				}
			});
			return false;
		}
</script>
<?= view('admin/common/endtag') ?>
