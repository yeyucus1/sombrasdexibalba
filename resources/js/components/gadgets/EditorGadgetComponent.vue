<template>
<vue-editor v-model="content" :id="content" :editorToolbar="customToolbar" ></vue-editor>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
    components: {
        VueEditor
    },
    name: "EditorGadgetComponent",
    data(){
        return{
            content:'',
            customToolbar: [
                [{ size: ["small", false, "large", ] }],
                ["bold", "italic", "underline", "strike"],
                [{ script: "sub" }, { script: "super" }],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],
                [{ color: [] }, { background: [] }],
            ]
        }
    }
}
</script>

<style scoped>

</style>
