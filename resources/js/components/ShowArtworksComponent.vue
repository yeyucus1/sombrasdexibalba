<template>
<!--    Contenedor Principal-->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mis obras</h3>
                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item">
                                <a class="page-link" :href="createRoute">
                                    Crear Obra<i class="fas fa-file-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <loading-gadget-component v-if="loadingArtworks"/>
                    <table v-else class="table">
                        <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Protagonista</th>
                            <th>Calificación</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, index) in myArtworks" :class="selectedArtwork?(selectedArtwork.id == item.id? 'bg-success':''):''">
                            <td>
                                {{item.title}}
                            </td>
                            <td>
                                {{item.author.pseudonym}}
                            </td>
                            <td>
                                {{item.character.name + ' ' + item.character.lastname}}
                            </td>
                            <td>
                            <span class="badge bg-info">
                                {{getRates(item) > 0?getRates(item):'No calificado'}}
                            </span>
                            </td>
                            <td>
                                <div>
                                    <button class="btn btn-primary" title="Detalles" @click="setArtwork(item)">
                                        <i class="fas fa-book"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->

        </div>

        <!-- Sinopsis Section -->
        <div v-if="selectedArtwork != null" class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Obra: <b>{{selectedArtwork.title}}</b></h1>
                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item" @click="goTo(showRoute.replace('id', selectedArtwork.id))">
                                <button class="btn btn-primary mr-1"title="leer">
                                    <i class="fas fa-book-reader" ></i>
                                </button>
                            </li>
                            <li class="page-item" @click="goTo(editRoute.replace('id',selectedArtwork.id))" v-if="selectedArtwork.canEdit">
                                <button class="btn btn-primary mr-1" title="Editar">
                                    <i class="fas fa-edit" ></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="m-3">
                        <h5 class="mb-1"><b>Sinopsis:</b></h5>
                        <div v-html="selectedArtwork.Synopsis">

                        </div>
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>

    </div>

</template>

<script>

export default {
    name: "ShowArtworksComponent",
    props: {
        createRoute: {
            type: String,
            required: true
        },
        artworksRoute: {
            type: String,
            required: false
        },
        editRoute: {
            type: String,
            required: true
        },
        showRoute: {
            type: String,
            required: true
        },
        myArtworksRoute: {
            type: String,
            required: false
        }
    },
    mounted() {
        this.getArtworks();
    },
    data() {
        return{
            error:null,
            loadingArtworks: true,
            loadingMyArtworks: true,
            artworks: [],
            selectedArtwork: null
        };
    },
    methods: {
        getArtworks() {
            this.loadingArtworks = true;
            let ax = axios({
                method: "get",
                url: this.artworksRoute,
                headres: {
                    'x-csrf-token': this.token
                }
            });
            ax.then(respose => {
                this.loadingArtworks= false;
                if (respose.data.status != 0) {
                    this.error = respose.data.message;
                    swal({
                        title : 'Error ',
                        text : respose.data.message,
                        closeOnEsc: false,
                        closeOnClickOutside: false
                    });
                } else {
                    this.myArtworks = respose.data.data;
                }
            });
            ax.catch(error => {
                console.error(error);
                swal({
                    title : 'Error ',
                    text : 'Error al obtener las obras, Por favor contacte a los programadores',
                    closeOnEsc: false,
                    closeOnClickOutside: false
                });
                this.error = error;
            })
        },
        setArtwork(artwork) {
            this.selectedArtwork = artwork;
        },
        getRates(row) {
            let averange =0;
            if(row.ratings.length) {
                row.ratings.map(rating => {
                    averange += rating.pivot.rating;
                });
                return averange/row.ratings.length;
            }else {
                return 0;
            }
            /*if (row.ratings.length)
                averange = 0;*/
            /*console.log(row.ratings.length);
            row.ratings.map(rating => {
                console.log(rating);
                sum = rating.pivot.rating;
            });*/
            //averange =(sum / this.row.length);
            //console.log(averange);
            return averange;
        },
        goTo(route) {
            window.location = route;
        }
    },
    computed: {

    }
}
</script>

<style scoped>

</style>
