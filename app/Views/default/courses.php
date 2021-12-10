<?php require_once 'common/header.php' ?>
  
<style> 
/* Checkbox styles */
label.checkbox {
  margin-right: 1rem;
  padding-left: 1.75rem;
  position: relative;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
label.checkbox input[type=checkbox] {
  position: absolute;
  opacity: 0;
}
label.checkbox input[type=checkbox]:focus ~ span {
  border: 2px solid #aab0b9;
}
label.checkbox input[type=checkbox]:focus:checked ~ span {
  border: 2px solid #20644c;
}
label.checkbox input[type=checkbox]:checked ~ span {
  color: #FFFFFF;
  background: #329E78 url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+DQo8c3ZnIHdpZHRoPSIxMiIgaGVpZ2h0PSI5IiB2aWV3Qm94PSIwIDAgMTIgOSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4NCiAgPHBhdGggZD0iTTQuNTc1IDguOTc3cy0uNDA0LS4wMDctLjUzNi0uMTY1TC4wNTcgNS42NGwuODI5LTEuMjI3TDQuNDcgNy4yNjggMTAuOTIxLjA4NmwuOTIzIDEuMTAzLTYuODYzIDcuNjRjLS4xMzQtLjAwMy0uNDA2LjE0OC0uNDA2LjE0OHoiIGZpbGw9IiNGRkYiIGZpbGwtcnVsZT0iZXZlbm9kZCIvPg0KPC9zdmc+) 50% 40% no-repeat;
  border: 2px solid #329E78;
}
label.checkbox span {
  border-radius: 3px;
  position: absolute;
  left: 0;
  /* top: -2px; */
  width: 1rem;
  height: 1rem;
  background-color: #d4d7dc;
  border: 2px solid #d4d7dc;
  pointer-events: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
label.checkbox.blue {
  margin-right: 1rem;
  padding-left: 1.75rem;
  position: relative;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
label.checkbox.blue input[type=checkbox] {
  position: absolute;
  opacity: 0;
}
label.checkbox.blue input[type=checkbox]:focus ~ span {
  border: 2px solid #aab0b9;
}
label.checkbox.blue input[type=checkbox]:focus:checked ~ span {
  border: 2px solid #265b81;
}
label.checkbox.blue input[type=checkbox]:checked ~ span {
  color: #FFFFFF;
  background: #3785BC url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+DQo8c3ZnIHdpZHRoPSIxMiIgaGVpZ2h0PSI5IiB2aWV3Qm94PSIwIDAgMTIgOSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4NCiAgPHBhdGggZD0iTTQuNTc1IDguOTc3cy0uNDA0LS4wMDctLjUzNi0uMTY1TC4wNTcgNS42NGwuODI5LTEuMjI3TDQuNDcgNy4yNjggMTAuOTIxLjA4NmwuOTIzIDEuMTAzLTYuODYzIDcuNjRjLS4xMzQtLjAwMy0uNDA2LjE0OC0uNDA2LjE0OHoiIGZpbGw9IiNGRkYiIGZpbGwtcnVsZT0iZXZlbm9kZCIvPg0KPC9zdmc+) 50% 40% no-repeat;
  border: 2px solid #3785BC;
}
label.checkbox.blue span {
  border-radius: 3px;
  position: absolute;
  left: 0;
  /* top: -2px; */
  width: 1rem;
  height: 1rem;
  background-color: #d4d7dc;
  border: 2px solid #d4d7dc;
  pointer-events: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.card .card-media img{
    height: auto;
    object-fit: initial;
    position: initial;
}
a[disabled] {
    pointer-events: none;
    background-color: #bdbdbd;
    color: #fff;
}
</style>
        <div class="container"  x-data="getFilters($watch)">

            <!-- Spacer -->
            <div class="my-8 lg:flex lg:space-x-10">
                <div class="lg:w-3/12"></div>
                <div class="w-full">
                    <div class="text-xl font-semibold"><?= ucwords(strtolower(htmlspecialchars($_REQUEST['tipo'] ?? '')), '\',. ') ?> Corsi </div>
                    <div class="text-sm mt-2 font-medium text-gray-500 leading-6">  Choose from +10.000 <?= ucwords(strtolower(htmlspecialchars(implode(', ',array_filter([$_REQUEST['categories'] ?? '', $_REQUEST['argomenti'] ?? ''])))), '\',. ')  ?> courses  </div>
                </div>
                
            </div>
               
            <div class="lg:flex lg:space-x-10">

                <div class="lg:w-3/12 space-y-4 lg:block hidden">
                <form>
                    <div>
                        <h4 class="font-semibold text-base mb-2"> Categories </h4>
                            <!-- <select class="selectpicker default shadow-sm rounded" data-selected-text-format="count" data-size="7"
                                title="All Categories"> -->
                        <?php foreach ($category as $categ) {?>
                        <div>

                                <label class='checkbox blue flex items-center'>
                                    <input type='checkbox' name="category[]" @change="changeUrl" x-model="categories" value="<?= $categ['url'] ?>">
                                    <span class='indicator'></span>
                                    <p><?= $categ['titolo'] ?></p> 
                                </label>
                            <!-- </select> -->
                        </div>
                        <!-- <br> -->
                        <?php }?>
                    </div>

                    <div>
                        <h4 class="font-semibold text-base mb-2"> Argomenti </h4>
                        <?php foreach ($argomenti as $argo) {?>
                        <div>

                                <label class='checkbox blue flex items-center'>
                                    <input type='checkbox' name="argomenti[]" @change="changeUrl" x-model="argomenti" value="<?= $argo['url'] ?>">
                                    <span class='indicator'></span>
                                    <p><?= $argo['nomeargomento'] ?></p> 
                                </label>
                            <!-- </select> -->
                        </div>
                        <!-- <br> -->
                        <?php }?>

                    </div>
                    <template x-if="argomenti.length > 0">
                        <div>
                            <h4 class="font-semibold text-base mb-2"> sottoargomenti </h4>

                            <template x-for="sotto in visiblesottoargomenti">
                                <div>
                                        <label class='checkbox blue flex items-center'>
                                            <input type='checkbox' name="sottoargomenti[]" @change="changeUrl" x-model="sottoargomenti" :value="sotto.url">
                                            <span class='indicator'></span>
                                            <p x-text="sotto.titolo"></p> 
                                        </label>
                                    <!-- </select> -->
                                </div> 
                            </template>
                            

                        </div>
                    </template>
                    
                    <div>
                        <h4 class="font-semibold text-base mb-2"> Tipologia </h4>
                        <div>
                                <label class='checkbox blue flex items-center'>
                                    <input type='checkbox' name="tipo[]" @change="changeUrl" x-model="tipo" value="aula">
                                    <span class='indicator'></span>
                                    <p>Aula</p> 
                                </label>
                            <!-- </select> -->
                        </div>

                        <div>
                                <label class='checkbox blue flex items-center'>
                                    <input type='checkbox' name="tipo[]" @change="changeUrl" x-model="tipo" value="online">
                                    <span class='indicator'></span>
                                    <p>Online</p> 
                                </label>
                            <!-- </select> -->
                        </div>

                        <div>
                                <label class='checkbox blue flex items-center'>
                                    <input type='checkbox' name="tipo[]" @change="changeUrl" x-model="tipo" value="webinar">
                                    <span class='indicator'></span>
                                    <p>Webinar</p> 
                                </label>
                            <!-- </select> -->
                        </div>
                        <!-- <br> -->

                    </div>


                    <a :href="url" class="flex items-center justify-center h-10 mt-8 px-6 rounded-md bg-blue-600 text-white"> Filter </a>

                    </form>
  
                </div>
            
                <div class="w-full md:space-y-10 space-y-5" x-data="{view: 'grid'}"> 
                    
    
                    <div>

                        <div class="md:flex justify-end items-center mb-8 pt-4 border-t">
    
                            
        
                            <div class="flex items-center justify-end">
        
                                <div class="bg-gray-100 border inline-flex p-0.5 rounded-md text-lg self-center">
                                    <button type="button" class="py-1.5 px-2.5 rounded-md" :class="view == 'list' ? 'bg-white shadow' : ''" @click="view = 'list'" data-tippy-placement="top" title="List view"> 
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> 
                                    </button>
                                    <button type="button" href="#" class="py-1.5 px-2.5 rounded-md" :class="view == 'grid' ? 'bg-white shadow' : ''" @click="view = 'grid'" data-tippy-placement="top" title="Grid view"> 
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                    </button>
                                </div>
                                <!-- <div class="w-40 lg:block hidden ml-3">
                                    <select class="selectpicker is-small rounded-md shadow-sm" data-size="7">
                                        <option value="">Newest</option>
                                        <option value="1">Popular</option>
                                        <option value="2">Free</option>
                                        <option value="3">Paid</option>
                                    </select>
                                </div> -->

                                <span class="w-20 lg:block hidden ml-3">Per Page: </span>
                                <div class="w-20 lg:block hidden ml-3">
                                    <select class="selectpicker is-small rounded-md shadow-sm" @change="perPageChange($event.target.value)" data-size="7" x-model="perPage">
                                        <option value="12">12</option>
                                        <option value="36">36</option>
                                        <option value="60">60</option>
                                    </select>
                                </div>
        
                            </div>
                        </div>


                        <template x-if="view == 'grid'">
                            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5">
                                <?php foreach($corsi as $c) { ?>
                                    <div class="card uk-transition-toggle flex flex-col justify-between">
                                        <div class="card-media h-40 flex items-center" @click="showModalPromo('<?= $c['video_promo'] ?>')">
                                            <div class="card-media-overly"></div>
                                            <img src="<?= $c['foto'] ? base_url('uploads/corsi/'.$c['foto']) : base_url('front/assets/images/courses/img-4.jpg') ?>" alt="" class="">
                                            <?php if($c['video_promo']) {?>
                                                <span class="icon-play"></span>
                                            <?php } ?>
                                        </div>
                                            <div class="card-body p-4">
                                                <a href="<?= $c['buy_type'] != 'is_modulo' ? base_url('corsi/'.$c['url']) : base_url('modulo/'.$c['url']) ?>">

                                                    <div class="font-semibold line-clamp-2"> <?= ellipsize($c['sotto_titolo'], 20) ?>
                                                    </div>
                                                    <div class="flex space-x-2 items-center text-sm pt-3">
                                                        <div> <?= $c['tipologia_corsi'] ?> </div>
                                                        <div>·</div>
                                                        <div> <?= $c['buy_type'] != 'is_modulo' ? $c['modulo_count'].' modulo' : '<a href="'.base_url('corsi/'.$c['modulo_count']).'">' .$c['corsiSottoTitoloForModulo'].' </a>' ?> </div>
                                                    </div>
                                                    <div class="pt-1 flex items-center justify-between">
                                                        <div class="text-sm font-semibold"> <?= $c['doctor_names'] ?>  </div>
                                                        <div class="text-lg font-semibold"> <?= $c['prezzo'] ?> </div>
                                                    </div>
                                                </a>

                                                <div class="flex justify-between items-center mt-2">
                                                    <button @click="addToCart('<?= $c['id'] ?>', '<?= $c['prezzo'] ?>', '<?= $c['buy_type'] ?>', '<?= $c['url'] ?>', 'corsi')" class="bg-blue-600 flex justify-center items-center w-9/12 rounded-md text-white text-center text-base h-8 hover:text-white hover:bg-blue-700" <?= strlen($c['prezzo']) == 0 ? 'disabled' : '' ?>> <?= strlen($c['prezzo']) == 0 ? 'non disponibile' : 'Aggiungi al carrello' ?> </button>
                                                    <a class="bg-transparent flex items-center justify-center rounded-full text-sm w-8 h-8 dark:bg-gray-800 dark:text-white border-solid border" href="#" uk-slider-item="next"> <i class="icon-feather-heart"></i></a>
                                                </div>
                                            </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </template>
                        <!-- course list -->
                        
    
                        <template x-if="view == 'list'">
                            <div class="tube-card mt-3 lg:mx-0 -mx-5">
                            
            
                                <div class="divide-y">
                                    <?php foreach($corsi as $c) { ?>
                                        <div class="flex md:space-x-6 space-x-3 md:p-5 p-2 relative">
                                            <div class="md:w-60 md:h-36 w-28 h-20 overflow-hidden rounded-lg relative shadow-sm flex items-center" @click="showModalPromo('<?= $c['video_promo'] ?>')">
                                                <img src="<?= $c['foto'] ? base_url('uploads/corsi/'.$c['foto']) : base_url('front/assets/images/courses/img-4.jpg') ?>" alt=""  class="rounded-lg w-full h-auto">
                                                <?php if($c['video_promo']) {?>
                                                    <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                                                <?php } ?>
                                            </div>
                                            <div class="flex-1 md:space-y-2 space-y-1">
                                                <a href="<?= $c['buy_type'] != 'is_modulo' ? base_url('corsi/'.$c['url']) : base_url('modulo/'.$c['url']) ?>" class="md:text-xl font-semibold line-clamp-2"> <?= ellipsize($c['sotto_titolo'], 20) ?> </a>
                                                <p class="leading-6 pr-4 line-clamp-2 md:block hidden"> <?= ellipsize($c['obiettivi'], 120) ?> </p>
                                                <a href="#" class="md:font-semibold block text-sm"> <?= $c['doctor_names'] ?> </a>
                                                <div class="flex items-center justify-between">
                                                    <div class="flex space-x-2 items-center text-sm">
                                                        <div> <?= $c['tipologia_corsi'] ?>  </div>
                                                        <div class="md:block hidden">·</div>
                                                        <div class="flex items-center"> 18 Hourse </div>
                                                        <div class="md:block hidden">·</div>
                                                        <div class="flex items-center"> <?= $c['buy_type'] != 'is_modulo' ? $c['modulo_count'].' modulo' : '<a href="'.base_url('corsi/'.$c['modulo_count']).'">' .$c['corsiSottoTitoloForModulo'].' </a>' ?> </div>
                                                    </div>
                                                    <div class="-mt-3.5">
                                                        <div class="text-lg font-semibold"> <?= $c['prezzo'] ?> </div>

                                                        <a href="<?= strlen($c['prezzo']) == 0 ? '#' : '' ?>" class="md:flex items-center justify-center h-9 px-8 rounded-md border hidden" <?= strlen($c['prezzo']) == 0 ? 'disabled' : '' ?>> <?= strlen($c['prezzo']) == 0 ? 'non disponibile' : 'Aggiungi al carrello' ?> </a>
                                                    </div>
                                                </div>
                                                <?php if($c['buy_type'] == 'module') { ?>
                                                    <p class="text-xs text-red-400">Frase avec possibilità di comprare il corso completo o il singolo modulo</p>
                                                <?php } ?>
                                                <!-- <div class="absolute top-1 right-3 md:flex hidden">
                                                    <a href="#" class="hover:bg-gray-200 p-1.5 inline-block rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                                    </svg>
                                                    </a>
                                                    <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" uk-drop="mode: hover;pos: top-right">
                
                                                        <ul class="space-y-1">
                                                        <li>
                                                            <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                                            <i class="uil-share-alt mr-1"></i> Share
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                                            <i class="uil-edit-alt mr-1"></i>  Edit Post
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                                            <i class="uil-comment-slash mr-1"></i>   Disable comments
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                                            <i class="uil-favorite mr-1"></i>  Add favorites
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <hr class="-mx-2 my-2 dark:border-gray-800">
                                                        </li>
                                                        <li>
                                                            <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                                                            <i class="uil-trash-alt mr-1"></i>  Delete
                                                            </a>
                                                        </li>
                                                        </ul>
                
                                                    </div>
                                                </div> -->
                
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </template>
                        <!-- Pagination -->
                        <?= view('default/common/pagination', $pagination) ?>
                    </div>

                </div> 
            </div>  

            <div id="video-promo" uk-modal>
                <div class="uk-modal-dialog shadow-lg rounded-md">
                    <button class="uk-modal-close-default m-2.5" type="button" uk-close></button>
                    <div class="uk-modal-header  rounded-t-md">
                        <h4 class="text-lg font-semibold mb-2"> Trailer video </h4>
                    </div>
                
                    <div class="embed-video">
                        <iframe :src="video_url" class="w-full"
                        uk-video="automute: true" frameborder="0" allowfullscreen uk-responsive></iframe>
                    </div>


                    <div class="uk-modal-body">
                        <!-- <h3 class="text-lg font-semibold mb-2">Build Responsive Websites </h3>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                            dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident,
                            sunt
                            in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                    </div>
                </div>
            </div>
        </div>
<?= view('default/common/footer') ?>
 
<script>
    function getFilters($watch) {
        return {
            video_url: '',
            url:'',
            categories: "<?= $_REQUEST['categories'] ?? '' ?>".split(',').filter((a) => a),
            argomenti: "<?= $_REQUEST['argomenti'] ?? '' ?>".split(',').filter((a) => a),
            allsottoargomenti: <?= json_encode($sottoargomenti) ?>,
            visiblesottoargomenti: [],
            sottoargomenti: "<?= $_REQUEST['sottoargomenti'] ?? '' ?>".split(',').filter((a) => a),
            perPage: <?= $_REQUEST['perPage'] ?? '12' ?>,
            tipo: "<?= $_REQUEST['tipo'] ?? '' ?>".split(',').filter((a) => a),
            init() {
                if (this.argomenti.length > 0) {
                    this.allsottoargomenti.forEach(element => {
                        if (this.argomenti.indexOf(element.nomeargomento) > -1) {
                            this.visiblesottoargomenti.push(element)
                        }
                    });
                }
                $watch('argomenti', value => {
                    this.visiblesottoargomenti = [];
                    // if (value.length > 0) {
                        this.allsottoargomenti.forEach(element => {
                            if (value.indexOf(element.nomeargomento) > -1) {
                                this.visiblesottoargomenti.push(element)
                            } else {
                                this.sottoargomenti.splice(this.sottoargomenti.indexOf(element.url), 1)
                            }
                        });
                    // }
                })
            },
            changeUrl() {
                getData = {
                    categories: this.categories.join(',').replace(/^,+|,+$/g, ''),
                    argomenti: this.argomenti.join(',').replace(/^,+|,+$/g, ''),
                    sottoargomenti: this.sottoargomenti.join(',').replace(/^,+|,+$/g, ''),
                    tipo: this.tipo.join(',').replace(/^,+|,+$/g, ''),
                    perPage: this.perPage,
                }
                let searchParams = new URLSearchParams(getData);
                this.url= `<?= base_url() ?>/corsi?${searchParams.toString()}`
            },
            perPageChange(pp){
                // console.log(pp);
                getData = {
                    categories: this.categories.join(',').replace(/^,+|,+$/g, ''),
                    argomenti: this.argomenti.join(',').replace(/^,+|,+$/g, ''),
                    sottoargomenti: this.sottoargomenti.join(',').replace(/^,+|,+$/g, ''),
                    tipo: this.tipo.join(',').replace(/^,+|,+$/g, ''),
                    perPage: pp,
                }
                let searchParams = new URLSearchParams(getData);
                this.url= `<?= base_url() ?>/corsi?${searchParams.toString()}`
                location.href = this.url
            },
            showModalPromo(urlvid) {
                // console.log(urlvid);
                this.video_url = urlvid
                if (urlvid && urlvid != '') {
                    UIkit.modal('#video-promo').show();
                }
            }
        }
    }

</script>
<?= view('default/common/close') ?>
