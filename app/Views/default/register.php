<?= view($view_folder.'/common/header') ?>
  
<style>
    .border{
        /* border-width: 1px !important; */
        border: 1px solid rgb(229, 231, 235) !important;
    }
    .parsley-errors-list{
        color: red;
        font-size: .75 rem;
    }
	a{font-family: 'Libre Franklin', sans-serif !important;} 
</style>
        <div class="lg:py-10 py-5"  x-data="getResData">
            <div class="container">

                <div class="lg:flex">
         
                    <div class="w-full lg:pr-24"> 
        
                        <div class="tube-card bg-white">
                                            
                            <h3 class="border-b flex font-semibold items-center justify-between px-7 py-5 text-base"><?php echo lang('front.title_register')?> <a href="<?php echo base_url('user/login')?>" class="font-medium inline-block txtlinkcolor-primary hover:underline"><?php echo lang('front.help_have_account')?> Accedi</a> </h3>
							
                        
                            <div class="lg:p-8 p-5">
     <?php if(isset($_SESSION['error']) ){ ?>
            <div class="uk-alert-danger" uk-alert>
                <!-- <a class="uk-alert-close" uk-close></a> -->
                <p><?= $_SESSION['error'] ?? '' ?></p>
            </div>
            <?php unset($_SESSION['error']); } ?>
                                <!-- <p> Sign up to  Courseplus  to get started. </p> -->
                                <form action="<?= base_url() ?>/register" id="form" method="POST" class="grid sm:grid-cols-2 gap-x-6 gap-y-4 mt-4">
                                    <div>
                                        <label for="nome" class="text-sm font-medium"> <?php echo lang('front.field_first_name')?></label>
                                        <input type="text" class="with-border" required id="nome" name="nome" data-parsley-trigger="focusout" value="<?php echo old('nome') ?? ''?>">
                                    </div>
                                    <div>
                                        <label for="cognome" class="text-sm font-medium"> <?php echo lang('front.field_last_name')?> </label>
                                        <input type="text" class="with-border"id="cognome" required id="cognome" name="cognome" data-parsley-trigger="focusout" value="<?php echo old('cognome') ?? ''?>">
                                    </div>
                                    <div>
                                        <label for="email" class="text-sm font-medium"> <?php echo lang('front.field_email')?> </label>
                                        <input type="text" class="with-border" id="email" name="email" required data-parsley-trigger="focusout" id="email" value="<?php echo old('email') ?? ''?>">
                                    </div>
                                    <!--div>
                                        <label for="telefono" class="text-sm font-medium"> <?php //echo lang('front.field_phone')?> </label>
                                        <input type="text" class="with-border" name="telefono" id="telefono" value="<?php //echo old('telefono') ?? ''?>">
                                    </div-->

                                    <div>
                                        <label for="password" class="text-sm font-medium"> <?php echo lang('front.field_password')?> </label>
                                        <input type="password" class="with-border" name="password" required data-parsley-trigger="focusout" id="password" value="<?php echo old('password') ?? ''?>">
                                    </div>
                                    <div>
                                        <label for="confirm-password" class="text-sm font-medium"> <?php echo lang('front.field_confirm_password')?> </label>
                                        <input type="password" class="with-border" name="confirm" data-parsley-equalto="#password" required data-parsley-trigger="focusout" id="confirm-password" value="<?php echo old('password') ?? ''?>">
                                    </div>
                                    <?php if(!empty($prof)){ ?>
                                    <div>
                                        <label for="professione" class="text-sm font-medium"> <?php echo lang('front.field_professione')?> </label>
                                        <select class="selectpicker border rounded-md" id="professione" name="professione">
                                            <option value=""><?php echo lang('front.field_select')?></option>
                                            <?php foreach($prof as $p) { ?>
                                                <option value="<?= $p['idprof'] ?>" <?php if(null !==old('professione') && old('professione')==$p['idprof']) echo 'selected'?>><?= $p['professione'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } ?>
                                    <!--div>
                                        <label for="cf" class="text-sm font-medium"> <?php //echo lang('front.field_cf')?> </label>
                                        <input type="text" class="with-border" id="cf" name="cf" value="<?php //echo old('cf') ?? ''?>">
                                    </div-->


                                    <!--div>
                                        <label for="residenza_stato" class="text-sm font-medium"> <?php //echo lang('front.field_country')?> </label>
                                        <select class="selectpicker border rounded-md" id="residenza_stato" name="residenza_stato" @change="handleCountry">
                                            <option value="0"><?php //echo lang('front.field_select')?></option>
                                            <?php foreach($country as $stato) { ?>
                                                <option value="<?= $stato['id'] ?>" <?php if(null !==old('residenza_stato') && old('residenza_stato')==$stato['id']) echo 'selected'?>><?= $stato['nazione'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div-->
                                    <!--div>
                                        <label for="residenza_provincia" class="text-sm font-medium"> <?php echo lang('front.field_provincia')?> </label>
                                        <div x-html="provincia"></div>
                                    </div>
                                    <div>
                                        <label for="residenza_comune" class="text-sm font-medium"> <?php echo lang('front.field_city')?> </label>
                                        <div x-html="comuni"></div>
                                    </div>
                                    <div>
                                        <label for="cap" class="text-sm font-medium"> <?php echo lang('front.field_zip')?> </label>
                                        <input type="text" name="cap" class="with-border"id="cap" value="<?php echo old('cap') ?? ''?>">
                                    </div>
                                    <div>
                                        <label for="indirizzo" class="text-sm font-medium"> <?php echo lang('front.field_address')?> </label>
                                        <input type="text" class="with-border"id="indirizzo" name="indirizzo" value="<?php echo old('indirizzo') ?? ''?>">
                                    </div-->
                                    <div class="col-span-2 checkbox my-2">
                                        <div>
                                            <input type="checkbox" id="use_privacy" name="privacy" value="1" data-parsley-checkmin="1" required>
                                            <label for="use_privacy" class="text-sm"><span class="checkbox-icon"></span> Accetto le <a target="_blank" href="https://academy.creazioneimpresa.it/page/condizioni" class="font-semibold">Condizioni</a>. Scopri come utilizziamo e proteggiamo i tuoi dati nelle nostre <a target="_blank" href="https://www.iubenda.com/privacy-policy/63306874" class="font-semibold">Norme sulla privacy</a>.</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" id="use_newsletter" name="newsletter" value="1">
                                            <label for="use_newsletter" class="text-sm"><span class="checkbox-icon"></span> Vorrei ricevere gli aggiornamenti via email relativi al marketing diretto.</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
    
                        </div>
                        
                        <div class="grid grid-cols-2 md:gap-6 gap-3 md:mt-10 mt-5">
                            
                            <button @click="$('#form').submit()" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white">
                                <span class="md:block"> <?php echo lang('front.btn_register')?> </span>
                            </button>
                        </div>

        
                    </div>
        

                </div>
        
            </div>
        </div>

<?= view($view_folder.'/common/footer') ?>

<script>
    
    
    function getResData(){
        return {
            stato: '', 
            comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control with-border">', 
            provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control with-border">',

            nascita_stato: '', 
            nascita_provincia : '<input type="text" id="nascita_provincia" name="nascita_provincia" class="form-control">',

            handleCountry(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=residenza_provincia`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => {this.provincia = res; setTimeout(() => {$('select').selectpicker('render');}, 50)})
                }
                else {
                    this.provincia = '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control with-border">'
                    this.comuni = '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control with-border">'
                }
            },
            
        }

         
    }
</script>
<?= view($view_folder.'/common/close') ?>
