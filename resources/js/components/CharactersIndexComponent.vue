<template>
    <div   >

                    <loading-gadget-component v-if="loadingArtworks"/>
                    <div v-else>
                        <div class="row">
                        <h3 class="col-md-8">Lista de personajes</h3>
                        <div class="col-md-4 text-right">
                            <a :href="characterCreateRoute" class="btn-primary btn" >Nuevo</a>
                        </div>
                    </div>
                    <table   class="table  ">

                        <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                           
                            <th>Edad</th>
                            <th>Descripcion </th>
                            <th>Familia</th>
                            
                               
                        </tr>
                        </thead>
                        <tbody>
                        <tr  v-for="character in characters" :key="characters.id">
                            <td class="col-xs-8">
                                {{character.name + " " + character.lastname}}
                            </td>
                            <td>
                                {{character.age }}
                            </td>
                            <td>
                                {{character.description }}
                            </td>
                            <td>
                                {{character.family + " " + character.family_description }}
                            </td>
                           
                            <td>
                            
                            </td>
                            <td>
                                <div>
                                    
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                </div>
</template>

<script>

export default {

        data(){
            return{
                characters: []
            }
        },
        created(){
            axios.get(this.characterRoute)
            .then(response => {
                console.log(response)
                this.characters = response.data.data})
            .catch(e=>console.log(e));
        },

    name: "CharacterComponentRead",
    props: {
        characterRoute :{
            type: String,
            requered: true
        },
        characterCreateRoute:{
            type: String,
            requered: true
        },

        
        
       
    },

    mounted() {
    },


}
</script>

<style scoped>
</style>
