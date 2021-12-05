<template>

    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input v-model="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input v-model="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
            <input v-model="mostrar" type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</template>

<script>
export default {
    name: "ReadersComponent",
    props: {
        id:{
            type: Number,
            required: true
        },
    },
    data(){
      return {
          email: "",
          password: "",
          mostrar: true
      }
    },
    beforeCreate() {
        console.log("se está creando");
    },
    created() {
        console.log("ya se creó");
    },
    beforeMount() {
        console.log("se está montando");
    },
    mounted() {
        console.log("ya se montó");
        this.mostrarId();
    },
    methods: {
        mostrarId() {
            console.log("el prop id contiene" + this.id + "de tipo numerico");
        }
    },
    computed: {

    }
}
</script>

<style scoped>

</style>
