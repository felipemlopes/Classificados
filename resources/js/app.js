/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
import money from 'v-money';
Vue.use(money);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('money', require('./components/CadastroAnuncio.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        type: "",
        cache: 0,
        money: {
            decimal: ',',
            thousands: '.',
            prefix: '',
            suffix: '',
            precision: 2,
            masked: false
        },
        dropdownmenu:false,
        message:'',
        conversation:'',
        csrftoken:'',
    },
    methods:{
        toggleDropdown(){
            this.dropdownmenu = !this.dropdownmenu;
        },
        onChangeEstado(event) {
            var selected = $('#estado option:selected').val();
            $.get('/cidades/'+selected, function (filtros) {
                $('select[id=cidade]').empty();
                $('select[id=cidade]').append('<option value=>Selecione a cidade</option>');
                $.each(filtros, function (key,value) {
                    $('select[id=cidade]').append('<option value=' + value.id + '>' + value.cidade + '</option>');
                });
            });
        },
        onChangeCategoria(event) {
            var selected = $('#categoria option:selected').val();
            $.get('/categoria/'+selected, function (filtros) {
                $('select[id=subcategoria]').empty();
                $('select[id=subcategoria]').append('<option value=>Selecione a subcategoria</option>');
                $.each(filtros, function (key,value) {
                    $('select[id=subcategoria]').append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            });
        },
        submitMessage(){
            if(this.message.trim() == '') {
                return false;
            }
            $('<li class="sent"><p>' + this.message + '</p></li>').appendTo($('.messages ul'));
            $('.message-input input').val(null);
            $('.contact.active .preview').html('<span>Você: </span>' + this.message);
            $(".messages").animate({ scrollTop: $(document).height() }, "fast");

            axios.post(`${this.conversation}/send`, {
                _token: this.csrftoken,
                conversation: this.conversation,
                message: this.message,
            })
                .then(response => {
                })
                .catch(error => {
                });
        },
    },
    mounted: function() {
        let cachehidden = $('#cachehidden').val();
        this.cache = cachehidden;
        this.csrftoken = $("input[name=_token]").val();
        this.conversation = $("input[name=conversation]").val();
    },
});
