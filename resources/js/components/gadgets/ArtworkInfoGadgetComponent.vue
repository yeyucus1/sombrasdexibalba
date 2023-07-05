<template>
<!--    Contenedor principal-->
    <div>
<!--        Botones-->
        <div>
            <h3>Información de la Obra</h3>
            <button class="btn btn-outline" type="button">
                <i class="fas fa-pen-fancy"></i>|Autor
            </button>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-12">

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ArtworkInfoGadgetComponent",
    props:{

    },

    data(){
        return {
            author:{
                pseudonym: '',
                house: '',

            }

        }
    }

}
</script>

<style scoped>

</style>
