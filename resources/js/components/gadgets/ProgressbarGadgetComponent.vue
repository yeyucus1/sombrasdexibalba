<template>
    <div>
        <span :class="'text-' + statusClass" >{{status}}</span>
        <div class="progress progress-xs col-12">
            <div :class="'progress-bar progress-bar-' + statusClass" :style="'width: '+progress + '%'"></div>
        </div>
    </div>

</template>

<script>
export default {
    name: "ProgressbarGadgetComponent",
    props: {
        length: {
            type:Number,
            required: true
        },
        type: {
            type: String,
            required: false,
            default: 'longText'
        }
    },
    computed: {
        progress(){
            return (this.length*100)/this.maxLength;
        },
        maxLength() {
            return (this.type== 'mediumText'?16777215:4294967295);
        },
        status() {
            if (this.length == 0)
                return 'Inaceptable (No puede estar vacio)';
            if (this.length > 0 && this.length <= (this.maxLength*.10))
                return 'Aceptable (corto)';
            if (this.length > (this.maxLength*.10) && this.length <= (this.maxLength * .9))
                return 'Aceptable';
            if (this.length > (this.maxLength*.9) && this.length <= this.maxLength)
                return 'Aceptable (en el limite)';
            if (this.length > this.maxLength)
                return 'Inaceptable (demaciado largo)';
        },
        statusClass() {
            if (this.length === 0 || this.length > this.maxLength)
                return 'danger';
            if ((this.length > 0 && this.length <= (this.maxLength*.10))||(this.length > (this.maxLength*.9) && this.length <= this.maxLength))
                return 'warning';
            if (this.length > (this.maxLength*.10) && this.length <= (this.maxLength * .9))
                return 'success';
        }
    }
}
</script>

<style scoped>

</style>
