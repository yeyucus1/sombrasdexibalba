<template>
<vue-editor v-model:id="content" :editorToolbar="customToolbar"></vue-editor>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
    components: {
        VueEditor
    },
    name: "CreateArtworkGadgetComponent",
    data(){
        return{
            content:'',
            customToolbar: [
                ["bold", "italic", "underline", "font"],
                [{ list: "ordered" }, { list: "bullet" }],
            ]
        }
    }
}
</script>

<style scoped>

</style>
