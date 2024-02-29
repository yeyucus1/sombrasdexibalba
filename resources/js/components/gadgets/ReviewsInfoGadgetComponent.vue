<template>
    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    Comentarios totales: <b class="text-info">{{reviewsQuantity}}</b>
                </div>
                <div class="row col-md-12 reviews-section-wrapper slimScrollBar">
                    <div class="col-md-12">
                        <div v-for="review in reviews" class="comment-wrapper rounded mt-2 slimScrollBar ">
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
        <div class="col-md-6">
            <textarea class="col-md-12"></textarea>
            <button class="btn btn-primary">
                Publicar
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReviewsInfoGadgetComponent",
    props:{

    },
    mounted() {
    },
    data() {
        return {
            reviews:[
                {
                    user: 'User1',
                    content: 'Este es el contenido de la primera reseña',
                    date: '12-02-2024',
                    read: false,
                },

                {
                    user: 'User1',
                    content: 'Este es el contenido de la primera reseña',
                    date: '12-02-2024',
                    read: false,
                },

                {
                    user: 'User1',
                    content: 'Este es el contenido de la primera reseña',
                    date: '12-02-2024',
                    read: false,
                }

            ],
            myReview: {},
        }
    },

    methods: {

    },

    computed: {

        reviewsQuantity: function () {
            return this.reviews.length;
        }

    }

}
</script>

<style scoped>
.comment-wrapper {
    background-color: rgb(212,181,149);
    height: 150px;
}

.comment-content-wrapper {
    height: 78px;
    padding: 5px
}

.actions {
    height:24px;
    padding: 4px;
}

.reviews-section-wrapper {
    max-height: 200px;
    min-height: 200px;
}
</style>
