<?= view($view_folder.'/common/header') ?>
  
        <!--  breadcrumb -->
        <div class="from-blue-500 via-blue-400 to-blue-500 bg-gradient-to-l breadcrumb-area py-6 text-white">
            <div class="container mx-auto lg:pt-5">
                <div class="breadcrumb text-white">
                    <ul class="m-0">
                        <li>
                            <a href="index.html"> <i class="icon-feather-home"></i> </a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>">Home</a>
                        </li> 
                        <li class="active">
                            <a href="#">Checkout </a>
                        </li>
                    </ul>
                </div>
                <div class="md:text-2xl text-base font-semibold mt-6 md:mb-6"> Checkout </div>
            </div>
        </div>
        
        <div class="lg:py-10 py-5" x-data="getResData">
            <div class="container">

                <div class="lg:flex">
         
                    <div class="w-full lg:pr-24"> 
        
                        <h2 class="text-xl font-semibold md:mb-6 mb-3"> Choose payment method </h2>

                        <div class="bg-white rounded-md shadow-md">
 
                            <!-- <ul class=" space-y-0 rounded-md" uk-accordion>
                                <li class="uk-open">
                                    <a class="uk-accordion-title border-b py-4 px-6" href="#"> <div class="flex items-center text-base font-semibold"> <ion-icon name="card-outline" class="mr-2"></ion-icon> Pay with Credit Card</div> </a>
                                    <div class="uk-accordion-content py-6 px-8 mt-0 border-b">
                                        
                                        <p class="">We accept following credit cards:&nbsp;&nbsp;<img class="inline-block" src="<?= base_url() ?>/front/assets/images/cards.png" style="width: 187px;" alt="Cerdit Cards"></p>
            
                                        <form class="grid sm:grid-cols-4 gap-4 mt-3">
                                            <div class="col-span-2">
                                                <input type="text" name="number" placeholder="Card Number" class="with-border">
                                            </div>
                                            <div class="col-span-2">
                                                <input type="text" name="name" placeholder="Full Name" class="with-border">
                                            </div>
                                            <div> 
                                                <input type="text" name="expiry" placeholder="MM/YY" class="with-border">
                                            </div>
                                            <div>    
                                                <input type="text" name="cvc" placeholder="CVC" class="with-border">
                                            </div>
                                            <div class="col-span-2 border rounded-md border-blue-500">
                                                <button class="w-full py-3 font-semibold rounded text-blue-600 text-base block" type="submit">Submit</button>
                                            </div>
                                        </form>
            
                                    </div>
                                </li>
                                <li>
                                    <a class="uk-accordion-title border-b py-4 px-6" href="#"> <div class="flex items-center text-base font-semibold"> <ion-icon name="logo-paypal" class="mr-2"></ion-icon> Pay with PayPal</div> </a>
                                    <div class="uk-accordion-content py-6 px-8 mt-0 border-b">
                                        
                                        <p><span class="font-semibold">PayPal</span> - the safer, easier way to pay</p> 
                                        <form class="grid sm:grid-cols-2 gap-4 mt-3">
                                            <div>
                                                <input type="text" name="email" placeholder="E-mail" class="with-border">
                                            </div>
                                            <div>
                                                <input type="Password" name="Password" placeholder="Password" class="with-border">
                                            </div>
                                        </form>
            
                                        <div class="flex flex-wrap items-center justify-between py-2 mt-3">
                                            <a class="font-medium text-sm text-blue-600 hover:underline" href="#">Forgot password?</a>
                                            <button class="button" type="submit">Log In</button>
                                        </div>
            
                                    </div>
                                </li>
                                <li>
                                    <a class="uk-accordion-title border-b py-4 px-6" href="#"> <div class="flex items-center text-base font-semibold"> <ion-icon name="gift-outline" class="mr-2"></ion-icon> Redeem Reward Points</div> </a>
                                    <div class="uk-accordion-content py-6 px-8 mt-0 border-b">
                                        
                                        <p>You currently have<span class="font-semibold">&nbsp;562</span>&nbsp;Reward Points to spend.</p>
                                        
                                        <div class="checkbox mt-3">
                                            <input type="checkbox" id="use_points_check" checked>
                                            <label for="use_points_check"><span class="checkbox-icon"></span>  Use my Reward Points to pay for this order</label>
                                        </div>
            
                                    </div>
                                </li>
                            </ul> -->

                            <form method="POST" action="<?= base_url('/order/checkout') ?>" class="grid sm:grid-cols-2 gap-x-6 gap-y-4 mt-4 p-6">
                                    <div class="col-span-2 flex justify-around">
                                        <div class="radio">
                                            <input id="radio-1" name="type" type="radio" x-model="type" value="company">
                                            <label for="radio-1"><span class="radio-label" ></span> Azienda
                                            </label>
                                        </div>
                                        <br>
                                        <div class="radio">
                                            <input id="radio-2" name="type" type="radio" x-model="type" value="professional">
                                            <label for="radio-2"><span class="radio-label"></span> Professionista
                                            </label>
                                        </div>
                                        <br>
                                        <div class="radio">
                                            <input id="radio-3" name="type" type="radio" x-model="type" value="private">
                                            <label for="radio-3"><span class="radio-label"></span> Privato
                                            </label>
                                        </div>
                                    </div>
                                    <template x-if="type != 'private'">
                                        <div>
                                            <label for="piva" class="text-sm font-medium"> P.iva </label>
                                            <input type="text" class="with-border" id="piva" name="piva" value="<?= $user['fattura_piva'] ?>">
                                        </div>
                                    </template>
                                    <template x-if="type == 'company'">
                                        <div>
                                            <label for="regione" class="text-sm font-medium"> Ragione Sociale </label>
                                            <input type="text" class="with-border" id="regione" name="regione" value="<?= $user['ragione_sociale'] ?>">
                                        </div>
                                    </template>
                                    <div>
                                        <label for="cf" class="text-sm font-medium"> Codice fiscale </label>
                                        <input type="text" class="with-border" id="cf" name="cf" value="<?= $user['fattura_cf'] ?>">
                                    </div>
                                    <div>
                                        <label for="name" class="text-sm font-medium"> First Name</label>
                                        <input type="text" class="with-border" id="name" name="name" value="<?= $user['fattura_nome'] ?>">
                                    </div>
                                    <div>
                                        <label for="cognome" class="text-sm font-medium"> Last Name</label>
                                        <input type="text" class="with-border" id="cognome" name="cognome" value="<?= $user['fattura_cognome'] ?>">
                                    </div>
                                    <div>
                                        <label for="residenza_stato" class="text-sm font-medium"> <?php echo lang('front.field_country')?> </label>
                                        <select class="selectpicker border rounded-md" id="residenza_stato" name="residenza_stato" x-model="stato" @change="handleCountry">
                                            <option value="0"><?php echo lang('front.field_select')?></option>
                                            <?php foreach($country as $stato) { ?>
                                                <option value="<?= $stato['id'] ?>" <?php if(null !==old('residenza_stato') && old('residenza_stato')==$stato['id']) echo 'selected'?>><?= $stato['nazione'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="residenza_provincia" class="text-sm font-medium"> <?php echo lang('front.field_provincia')?> </label>
                                        <div x-html="provincia"></div>
                                    </div>
                                    <div>
                                        <label for="residenza_comune" class="text-sm font-medium"> <?php echo lang('front.field_city')?> </label>
                                        <div x-html="comuni"></div>
                                    </div>
                                    <div>
                                        <label for="indirizzo" class="text-sm font-medium"> Indirizzo</label>
                                        <input type="text" class="with-border" id="indirizzo" name="indirizzo" value="<?= $user['fattura_indirizzo'] ?>">
                                    </div>
                                    <div>
                                        <label for="cap" class="text-sm font-medium"> CAP</label>
                                        <input type="text" class="with-border" id="cap" name="cap" value="<?= $user['fattura_cap'] ?>">
                                    </div>
                                    <div>
                                        <label for="telefono" class="text-sm font-medium"> Telefono </label>
                                        <input type="text" class="with-border" id="telefono" name="telefono" value="<?= $user['fattura_phone'] ?>">
                                    </div>
                                    <div>
                                        <label for="pec" class="text-sm font-medium"> PEC </label>
                                        <input type="text" class="with-border" id="pec" name="pec" value="<?= $user['fattura_pec'] ?>">
                                    </div>
                                    <template x-if="type != 'private'">
                                        <div>
                                            <label for="sdi" class="text-sm font-medium"> SDI </label>
                                            <input type="text" class="with-border" id="sdi" name="sdi" value="<?= $user['fattura_sdi'] ?>">
                                        </div>
                                    </template>

                                    <div class="col-span-2 flex justify-around">
                                        <?php if(!empty(array_filter($methods, function($el){return $el['id_method'] == '2';}))){ ?>
                                            <div class="radio">
                                                <input id="paypal" name="paymethod" type="radio" x-model="paymethod" value="paypal">
                                                <label for="paypal"><span class="radio-label" ></span> <span class="icon-brand-cc-paypal text-3xl"></span>
                                                </label>
                                            </div>
                                        <br>
                                        <?php } ?>

                                        <?php if(!empty(array_filter($methods, function($el){return $el['id_method'] == '3';}))){ ?>
                                            <div class="radio">
                                                <input id="stripe" name="paymethod" type="radio" x-model="paymethod" value="stripe">
                                                <label for="stripe"><span class="radio-label"></span> <span class="icon-brand-cc-stripe text-3xl"></span>
                                                </label>
                                            </div>
                                            <br>
                                        <?php } ?>

                                        <?php if(!empty(array_filter($methods, function($el){return $el['id_method'] == '1';}))){ ?>
                                            <div class="radio">
                                                <input id="iban" name="paymethod" type="radio" x-model="paymethod" value="iban">
                                                <label for="iban"><span class="radio-label"></span> <span class="icon-brand-cc-mastercard text-3xl"></span>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <?php if(!empty(array_filter($methods, function($el){return $el['id_method'] == '1';}))){ ?>
                                    <?php $methIban = array_filter($methods, function($el){return $el['id_method'] == '1';}) ?>
                                        <template x-if="paymethod == 'iban'">
                                            <div class="uk-alert-primary uk-alert col-span-2" uk-alert="">
                                                <p>IBAN: <?= json_decode(reset($methIban)['details'])->iban ?></p>
                                            </div>
                                        </template>
                                    <?php } ?>
                                    
                                    <div class="flex justify-between col-span-2">
                                        <a class="bg-gray-200 flex font-medium items-center justify-center py-3 rounded-md w-1/3" href="pages-cart.html">
                                            <i class="icon-feather-chevron-left mr-1"></i>
                                            <span class="md:block hidden">Back to Cart</span><span class="md:hidden block">Back</span>
                                        </a>
                                        <button class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white w-1/3">
                                            <span class="md:block hidden">Billing address </span><span class="md:hidden block">Review</span>
                                            <i class="icon-feather-chevron-right ml-1"></i>
                                        </button>
                                    </div>
                                </form>
            
                        </div>
    
                        
                        
        
                    </div>
        
                    <!-- Sidebar -->
                    <div class="lg:w-5/12 lg:-ml-12 lg:mt-0 mt-8">
                        <div class="bg-white rounded-md shadow-lg lg:p-6 p-3" uk-sticky="offset:; offset:90 ; media: 1024 ; bottom: true">
        
                            <div class="font-semibold px-5 pb-3 text-lg text-center"> Order summary </div>
        
                            <div>
                                <template x-for="item in cartItems" :key="item.id">
                                    <div class="flex py-3 space-x-2.5 delimiter-bottom">
                                        <a class="block md:mr-2" href="#"><img class="w-16 h-11 object-cover rounded" :src="item.options.image ? item.options.image : '<?= base_url('front/assets/images/courses/img-1.jpg') ?>'" alt="Product"></a>
                                        <div class="flex-1">
                                            <h6 class="font-medium"><a href="#" class="line-clamp-2" x-text="item.name"></a></h6>
                                            <div class="flex justify-between mt-1"><span class="font-medium text-sm text-blue-500" x-text="item.type"></span><span class="font-bold mt-0.5" x-text="formatter.format(item.price)"></span></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
        
                            <ul class="border-b border-t my-3 py-3 text-sm">
                                <li class="flex justify-between align-center"><span class="mr-2">Subtotal:</span><span x-text="formatter.format(total)"></span></li>
                                <li class="flex justify-between align-center"><span class="mr-2">tax:</span><span x-text="formatter.format(tax)"></span></li>
                                <li class="flex justify-between align-center"><span class="mr-2">Discount:</span><span><span class="text-right">—</span></span></li>
                            </ul>
        
                            <h3 class="font-semibold text-center my-6 text-2xl" x-text="formatter.format(total+tax)"></h3>
                            <form method="post" class="space-y-3">
                                <input class="form-control with-border" type="text" placeholder="Promo code" required="">
                                <div class="col-span-2 border rounded-md border-blue-500">
                                    <button class="w-full py-2.5 font-semibold rounded text-blue-600 text-base block" type="submit">Apply promo code</button>
                                </div>
                            </form>
                             
                        </div>
                    </div>
        
                </div>
        
            </div>
        </div>
<?= view($view_folder.'/common/footer') ?>
<script>
    function getResData(){
        return {
            stato: '<?= $user_data['profile']['fattura_stato'] ?? '' ?>', 
            paymethod: 'paypal',
            type: '<?= $user_data['profile']['type'] ?? 'private' ?>',
            comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control with-border">', 
            provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control with-border">',

            

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
            
            init(){
                Promise.allSettled([
                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['fattura_stato'] ?>' == '106') {
                                // $('#loading').modal('show');
                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['fattura_provincia'] ?>&name=residenza_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.provincia = res; setTimeout(() => {$('select').selectpicker('render');}, 50); resolve()})
                            } resolve();})) ,


                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['fattura_stato'] ?>' == '106' && '<?= $user['fattura_provincia'] ?>') {
                                // $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['fattura_provincia'] ?>&selected=<?= $user['fattura_comune'] ?>&name=residenza_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.comuni = res; setTimeout(() => {$('select').selectpicker('render');}, 50); resolve()})
                            } resolve();})),

                            
                        ])
            }
        }

         
    }
</script>
<?= view($view_folder.'/common/close') ?>
