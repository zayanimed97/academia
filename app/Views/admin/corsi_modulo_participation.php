<?= view('admin/common/header',array('page_title'=>lang('app.title_page_participation'))) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                          <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>"><?php echo lang('app.menu_dashboard')?></a></li>
											 <li class="breadcrumb-item"><a href="<?php echo base_url('admin/corsi')?>"><?php echo lang('app.menu_corsi')?></a></li>
											  <li class="breadcrumb-item"><a href="<?php echo base_url('admin/modulo')?>"><?php echo lang('app.menu_corsi_modulo')?></a></li>
											 <li class="breadcrumb-item active"><?php echo lang('app.menu_participation')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.title_page_participation') ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
						<div class="row">
							<div class="col-12">
								<div class="alert alert-primary col-12" role="alert">
								  <h4 class="alert-heading"><?php echo $inf_modulo['titolo']?></h4>
								  <p> 
									<ul>
										<li><b><?php echo lang('app.field_subtitle')?>: </b><?php echo $inf_modulo['sotto_titolo']?></li>
										<li><b><?php echo lang('app.field_type_cours')?>: </b><?php echo $inf_corsi['tipologia_corsi']?></li>
										<!--li><b><?php echo lang('app.field_type_formation')?>: </b><?php echo $inf_corsi['tipologia_formazione']?></li-->
										<li><b><?php echo lang('app.field_doctors')?>: </b><?php echo $inf_doctor?></li>
										<?php if($inf_modulo['free']=='yes'){?><li><b><?php echo lang('app.field_free_cours')?>: </b><?php echo lang('app.yes')?></li>
										<?php } else{?>
										<li><b><?php echo lang('app.field_buy_type')?>: </b><?php if($inf_corsi['buy_type']=='cours') echo lang('app.field_buy_type_cours'); elseif($inf_corsi['buy_type']=='module')  echo lang('app.field_buy_type_modulo'); else echo lang('app.field_buy_type_date');?></li>
										<?php } ?>
									</ul>
								  </p>

								</div>
								<div class="col-12" style="margin-bottom: 10px;">
									<div class="row">
										<div style="margin-right: 10px;"><b>Invia email</b></div>
										 <div style="margin-right: 5px;">
										
											<form id="frm-send-credentiel" name="frm-send-credentiel" method="post">
												<input type="hidden" name="action" value="send_credential_multiple">
												<input type="submit" class="btn-sm btn btn-primary" name="generate" value="<?php echo lang('app.btn_send_credentials')?>">
											</form>
										
										</div>
										<div style="margin-right: 5px;">
									
											<form id="frm-send-promo" name="frm-send-promo" method="post">
												<input type="hidden" name="action" value="send_promo_multiple">
												<input type="submit" class="btn-sm btn btn-primary" name="generate" value="<?php echo lang('app.btn_send_promo')?>">
											</form>
										
										</div>
										
										<div>
											<input type="button" onclick="get_notif();" class="btn-sm btn btn-primary" name="generate" value="<?php echo lang('app.btn_send_notification')?>">
											
										
										</div>
									</div>
								</div>
						</div>
						</div>
						 <?php 
										 if(isset($error)){?>
										 <div class="alert alert-danger" role="alert">
											 <?php echo $error?>
											</div>
										 <?php }?>
										  <?php 
										 if(isset($success)){?>
										 <div class="alert alert-success" role="alert">
											 <?php echo $success?>
											</div>
										 <?php }?>
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
														<th data-sorting="disabled"><input type="checkbox" class="toggle-all"></th>
														<th><?php echo lang('app.field_last_name')?></th>	
														<th><?php echo lang('app.field_first_name')?></th>	  
														 <th><?php echo lang('app.field_credentiel')?></th>
														<th><?php echo lang('app.field_cart')?></th>		
														<th><?php echo lang('app.field_date_inscrit')?></th>														
                                                       <?php if($inf_corsi['buy_type']=='date'){?>
													   <th><?php echo lang('app.field_date_session')?></th>	
													   <?php } ?>
													   <th><?php echo lang('app.field_date_confirmation')?></th>
														<?php if($inf_corsi['tipologia_corsi']=='webinar'){?>
															<th><?php echo lang('app.field_participa')?></th>
														<?php } ?>	
													<?php if($inf_corsi['tipologia_corsi']=='online'){?>
														<th><?php echo lang('app.field_progress_video')?></th>
													<?php } ?>														
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($list as $k=>$arg) { ?>
                                                    <tr>
														  <td><?= ($k+1) ?></td>
														  	<td><input type="checkbox" class="ids_generate" name="ids_generate[]" value="<?php echo $arg['id']?>"></td>
                                                        <td><?= $arg['participante'] ?></td>
                                                        <td><?= $arg['participant_cognome'] ?></td>
                                                        <td><?= $arg['credentiel'] ?><br/><a href="<?php echo base_url('/admin/send_credential/'.$arg['id_user'].'/yes')?>"><?php echo lang('app.btn_send_credentials')?></a></td>
														<td><?= $arg['quota'] ?></td>
														<td><?php echo date('d/m/Y',strtotime($arg['date'])) ?></td>
														 <?php if($inf_corsi['buy_type']=='date'){?>
                                                        <td><?php if(isset($arg['date_session']) && $arg['date_session']!="") echo date('d/m/Y',strtotime($arg['date_session'])) ?></td>
														 <?php } ?>
														 <td><?php if($arg['confirm_mail']!="") echo date('d/m/Y',strtotime($arg['confirm_mail'])) ?></td>
														<?php if($inf_corsi['tipologia_corsi']=='webinar'){?>
														<td><?= $arg['confirm_zoom'] ?></td>
														<?php } ?>
														<?php if($inf_corsi['tipologia_corsi']=='online'){?>
															<td>
															<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?= round($arg['total_vimeo_percent']) ?>%" aria-valuenow="<?= round($arg['total_vimeo_percent']) ?>" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<a data-toggle="modal" data-target="#video-status-modal" onclick="get_video_details('<?php echo $arg['id']?>')"><?php echo lang('app.field_details')?></a>
															</td>
														<?php } ?>		
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

             <?php $attributes = ['class' => '', 'id' => 'pdf_form_list','method'=>'post'];
				echo form_open_multipart( base_url('admin/corsi/'.$inf_corsi['id'].'/modulo'), $attributes);?>
				  <input type="hidden" value="" id="deleteID" name="id">
				    <input type="hidden" value="delete" id="action" name="action">
            <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.title_modal_delete_corsi_modulo') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">

                                <?php echo lang('app.msg_delete_corso_modulo')?>

                        </div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn width-100 btn-light" data-dismiss="modal"><?php echo lang('app.btn_close')?></a>
							<?php $data=["name"=>"save",
												"value"=>lang('app.btn_delete'),
												'class' => 'btn btn-danger'
									];
								
									echo form_submit($data,lang('app.btn_delete'));?>
							
						</div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    <?php echo form_close();?>	
	
	<div id="payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.title_modal_cart_details') ?></h4>
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
	<div id="video-status-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.title_modal_video_status') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" id="list_video_status">

                            

                        </div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal"><?php echo lang('app.btn_close')?></a>
							
						</div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
			
			
			     <?php $attributes = ['class' => '', 'id' => 'frm-send-notification','method'=>'post'];
				echo form_open_multipart( base_url('admin/participation/'.$inf_modulo['id']), $attributes);?>
				
				    <input type="hidden" value="send_notification_multiple" id="action" name="action">
            <div id="notif-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.title_modal_send_notification') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
							<label><?php echo lang('app.field_subject')?></label>
                              <input type="text" name="notification_subject" id="notification_subject" class="form-control" value="<?php echo $temp['subject'] ?? ""?>">
							<label><?php echo lang('app.field_message')?></label>
							  <textarea name="notification_message" id="notification_message" class="form-control"><?php echo $temp['html'] ?? ""?></textarea>
							
							  <div class="card text-white bg-info text-xs-center">
															<div class="card-body">
															<h5 class="card-title text-white"><?php echo lang('app.title_section_help_email')?></h5>
																<blockquote class="card-bodyquote">
																  <?php echo $temp['helps'] ?? ""?>
																</blockquote>
															</div>
														</div> <!-- end card-box-->
                        </div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal"><?php echo lang('app.btn_cancel')?></a>
							<?php $data=["name"=>"save",
												"value"=>lang('app.btn_send'),
												'class' => 'btn btn-success'
									];
								
									echo form_submit($data,lang('app.btn_delete'));?>
							
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
  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.js"></script>
		<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/lang/summernote-it-IT.min.js"></script>
<!--script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/datatables.init.js"></script-->
<script>
 var table =$('#basic-datatable').DataTable({
            responsive: false,
			language: {
				url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json'
			},
			scrollY:600,
			scrollX:!0,
			scrollCollapse:!0,
			paging:!1,
		/*	fixedColumns:!0,
			responsive:!0  */
          
        });
	$(".toggle-all").on("click", function () {
		
        $("input:checkbox[class='ids_generate']").prop('checked', $(this).prop('checked'));
    });
	
	$('#frm-send-credentiel').on('submit', function(e){ 
      var form = this;
		var xx= $('[class="ids_generate"]:checked').length; 
		if(xx==0){ alert("<?php echo lang('app.msg_select_participation')?>"); return false;}
		else{
			var str='';
			$("input:checkbox[class='ids_generate']:checked").each(function(){
				$(form).append(
					 $('<input>')
						.attr('type', 'hidden')
						.attr('name', 'id[]')
						.val($(this).val())
				 );
			});
		}	
   });
   
   
     $('#frm-send-promo').on('submit', function(e){
      var form = this;
		var xx= $('[class="ids_generate"]:checked').length; 
		if(xx==0){ alert("<?php echo lang('app.msg_select_participation')?>"); return false;}
		else{
			var str='';
			$("input:checkbox[class='ids_generate']:checked").each(function(){
				$(form).append(
					 $('<input>')
						.attr('type', 'hidden')
						.attr('name', 'id[]')
						.val($(this).val())
				 );
			});
		}
   });
   
   $('#frm-send-notification').on('submit', function(e){
      var form = this;
		//var xx= $('[class="ids_generate"]:checked').length; 
		var subject=$("#notification_subject").val();
		var msg=$("#notification_message").summernote('code');
		
		if(subject=='' ||msg==''){ alert("<?php echo lang('app.error_required')?>"); return false;}
		else{
			var str='';
			$("input:checkbox[class='ids_generate']:checked").each(function(){
				$(form).append(
					 $('<input>')
						.attr('type', 'hidden')
						.attr('name', 'id[]')
						.val($(this).val())
				 );
			});
		}
   });
   
   
</script>
<script>
	 !function(n){
		 "use strict";function e(){this.$body=n("body")}
		 e.prototype.init=function(){
			 n("#notification_message").summernote({lang: 'it-IT',placeholder:"Write something...",height:230,callbacks:{onInit:function(e){n(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")}}})
			  }
			 ,n.Summernote=new e,n.Summernote.Constructor=e}
			 (window.jQuery),function(){"use strict";window.jQuery.Summernote.init()}();
	 </script>
<script>
function get_notif(){
	var xx= $('[class="ids_generate"]:checked').length; 
		if(xx==0){ alert("<?php echo lang('app.msg_select_participation')?>"); return false;}
		else{
			$("#notif-modal").modal('show');
		}
}
     function get_del(id){
      
        $('#deleteID').val(id)
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
	
	function get_video_details(id){
		$.ajax({
				  url:"<?php echo base_url()?>/ajax/get_video_details",
				  method:"POST",
				  data:{id:id}
				  
			}).done(function(data){
				$("#list_video_status").html(data);
				
			
			});
	}
</script>
<?= view('admin/common/endtag') ?>
