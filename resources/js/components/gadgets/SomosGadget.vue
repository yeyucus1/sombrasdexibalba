<template>
    <div class="col-md-6">
        <div class="testblock">{{description}}
            <a :href="facebookLink"><i class="fab fa-facebook"></i></a>
        </div>
        <div class="clientblock">
            <img :src="image" :alt="'imagen de '+ name">
            <p><strong>{{name}}</strong> <br>
                {{position}}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "SomosGadget",
    props: {
        name: {
            type: String,
            required: true
        },
        position: {
            type: String,
            required: true
        },
        description: {
            type: String,
            required: true
        },
        facebookLink: {
            type: String,
            required: false
        },
    },
}
</script>

<style scoped>

</style>
