<?php if($role=='doctor'){
	$page_title=lang('app.title_page_list_doctor');
	$menu=lang('app.menu_doctors');
	$menu_new=lang('app.new_doctor');
}
else{
	$page_title=lang('app.title_page_list_participant');
	$menu=lang('app.menu_participant');
	$menu_new=lang('app.new_participant');
	
}?>
<?= view('admin/common/header',array('page_title'=>$page_title)) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

 <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
<div x-data="getInfoData()">
            <div class="content-page">
                <div id="workaround"></div>
                <div class="content">
                    <!--div x-text="data.id"></div-->
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                          <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>"><?php echo lang('app.menu_dashboard')?></a></li>
											
											  <li class="breadcrumb-item active"><?php echo $menu?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= $page_title ?></h4>
                                        <a href="<?php echo base_url('admin/new_user?role='.$role )?>" class="btn btn-info btn-rounded waves-effect waves-light ml-4" style="height: fit-content;">
                                            <span class="btn-label"><i class="mdi mdi-database-plus"></i></span><?= $menu_new ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <?php if(session('error') ?? false){?>
										 <div class="alert alert-danger" role="alert">
											 <?php echo session('error')?>
											</div>
										 <?php }?>
										  <?php 
										 if(session('success') ?? false){?>
										 <div class="alert alert-success" role="alert">
											 <?php echo session('success')?>
											</div>
										 <?php }?>
										  <?php 
										 if($success ?? false){?>
										 <div class="alert alert-success" role="alert">
											 <?php echo $success?>
											</div>
										 <?php }?>
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
									
										<div class="row">
										<div class="col-md-12">
											<input type="button" onclick="get_notif();" class="btn btn-primary" name="generate" value="<?php echo lang('app.btn_send_notification')?>">

											<a target="_blank" class="btn btn-warning" href="<?php echo base_url('admin/report/list_participanti')?>"><?php echo lang('app.btn_export')?></a>
										</div>
										</div>
									
									  <div class="table-responsive">
                                            <table id="basic-datatable" x-ref="dataTable" class="table dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
														<th>ID</th>
														<th data-sorting="disabled"><input type="checkbox" class="toggle-all"></th>
                                                        <th><?php echo lang('app.field_first_name')?></th>
                                                        <th><?php echo lang('app.field_email')?></th>
                                                        <th><?php echo lang('app.field_phone')?></th>
														
														 <th><?php echo lang('app.field_cf')?></th>
														  <th><?php echo lang('app.field_active_status')?></th>
                                                          <?php if($role == 'participant') { ?>
														  <th>Acquisto</th>
                                                          <?php } ?>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($users as $user) { ?>
                                                    <tr>
														 <td><?= $user['id'] ?></td>
														 	<td><input type="checkbox" class="ids_generate" name="ids_generate[]" value="<?php echo $user['idu']?>"></td>
                                                        <td><?= $user['display_name'] ?></td>
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <p><?= $user['user_email'] ?></p>
                                                                <?php if($user['role']=='participant'){?>
                                                                    <a href="<?php echo base_url('/admin/send_credential/'.$user['idu'].'/yes')?>"><?php echo lang('app.btn_send_credentials')?></a>
															    <?php }?>
                                                            </div></td>
                                                        <td><?= $user['telefono']; if($user['mobile']!='') echo ' | '. $user['mobile']?></td>
														  <td><?= $user['cf'] ?></td>
														   <td><?php if($user['active']=='yes') echo lang('app.yes'); else echo lang('app.no'); ?></td>
                                                            <?php if($role == 'participant') { ?>
                                                                <td><button type="button" onclick="buyList(<?= $user['idu'] ?>)" class="btn btn-primary p-1"><?= $user['countBuys']  ?></button></td>
                                                            <?php } ?>
                                                        <td class="row pt-1">
                                                            <button type="button" onclick="workAroundClick(<?= htmlspecialchars(json_encode($user)) ?>)" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-user"></i>
                                                            </button>

                                                            <!--a href="<?= base_url() ?>/admin/deleteUser/<?= $user['idu'] ?>" class="p-1 mr-2" style="height: fit-content; font-size: 1rem; color: red">
                                                                <i class="fe-x-circle"></i>
                                                            </a-->
															<a data-toggle="modal" data-target="#delete-modal-dialog" onclick="del_data('<?php echo $user['idu']?>')" class="p-1 mr-2" style="height: fit-content; font-size: 1rem; color: red">
                                                                <i class="fe-x-circle"></i>
                                                            </a>
                                                            <a href="<?= base_url() ?>/admin/edit_user/<?= $user['idu'] ?>" class="p-1" style="height: fit-content; font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </a>
															
															<?php if($user['role']=='participant'){?>
															<a href="<?php echo base_url('admin/loginAs/'.$user['idu'])?>" class="p-1" style="height: fit-content; font-size: 1rem"><?php echo lang('app.btn_login')?></a>
															<?php }?>

                                                            <button type="button" onclick="emailList(<?=$user['idu']?>)" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-mail"></i>
                                                            </button>
															
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


<?php $attributes = ['class' => 'form-input-flat', 'id' => 'deleteform','method'=>'get'];
		echo form_open("", $attributes);?>
		
		<div class="modal fade"id="delete-modal-dialog" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_delete_user')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group">
                           <?php  echo lang('app.alert_msg_delete_user')?>
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

            <!-- update professione modal content -->
            <div id="user-info-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"> <?php echo lang('app.title_modal_user_profile')?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_first_name')?> :</label>
                                    <p x-text="data.nome"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"><?php echo lang('app.field_last_name')?> :</label>
                                    <p x-text="data.cognome"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>
                            

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_email')?> :</label>
                                    <p x-text="data.email"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"><?php echo lang('app.field_phone')?> :</label>
                                    <p x-text="data.telefono"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_cf')?> :</label>
                                    <p x-text="data.cf"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
								<div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_ruolo')?> :</label>
                                    <p x-text="data.ruolo"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
								
                              
                            </div>

                            <div class="row">
							  <div class="col-md-4">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_country')?> :</label>
                                    <p x-text="data.residenza_stato_name ?? data.residenza_stato"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_provincia')?> :</label>
                                    <p x-text="data.residenza_provincia_name ?? data.residenza_provincia"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-4">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_city')?> :</label>
                                    <p x-text="data.residenza_comune_name ?? data.residenza_comune"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_zip')?>:</label>
                                    <p x-text="data.residenza_cap"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_address')?>:</label>
                                    <p x-text="data.residenza_indirizzo"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>
							  <div class="row">
							   <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_description')?>:</label>
                                    <p x-text="data.description"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
								 <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_qualifica')?>:</label>
                                    <p x-text="data.qualifica"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
								<?php if($role=='participant'){?>
								 <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_prof_albo')?>:</label>
                                    <p x-text="data.prof_albo"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
								
								<div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_professione_city')?>:</label>
                                    <p x-text="data.professione_citta"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
								
								<div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_code_abo')?>:</label>
                                    <p x-text="data.abo"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
								
								<div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_del')?>:</label>
                                    <p x-text="data.del"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
								
								<div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> <?php echo lang('app.field_posizion')?>:</label>
                                    <p x-text="data.posizione"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
								<?php } ?>
							  </div>
                          
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="list-buy-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
                <div class="modal-dialog  modal-dialog-centered justify-content-center">
                    <div class="modal-content" style="width: fit-content; max-width: 90vw">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"> Lista degli acquisti </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="buy-datatable" x-ref="dataTable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Corsi / Lezioni</th>
                                            <th>Importo</th>
                                            <th>data</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody id="buyBody">
                                        
                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive-->
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="list-emails-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
                <div class="modal-dialog  modal-dialog-centered justify-content-center">
                    <div class="modal-content" style="width: fit-content; max-width: 90vw">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"> Log email </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" style="width: fit-content;">
                            <div class="table-responsive">
                                <table id="emails-datatable" x-ref="dataTable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tipo</th>
                                            <th>Contatto</th>
                                            <th>Oggetto</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody id="emailsBody">
                                        
                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive-->
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
</div>
 <?php $attributes = ['class' => '', 'id' => 'frm-send-notification','method'=>'post'];
				echo form_open_multipart( base_url('admin/user_list?role='.$role), $attributes);?>
				
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
							<div class="alert alert-warning">
							name => {var_user_name}<br/>

							Username => {var_email}<br/>
							Password => {var_password}<br/>
							</div>
							 
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
<!-- <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/pdfmake.min.js"></script> -->
<!-- <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/vfs_fonts.js"></script> -->
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.js"></script>
		<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/lang/summernote-it-IT.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/datatables.init.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.8.1/dist/cdn.min.js"></script>

<script>
    $(document).ready(() => {
        $("#buy-datatable").DataTable({language:{url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json',paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"} ,drawCallback: function () {$(".dataTables_paginate > .pagination").addClass("pagination-rounded");}}});
        $("#emails-datatable").DataTable({language:{url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json',paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"} ,drawCallback: function () {$(".dataTables_paginate > .pagination").addClass("pagination-rounded");}}});
	
	$(".toggle-all").on("click", function () {
		
        $("input:checkbox[class='ids_generate']").prop('checked', $(this).prop('checked'));
    });
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
   function del_data(id){
			$("#deleteform").attr('action',"<?= base_url() ?>/admin/deleteUser/"+id);
		}
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
    function buyList(id){
                let html = '';
                $('#buyBody').html(html);
                fetch(`<?php echo base_url()?>/admin/listBuys/${id}`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() )
                        .then(res => {
                            JSON.parse(res).forEach(el => {
                                html += `       <tr><td>${el.id}</td>\
                                                <td>${el.st}</td>\
                                                <td>${el.price_ht}</td>\
                                                <td>${el.date}</td>\
                                                </tr>`
                            });
                            $('#buyBody').html(html);
                            $('#list-buy-modal').modal('show');
                        })
            }  
            
    function emailList(id){
                let html = '';
                $('#emailsBody').html(html);

                fetch(`<?php echo base_url()?>/admin/listEmails/${id}`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() )
                        .then(res => {
                            JSON.parse(res).forEach(el => {
                                html += `       <tr><td>${el.id}</td>\
                                                <td>${el.type}</td>\
                                                <td>${el.user_to}</td>\
                                                <td>${el.subject}</td>\
                                                <td>${el.date}</td>\
                                                </tr>`
                            });
                            $('#emailsBody').html(html);
                            $('#list-emails-modal').modal('show');
                        }).catch(err => {this.list = {}})
            }
    function getInfoData() {
        return{
            
            list: [], 
            data:{},
            
        }
    }

    async function workAroundClick(userData){
        console.log(userData);
        await $('#workaround').attr('x-on:click', 'data = '+JSON.stringify(userData));
        $('#workaround').click();
        $('#user-info-modal').modal('show');
    }
</script>
<?= view('admin/common/endtag') ?>
