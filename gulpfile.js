var elixir = require('laravel-elixir');
process.env.DISABLE_NOTIFIER = true;
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

     mix.styles([
        'plugins/combo-select/combo.select.css',
        'plugins/lightbox2/css/lightbox.css'   
    ],  'public/dist/css/immobile.css');

    mix.scripts([
        'plugins/lightbox2/dist/js/lightbox.min.js', 
        'plugins/input-mask/jquery.inputmask.js',
        'plugins/input-mask/jquery.inputmask.date.extensions.js',
        'plugins/input-mask/jquery.inputmask.extensions.js', 
        'immobile.js'
    ], 'public/dist/js/immobile.min.js');

    //IMAGEM DA VISTORIA POR AMBIENCE
    mix.scripts([
     	'image_ambience.js'
    ], 'public/dist/js/image_ambience.min.js');

    //REGISTRO DE CHAVES E RESERVA
    //    //REGISTRO DE CHAVES E RESERVA
    mix.styles([
        'plugins/combo-select/combo.select.css', 
        'plugins/daterangepicker/daterangepicker.css',
        'plugins/dataTables/jquery.dataTables.min.css',
        'plugins/dataTables/dataTables.bootstrap.css',
        'key.css'        
    ], 'public/dist/css/key.min.css');
    mix.scripts([
        'plugins/datatables/jquery.dataTables.min.js',
        'plugins/datatables/dataTables.bootstrap.min.js',
        'plugins/jquery-serializejson/jquery.serializejson.min.js',
        'plugins/input-mask/jquery.inputmask.js',
        'plugins/input-mask/jquery.inputmask.date.extensions.js',
        'plugins/input-mask/jquery.inputmask.extensions.js', 
        'plugins/combo-select/jquery.combo.select.js',
        'moment.min.js',
        'plugins/daterangepicker/daterangepicker.js',
        'plugins/jquery-maskmoney/src/jquery.maskMoney.js',
        'mascaraFone.js',
        //'immobile.js',
        'key.js'
    ], 'public/dist/js/key.min.js');

/* - DELIVERY - */

    mix.scripts([
        'delivery.js',
        'plugins/jquery-serializejson/jquery.serializejson.min.js'
    ], 'public/dist/js/delivery.min.js');

    mix.scripts([
        'plugins/jquery-serializejson/jquery.serializejson.min.js',
        'function_all.js'
    ], 'public/dist/js/function_all.min.js');

/* - CLIENTES - */
    mix.styles([
        'clients.css'        
    ], 'public/dist/css/clients.min.css');
     mix.scripts([
        'plugins/input-mask/jquery.inputmask.js',
        'plugins/input-mask/jquery.inputmask.date.extensions.js',
        'plugins/input-mask/jquery.inputmask.extensions.js', 
        'plugins/jquery-maskmoney/src/jquery.maskMoney.js',
        'plugins/jquery-serializejson/jquery.serializejson.min.js',
        'function_all.js',
        'clients.js'       
    ], 'public/dist/js/clients.min.js');

    //PÁGINA DE AVALIAÇÃO DE VISITA
    mix.styles([
        'plugins/dataTables/jquery.dataTables.min.css',
        'plugins/dataTables/dataTables.bootstrap.css'
        ], 'public/dist/css/evaluation.min.css');
    mix.scripts([
        'plugins/datatables/jquery.dataTables.min.js',
        'plugins/datatables/dataTables.bootstrap.min.js',
        'evaluation.js'
        ], 'public/dist/js/evaluation.min.js');
    /*
    PÁGINA DE VISTORIA
     */
    mix.styles([
        'plugins/dataTables/dataTables.bootstrap.css',
        'plugins/awesome-bootstrap-checkbox/Font-Awesome/css/font-awesome.css',
        'plugins/awesome-bootstrap-checkbox/Font-Awesome/css/build.css'       
        ],'public/dist/css/survey.min.css');

    mix.scripts([  
        'plugins/datatables/jquery.dataTables.min.js',
        'plugins/datatables/dataTables.bootstrap.min.js',      
        'crud_new_survey.js',
        'crud_survey.js',
        'edit_survey.js',
        'survey.js'
        ],'public/dist/js/survey.min.js');
    
    mix.scripts(['new_add_user.js'], 'public/dist/js/new_add_user.js');

    /* Para upload de arquivos */
   
    mix.sass([
        'dropzone/basic.scss',
        'dropzone/dropzone.scss'
        ], 'public/dist/css/upload_ambience.css');

     mix.scripts([
        'moment.min.js',
        'plugins/daterangepicker/daterangepicker.js',
        'plugins/dropzone/src/dropzone.js',
        'upload_ambience.js'
        ], 'public/dist/js/upload_ambience.min.js')
});
