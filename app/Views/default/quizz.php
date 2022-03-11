<?= view($view_folder.'/common/header') ?>

<div class="flex justify-center items center mt-8" x-data="getQuestions">
    <div class="shadow bg-white rounded-md w-1/3 p-8">
        <progress id="js-progressbar" class="uk-progress" :value="visibleQuestion+1" :max="questions.length"></progress>
        <p>question <span x-text="visibleQuestion+1"></span> out of <span x-text="questions.length"></span></p>        
        <!-- <h3 class="border-b flex font-semibold items-center justify-between px-7 py-5 text-base"> Quizz for modulo2 </h3> -->

        <h3 class="flex font-semibold items-center justify-between py-5 text-base" x-text="questions[visibleQuestion].question"></h3>

        <div class="flex flex-col">
            <template x-if="questions[visibleQuestion].type == 'unica'">
                <template x-for="res in questions[visibleQuestion].reponses">
                    <div class="radio">
                        <input :id="'radio-'+res.id" :name="'radio-'+questions[visibleQuestion].id" type="radio" x-model="responses[questions[visibleQuestion].id]" :value="res.id">
                        <label :for="'radio-'+res.id"><span class="radio-label"></span> <span  x-text="res.response"></span> </label>
                    </div>
                </template>
            </template>
            
            <template x-if="questions[visibleQuestion].type == 'multipla'">
                <template x-for="res in questions[visibleQuestion].reponses">
                    <div class="checkbox">
                        <input type="checkbox" :id="'checkbox'+res.id" name="'checkbox'+questions[visibleQuestion]" x-model="responses[res.id+'multiple']" :value="res.id">
                        <label :for="'checkbox'+res.id"><span class="checkbox-icon"></span> <span x-text="res.response"></span></label>
                    </div>
                </template>
            </template>

            <div class="flex justify-around mt-8">
                <button type="button" x-show="visibleQuestion > 0" @click="prevQuestion" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white p-4">
                    <span class="md:block"> <?php echo lang('app.btn_prev')?> </span>
                </button>

                <button type="button" x-show="visibleQuestion + 1 < questions.length" @click="nextQuestion" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white p-4">
                    <span class="md:block"> <?php echo lang('app.btn_next')?> </span>
                </button>
                
                <button x-show="visibleQuestion + 1 == questions.length" @click="submit" type="button" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white p-4">
                    <span class="md:block"> <?php echo lang('front.btn_send')?> </span>
                </button>
            </div>
                <!-- <div class="checkbox">
                    <input type="checkbox" id="chekcbox1" checked="">
                    <label for="chekcbox1"><span class="checkbox-icon"></span> Checkbox</label>
                </div> -->
        </div>

    </div>
</div>

        <!-- <div id="modal-example" uk-modal>
            <div class="uk-modal-body uk-modal-dialog rounded-md shadow-2xl">
                <h2 class="mb-2 uk-modal-title">Headline</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div> -->
<?= view($view_folder.'/common/footer') ?>
<script>
    function getQuestions() {
        return {
            questions: <?= json_encode($questions) ?>,
            visibleQuestion: 0,
            responses: [],
            nextQuestion() {
                this.visibleQuestion ++
            },
            prevQuestion() {
                this.visibleQuestion --
            },
            submit(){
                // let responses = Object.keys(this.responses).filter((el) => {return el});
                let responses = []
                Object.keys(this.responses).forEach(el => {
                    if (el.includes('multiple') && this.responses[el]) {
                        responses.push(el.replace('multiple', ''))
                    } else if(!el.includes('multiple')) {
                        responses.push(this.responses[el])
                    }
                })
                fetch('<?= base_url('/user/submitQuizz') ?>', {
                        method: 'post',
                        headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" },
                        body: JSON.stringify({'responses':responses, 'id_quizz': <?= $id_quizz ?>, 'questions': this.questions.map(el => {return el.id})})
                    })
                    .then( el => el.json() )
                    .then(res =>    {   
                                        console.log(res);
                                    })
            }
        }
    }
    
</script>
<?= view($view_folder.'/common/close') ?>

