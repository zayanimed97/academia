<?= view('admin/common/header',array('page_title'=>lang('app.title_page_cart'))) ?>
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
											 
											 <li class="breadcrumb-item active"><?php echo lang('app.menu_cart')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.title_page_cart') ?></h4>
										
                                       
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
						
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                     
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
                                        <div class="table-responsive">
                                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
														<th><?php echo lang('app.field_last_name')?></th>	
														<th><?php echo lang('app.field_first_name')?></th>	  
														 <th><?php echo lang('app.field_credentiel')?></th>
														<th><?php echo lang('app.field_total')?></th>		
														<th><?php echo lang('app.field_date')?></th>
														<th><?php echo lang('app.field_status')?></th>																
														<th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($list as $k=>$arg) { ?>
                                                    <tr>
														<td><?= $arg['id'] ?></td>
                                                        <td><?= $arg['participante'] ?></td>
                                                        <td><?= $arg['participant_cognome'] ?></td>
                                                        <td><?= $arg['credentiel'] ?></td>
														<td><?= number_format($arg['total_paid'],2,',','.') ?>€</td>
														<td><?php echo date('d/m/Y',strtotime($arg['date'])) ?></td>
														 <td><?= $arg['status_label'] ?></td>
														<td class="row pt-1">
                                                            <a  data-toggle="modal" data-target="#payment-modal" onclick="get_payments('<?php echo $arg['id']?>')" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-dollar-sign"></i>
                                                            </a>
															<a  data-toggle="modal" data-target="#items-modal" onclick="get_items('<?php echo $arg['id']?>')" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-list"></i>
                                                            </a>
															<?php if(strtolower($arg['status'])=='pending'){?>
                                                            <a data-toggle="modal" data-target="#status-modal" onclick="get_update_status('<?php echo $arg['id']?>','<?php echo $arg['status']?>')" class="p-1 mr-2" style="height: fit-content; font-size: 1rem; color: red">
                                                                <i class="fe-edit-1"></i>
                                                            </a>
															<?php } ?>
                                                           
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div> <!-- end .table-responsive-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
    
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                   <?php echo view('admin/common/footer_bar')?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
 <div id="items-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.title_modal_cart_items') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" id="list_items">

                            

                        </div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal"><?php echo lang('app.btn_cancel')?></a>
							
						</div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

<div id="payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.title_modal_cart_payments') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" id="list_payment">

                            

                        </div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal"><?php echo lang('app.btn_cancel')?></a>
							
						</div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

			
             <?php $attributes = ['class' => '', 'id' => 'pdf_form_list','method'=>'post','onsubmit'=>"return verif_update_status();"];
				echo form_open_multipart( base_url('admin/cart/'), $attributes);?>
				  <input type="hidden" value="" id="statusID" name="id">
				    <input type="hidden" value="update_status" id="action" name="action">
            <div id="status-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.title_modal_update_order_status') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
<div class="form-group required-field">
                            <label for="acc-lastname"><?php echo lang('app.field_status')?> <span class="text-danger">*</span></label>
																	<?php 
																		
																	$input = [
																	
																	'name'  => 'update_status',
																	'id'    => 'update_status',
																	'placeholder' =>lang('app.field_status'),
																	'class' => 'form-control'
															];
															$options=array();
															$options['']=lang('app.field_select');
															$options['COMPLETED']=lang('app.status_completed');
															$options['CANCELED']=lang('app.status_canceled');
															
															echo form_dropdown($input, $options);
															?>
</div>
                        </div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal"><?php echo lang('app.btn_cancel')?></a>
							<?php $data=["name"=>"save",
												"value"=>lang('app.btn_save'),
												'class' => 'btn btn-success'
									];
								
									echo form_submit($data,lang('app.btn_save'));?>
							
						</div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    <?php echo form_close();?>	
<?= view('admin/common/footer') ?>

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
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>

<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/datatables.init.js"></script>

<script>
     function get_update_status(id,status){
      
        $('#statusID').val(id);
		//$("#update_status").val(status);
    }
	
	function get_items(id){
		$.ajax({
				  url:"<?php echo base_url()?>/ajax/get_cart_items",
				  method:"POST",
				  data:{id:id}
				  
			}).done(function(data){
				$("#list_items").html(data);
				
			
			});
	}
	
	function get_payments(id){
		$.ajax({
				  url:"<?php echo base_url()?>/ajax/get_cart_payment",
				  method:"POST",
				  data:{id:id}
				  
			}).done(function(data){
				$("#list_payment").html(data);
				
			
			});
	}
	function verif_update_status(){
		var st=$("#update_status").val();
		if(st==""){
			alert("<?php echo lang('app.error_required')?>");
			return false;
		}
		else return true;
	}
</script>
<?= view('admin/common/endtag') ?>
