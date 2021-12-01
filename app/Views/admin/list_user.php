<?= view('admin/common/header',array('page_title'=>lang('app.dashboard_category'))) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
<div x-data="{data: {}}">
            <div class="content-page">
                <div id="workaround">gsdgqgq</div>
                <div class="content">
                    <div x-text="data.id"></div>
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Editable</li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.dashboard_professione') ?></h4>
                                        <a href="/admin/new_user?role=<?= $_REQUEST['role'] ?>" class="btn btn-info btn-rounded waves-effect waves-light ml-4" style="height: fit-content;">
                                            <span class="btn-label"><i class="mdi mdi-database-plus"></i></span><?= lang('app.new_user') ?>
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
        
                                        <h5 class="mt-0"><?= lang('app.field_professione') ?></h5>
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
                                        <div class="table-responsive">
                                            <table id="basic-datatable" x-ref="dataTable" class="table dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>name</th>
                                                        <th>email</th>
                                                        <th>phone</th>
                                                        <th>actions</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($users as $user) { ?>
                                                    <tr>
                                                        <td><?= $user['display_name'] ?></td>
                                                        <td><?= $user['email'] ?></td>
                                                        <td><?= $user['telefono'] ?></td>
                                                        <td class="row pt-1">
                                                            <button type="button" onclick="workAroundClick(<?= htmlspecialchars(json_encode($user)) ?>)" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </button>

                                                            <a href="<?= base_url() ?>/admin/deleteUser/<?= $user['idu'] ?>" class="p-1 mr-2" style="height: fit-content; font-size: 1rem; color: red">
                                                                <i class="fe-x-circle"></i>
                                                            </a>

                                                            <a href="<?= base_url() ?>/admin/edit_user/<?= $user['idu'] ?>" class="p-1" style="height: fit-content; font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </a>
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
                            <h4 class="modal-title" id="standard-modalLabel"> User Info </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> First Name :</label>
                                    <p x-text="data.nome"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1">Last Name :</label>
                                    <p x-text="data.cognome"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>
                            

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> email :</label>
                                    <p x-text="data.email"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1">telefono :</label>
                                    <p x-text="data.telefono"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> cf :</label>
                                    <p x-text="data.cf"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> residenza stato :</label>
                                    <p x-text="data.residenza_stato_name ?? data.residenza_stato"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> residenza provincia :</label>
                                    <p x-text="data.residenza_provincia_name ?? data.residenza_provincia"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> residenza commune :</label>
                                    <p x-text="data.residenza_comune_name ?? data.residenza_comune"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> residenza cap :</label>
                                    <p x-text="data.residenza_cap"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1">residenza indirizzo :</label>
                                    <p x-text="data.residenza_indirizzo"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> nascita provincia :</label>
                                    <p x-text="data.nascita_provincia_name ?? data.nascita_provincia"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->


                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1">nascita stato :</label>
                                    <p x-text="data.nascita_stato_name ?? data.nascita_stato"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                            </div>

                            <div class="row">
                                

                                <div class="col-md-6">
                                    <!-- assignee -->
                                    <label class="mt-2 mb-1"> nascita data :</label>
                                    <p x-text="data.nascita_data"></p>
                                    <!-- end assignee -->
                                </div> <!-- end col -->


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
