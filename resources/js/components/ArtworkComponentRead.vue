<template>
    <div>
        <h2>Autor: {{artwork.author.name + ' ' + artwork.author.lastname}}</h2>
        <h3>Titulo: {{artwork.title}}</h3>
        <div class="col-12 p-2" v-html="artwork.content">
        </div>
    </div>
</template>

<script>

export default {
    name: "ArtworkComponentRead",
    props: {
        artwork: {
            required: true,
            type: Object
        }
    },

    mounted() {

    },
}
</script>

<style scoped>

</style>
