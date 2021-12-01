<?= view('admin/common/header',array('page_title'=>lang('app.dashboard_category'))) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Wizard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Form Wizard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                        
                        <div class="row" x-data="{ private: '<?= (($user['type'] ?? "") == "private") ? 'private' : 'company' ?>'}">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title mb-3"> Basic Wizard</h4>

                                        <form method="post" action="<?= base_url() ?>/admin/updateUser"  x-data="getResData()">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                            <div id="basicwizard">
                                                <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
                                                    <li class="nav-item">
                                                        <a href="#basictab1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2"> 
                                                            <i class="mdi mdi-account-circle mr-1"></i>
                                                            <span class="d-none d-sm-inline">Account</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#basictab2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-face-profile mr-1"></i>
                                                            <span class="d-none d-sm-inline">Profile</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#basictab3" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                            <span class="d-none d-sm-inline">Nascita</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#basictab4" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                            <span class="d-none d-sm-inline">Contacts</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content b-0 mb-0 pt-0" x-data="{password : '', confirm: ''}">
                                                    <div class="tab-pane" id="basictab1">
                                                        <div class="row">
                                                        <template x-if="password != confirm">
                                                            <div class="alert alert-warning bg-warning text-white border-0 col-12" role="alert">
                                                                Password Doesn't Match
                                                            </div>
                                                        </template>
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="Email">Email</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="Email" name="email" value="<?= $user['email'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="password"> Password </label>
                                                                    <div class="col-md-9">
                                                                        <input type="password" x-model="password" id="password" name="Password" class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="confirm">ConfirmPassword</label>
                                                                    <div class="col-md-9">
                                                                        <input type="password" x-model="confirm" id="confirm" name="confirm" class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
                                                    <div class="tab-pane" id="basictab2" >
                                                        <div class="row" >
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name"> nome</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="name" name="nome" class="form-control" value="<?= $user['nome'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="cognome"> cognome</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="cognome" name="cognome" class="form-control" value="<?= $user['cognome'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->
                                                        


                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="email_profile"> email</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="email_profile" name="email_profile" class="form-control" value="<?= $user['email'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="telefono"> telefono</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?= $user['telefono'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->

                                                        <!-- <template x-if="private == 'private'"> -->
                                                            <div class="row" >
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="cf"> cf </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="cf" name="cf" class="form-control" value="<?= $user['cf'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    
                                                            </div> <!-- end row -->
                                                        <!-- </template> -->


                                                        <!-- <h3>Residenza</h3>
                                                        <hr class="mb-4" /> -->


                                                        <!-- <template x-if="private == 'private'">

                                                        <div>
                                                            <h3>nascita</h3>
                                                            <hr class="mb-4" />


                                                            <div class="row">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="nascita_data"> nascita data</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="nascita_data" name="nascita_data" class="form-control" value="<?= $user['user_email'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="nascita_stato"> nascita stato</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="nascita_stato" name="nascita_stato" class="form-control" value="<?= $user['user_email'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    
                                                            </div> end row

                                                            <div class="row">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="nascita_provincia"> nascita provincia</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control" value="<?= $user['user_email'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                    
                                                            </div> end row
                                                        </div>
                                                        </template> -->
                                                    </div>

                                                    <div class="tab-pane" id="basictab3">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_stato"> residenza stato</label>
                                                                    <div class="col-md-9">
                                                                        <select x-model="stato" @change="handleCountry" type="text" id="residenza_stato" name="residenza_stato" class="form-control">
                                                                            <option value="0"> select option </option>
                                                                            <?php foreach($nazioni as $naz) { ?>
                                                                                <option value="<?= $naz['id'] ?>"> <?= $naz['nazione'] ?> </option>
                                                                            <?php } ?>
                                                                            <!-- <option value="estero"> Estero </option> -->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_provincia"> residenza provincia</label>
                                                                    <div class="col-md-9" x-html="provincia">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                

                                                            <!-- <div class="row"> -->
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_comune"> residenza comune</label>
                                                                    <div class="col-md-9" x-html="comuni">
                                                                        <!-- <input type="text" id="residenza_comune" name="residenza_comune" class="form-control" value="<?= $user['user_email'] ?>"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_cap"> residenza cap</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="residenza_cap" name="residenza_cap" class="form-control" value="<?= $user['residenza_cap'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="residenza_indirizzo"> residenza indirizzo</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="residenza_indirizzo" name="residenza_indirizzo" class="form-control" value="<?= $user['residenza_indirizzo'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->
                                                    </div>

                                                    <div class="tab-pane" id="basictab4">
                                                            
                                                        
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <!-- <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_stato"> stato </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="nascita_stato" name="nascita_stato" class="form-control" value="<?= $user['nascita_stato'] ?>">
                                                                    </div>
                                                                </div> -->
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_stato">stato</label>
                                                                    <div class="col-md-9">
                                                                        <select x-model="nascita_stato" @change="handleCountryNascita" type="text" id="nascita_stato" name="nascita_stato" class="form-control">
                                                                            <option value="0"> select option </option>
                                                                            <?php foreach($nazioni as $naz) { ?>
                                                                                <option value="<?= $naz['id'] ?>"> <?= $naz['nazione'] ?> </option>
                                                                            <?php } ?>
                                                                            <!-- <option value="estero"> Estero </option> -->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_provincia"> provincia</label>
                                                                    <div class="col-md-9" x-html="nascita_provincia">
                                                                        <!-- <input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control" value="<?= $user['nascita_provincia'] ?>"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->

                                                        <div class="row" >
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_piva"> data </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="basic-datepicker" name="nascita_data" class="form-control" placeholder="Basic datepicker" value="<?= $user['nascita_data'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="nascita_cf"> cf</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="nascita_cf" name="nascita_cf" class="form-control" value="<?= $user['nascita_stato'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                                
                                                        </div> <!-- end row -->
                                                                
                                                    </div>

                                                    <ul class="list-inline wizard mb-0">
                                                        <!-- <li class="previous list-inline-item">
                                                            <a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                                                        </li> -->
                                                        <li class="list-inline-item float-right">
                                                            <button type="submit" class="btn btn-secondary">submit</button>
                                                        </li>
                                                        <!-- <li class="next list-inline-item float-right">
                                                            <a href="javascript: void(0);" class="btn btn-secondary">Next</a>
                                                        </li> -->
                                                    </ul>

                                                </div> <!-- tab-content -->
                                            </div> <!-- end #basicwizard-->
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


<?= view('admin/common/footer') ?>

        <script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script>
        
        <!-- Plugins js-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>

        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-pickers.init.js"></script>


        <!-- Init js-->
        <script>
            // form repeater Initialization
            $('.repeater-email').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                }
            }
            });

            $('.repeater-phone').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                }
            }
            });

            function handleCountry(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=residenza_provincia&selected=<?= $user['nascita_provincia'] ?>`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.provincia = res)
                }
                else {
                    this.provincia = '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control">'
                    this.comuni = '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control">'
                }
            }

            function handleCountryNascita(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=nascita_provincia&selected=<?= $user['nascita_provincia'] ?>`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.nascita_provincia = res)
                }
                else {
                    this.nascita_provincia = '<input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control">'
                }
            }

            function getResData(){
                return {
                    stato: '<?= $user['residenza_stato'] ?>', 
                    comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control" value="<?= $user['residenza_comune'] ?>">', 
                    provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control" value="<?= $user['residenza_provincia'] ?>">',

                    nascita_stato: '<?= $user['nascita_stato'] ?>', 
                    nascita_provincia : '<input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control" value="<?= $user['nascita_provincia'] ?>">',
                    init(){
                        Promise.allSettled([
                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['residenza_stato'] ?>' == '106') {
                                $('#loading').modal('show');
                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['residenza_provincia'] ?>&name=residenza_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.provincia = res; resolve()})
                            } resolve();})) ,


                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['residenza_stato'] ?>' == '106' && '<?= $user['residenza_provincia'] ?>') {
                                $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['residenza_provincia'] ?>&selected=<?= $user['residenza_comune'] ?>&name=residenza_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.comuni = res; resolve()})
                            } resolve();})),

                            
                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['nascita_stato'] ?>' == '106') {
                                $('#loading').modal('show');

                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['nascita_provincia'] ?>&name=nascita_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.nascita_provincia = res; resolve()})
                            } resolve();})),

                            
                        ])
                        
                        .then(() => { $('#loading').modal('hide'); })
                    }
                }
                }
        </script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-wizard.init.js"></script>

<?= view('admin/common/endtag') ?>
