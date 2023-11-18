<template>
    <div class="row">
        <div class="col-md-6">
            Reseñas.
            <div v-for="review in reviews" class="comment-wrapper rounded mt-2">
                <h5 class=" col-12 rounded bg-white"><b>{{review.user}}</b></h5>
                <p class="comment-content-wrapper">
                    {{review.content}}
                </p>
                <div class="actions bg-white text-right">
<!--                    Para la siguiente version-->
<!--                    <a href="">-->
<!--                        <i class="fas fa-trash-alt text-info"></i>-->
<!--                    </a>-->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            Mi Reseña
            <div class="my-comment-wrapper rounded">
                <form @submit="">
                    <div v-if="!editingReview">
                        <h3>{{ myReview ? myReview : 'Aun no haces una reseña' }}</h3>
                    </div>
                    <div v-else>
                        <textarea v-model="myReview" name="" maxlength="255" id="" cols="40" style="resize: none" rows="5">
                        </textarea>
                    </div>
                    <div v-if="editingReview">

                        <button  class="btn button btn-primary">
                            <i class="far fa-check"></i> | Guardar
                        </button>
                        <button  class="btn button btn-secondary">
                            <i class="far fa-times-circle"></i> | Cancelar
                        </button>

                    </div>
                    <div v-else>
                        <button @click="editingReview=true" class="btn button btn-primary">
                            <i :class="myReview?'fas fa-edit':'fas fa-plus-square'"></i> |{{myReview?'Editar':'Reseñar'}}
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "InfoReviewsGadgetComponent",
    props: {
        infoRoute: {
            type: String,
            required: true
        }
    },

    mounted() {
    },

    data() {
        return {
            myReview: '',
            editingReview: false,
            reviews: [
                {

                    user: 'Ethan M. Morgue',
                    content: 'Content Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias aperiam assumenda atque aut, autem beatae culpa, deleniti eaque earum harum impedit magni molestiae necessitatibus possimus, quasi qui quia sunt!',
                }
            ],
        }
    }
}
</script>

<style scoped>

    .comment-wrapper {
        background-color: rgb(212,181,149);
        height: 150px;
        overflow: scroll;
    }

    .comment-content-wrapper {
        height: 78px;
        overflow: scroll;
        padding: 5px
    }

    .actions {
        height:24px;
        padding: 4px;
    }

</style>
