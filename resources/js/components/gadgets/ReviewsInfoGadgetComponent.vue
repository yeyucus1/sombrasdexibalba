<template>
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    Comentarios totales: <b class="text-info">{{reviewsQuantity}}</b>
                </div>
                <div class="row col-md-12 reviews-section-wrapper slimScrollBar">
                    <div class="col-md-12">
                        <div v-for="review in reviews" class="comment-wrapper rounded mt-2">
                            <h5 class=" col-12 rounded bg-white ancient-title-font"><b>{{review.user}}</b></h5>
                            <p class="comment-content-wrapper">
                                {{review.content}}
                            </p>
                            <div class="actions bg-white text-right p-0">
                                <!--                    Para la siguiente version-->
                                <!--                    <a href="">-->
                                <!--                        <i class="fas fa-trash-alt text-info"></i>-->
                                <!--                    </a>-->
                                <span class="col-span-8 col-4">
                                    <b class="text-muted">
                                        {{review.date}}
                                    </b>
                                    <span v-if="!review.read" class="badge badge-danger">
                                        Nueva
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 my-comment-wrapper rounded">
            <h2>Mi reseña</h2>
                <div>
                    <div class="comment-wrapper rounded mt-2">
                        <h5 class=" col-12 rounded bg-white ancient-title-font"><b>Mi Reseña</b></h5>
                        <p v-if="editingReview" class="comment-content-wrapper">
                            <textarea class="rounded col-md-12 ta-heigth"
                                      v-model="newReview"
                                      maxlength="255"
                                      style="resize: none">
                            </textarea>
                        </p>
                        <p v-else-if="myReview" class="comment-content-wrapper">
                            {{myReview}}
                        </p>
                        <p v-else class="comment-content-wrapper">
                            No haz hecho una reseña aun
                        </p>


                        <div class="actions bg-white text-right p-0">
                            <!--                    Para la siguiente version-->
                            <!--                    <a href="">-->
                            <!--                        <i class="fas fa-trash-alt text-info"></i>-->
                            <!--                    </a>-->
                            <span v-if="editingReview" class="col-span-8 col-4">
                                <button @click="saveReview" class="btn btn-primary pt-0 pb-0">
                                    <i class="far fa-save"></i> | Guardar
                                </button>
                                <button @click="cancelEditReview" class="btn btn-secondary pt-0 pb-0">
                                    <i class="far fa-times-circle"></i> | Cancelar
                                </button>
                            </span>
                            <span v-else class="col-span-8 col-4">
                                <button @click="makeReview"
                                        class="btn btn-primary pt-0 pb-0">
                                    <i :class="myReview?'fas fa-edit':'fas fa-plus-square'"></i> |{{myReview?'Editar':'Reseñar'}}
                                </button>
                                <button @click="deleteReview"
                                        v-if="myReview"
                                        class="btn btn-danger pt-0 pb-0">
                                    <i class="fas fa-trash"></i> |Eliminar
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReviewsInfoGadgetComponent",
    props:{
        infoRoute: {
            type:String,
            required: true,
        },

        currentUser: {
            type: Object,
            required: true
        },

        token: {
            type: String,
            required: true
        },

        artwork: {
            type: Object,
            required: true
        },


    },
    mounted() {
        this.getReviews();
        this.getMyReview();
    },
    data() {
        return {
            reviews:[

            ],
            editingReview: false,
            myReview: null,
            reviewsQuantity:0,
            newReview: '',
        }
    },

    methods: {

        getReviews: function() {
            let getReviewRoute = this.infoRoute + '/reviews/getAllReviews';
            let getReviewsRequestData = {
                user_id:this.currentUser.user_id,
                artwork_id: this.artwork.artwork_id,
            };
            let ax = axios({
                method: 'GET',
                url: getReviewRoute,
                headers: {
                    'x-csrf-token': this.token
                },
                params: getReviewsRequestData
            });
            ax.then(response=>{
                this.reviewsQuantity = response.data.reviewsCount;
                this.reviews = response.data.reviews;
            })
        },

        getMyReview: function() {
            let getReviewRoute = this.infoRoute + '/reviews/getMyReview';
            let getReviewsRequestData = {
                user_id:this.currentUser.user_id,
                artwork_id: this.artwork.artwork_id,
            };
            let ax = axios({
                method: 'GET',
                url: getReviewRoute,
                headers: {
                    'x-csrf-token': this.token
                },
                params: getReviewsRequestData
            });
            ax.then(response=>{
                let content = '';
                if(response.data.pivot) {
                    content = response.data.pivot.content;
                }
                this.myReview = content;
                
            })
        },

        saveReview: function() {
            this.myReview = this.newReview;
            this.editingReview = false;
            let setReviewRoute = this.infoRoute + '/reviews/setReview';
            swal({
                title : 'Guardando',
                text : 'Por favor espere...',
                buttons : false,
                closeOnEsc: false,
                closeOnClickOutside: false
            });
            let requestData = {
                user: this.currentUser.user_id,
                currentUser: this.currentUser.user_id,
                artwork: this.artwork.artwork_id,
                review: this.newReview
            };
            let ax = axios({
                method: 'POST',
                url: setReviewRoute,
                headres: {
                    'x-csrf-token': this.token
                },
                data: requestData,
            });
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
                        text : 'Se ha guardado correctamente la reseña',
                        icon: 'success',
                        closeOnEsc: false,
                        closeOnClickOutside: false
                    }).then(()=>{
                        this.getMyReview();
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

        deleteReview: function() {
            this.myReview = this.newReview;
            this.editingReview = false;
            let setReviewRoute = this.infoRoute + '/reviews/deleteReview';
            swal({
                title : 'Eliminando',
                text : 'Por favor espere...',
                buttons : false,
                closeOnEsc: false,
                closeOnClickOutside: false
            });
            let requestData = {
                user: this.currentUser.user_id,
                currentUser: this.currentUser.user_id,
                artwork: this.artwork.artwork_id,
            };
            let ax = axios({
                method: 'DELETE',
                url: setReviewRoute,
                headres: {
                    'x-csrf-token': this.token
                },
                data: requestData,
            });
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
                        text : 'La reseña se ha eliminado correctamente',
                        icon: 'success',
                        closeOnEsc: false,
                        closeOnClickOutside: false
                    }).then(()=>{
                        this.getMyReview();
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

        cancelEditReview: function() {
            this.newReview = this.myReview;
            this.editingReview = false;
        },

        makeReview: function() {
            this.newReview = this.myReview;
            this.editingReview = true;
        }

    },

    computed: {

        // reviewsQuantity: function () {
        //     return this.reviews.length;
        // }

    }

}
</script>

<style scoped>
.comment-wrapper {
    background-color: rgb(212,181,149);
    height: 150px;
}

.ta-heigth {
    height: 88px;
}

.comment-content-wrapper {
    height: 78px;
    padding: 5px
}

.actions {
    height:26px;
    padding: 4px;
}

.reviews-section-wrapper {
    max-height: 200px;
    min-height: 200px;
    height: 200px;
    overflow-y: scroll;
}
</style>
