<template>
<!--    Contenedor principal-->
    <div>
<!--        Botones-->
        <div>
            <h3>Información de la Obra</h3>
            <button class="btn" :class=" this.selectedButton === 'author'?'btn-outline-primary': 'btn-outline-secondary' " @click="changeSelectedButton('author')" type="button">
                <i class="fas fa-pen-fancy mr-1"></i>|Autor
            </button>
            <button class="btn" :class=" this.selectedButton === 'protagonist'?'btn-outline-primary': 'btn-outline-secondary' " @click="changeSelectedButton('protagonist')" type="button">
                <i class="fas fa-user-secret mr-1"></i>|Protagonista
            </button>
            <button class="btn" :class=" this.selectedButton === 'ratings'?'btn-outline-primary': 'btn-outline-secondary' " @click="changeSelectedButton('ratings')" type="button">
                <i class="fas fa-skull mr-1"></i>|Calificaciones
            </button>
            <button class="btn" :class=" this.selectedButton === 'reviews'?'btn-outline-primary': 'btn-outline-secondary' " @click="changeSelectedButton('comments')" type="button">
                <i class="fas fa-sticky-note mr-1"></i>|Reseñas
            </button>
        </div>
<!--        Loading Component-->
        <div v-if="loadingInfo"  class="col-xs-12 rounded mt-2 info-wrapper text-center">
            <loading-gadget-component />
        </div>

<!--        Secciones separadas-->
        <div v-else class="col-xs-12 rounded mt-2 ">
<!--            Autor-->
            <div v-if="this.selectedButton === 'author'" class="col-xs-12 info-wrapper">

                Autor:
                <b>Nombre: </b>{{info.author.pseudonym}}<br>
                <b>Casa: </b> {{info.author.house}}

            </div>
<!--            Protagonista-->
            <div v-if="this.selectedButton === 'protagonist'" class="col-xs-12 info-wrapper" >
                Protagonista: <br>
                <b>Nombre Completo: </b>{{info.protagonist.fullName}}<br>
                <b>Edad: </b>{{info.protagonist.age}}<br>
                <b>Descripción del personaje: </b>{{info.protagonist.description}}<br>
                <b>Familia: </b>{{info.protagonist.family}}<br>
                <b>Descripción de la familia: </b>{{info.protagonist.familyDescription}}<br>
                <b>Ciudad de Origen: </b>{{info.protagonist.nativeCity}}<br>
                <b>Ciudad donde vive: </b>{{info.protagonist.livingCity}}<br>
                <b>Autor original: </b>{{info.protagonist.author}}<br>
            </div>
<!--            Calificaciones-->
            <div v-if="this.selectedButton === 'ratings'" class="row info-wrapper " >
<!--                General Rating-->
                <div class="col-md-6">
