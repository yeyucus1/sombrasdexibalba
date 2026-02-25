<template>
    <div>
        <artwork-info-gadget-component :current-user="currentUser"
                                       :token="token"
                                       :info-route="infoRoute"
                                       :artwork="artwork"
                                       :current-user-rate="currentUserRate"
        />
        <div class="col-12 rounded ancient-content-section-style mt-3 general-content-section">
            <h3 class="ancient-title-style text-center ancient-title-font">{{artwork.title}}</h3>

            <div class="col-12 p-2 ancient-text-style" v-html="artwork.content">
            </div>
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
        },

        currentUser: {
            type: Object,
            required: true,
        },

        currentUserRate: {
            type: Number,
            required: false,
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
    },
}
</script>

<style scoped>

.ancient-synopsis-style {
    font-size: 20px;
    font-style: italic;
    color: rgb(130, 104, 80);
    border-bottom: 1px solid rgba(120,96,73,0.3);
    padding-bottom: 15px;
}

    .ancient-title-style {
        //font-family: cursive;
        font-size: 50px;
        color: rgb(120 96 73);
    }

    .general-content-section {
        overflow-x: scroll;
        padding: 25px;
    }

    .ancient-content-section-style {
        background-color: rgb(212,181,149);
        height: 350px;
    }

    .ancient-text-style {
        color: rgb(117, 93, 71);
    }
    
</style>
