<?= view($view_folder.'/common/header') ?>
<style>
    input[type="radio"]:checked ~ label div{
        border: .5px solid #FF7700;
    }
    input[type="radio"] ~ label div{
        border: .5px solid #666;
    }
    #fb-share-button {
    background: #3b5998;
    border-radius: 3px;
    font-weight: 600;
    padding: 0px 5px;
    display: flex;
    align-items: center;
    position: static;
    }

    #fb-share-button:hover {
        cursor: pointer;
        background: #213A6F
    }

    #fb-share-button svg {
        width: 12px;
        fill: white;
        vertical-align: middle;
        border-radius: 2px
    }

    #fb-share-button span {
        vertical-align: middle;
        color: white;
        font-size: .75em;
        padding: 0 3px
    }
</style>
        <!--  breadcrumb -->
        <div class="from-blue-500 bg-grey breadcrumb-area py-6 text-black">
            <div class="container mx-auto lg:pt-5">
                <div class="breadcrumb text-black">
                    <ul class="m-0">
                        <li>
                            <a href="<?= base_url() ?>"> <i class="icon-feather-home"></i> </a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>">Home</a>
                        </li> 
                        <li class="active">
                            <a href="#">Checkout </a>
                        </li>
                    </ul>
                </div>
                <div class="md:text-2xl text-base font-semibold mt-6 md:mb-6"> <?php echo lang('front.title_page_checkout')?> </div>
            </div>
        </div>
        
        <div class="lg:py-10 py-5" x-data="getResData">
            <div class="container">

                <div class="lg:flex">
         
                    <div class="w-full lg:pr-24"> 
        
                        <h2 class="text-xl font-semibold md:mb-6 mb-3"> <?php echo lang('front.title_section_profile_fatturazione')?></h2>

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
                                            <label for="radio-1"><span class="radio-label" ></span> <?php echo lang('front.field_azienda')?>
                                            </label>
                                        </div>
                                        <br>
                                        <div class="radio">
                                            <input id="radio-2" name="type" type="radio" x-model="type" value="professional">
                                            <label for="radio-2"><span class="radio-label"></span> <?php echo lang('front.field_prof')?>
                                            </label>
                                        </div>
                                        <br>
                                        <div class="radio">
                                            <input id="radio-3" name="type" type="radio" x-model="type" value="private">
                                            <label for="radio-3"><span class="radio-label"></span> <?php echo lang('front.field_private')?>
                                            </label>
                                        </div>
                                    </div>
                                    <template x-if="type != 'private'">
                                        <div>
                                            <label for="piva" class="text-sm font-medium"><?php echo lang('front.field_piva')?></label>
                                            <input type="text" class="with-border" id="piva" name="piva" value="<?= $user['fattura_piva'] ?>" required>
                                        </div>
                                    </template>
                                    <template x-if="type == 'company'">
                                        <div>
                                            <label for="regione" class="text-sm font-medium"> <?php echo lang('front.field_company_name')?> </label>
                                            <input type="text" class="with-border" id="regione" name="regione" value="<?= $user['ragione_sociale'] ?>" required>
                                        </div>
                                    </template>
                                    <div>
                                        <label for="cf" class="text-sm font-medium"> <?php echo lang('front.field_cf')?> </label>
                                        <input type="text" class="with-border" id="cf" name="cf" value="<?= $user['fattura_cf'] ?>" required>
                                    </div>
                                    <div>
                                        <label for="name" class="text-sm font-medium"> <?php echo lang('front.field_first_name')?></label>
                                        <input type="text" class="with-border" id="name" name="name" value="<?= $user['fattura_nome'] ?>" required>
                                    </div>
                                    <div>
                                        <label for="cognome" class="text-sm font-medium"> <?php echo lang('front.field_last_name')?></label>
                                        <input type="text" class="with-border" id="cognome" name="cognome" value="<?= $user['fattura_cognome'] ?>" required>
                                    </div>
                                    <div>
                                        <label for="residenza_stato" class="text-sm font-medium"> <?php echo lang('front.field_country')?> </label>
                                        <select class="selectpicker border rounded-md" id="residenza_stato" name="residenza_stato" x-model="stato" @change="handleCountry" required>
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
                                        <label for="indirizzo" class="text-sm font-medium"> <?php echo lang('front.field_address')?></label>
                                        <input type="text" class="with-border" id="indirizzo" name="indirizzo" value="<?= $user['fattura_indirizzo'] ?>" required>
                                    </div>
                                    <div>
                                        <label for="cap" class="text-sm font-medium"> <?php echo lang('front.field_zip')?></label>
                                        <input type="text" class="with-border" id="cap" name="cap" value="<?= $user['fattura_cap'] ?>" required>
                                    </div>
                                    <div>
                                        <label for="telefono" class="text-sm font-medium"> <?php echo lang('front.field_phone')?> </label>
                                        <input type="text" class="with-border" id="telefono" name="telefono" value="<?= $user['fattura_phone'] ?>" required>
                                    </div>
                                    <div>
                                        <label for="pec" class="text-sm font-medium"> <?php echo lang('front.field_pec')?> </label>
                                        <input type="text" class="with-border" id="pec" name="pec" value="<?= $user['fattura_pec'] ?>" :required="type != 'private'">
                                    </div>
                                    <template x-if="type != 'private'">
                                        <div>
                                            <label for="sdi" class="text-sm font-medium"> <?php echo lang('front.field_sdi')?> </label>
                                            <input type="text" class="with-border" id="sdi" name="sdi" value="<?= $user['fattura_sdi'] ?>" required>
                                        </div>
                                    </template>
                                    <template x-if="total > 0">
                                    <div class="col-span-2">
                                        <h2 class="col-span-2 text-xl font-semibold md:mb-6 mb-3"> <?php echo lang('front.title_section_payment_method')?></h2>

                                        <div class="col-span-2 flex justify-around flex-wrap space-y-4">
                                            <?php if(!empty(array_filter($methods, function($el){return $el['id_method'] == '2';}))){ ?>
                                                <div class="radio w-full md:w-1/2 h-24 mt-4">
                                                    <input id="paypal" name="paymethod" type="radio" x-model="paymethod" value="paypal">
                                                    <label for="paypal" class="h-full w-full">
                                                        <div class="h-full w-full flex justify-center items-center rounded-lg">
                                                            <img class="h-full" src="<?= base_url('/front/assets/images/paypal.png') ?>" alt="">
                                                        </div>
                                                    </label>
                                                </div>
                                            <br>
                                            <?php } ?>

                                            <?php if(!empty(array_filter($methods, function($el){return $el['id_method'] == '3';}))){ ?>
                                                <div class="radio w-full md:w-1/2 h-24">
                                                    <input id="stripe" name="paymethod" type="radio" x-model="paymethod" value="stripe">
                                                    <label for="stripe" class="h-full w-full">
                                                        <div class="h-full w-full flex justify-center items-center rounded-lg">
                                                            <img class="h-full" src="<?= base_url('/front/assets/images/stripe.png') ?>" alt="">
                                                        </div>
                                                    </label>
                                                </div>
                                                <br>
                                            <?php } ?>

                                            <?php if(!empty(array_filter($methods, function($el){return $el['id_method'] == '1';}))){ ?>
                                                <div class="radio w-full md:w-1/2 h-24">
                                                    <input id="iban" name="paymethod" type="radio" x-model="paymethod" value="iban">
                                                    <label for="iban" class="h-full w-full">
                                                    <div class="h-full w-full flex justify-center items-center rounded-lg">
                                                        <img class="h-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNwEgcoA0L5KK7goHFzHR9VYChO5SI7i8wpA&usqp=CAU" alt="">
                                                    </div>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <?php if(!empty(array_filter($methods, function($el){return $el['id_method'] == '1';}))){ ?>
                                        <?php $methIban = array_filter($methods, function($el){return $el['id_method'] == '1';})
                                        ?>
                                            <template x-if="paymethod == 'iban'">
                                                <div class="uk-alert-primary uk-alert col-span-2" uk-alert="">
                                                <?php $methIban=json_decode($methIban[0]['details']); 
                                            ?>
                                                    <p><?php echo lang('front.field_iban')?>: <?php echo $methIban->iban ?></p>
                                                    <p><?php echo lang('front.field_bank_name')?>: <?php echo $methIban->bank_name ?></p>
                                                    <p><?php echo lang('front.field_bank_property')?>: <?php echo $methIban->property ?></p>
                                                </div>
                                            </template>
                                        <?php } ?>
                                        </div>
                                    </template>

                                    <div class="flex justify-center col-span-2">
                                        
                                        <button class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white w-1/3">
                                            <span class="md:block hidden" x-text="total > 0 ? '<?php echo lang('front.btn_pay')?>' : '<?php echo lang('front.btn_pay_free')?>'"></span><span class="md:hidden block" x-text="total > 0 ? '<?php echo lang('front.btn_pay2')?>' : '<?php echo lang('front.btn_pay2_free')?>'"></span>
                                            <i class="icon-feather-chevron-right ml-1"></i>
                                        </button>
                                    </div>
                                </form>
            
                        </div>
    
                        
                        
        
                    </div>
        
                    <!-- Sidebar -->
                    <div class="lg:w-7/12 lg:-ml-12 lg:mt-0 mt-8">
                        <div class="bg-white rounded-md shadow-lg lg:p-6 p-3" uk-sticky="offset:; offset:90 ; media: 1024 ; bottom: true">
        
                            <div class="font-semibold px-5 pb-3 text-lg text-center"> <?php echo lang('front.title_section_order_summary')?> </div>
                            <template x-if="flashMessage.status == 'success'">
                                <div class="uk-alert-success uk-alert" uk-alert="">
                                    <p x-text="flashMessage.message"></p>
                                </div>
                            </template>
                            <template x-if="flashMessage.status == 'error'">
                                <div class="uk-alert-warning uk-alert" uk-alert="">
                                    <p x-text="flashMessage.message"></p>
                                </div>
                            </template>
                            <div>
                                <template x-for="item in cartItems" :key="item.id">
                                    <div class="flex py-3 space-x-2.5 delimiter-bottom">
                                        <a class="block md:mr-2" href="#"><img class="w-16 h-11 object-cover rounded" :src="item.options.image ? item.options.image : '<?= base_url('front/assets/images/courses/img-1.jpg') ?>'" alt="Product"></a>
                                        <div class="flex-1">
                                            <h6 class="font-medium"><a :href="item.url" class="line-clamp-2" x-text="item.name"></a></h6>
                                            <div class="flex justify-between mt-1">
                                                
                                                <span class="font-medium text-sm text-blue-500" x-text="item.type"></span>
                                                <div>
                                                    <template x-if="item.price != item.originalPrice">
                                                        <span class="font-bold mt-0.5 discounted" x-text="formatter.format(item.originalPrice)"></span>
                                                    </template>
                                                    <span class="font-bold mt-0.5" x-text="formatter.format(item.price)"></span>
                                                </div>
                                            </div>
                                            <?php if(isset($settings['facebook_id'])&&isset($settings['facebook_discount'])&&in_array('share', $ente_package['extra'])){ ?>
                                            <template x-if="item.price > 0">
                                                <div class="flex justify-between mt-1">
                                                    <p @click="shareFacebook(item.rowid, item.url, '<?= $settings['facebook_discount'] ?? 0?>')" class="text-green-400 cursor-pointer hover:underline">Condividi e risparmia <?= $amount->format($settings['facebook_discount'] ?? 0) ?></p>
                                                </div>
                                            </template>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </template>
                            </div>
        
                            <ul class="border-b border-t my-3 py-3 text-sm space-y-4">
                                <li class="flex justify-between align-center"><span class="mr-2"><?php echo lang('front.field_subtotal')?>:</span><span x-text="formatter.format(total+(Object.keys(couponSum).length > 0 ? Object.values(couponSum).reduce((pv,cv) => {return parseFloat(pv ? pv : 0)+parseFloat(cv ? cv : 0)}) : 0)+(Object.keys(shareSum).length > 0 ? Object.values(shareSum).reduce((pv,cv) => {return parseFloat(pv ? pv : 0)+parseFloat(cv ? cv : 0)}) : 0))"></span></li>
                                <li class="flex justify-between align-center"><span class="mr-2"><?php echo lang('front.field_discount')?>:</span>
                                    <span>
                                        <template x-for="(discount,idx) in couponSum">
                                            <span class="block text-xs text-right"><span x-text="idx + ': '"></span> <span class="ml-4" x-text="formatter.format(discount)"></span></span>
                                        </template>
                                            <span class="block text-right" x-text="formatter.format(Object.keys(couponSum).length > 0 ? Object.values(couponSum).reduce((pv,cv) => {return parseFloat(pv ? pv : 0)+parseFloat(cv ? cv : 0)}) : 0)"></span>
                                    </span>
                                </li>
                                <li class="flex justify-between align-center"><span class="mr-2"><?php echo lang('front.share')?>:</span>
                                    <span>
                                        <template x-for="(discount,idx) in shareSum">
                                            <span class="block text-xs text-right"><span x-text="idx + ': '"></span> <span class="ml-4" x-text="formatter.format(discount)"></span></span>
                                        </template>
                                            <span class="block text-right" x-text="formatter.format(Object.keys(shareSum).length > 0 ? Object.values(shareSum).reduce((pv,cv) => {return parseFloat(pv ? pv : 0)+parseFloat(cv ? cv : 0)}) : 0)"></span>
                                    </span>
                                </li>
                                <li class="flex justify-between align-center"><span class="mr-2"><?php echo lang('front.field_subtotal_after_discount')?>:</span><span x-text="formatter.format(total)"></span></li>
                                <li class="flex justify-between align-center"><span class="mr-2"><?php echo lang('front.field_tax')?>:</span><span x-text="formatter.format(tax)"></span></li>

                            </ul>
        
                            <h3 class="font-semibold text-center my-6 text-2xl" x-text="formatter.format(total+tax)"></h3>
                            <?php if(in_array('coupon', $ente_package['extra'])) {?>
                            <form method="post" @submit.prevent="applyCoupon($refs.coupon.value)" class="space-y-3" action="<?= base_url('/order/coupon') ?>">
                                <input class="form-control with-border" type="text" name="coupon" x-ref="coupon" placeholder="<?php echo lang('front.field_insert_code')?>">
                                <div class="col-span-2 border rounded-md border-blue-500">
                                    <button class="w-full py-2.5 font-semibold rounded text-blue-600 text-base block" type="submit"><?php echo lang('front.apply_coupon')?></button>
                                </div>
                            </form> 
                            <?php } ?>
                        </div>
                    </div>
        
                </div>
        
            </div>
        </div>
<?= view($view_folder.'/common/footer') ?>
<?php if(isset($settings['facebook_id'])){ ?>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '<?= $settings['facebook_id'] ?>',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v12.0'
    });
  };
</script>
<?php } ?>

<script>
    function getResData(){
        return {
            stato: '<?= $user['fattura_stato'] ?? '' ?>', 
            paymethod: 'paypal',
            type: '<?= $user['type'] ?? 'private' ?>',
            comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control with-border" required>', 
            provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control with-border" required>',

            

            handleCountry(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=residenza_provincia`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => {this.provincia = res; setTimeout(() => {$('select').selectpicker('render');}, 50)})
                }
                else {
                    this.provincia = '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control with-border" required>'
                    this.comuni = '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control with-border" required>'
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
