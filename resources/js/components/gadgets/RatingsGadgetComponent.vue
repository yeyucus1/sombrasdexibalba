<template>

    <div>
        <div v-if="generalRating" class="ratings-wrapper text-center col-12">
            <i class="rate-icon" :class="IconClass"></i><span class="rate-icon"><b>{{generalRatingRate?generalRatingRate:0}}</b></span> <br>
            <h4><b>Calificación</b> </h4>
        </div>
        <div v-else>
            <div v-if="setRating" class="rounded border border-danger">
                <div v-show="loadingRating" class="text-center">
                    <loading-gadget-component/>
                </div>
                <div v-show="!loadingRating">
                    <h5 ><b>Usuario: {{currentUserRate.user}}</b></h5>

                    <form id="ratingsForm" class="col-12">
                        <p class="clasificacion">
                            <input @click="changeRating(5)" id="radio1" type="radio" v-model="currentUserRate.rate" name="estrellas" :value="5">
                            <label class="labelSet" for="radio1" title="excelente">
                                <i  :class="IconClass"></i>
                            </label>
                            
                            <input @click="changeRating(4)" id="radio2" type="radio" v-model="currentUserRate.rate" name="estrellas" :value="4">
                            <label class="labelSet" for="radio2" title="excepcional">
                                <i  :class="IconClass"></i>
                            </label>
                            <input @click="changeRating(3)" id="radio3" type="radio" v-model="currentUserRate.rate" name="estrellas" :value="3">
                            <label class="labelSet" for="radio3" title="regular">
                                <i  :class="IconClass"></i>
                            </label>
                            <input @click="changeRating(2)" id="radio4" type="radio" v-model="currentUserRate.rate" name="estrellas" :value="2">
                            <label class="labelSet" for="radio4" title="deficiente">
                                <i  :class="IconClass"></i>
                            </label>
                            <input @click="changeRating(1)" id="radio5" type="radio" v-model="currentUserRate.rate" name="estrellas" :value="1">
                            <label class="labelSet" for="radio5" title="mala">
                                <i  :class="IconClass"></i>
                            </label>
                        </p>
                    </form>
                </div>

            </div>

            <!--          mostrar  Show rating-->
            <div v-else class="rounded bg-blue">
                <h4>Usuario: <b>{{ratingInfo.user}}</b></h4>
                <form id="ratingsForm" class="col-12">
                    <p class="clasificacion">
                        <input id="rad1" type="radio" v-model="ratingInfo.rating" disabled name="estrellas" :value="5">
                        <label class="labelGet" for="rad1" title="excelente">
                            <i  :class="IconClass"></i>
                        </label>
                        <input id="rad2" type="radio" v-model="ratingInfo.rating" disabled name="estrellas" :value="4">
                        <label class="labelGet" for="rad2" title="excepcional">
                            <i  :class="IconClass"></i>
                        </label>
                        <input id="rad3" type="radio" v-model="ratingInfo.rating" disabled name="estrellas" :value="3">
                        <label class="labelGet" for="rad3" title="regular">
                            <i  :class="IconClass"></i>
                        </label>
                        <input id="rad4" type="radio" v-model="ratingInfo.rating" disabled name="estrellas" :value="2">
                        <label class="labelGet" for="rad4" title="deficiente">
                            <i  :class="IconClass"></i>
                        </label>
                        <input id="rad5" type="radio" v-model="ratingInfo.rating" disabled name="estrellas" :value="1">
                        <label class="labelGet" for="rad5" title="mala">
                            <i  :class="IconClass"></i>
                        </label>
                    </p>
                </form>
            </div>
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
            type: Object,
            required: false,
        },

        currentUser: {
            type: Object,
            required: true,
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

    methods: {

        changeRating(value){
            let info = {
                user: this.currentUserRate.user_id,
                artwork: this.artwork.artwork_id,
                currentUser: this.currentUser.user_id,
                rating: value,
            };
            this.$emit('setRating',info);
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
