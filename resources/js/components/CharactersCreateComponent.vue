<template>
<div class="p-3 mb-2 bg-light text-dark">
    
        <!--Información general de los personajes-->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{(this.info?'Editar':'Crear')+' Personaje'}}</h3>
            </div>
        </div>

            <!-- /.card-header -->
            <!-- form start -->
            <div>
                <h5 class="ml-1">
                    Crear Personaje.
                </h5>
            </div>
            <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input id="name" type="text" class="form-control" placeholder="Nombre" v-model="character.name">
                        <span v-if="errors.hasOwnProperty('name')" class="text-danger">{{errors.name[0]}}</span>
                    </div>
            </div>

            <div class="form-group">
                        <label for="lastname">Genero:</label>
                        <select class="custom-select form-control-border" id="lastname" v-model="character.lastname">
                            <option v-for="element in catalog.charactersGeneres" :value="element.id" :title="element.description">{{element.name}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('genere')" class="text-danger">{{errors.genere[0]}}</span>
                    </div>

                    <div class="card-body">
                    <div class="form-group">
                        <label for="age">Edad:</label>
                        <input id="age" type="number" class="form-control" placeholder="Edad" v-model="character.age">
                        <span v-if="errors.hasOwnProperty('age')" class="text-danger">{{errors.age[0]}}</span>
                    </div>
            </div>     
            
            <div class="card-body">
                <div class="form-group">
                        <label for="description">Descripcion:</label>
                        <input id="description" type="text" class="form-control" placeholder="description" v-model="character.description">
                        <span v-if="errors.hasOwnProperty('description')" class="text-danger">{{errors.description[0]}}</span>
                    </div>
            </div>

            <div class="form-group">
                        <label for="family">Familia:</label>
                        <select class="custom-select form-control-border" id="family" v-model="character.family">
                            <option v-for="element in catalog.charactersFamily" :value="element.id" :title="element.family">{{element.name}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('genere')" class="text-danger">{{errors.family[0]}}</span>
                    </div>

                    
                    <div class="form-group">
                        <label for="family_description">Descripcion de laFamilia:</label>
                        <select class="custom-select form-control-border" id="family_description" v-model="character.family_description">
                            <option v-for="element in catalog.charactersFamily" :value="element.id" :title="element.family">{{element.name}}</option>
                        </select>
                        <span v-if="errors.hasOwnProperty('genere')" class="text-danger">{{errors.family_description[0]}}</span>
                    </div>

                    <div class="card-body">
                    <div class="form-group">
                        <label for="native_city">Ciudad Natal:</label>
                        <input id="native_city" type="text" class="form-control" placeholder="Nombre" v-model="character.native_city">
                        <span v-if="errors.hasOwnProperty('native_city')" class="text-danger">{{errors.native_city[0]}}</span>
                    </div>
                    </div>     

                    <div class="card-body">
                    <div class="form-group">
                        <label for="living_city">Ciudad Natal:</label>
                        <input id="living_city" type="text" class="form-control" placeholder="Nombre" v-model="character.living_city">
                        <span v-if="errors.hasOwnProperty('living_city')" class="text-danger">{{errors.living_city[0]}}</span>
                    </div>

                    <div class="card-footer">
                    <button type="button" class="button btn-primary" @click="saveCharacter">Guardar</button>
                    <button type="button" class="button btn-secondary" @click="regresar">Cancelar</button>
                    <!--
                    Información general de la obra
                                        Mensage para la versión 2
                                        <span class="text-danger">Esto se guardará hasta guardar (al menos como borrador) el contenido de la obra</span>-->
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
    name: "CharactersCreateComponent",
    props: {
        characterStoreRoute :{
            type: String,
            requered: true
        },
    },
    

    mounted() {
    },

    data(){
        return{
            character: {
                name: '',
                lastname: '',
                age: '',
                description: '',
                family: '',
                family_description: '',
                native_city: '',
                living_city: '',
                location_id: 0,
                creator: this.creator
            },


            // Catalogos disponibles
            catalog: {
                characters: [],
                locations: [],

                charactersFamily: [
                {id:1, name:'Familia Generica', description:'Familia Generica'},
                {id:2, name:'Sin Familia', description:'Sin Familia'},
                ],

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
                charactersGeneres: [
                    {id:1, name:'Masculino',description:'Genero masculino'},
                    {id:2, name:'Femenino',description:'Genero femenino'},
                    {id:3, name: 'Otro' ,description:'Genero desconocido'}
                    
                ],
                chapters: [

                ],
            },
            errors: {}
        }
    },

    methods: {
        regresar() {
            history.back();
        },
        saveCharacter(){
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
                    data: this.info?Object.assign({user:this.creator}, this.character)
                    :this.character,
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
                                text: 'Agregar otro personaje',
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
    }
}
</script>

<style scoped>

</style>