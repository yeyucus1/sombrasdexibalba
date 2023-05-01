<template>
    <div>
        <vue-editor v-model="content"
                    id="artwork-content"
                    :use-save-button="false"
        >
        </vue-editor>
    </div>

</template>

<script>
import {VueEditor} from "vue2-editor";

export default {
    components: {
        VueEditor
    },
    name: "TestComponent.vue"


}
</script>

<style scoped>

</style>
