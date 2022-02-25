<template>
    <div>
        <!--Información general de la obra-->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Información general de la obra</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Titulo:</label>
                        <input id="title" type="text" class="form-control" placeholder="Titulo" v-model="artwork.title">
                        <span v-if="errors.hasOwnProperty('title')" class="text-danger">Error</span>
                    </div>
                    <div class="form-group">
                        <label for="genere">Genero:</label>
                        <select class="custom-select form-control-border" id="genere" v-model="artwork.genere">
                            <option v-for="element in catalog.artworkGeneres" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="artwork-type">Tipo de Obra:</label>
                        <select class="custom-select form-control-border" id="artwork-type" v-model="artwork.type">
                            <option v-for="element in catalog.artworkTypes" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    Información general de la obra
                    <!--                    Mensage para la versión 2
                                        <span class="text-danger">Esto se guardará hasta guardar (al menos como borrador) el contenido de la obra</span>-->
                </div>
            </div>
        </div>

        <!-- Privacidad -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Control de acceso de la obra</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="access">Tipo de acceso:</label>
                        <select class="custom-select form-control-border" id="access" v-model="artwork.access">
                            <option v-for="element in catalog.accessTypes" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="artwork-preferences">Preferencias de publicación:</label>
                        <select class="custom-select form-control-border" id="artwork-preferences" v-model="artwork.access.preferences">
                            <option v-for="element in catalog.preferences" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    Control de acceso.
                </div>
            </div>
        </div>


        <!--        Capitulos en la versión 2-->

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Contenido</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div>
                <vue-editor style="" v-model:id="content" :editorToolbar="customToolbar" ></vue-editor>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button class="button btn-primary">Guardar</button>
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
    name: "CreateArtworkGadgetComponent",
    props: {
        user: {
            type: Object,
            required: true,
        },
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
        info: {
            type:Object,
            required: false,
        }
    },
    mounted() {
        this.artwork.creator= this.user;
        this.catalog.artworkTypes = this.types;
        this.catalog.artworkGeneres = this.genres;
        console.log(this.catalog.accessTypes, this.types);
    },
    data(){
        return{
            content:'',
            customToolbar: [
                ["bold", "italic", "underline", "strike"],
                [{ script: "sub" }, { script: "super" }],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],
                [{ color: [] }, { background: [] }],
            ],
            artwork: {
                general: {
                    title: '',
                    creator: null,
                    genere: 0,
                },
                access: {
                    type: '',
                    preferences: ''
                }
            },
            chapter: {
                title: 'Unico capitulo',
                number: 1,
                content: ''
            },


            // Catalogos disponibles
            catalog: {
                accessTypes: [
                    {id:1, name:'Publico', description:'Todo mundo puede verlo'},
                    {id:2, name:'Casa', description:'Solo los miembros de tu casa pueden verlo'},
                ],
                preferences: [
                    {id:1, name:'Publicar  Borradores', description:'Mostrar trabajo en proceso'},
                    {id:2, name:'Publicar solo Capitulos Terminados', description:'No mostrar trabajos en proceso'},
                    {id:3, name:'Publicar solo Obra terminada', description:'Mostrar hasta que la obra esté completamente terminada'},
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
            },
            errors: {}
        }
    },

    methods: {
        saveArtwork(){

        }
    }
}
</script>

<style scoped>

</style>
