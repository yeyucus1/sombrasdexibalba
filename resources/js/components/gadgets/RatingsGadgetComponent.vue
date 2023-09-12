<template>

    <div>
        <div v-if="generalRating" class="ratings-wrapper text-center col-12">
            <i class="rate-icon" :class="IconClass"></i><span class="rate-icon"><b>{{generalRatingRate}}</b></span> <br>
            <h4><b>Calificación</b> </h4>
        </div>
        <div v-else>
            <div v-if="setRating" class="rounded border border-danger">
                <div v-show="loadingRating" class="text-center">
                    <loading-gadget-component/>
                </div>
                <div v-show="!loadingRating">
                    <h5 ><b>Usuario: {{currentUser.name}}</b></h5>

                    <form id="ratingsForm" class="col-12">
                        <p class="clasificacion">
                            <input @click="changeRating" id="radio1" type="radio" v-model="rating" name="estrellas" :value="5">
                            <label class="labelSet" for="radio1" title="excelente">
                                <i  :class="IconClass"></i>
                            </label>
                            <input @click="changeRating" id="radio2" type="radio" v-model="rating" name="estrellas" :value="4">
                            <label class="labelSet" for="radio2" title="excepcional">
                                <i  :class="IconClass"></i>
                            </label>
                            <input @click="changeRating" id="radio3" type="radio" v-model="rating" name="estrellas" :value="3">
                            <label class="labelSet" for="radio3" title="regular">
                                <i  :class="IconClass"></i>
                            </label>
                            <input @click="changeRating" id="radio4" type="radio" v-model="rating" name="estrellas" :value="2">
                            <label class="labelSet" for="radio4" title="deficiente">
                                <i  :class="IconClass"></i>
                            </label>
                            <input @click="changeRating" id="radio5" type="radio" v-model="rating" name="estrellas" :value="1">
                            <label class="labelSet" for="radio5" title="mala">
                                <i  :class="IconClass"></i>
                            </label>
                        </p>
                    </form>
                </div>

                </div>
            </div>
<!--            Show rating-->
            <div v-else>
                <h4>Usuario: <b>{{ratingInfo.user}}</b></h4>
                <form id="ratingsForm" class="col-12">
                    <p class="clasificacion">
                        <input id="rad1" type="radio" v-model="ratingInfo.rate" disabled name="estrellas" :value="5">
                        <label class="labelGet" for="rad1" title="excelente">
                            <i  :class="IconClass"></i>
                        </label>
                        <input id="rad2" type="radio" v-model="ratingInfo.rate" disabled name="estrellas" :value="4">
                        <label class="labelGet" for="rad2" title="excepcional">
                            <i  :class="IconClass"></i>
                        </label>
                        <input id="rad3" type="radio" v-model="ratingInfo.rate" disabled name="estrellas" :value="3">
                        <label class="labelGet" for="rad3" title="regular">
                            <i  :class="IconClass"></i>
                        </label>
                        <input id="rad4" type="radio" v-model="ratingInfo.rate" disabled name="estrellas" :value="2">
                        <label class="labelGet" for="rad4" title="deficiente">
                            <i  :class="IconClass"></i>
                        </label>
                        <input id="rad5" type="radio" v-model="ratingInfo.rate" disabled name="estrellas" :value="1">
                        <label class="labelGet" for="rad5" title="mala">
                            <i  :class="IconClass"></i>
                        </label>
                    </p>
                </form>
            </div>

        </div>

</template>

<script>
export default {
    name: "RatingsGadgetComponent",
    props: {
        generalRating: {
            type: Boolean,
            required: false,
            default: false
        },

        generalRatingRate: {
            type: Number,
            required: false,
            default: 0
        },

        ratingInfo: {
            type: Object,
            required: false,
        },

        setRating: {
            type: Boolean,
            required: false,
            default: true
        },

        currentUserRate: {
            type: Number,
            required: false,
        },

        currentUser: {
            type: Object,
            required: true,
        },

        ratingRoute: {
            type: String,
            required: true
        },

        artwork: {
            required: true,
            type: Object
        },

        token: {
            type:String,
            required: true,
        }

    },
    data() {
        return {

            IconClass: 'fas fa-skull',
            /*ratingInfo: {
                user: 'Ethan M. Morgue',
                rating: 3
            },*/
            rating: 0,
            loadingRating: false,
        }
    },
    mounted() {
        // console.log('Ruta para calificar:',this.ratingRoute);
        if(this.setRating && this.currentUserRate) {
            this.rating = this.currentUserRate;
        }
    },
    methods: {

        makeSetRatingRequest(){
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
                data: this.info?Object.assign({user:this.creator}, this.artwork)
                    :this.artwork,
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

        changeRating(){
            this.loadingRating = true;
            setTimeout(this.makeSetRatingRequest, 500);
        }
    }
}
</script>

<style scoped>

#form {
    width: 250px;
    margin: 0 auto;
    height: 50px;
}

#form p {
    text-align: center;
}

#form label {
    font-size: 20px;
}

input[type="radio"] {
    display: none;
}

label {
    color: grey;
    margin-left: 2px;
}

.clasificacion {
    direction: rtl;
    unicode-bidi: bidi-override;
}

.labelSet:hover,
.labelSet:hover ~ .labelSet {
    color: orange;
}

input[type="radio"]:checked ~ .labelSet {

    color: red;

}

.labelGet {

    cursor: not-allowed;

}

input[type="radio"]:checked ~ .labelGet {

    color: red;

}

.rate-icon {
    font-size: 60px;
}
.ratings-wrapper {
    background: -webkit-linear-gradient(orange,red 80%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

</style>

<!--
mala
deficiente
regular
excepcional
excelente
-->
