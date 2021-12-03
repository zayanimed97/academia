<?= view('admin/common/header',array('page_title'=>lang('app.dashboard_category'))) ?>

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

                                        <form method="post" action="<?= base_url() ?>/admin/updateProfile"  x-data="getResData()">
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
                                                            <span class="d-none d-sm-inline">Fattura</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#basictab4" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                            <span class="d-none d-sm-inline">Contacts</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content b-0 mb-0 pt-0">
                                                    <div class="tab-pane" id="basictab1">
                                                        <div class="row">
                                                        <template x-if="<?= isset($_SESSION['error']) ? 'true' : 'false' ?>">
                                                            <div class="alert alert-warning bg-warning text-white border-0 col-12" role="alert">
                                                                Old Password is incorrect
                                                            </div>
                                                        </template>
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="Email">Email</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="Email" name="email" value="<?= $user['user_email'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="old-password"> Old Password </label>
                                                                    <div class="col-md-9">
                                                                        <input type="password" id="old-password" name="Old Password" class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="confirm">New Password</label>
                                                                    <div class="col-md-9">
                                                                        <input type="password" id="confirm" name="confirm" class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
                                                    <div class="tab-pane" id="basictab2" >
                                                        <div class="row mb-4">
                                                            <div class="custom-control custom-radio mr-4">
                                                                <input type="radio" id="private" name="private" x-model="private"  value="private" class="custom-control-input">
                                                                <label class="custom-control-label" for="private">Private</label>
                                                            </div>

                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="company" name="private" x-model="private" value="company" class="custom-control-input">
                                                                <label class="custom-control-label" for="company">Company</label>
                                                            </div>
                                                        </div>
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

                                                        <template x-if="private == 'private'">
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
                                                        </template>

                                                        <template x-if="private == 'company'">
                                                            <div class="row" >
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="piva"> piva </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="piva" name="piva" class="form-control" value="<?= $user['piva'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="regione_sociale"> regione sociale </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" id="regione_sociale" name="regione_sociale" class="form-control" value="<?= $user['ragione_sociale'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    
                                                            </div> <!-- end row -->
                                                        </template>


                                                        <h3>Residenza</h3>
                                                        <hr class="mb-4" />


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
                                                        <div class="row" >
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_piva"> piva</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="fattura_piva" name="fattura_piva" class="form-control" value="<?= $user['fattura_piva'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_cf"> cf</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="fattura_cf" name="fattura_cf" class="form-control" value="<?= $user['fattura_cf'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <!-- <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_stato"> stato </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="fattura_stato" name="fattura_stato" class="form-control" value="<?= $user['fattura_stato'] ?>">
                                                                    </div>
                                                                </div> -->
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_stato">stato</label>
                                                                    <div class="col-md-9">
                                                                        <select x-model="fattura_stato" @change="handleCountryFattura" type="text" id="fattura_stato" name="fattura_stato" class="form-control">
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
                                                                    <label class="col-md-3 col-form-label" for="fattura_provincia"> provincia</label>
                                                                    <div class="col-md-9" x-html="fattura_provincia">
                                                                        <!-- <input type="text" id="fattura_provincia" name="fattura_provincia" class="form-control" value="<?= $user['fattura_provincia'] ?>"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->

                                                        <div class="row" >
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_comune"> comune</label>
                                                                    <div class="col-md-9" x-html="fattura_comuni">
                                                                        <!-- <input type="text" id="fattura_comune" name="fattura_comune" class="form-control" value="<?= $user['fattura_comune'] ?>"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_indirizzo"> indirizzo </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="fattura_indirizzo" name="fattura_indirizzo" class="form-control" value="<?= $user['fattura_indirizzo'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_cap"> cap</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="fattura_cap" name="fattura_cap" class="form-control" value="<?= $user['fattura_cap'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_pec"> pec</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="fattura_pec" name="fattura_pec" class="form-control" value="<?= $user['fattura_pec'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->

                                                        <div class="row" >
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_sdi"> sdi</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="fattura_sdi" name="fattura_sdi" class="form-control" value="<?= $user['fattura_sdi'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="fattura_phone"> phone</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="fattura_phone" name="fattura_phone" class="form-control" value="<?= $user['fattura_phone'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div> <!-- end row -->
                                                    </div>

                                                    <div class="tab-pane" id="basictab4">
                                                        <div class="row" >
                                                            <div class="col-12 col-md-6 repeater-email">
                                                                <div data-repeater-list="mail">
                                                                <?php foreach(explode(',,,',$settings['contact_email'] ?? '') as $email) { ?>
                                                                    <div class="form-group row mb-3" data-repeater-item>
                                                                        <label class="col-12 col-form-label" for="email_contact"> emails</label>
                                                                        <div class="col-md-9">
                                                                        
                                                                            <input type="text" name="email_contact" class="form-control" value="<?= $email ?>">
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-12 form-group d-flex align-items-center">
                                                                            <button class="btn btn-danger" data-repeater-delete type="button">
                                                                                Delete
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                    
                                                                
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col">
                                                                        <button class="btn btn-primary" data-repeater-create type="button">
                                                                            Add
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6 repeater-phone">
                                                                <div  data-repeater-list="phone">
                                                                <?php foreach(explode(',,,',$settings['contact_telephone'] ?? '') as $phone) { ?>

                                                                    <div class="form-group row mb-3" data-repeater-item>
                                                                        <label class="col-12 col-form-label" for="phone_contact"> telephone </label>
                                                                        <div class="col-md-9">
                                                                        
                                                                            <input type="text"  name="phone_contact" class="form-control" value="<?= $phone ?>">
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-12 form-group d-flex align-items-center">
                                                                            <button class="btn btn-danger" data-repeater-delete type="button">
                                                                                Delete
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                        
                                                                    
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col">
                                                                        <button class="btn btn-primary" data-repeater-create type="button">
                                                                            Add
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div>
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
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=residenza_provincia&selected=<?= $user['fattura_provincia'] ?>`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.provincia = res)
                }
                else {
                    this.provincia = '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control">'
                    this.comuni = '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control">'
                }
            }

            function handleCountryFattura(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=fattura_provincia&selected=<?= $user['fattura_provincia'] ?>`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.fattura_provincia = res)
                }
                else {
                    this.fattura_provincia = '<input type="text" id="fattura_provincia" name="fattura_provincia" class="form-control">'
                    this.fattura_comuni = '<input type="text" id="fattura_comune" name="fattura_comune" class="form-control">'
                }
            }

            function getResData(){
                return {
                    stato: '<?= $user['residenza_stato'] ?>', 
                    comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control">', 
                    provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control">',

                    fattura_stato: '<?= $user['fattura_stato'] ?>', 
                    fattura_comuni: '<input type="text" id="fattura_comune" name="fattura_comune" class="form-control">', 
                    fattura_provincia : '<input type="text" id="fattura_provincia" name="fattura_provincia" class="form-control">',
                    init(){
                        Promise.allSettled([
                            new Promise((resolve, reject) => {if ('<?= $user['residenza_stato'] ?>' == '106') {
                                // $('#loading').modal('show');

                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['residenza_provincia'] ?>&name=residenza_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.provincia = res; resolve()})
                            } return resolve();}),


                            new Promise((resolve, reject) => {if ('<?= $user['residenza_stato'] ?>' == '106' && '<?= $user['residenza_provincia'] ?>') {
                                // $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['residenza_provincia'] ?>&selected=<?= $user['residenza_comune'] ?>&name=residenza_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.comuni = res; resolve()})
                            } return resolve();}),

                            
                            new Promise((resolve, reject) => {if ('<?= $user['fattura_stato'] ?>' == '106') {
                                // $('#loading').modal('show');

                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['fattura_provincia'] ?>&name=fattura_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.fattura_provincia = res; resolve()})
                            } return resolve();}),

                            new Promise((resolve, reject) => {if ('<?= $user['fattura_stato'] ?>' == '106' && '<?= $user['fattura_provincia'] ?>') {
                                // $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['fattura_provincia'] ?>&selected=<?= $user['fattura_comune'] ?>&name=fattura_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.fattura_comuni = res; resolve()})
                            } return resolve();})
                        ])
                        
                        .then(() => {
                            // $('#loading').modal('hide');
                            console.log('complete');
                        })
                    }
                }
                }
        </script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-wizard.init.js"></script>

<?= view('admin/common/endtag') ?>
