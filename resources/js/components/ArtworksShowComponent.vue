<template>
    <div>
        <div class="col-xs-12 col-md-6 artworks">
            <div class="item" v-for="itemArtwork in artworks">
                <div class="col-xs-12">
                    <div class="col-xs-8">
                        {{itemArtwork.name}}
                    </div>
                    <div class="col-xs-4">
                        <button class="btn-primary">
                            Prevew
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <div class="d-xs-none preview">

        </div>

    </div>
</template>

<script>
export default {
    name: "ArtworksShowComponent",
    props: {

    },
    data () {
        return {
            artworks: [
                {
                    name: "cuento 1",
                },
                {
                    name: "cuento 2",
                },
                {
                    name: "cuento 3",
                },
            ]
        };
    }
}
</script>

<style scoped>

</style>
