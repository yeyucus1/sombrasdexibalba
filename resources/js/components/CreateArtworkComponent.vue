<template>
    <div>
        <!--Información general de la obra-->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{(this.info?'Editar':'Crear')+' obra'}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div>
                <h5 class="ml-1">
                    Información basica.
                </h5>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Titulo:</label>
                        <input id="title" type="text" class="form-control" placeholder="Titulo" v-model="artwork.title">
                        <span v-if="errors.hasOwnProperty('title')" class="text-danger">{{errors.title[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label for="genere">Genero:</label>
                        <select class="custom-select form-control-border" id="genere" v-model="artwork.genere">
                            <option v-for="element in catalog.artworkGeneres" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('genere')" class="text-danger">{{errors.genere[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label for="artwork-type">Tipo de Obra:</label>
                        <select class="custom-select form-control-border" id="artwork-type" v-model="artwork.type">
                            <option v-for="element in catalog.artworkTypes" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('type')" class="text-danger">{{errors.type[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label for="artwork-protagonist">Protagonista de la obra:</label>
                        <select class="custom-select form-control-border" id="artwork-protagonist" v-model="artwork.protagonist">
                            <option v-for="element in catalog.characters" :value="element.id" :title="element.description">{{element.name + ' ' + element.lastname}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('protagonist')" class="text-danger">{{errors.protagonist[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label for="artwork-location">Escenario de la obra:</label>
                        <select class="custom-select form-control-border" id="artwork-location" v-model="artwork.location_id">
                            <option v-for="element in catalog.locations" :value="element.id" :title="element.description">{{element.name + ' ' + element.lastname}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('protagonist')" class="text-danger">{{errors.protagonist[0]}}</span>
                    </div>
<!--                    Sección de privacidad de la obra-->
                    <hr>
                    <h5 class="ml-1">Privacidad.</h5>

                    <div class="form-group">
                        <label for="access">Tipo de acceso:</label>
                        <select class="custom-select form-control-border" id="access" v-model="artwork.access">
                            <option v-for="element in catalog.accessTypes" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('access')" class="text-danger">{{errors.access[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label for="artwork-preferences">Preferencias de publicación:</label>
                        <select class="custom-select form-control-border" id="artwork-preferences" v-model="artwork.preferences">
                            <option v-for="element in catalog.preferences" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('preferences')" class="text-danger">{{errors.preferences[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label for="artwork-status">Obra Terminada:</label>
                        <select class="custom-select form-control-border" id="artwork-status" v-model="artwork.status">
                            <option v-for="element in catalog.statusOptions" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('status')" class="text-danger">{{errors.status[0]}}</span>
                    </div>
                    <hr>
                    <h5 class="ml-1">Obra.</h5>

                    <div class="form-group">
                        <label for="artwork-status">Contenido de la Obra:</label>
                        <progressbar-gadget-component :length="artwork.content.length"/>
                        <vue-editor v-model="artwork.content"
                                    id="artwork-content"
                                    :editor-toolbar="catalog.customToolbar"
                                    :use-save-button="false"
                        >
                        </vue-editor>
                        <span v-if="errors.hasOwnProperty('content')" class="text-danger">{{errors.content[0]}}</span>
                    </div>

                    <div class="form-group">
                        <label for="artwork-status">Sinopsis:</label>
                        <progressbar-gadget-component :length="artwork.synopsis.length" type="mediumText"/>
                        <vue-editor v-model="artwork.synopsis"
                                    id="artwork-synopsis"
                                    :editor-toolbar="catalog.customToolbar"
                                    :use-save-button="false"
                        >
                        </vue-editor>
                        <span v-if="errors.hasOwnProperty('synopsis')" class="text-danger">{{errors.synopsis[0]}}</span>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" class="button btn-primary" @click="saveArtwork">Guardar</button>
                    <!--
                    Información general de la obra
                                        Mensage para la versión 2
                                        <span class="text-danger">Esto se guardará hasta guardar (al menos como borrador) el contenido de la obra</span>-->
                </div>
            </div>
        </div>


    </div>

</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
    components: {
        VueEditor
    },
    name: "CreateArtworkComponent",
    props: {
        edit: {
            required: false
        },
        genres: {
            type: Array,
            required: true
        },
        types: {
            type: Array,
            required:true
        },
        characters: {
            type: Array,
            required:true
        },
        locations: {
            type: Array,
            required:true
        },
        saveRoute: {
            type:String,
            required:true
        },
        mainRoute: {
            type:String,
            required:true
        },
        token: {
            type:String,
            required:true
        },
        info: {
            type:Object,
            required: false,
        },
        creator: {
            type: Number,
            required: true
        }
    },

    mounted() {
        this.catalog.artworkTypes = this.types;
        this.catalog.artworkGeneres = this.genres;
        this.catalog.characters = this.characters;
        this.catalog.locations =this.locations;
        if (this.info) {
            console.log(this.info);
            this.artwork = {
                title: this.info.title,
                synopsis: this.info.Synopsis,
                content: this.info.content,
                access: this.info.access,
                preferences: this.info.publi_pref,
                status: this.info.status,
                type: this.info.type,
                genere: this.info.genere,
                location_id: this.info.location_id,
                protagonist: this.info.character_id
            }
        }
    },

    data(){
        return{
            artwork: {
                title: '',
                synopsis: '',
                content: '',
                access: '',
                preferences: '',
                status: '',
                type: 0,
                genere: 0,
                location_id: 0,
                protagonist: 0,
                creator: this.creator
            },


            // Catalogos disponibles
            catalog: {
                characters: [],
                locations: [],

                customToolbar: [
                    ["bold", "italic", "underline", "strike"],
                    [{ script: "sub" }, { script: "super" }],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ indent: "-1" }, { indent: "+1" }],
                    [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],
                    [{ color: [] }, { background: [] }],
                ],

                statusOptions: [
                    {id:'in_process', name:'No', description:'En proceso'},
                    {id:'finished', name:'Si', description:'Terminado'},
                ],
                accessTypes: [
                    {id:'public', name:'Publica', description:'Todo mundo puede verlo'},
                    {id:'house', name:'Casa', description:'Solo los miembros de tu casa pueden verlo'},
                ],
                preferences: [
                    {id:'in_process', name:'Publicar  Borradores', description:'Mostrar trabajo en proceso'},
                    {id:'finished', name:'Publicar solo Obra terminada', description:'Mostrar hasta que la obra esté completamente terminada'},
                ],
                artworkTypes: [
                    {id: '1',name:'Cuento Corto', description:'Cuento en un solo capítulo'},
                    {id: '2',name:'Cuento Largo', description:'Cuento en varios capitulos (menos de 3 capitulos)'},
                    {id: '3',name:'Poema en verso', description:'Poema (en verso en un solo capítulo)'},
                    {id: '4',name:'Novela', description:'Novela (Mas de 3 capitulos)'},
                ],
                artworkGeneres: [
                    {id:1, name:'Terror', description:'Obra de miedo, pero con implicaciones reales (personas, animales, etc.)'},
                    {id:2, name:'Horror', description:'Obra de miedo, pero con implicaciones paranormales (fantasmas, magia, criptidos, etc.)'},
                    {id:3, name:'Misterio', description:'Obra de misterio'},
                    {id:4, name:'Amor', description:'Obra de amor, sin implicaciones eroricas'},
                    {id:5, name:'Ciencia Ficción', description:'Obra de ciencia ficción'},
                    {id:6, name:'Historia real', description:'Historia basada en hechos reales'},
                ],
                chapters: [

                ],
            },
            errors: {}
        }
    },

    methods: {
        saveArtwork(){
            this.errors= {};
                swal({
                    title : 'Guardando',
                    text : 'Por favor espere...',
                    buttons : false,
                    closeOnEsc: false,
                    closeOnClickOutside: false
                });
                let ax = axios({
                    method: this.info?"put":"post",
                    url: this.saveRoute,
                    headres: {
                        'x-csrf-token': this.token
                    },
                    data: this.artwork,
                })
                ax.then(response => {
                    if(response.data.status !== 0) {
                        this.errors = response.data.data;
                        swal({
                            title : 'Error ',
                            text : response.data.message,
                            cancel: 'Cancelar',
                            closeOnEsc: false,
                            closeOnClickOutside: false
                        });
                    } else {
                        let buttons = !this.info?{
                            another: {
                                text: 'Agregar otra obra',
                                value: 'another'
                            },
                            exit: {
                                text: 'Salir',
                                value: 'exit'
                            }
                        }:{
                            exit: {
                                text: 'Aceptar',
                                value: 'exit'
                            }
                        }
                        swal({
                            title : 'Correcto',
                            text : response.data.message,
                            icon: 'success',
                            buttons: buttons,
                            closeOnEsc: false,
                            closeOnClickOutside: false
                        }).then(res => {
                            if (res === 'another') {
                                this.clearFields();
                            } else {
                                window.location = this.mainRoute;
                            }
                        });
                    }
                });
                ax.catch(error=>{
                    console.error(error);
                    swal({
                        title : 'Error ',
                        text : 'Ocurrio un error, intentelo mas tarde, si el error persiste, por favor contacte al administrador',
                        closeOnEsc: false,
                        closeOnClickOutside: false
                    });
                });
        },
        clearFields(){
            this.artwork = {
                title: '',
                synopsis: '',
                content: '',
                access: '',
                preferences: '',
                status: '',
                type: 0,
                creator: 0,
                genere: 0,
                location_id: 0,
                character_id: 0
            }
        }
    }
}
</script>

<style scoped>

</style>