<!--                    Calificacion general-->
                    <ratings-gadget-component :general-rating="true"
                                              :current-user="currentUser"
                                              :general-rating-rate="info.ratings.avgRaiting"
                                              :token="token"
                                              :artwork="artwork"
                    />
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <p class="m-0">Calificaciones de otros usuarios</p>
                        <div class="col-md-12 rounded ratings-style" >

                            <ratings-gadget-component :set-rating="false"
                                                      v-for="(rating, index) in this.info.ratings.allRatings"
                                                      :key="'rating_' + index"
                                                      :rating-info="rating"
                                                      :current-user="currentUser"
                                                      class="col-12"
                                                      :token="token"
                                                      :artwork="artwork"
                            />
                        </div>
                        <p class="m-0"><b>Calificación Personal</b></p>
                    <ratings-gadget-component :set-rating="true"
                                              :current-user="currentUser"
                                              class="col-12"
                                              :token="token"
                                              :artwork="artwork"
                                              @setRating="setRating"
                                              :current-user-rate="this.info.ratings.myRating"
                    />
                    </div>
                </div>

                <!--            Comentarios-->


            </div>

            <div v-if="this.selectedButton === 'comments'" class="row info-wrapper " >
                <info-comments-gadget-component/>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "ArtworkInfoGadgetComponent",
    props:{

        artwork: {
            required: true,
            type: Object
        },

        currentUser: {
            type: Object,
            required: true,
        },

        token: {
            type:String,
            required: true,
        },

        infoRoute: {
            type:String,
            required: true
        }

    },

    mounted() {
        this.getAuthor(this.currentUser, this.artwork);
    },

    data(){
        return {
            selectedButton: 'author',
            rateRoute: '',

            info: {
                author: {

                    pseudonym: '',
                    house: '',

                },

                protagonist: {

                    full_name: '',
                    lastName: '',
                    age: 0,
                    description: '',
                    family: '',
                    familyDescription: '',
                    nativeCity: '',
                    livingCity: '',
                    creator: ''

                },

                ratings: {
                    avgRaiting:0,
                    allRatings:[],
                    myRating: {},

                }

            },

            loadingInfo: false,

        }
    },

    methods: {

        changeSelectedButton: function (value){
            this.selectedButton = value;
            console.log(value);
            switch (value) {
                case 'author':
                    this.getAuthor();
                    break;
                case 'protagonist':
                    this.getProtagonist();
                    break;
                case 'ratings':
                    this.getRatings();
                    break;
                case 'reviews':
                    this.getComments();
                    break;
            }
        },

        getProtagonist: function () {
            this.loadingInfo = true;
            let requestInfo = {
                user_id: this.currentUser.user_id,
                artwork_id: this.artwork.artwork_id,
            };

            let infoProtagonistRoute = this.infoRoute + '/protagonist';

            let ax = axios.get(infoProtagonistRoute, {
                params:requestInfo,
            });
            ax.then(result =>{
                console.log('Segun funciona', result.data);
                this.info.protagonist = result.data;
                this.loadingInfo = false;
            });

            ax.catch(ex => {
                this.loadingInfo = false;
                console.log(ex)
            })
        },

        getAuthor: function() {
            //console.log(this.currentUser);
            let requestInfo = {
                params:{
                user_id: this.currentUser.user_id,
                artwork_id: this.artwork.artwork_id,
            }};

            //console.log(requestInfo);

            let infoAuthorRoute = this.infoRoute + '/author';

            let ax = axios.get(infoAuthorRoute, requestInfo);
            ax.then(result =>{
                this.info.author = {
                    pseudonym: result.data.user,
                    house: result.data.house

                };
            });
        },

        getRatings: function() {
            //console.log(this.currentUser);
            this.loadingInfo = true;
            let requestInfo = {
                params:{
                user_id: this.currentUser.user_id,
                artwork_id: this.artwork.artwork_id,
            }};

            let infoAVGRatingsRoute = this.infoRoute + '/rating/avgRatings';
            let infoAllRatingsRoute = this.infoRoute + '/rating/allRatings';
            let infoMyRatingRoute = this.infoRoute + '/rating/getRating';

            let axAVG= axios.get(infoAVGRatingsRoute, requestInfo);
            axAVG.then(result =>{
                console.log(result);
                this.info.ratings.avgRaiting = result.data;

            });

            axAVG.catch(e=>{
                console.error(e);
                this.loadingInfo = false;
            })

            let axAll = axios.get(infoAllRatingsRoute, requestInfo);
            axAll.then(result =>{
                console.log(result);
                this.info.ratings.allRatings = result.data;
                this.loadingInfo = false
            });

            axAll.catch(e=>{
                console.error(e);
                this.loadingInfo = false;
            })

            let axMine = axios.get(infoMyRatingRoute, requestInfo);
            axMine.then(result =>{
                console.log(result);
                this.info.ratings.myRating = result.data;
                this.loadingInfo = false
            });

            axMine.catch(e=>{
                console.error(e);
                this.loadingInfo = false;
            })

        },

        setRating: function (requestData) {
            this.makeSetRatingRequest(requestData);
        },

        makeSetRatingRequest(requestData){
            let setRatingRoute = this.infoRoute + '/rating/setRating';
            swal({
                title : 'Guardando',
                text : 'Por favor espere...',
                buttons : false,
                closeOnEsc: false,
                closeOnClickOutside: false
            });
            let ax = axios({
                method: 'POST',
                url: setRatingRoute,
                headres: {
                    'x-csrf-token': this.token
                },
                data: requestData,
            })
            ax.then(response => {
                if(response.data.status !== 0) {
                    swal({
                        title : 'Error ',
                        text : response.data.message,
                        cancel: 'Cancelar',
                        closeOnEsc: false,
                        closeOnClickOutside: false
                    });
                } else {
                    swal({
                        title : 'Correcto',
                        text : 'Se ha guardado correctamente la calificación',
                        icon: 'success',
                        closeOnEsc: false,
                        closeOnClickOutside: false
                    }).then(()=>{
                        this.getRatings();
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

        getComments: function () {

        }

    }

}
</script>

<style scoped>

    .ratings-style {
        height: 100px;
        max-height: 100px;
        background-color: #b4b6b6;
        overflow-x: scroll
    }

    .info-wrapper{
        height: 250px;
        max-height: 250px;
        overflow-x: hidden;

        border-radius: 15px;

        background-color: #e3e1e1;

        padding: 1%;

    }
</style>
