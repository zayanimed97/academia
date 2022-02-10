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
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
<div x-data="{data: {}}">
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
        
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
									<a target="_blank" class="btn btn-warning" href="<?php echo base_url('admin/report/list_participanti')?>"><?php echo lang('app.btn_export')?></a>
									  <div class="table-responsive">
                                            <table id="basic-datatable" x-ref="dataTable" class="table dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
														<th>ID</th>
                                                        <th><?php echo lang('app.field_first_name')?></th>
                                                        <th><?php echo lang('app.field_email')?></th>
                                                        <th><?php echo lang('app.field_phone')?></th>
														
														 <th><?php echo lang('app.field_cf')?></th>
														  <th><?php echo lang('app.field_active_status')?></th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($users as $user) { ?>
                                                    <tr>
														 <td><?= $user['id'] ?></td>
                                                        <td><?= $user['display_name'] ?></td>
                                                        <td><?= $user['user_email'] ?></td>
                                                        <td><?= $user['telefono']; if($user['mobile']!='') echo ' | '. $user['mobile']?></td>
														  <td><?= $user['cf'] ?></td>
														   <td><?php if($user['active']=='yes') echo lang('app.yes'); else echo lang('app.no'); ?></td>
                                                        <td class="row pt-1">
                                                            <button type="button" onclick="workAroundClick(<?= htmlspecialchars(json_encode($user)) ?>)" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-user"></i>
                                                            </button>

                                                            <a href="<?= base_url() ?>/admin/deleteUser/<?= $user['idu'] ?>" class="p-1 mr-2" style="height: fit-content; font-size: 1rem; color: red">
                                                                <i class="fe-x-circle"></i>
                                                            </a>

                                                            <a href="<?= base_url() ?>/admin/edit_user/<?= $user['idu'] ?>" class="p-1" style="height: fit-content; font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </a>
															
															<?php if($user['role']=='participant'){?>
															<a href="<?php echo base_url('admin/loginAs/'.$user['idu'])?>" class="p-1" style="height: fit-content; font-size: 1rem"><?php echo lang('app.btn_login')?></a>
															<?php }?>
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
</div>
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

<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/datatables.init.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script>

<script>


    function getInfoData() {
        return{
            
            data: {}, 
            changeData(dataUser) {
                console.log('avsava');
                $('#user-info-modal').modal('show');
                this.data = dataUser
            },
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
