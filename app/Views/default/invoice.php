<?= view($view_folder.'/common/header') ?>
<style>
    body{min-width: 100vw; width: fit-content}
    #invoiceholder{
        width:100%;
        height: 100%;
        padding-top: 50px;
    }
    #headerimage{
        z-index:-1;
        position:relative;
        top: -50px;
        height: 350px;
        background-image: url('http://michaeltruong.ca/images/invoicebg.jpg');

        -webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
        -moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
        box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
        overflow:hidden;
        background-attachment: fixed;
        background-size: 1920px 80%;
        background-position: 50% -90%;
    }
    #invoice{
        position: relative;
        top: -290px;
        margin: 0 auto;
        width: 700px;
        background: #FFF;
    }

    [id*='invoice-']{ /* Targets all id with 'col-' */
        border-bottom: 1px solid #EEE;
        padding: 30px;
    }

    #invoice-top{min-height: 120px;}
    #invoice-mid{min-height: 120px;}
    #invoice-bot{ min-height: 250px;}

    .logo{
        float: left;
        height: 60px;
        width: 60px;
        background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
        background-size: 60px 60px;
    }
    .clientlogo{
        float: left;
        height: 60px;
        width: 60px;
        background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
        background-size: 60px 60px;
        border-radius: 50px;
    }
    .enteLogo{
        float: left;
        height: 60px;
        width: 60px;
        background: url(<?= base_url('front/assets/images/avatars/placeholder.png') ?>) no-repeat;
        background-size: 60px 60px;
        border-radius: 50px;
    }
    .info{
        display: block;
        float:left;
        margin-left: 20px;
    }
    .title{
        float: right;
    }
    .title p{text-align: right;}
    #project{margin-left: 52%;}
    table{
        width: 100%;
        border-collapse: collapse;
    }
    td{
        padding: 5px 0 5px 15px;
        border: 1px solid #EEE
    }
    .tabletitle{
        padding: 5px;
        background: #EEE;
    }
    .service{border: 1px solid #EEE;}
    .item{width: 50%;}
    .itemtext{font-size: .9em;}

    #legalcopy{
        margin-top: 30px;
    }
    form{
        float:right;
        margin-top: 30px;
        text-align: right;
    }


    .effect2
    {
        position: relative;
    }
    .effect2:before, .effect2:after
    {
        z-index: -1;
        position: absolute;
        content: "";
        bottom: 15px;
        left: 10px;
        width: 50%;
        top: 80%;
        max-width:300px;
        background: #777;
        -webkit-box-shadow: 0 15px 10px #777;
        -moz-box-shadow: 0 15px 10px #777;
        box-shadow: 0 15px 10px #777;
        -webkit-transform: rotate(-3deg);
        -moz-transform: rotate(-3deg);
        -o-transform: rotate(-3deg);
        -ms-transform: rotate(-3deg);
        transform: rotate(-3deg);
    }
    .effect2:after
    {
        -webkit-transform: rotate(3deg);
        -moz-transform: rotate(3deg);
        -o-transform: rotate(3deg);
        -ms-transform: rotate(3deg);
        transform: rotate(3deg);
        right: 10px;
        left: auto;
    }



    .legal{
        width:70%;
    }
