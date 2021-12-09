<?= view('default/common/header') ?>
  
<style>
    .border{
        /* border-width: 1px !important; */
        border: 1px solid rgb(229, 231, 235) !important;
    }
    .parsley-errors-list{
        color: red;
        font-size: .75 rem;
    }
</style>
        <div class="lg:py-10 py-5"  x-data="getResData">
            <div class="container">

                <div class="lg:flex">
         
                    <div class="w-full lg:pr-24"> 
        
                        <div class="shadow bg-white rounded-md">
                                            
                            <h3 class="border-b flex font-semibold items-center justify-between px-7 py-5 text-base"> Create Account <a href="#" class="font-medium inline-block text-blue-500 text-sm hover:underline">already have an account</a> </h3>
                        
                            <div class="lg:p-8 p-5">
    
                                <!-- <p> Sign up to  Courseplus  to get started. </p> -->
                                <form action="<?= base_url() ?>/register" id="form" method="POST" class="grid sm:grid-cols-2 gap-x-6 gap-y-4 mt-4">
                                    <div>
                                        <label for="nome" class="text-sm font-medium"> Nome</label>
                                        <input type="text" class="with-border" required id="nome" name="nome" data-parsley-trigger="focusout">
                                    </div>
                                    <div>
                                        <label for="cognome" class="text-sm font-medium"> Cognome </label>
                                        <input type="text" class="with-border"id="cognome" required id="cognome" name="cognome" data-parsley-trigger="focusout">
                                    </div>
                                    <div>
                                        <label for="email" class="text-sm font-medium"> Email </label>
                                        <input type="text" class="with-border" id="email" name="email" required data-parsley-trigger="focusout" id="email" >
                                    </div>
                                    <div>
                                        <label for="telefono" class="text-sm font-medium"> telefono </label>
                                        <input type="text" class="with-border" name="telefono" id="telefono">
                                    </div>

                                    <div>
                                        <label for="password" class="text-sm font-medium"> Password </label>
                                        <input type="password" class="with-border" name="password" required data-parsley-trigger="focusout" id="password">
                                    </div>
                                    <div>
                                        <label for="confirm-password" class="text-sm font-medium"> Confirm Password </label>
                                        <input type="password" class="with-border" name="confirm" data-parsley-equalto="#password" required data-parsley-trigger="focusout" id="confirm-password">
                                    </div>

                                    <div>
                                        <label for="professione" class="text-sm font-medium"> Professione </label>
                                        <select class="selectpicker border rounded-md" id="professione" name="professione">
                                            <option value="0">Choose professione</option>
                                            <?php foreach($prof as $p) { ?>
                                                <option value="<?= $p['idprof'] ?>"><?= $p['professione'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="cf" class="text-sm font-medium"> cf </label>
                                        <input type="text" class="with-border" id="cf" name="cf">
                                    </div>


                                    <div>
                                        <label for="residenza_stato" class="text-sm font-medium"> Rezidenza Stato </label>
                                        <select class="selectpicker border rounded-md" id="residenza_stato" name="residenza_stato" @change="handleCountry">
                                            <option value="0">Choose country</option>
                                            <?php foreach($country as $stato) { ?>
                                                <option value="<?= $stato['id'] ?>"><?= $stato['nazione'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="residenza_provincia" class="text-sm font-medium"> Rezindenza Provincia </label>
                                        <div x-html="provincia"></div>
                                    </div>
                                    <div>
                                        <label for="residenza_comune" class="text-sm font-medium"> Rezidenza Comune </label>
                                        <div x-html="comuni"></div>
                                    </div>
                                    <div>
                                        <label for="cap" class="text-sm font-medium"> Rezidenza CAP </label>
                                        <input type="text" name="cap" class="with-border"id="cap">
                                    </div>
                                    <div>
                                        <label for="indirizzo" class="text-sm font-medium"> Rezidenza Indirizzo </label>
                                        <input type="text" class="with-border"id="indirizzo" name="indirizzo">
                                    </div>
                                    <!-- <div class="cols-span-2 checkbox my-2">
                                        <input type="checkbox" id="use_points">
                                        <label for="use_points" class="text-sm"><span class="checkbox-icon"></span> I agree to the <a target="_blank" href="#" class="font-semibold">Terms and Conditions</a> </label>
                                    </div> -->
                                </form>
                            </div>
    
                        </div>
                        
                        <div class="grid grid-cols-2 md:gap-6 gap-3 md:mt-10 mt-5">
                            
                            <button @click="$('#form').submit()" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white">
                                <span class="md:block"> Submit </span>
                            </button>
                        </div>

        
                    </div>
        

                </div>
        
            </div>
        </div>

<?= view('default/common/footer') ?>

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
                        .then( el => el.text() ).then(res => {this.provincia = res; $('select').selectpicker();})
                }
                else {
                    this.provincia = '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control with-border">'
                    this.comuni = '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control with-border">'
                }
            },
            
        }

         
    }
</script>
<?= view('default/common/close') ?>
