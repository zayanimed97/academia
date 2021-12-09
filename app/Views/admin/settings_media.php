<?= view('admin/common/header',array('page_title'=>lang('app.title_page_settings_media'))) ?>

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
                                            <li class="breadcrumb-item active"><?php echo lang('app.menu_setting_media')?></li>
                                          
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_settings_media')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
						<?php 
										 if(isset($warning)){?>
										 <div class="alert alert-warning m-b-20" role="alert">
											 <?php echo $warning?>
											</div>
										 <?php }?>
						 <?php 
										 if(isset($validation)){?>
										 <div class="alert alert-danger m-b-20" role="alert">
											 <?php echo $validation->listErrors()?>
											</div>
										 <?php }?>
							 <?php 
							 
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
                            <div class="col-6">
                                <div class="card">
								 
                                    <div class="card-body">
                                        <h4 class="header-title"><?php echo lang('app.title_section_media_logo')?></h4>
                                       
										<?php $attributes = ['class' => 'form-input-flat', 'id' => 'add_corsi_form','method'=>'post'];
											echo form_open_multipart('', $attributes);?>
											<input type="hidden" name="action" value="logo">
													<div class="col-md-12">
													  <div class="form-group">
														<label class="col-form-label " for="logo"><?php echo lang("app.field_logo")?> </label>
														<div class="row">
															<div class="col-8">
															<input class="form-control" type="file" id="logo" name="logo"  />
															</div>
															<div class="col-4">
																<?php if($logo!=""){?> <img src="<?php echo base_url('uploads/'.$logo)?>" style="width:100%"> <?php } ?>
															</div>
														</div>
														</div>
													 </div>
													 <div class="col-md-12">
													  <div class="form-group">
														<label class="col-form-label " for="faveicon"><?php echo lang("app.field_faveicon")?> </label>
														<div class="row">
															<div class="col-8">
															<input class="form-control" type="file" id="faveicon" name="faveicon"  />
															</div>
															<div class="col-4">
																<?php if($faveicon!=""){?> <img src="<?php echo base_url('uploads/'.$faveicon)?>" style="width:100%"> <?php } ?>
															</div>
														</div>
														</div>
													 </div>
											<?php $data=["name"=>"save",
											"value"=>lang('app.btn_save'),
											'class' => 'btn btn-success'
								];
								
								echo form_submit($data,lang('app.btn_save'));?>
										</form>
                                    
                                        <!-- end row-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
							  <div class="col-6">
                                <div class="card">
								 
                                    <div class="card-body">
                                        <h4 class="header-title"><?php echo lang('app.title_section_media_corso')?></h4>
                                       
										<?php $attributes = ['class' => 'form-input-flat', 'id' => 'add_corsi_form','method'=>'post'];
											echo form_open_multipart('', $attributes);?>
											<input type="hidden" name="action" value="corso">
											<?php $packs=json_decode($inf_package['package'],true);
											if(in_array('aula',$packs['type_cours'])){?>
													<div class="col-md-12">
													  <div class="form-group">
														<label class="col-form-label " for="aula">Aula </label>
														<div class="row">
															<div class="col-8">
															<input class="form-control" type="file" id="aula" name="aula"  />
															</div>
															<div class="col-4">
																<?php if($aula!=""){?> <img src="<?php echo base_url('uploads/'.$aula)?>" style="width:100%"> <?php } ?>
															</div>
														</div>
														</div>
													 </div>
											<?php } 
												if(in_array('webinar',$packs['type_cours'])){?>
													<div class="col-md-12">
													  <div class="form-group">
														<label class="col-form-label " for="webinar">webinar </label>
														<div class="row">
															<div class="col-8">
															<input class="form-control" type="file" id="webinar" name="webinar"  />
															</div>
															<div class="col-4">
																<?php if($webinar!=""){?> <img src="<?php echo base_url('uploads/'.$webinar)?>" style="width:100%"> <?php } ?>
															</div>
														</div>
														</div>
													 </div>
											<?php } 
												if(in_array('online',$packs['type_cours'])){?>
													<div class="col-md-12">
													  <div class="form-group">
														<label class="col-form-label " for="online">online </label>
														<div class="row">
															<div class="col-8">
															<input class="form-control" type="file" id="online" name="online"  />
															</div>
															<div class="col-4">
																<?php if($online!=""){?> <img src="<?php echo base_url('uploads/'.$online)?>" style="width:100%"> <?php } ?>
															</div>
														</div>
														</div>
													 </div>
											<?php } ?>											
											<?php $data=["name"=>"save",
											"value"=>lang('app.btn_save'),
											'class' => 'btn btn-success'
								];
								
								echo form_submit($data,lang('app.btn_save'));?>
										</form>
                                    
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
		<?php $attributes = ['class' => 'form-input-flat', 'id' => 'myform','method'=>'post'];
		echo form_open('', $attributes);?>
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="id_to_delete" id="id_to_delete">
		
		<div class="modal fade"id="delete-modal-dialog" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_new_item_category')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group">
                           <?php  echo lang('app.alert_msg_delete_item')?>
						  </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo lang('app.btn_delete')?></button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"><?php echo lang('app.btn_close')?></button>
                            </div>
                        
                    </div>
                </div><!-- /.modal-content -->
            </div>
		</div>
		
		
		
		
           <?php echo form_close();?>	
		
		
      <?= view('admin/common/footer') ?>
        <!-- Vendor js -->
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/js/vendor.min.js"></script>
		
		 <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
		
		  <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
		  <script src="https://npmcdn.com/flatpickr/dist/l10n/it.js"></script>
		 <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		 
		  <!-- third party js -->
       
		 
        <!-- App js -->
		 <!--script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/js/pages/form-pickers.init.js"></script-->
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/js/app.min.js"></script>
        <script>
	
		$(document).ready(function(){
			$("#scroll-horizontal-datatable").DataTable({scrollX:!0,
			language:{
					url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json',
				paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"},
			
			},
				drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}
			});
			$("#nascita_data").flatpickr({
				"altInput":true,
				"altFormat":"j F, Y",
				"dateFormat":"Y-m-d",
				"locale": "it"
			});
		});
		function del_data(id){
			$("#id_to_delete").val(id);
		}
		  function list_booking(id){
		 $("#booking_form_item_id").val(id);
		 $("#booking_form").submit();
	 }
		</script>
   <?= view('admin/common/endtag') ?>