</style>
<?php $enteProfile = $UserProfileModel->where('user_id', $selected_ente['id'])->first() ?>
<div class="lg:py-10 py-5">
            <div class="container">

                <div class="lg:flex">
                <div id="invoiceholder">

                    <div id="headerimage"></div>
                    <div id="invoice" class="effect2">
                    
                    <!-- <div id="invoice-top">
                        <div class="logo"></div>
                        <div class="info">
                        <h2>Michael Truong</h2>
                        <p> hello@michaeltruong.ca </br>
                            289-335-6503
                        </p>
                        </div>
                        <div class="title">
                        <p>Issued: May 27, 2015</br>
                            Payment Due: June 27, 2015
                        </p>
                        </div>
                    </div> -->


                    
                    <div id="invoice-mid" class="flex justify-between">
                        <div>
                            <div class="clientlogo"></div>
                            <div class="info">
                            <h2><?= session('user_data')['display_name'] ?? '' ?></h2>
                            <p><?= session('user_data')['profile']['email'] ?? '' ?></br>
                            <?= session('user_data')['profile']['fattura_phone'] ?? '' ?></br>
                            </div>
                        </div>
                        <div>
                            <div class="flex">
                                <div class="mr-4">
                                    <h2><?= $selected_ente['display_name'] ?? '' ?></h2>
                                    <p><?= $enteProfile['email'] ?? '' ?></br>
                                    <?= $enteProfile['fattura_phone'] ?? '' ?></br>
                                </div>
                                
                                <div class="enteLogo"></div>
                            </div>
                        </div>

                        <!-- <div id="project">
                        <h2>Project Description</h2>
                        <p>Proin cursus, dui non tincidunt elementum, tortor ex feugiat enim, at elementum enim quam vel purus. Curabitur semper malesuada urna ut suscipit.</p>
                        </div>    -->

                    </div><!--End Invoice Mid-->
                    
                    <div id="invoice-bot">
                        
                        <div id="table">
                        <table>
                            <tr class="tabletitle">
                            <td class="item"><h2>Item Description</h2></td>
                            <td class="Hours"><h2>Price</h2></td>
                            <td class="Rate"><h2>Coupons</h2></td>
                            <td class="subtotal"><h2>Sub-total</h2></td>
                            </tr>
                            <?php $tax = 0;$total=0;foreach($cartItems as $item){ $tax += floatVal($item['price_ht'])*(floatVal($item['vat']/100)); $total += $item['price_ht'];?>
                                
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext"><?= json_decode($item['details'])->name ?></p></td>
                                    <td class="tableitem"><p class="itemtext"><?= $amount->format(json_decode($item['details'])->originalPrice) ?></p></td>
                                    <td class="tableitem"><p class="itemtext">  <?php $coupon = 0; foreach(json_decode($item['details'])->coupon as $name=>$value){ $coupon += $value;?>
                                                                                    <div class="itemtext"><?= $name ?>: <?= $amount->format($value) ?></div>
                                                                                <?php } ?></p></td>
                                    <td class="tableitem"><p class="itemtext"><?= $amount->format($item['price_ht']) ?></p></td>
                                </tr>
                            <?php } ?>
                            
                           
                            
                            
                            <tr class="tabletitle">
                                <td></td>
                                <td class="Hours"><h2>Sub Total</h2></td>
                                <td class="Rate"><p><?= $amount->format($coupon) ?></p></td>
                                <td class="payment"><h2><?= $amount->format($total) ?></h2></td>
                            </tr>

                            <tr class="tabletitle">
                                <td></td>
                                <td class="Hours"></td>
                                <td class="Rate"><h2>tax</h2></td>
                                <td class="payment"><h2><?= $amount->format($tax) ?></h2></td>
                            </tr>

                            <tr class="tabletitle">
                                <td></td>
                                <td class="Hours"></td>
                                <td class="Rate"><h2>Total</h2></td>
                                <td class="payment"><h2><?= $amount->format($total + $tax) ?></h2></td>
                            </tr>

                            <tr class="tabletitle">
                                <td></td>
                                <td class="Hours"></td>
                                <td class="Rate"><h2>Metodo di pagamento</h2></td>
                                <td class="payment"><h2><?= $payment_method ?></h2></td>
                            </tr>
                        </table>
                        </div><!--End Table-->
                        
                    <!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="QRZ7QTM9XRPJ6">
                        <input type="image" src="http://michaeltruong.ca/images/paypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    </form> -->

                        
                        <div id="legalcopy">
                        <!-- <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices.  -->
                        </p>
                        </div>
                        
                    </div><!--End InvoiceBot-->
                    </div><!--End Invoice-->
                    </div><!-- End Invoice Holder-->
                </div>
            </div>
</div>
<?= view($view_folder.'/common/footer') ?>
<?= view($view_folder.'/common/close') ?>
