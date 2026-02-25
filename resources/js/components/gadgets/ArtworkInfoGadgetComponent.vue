<template>
    <!-- Contenedor principal -->
    <div>

        <!-- Botones -->
        <div>
            <h3>Información de la Obra</h3>

            <button class="btn"
                    :class="selectedButton === 'author' ? 'btn-outline-primary' : 'btn-outline-secondary'"
                    @click="changeSelectedButton('author')">
                <i class="fas fa-pen-fancy mr-1"></i>|Autor
            </button>

            <button class="btn"
                    :class="selectedButton === 'protagonist' ? 'btn-outline-primary' : 'btn-outline-secondary'"
                    @click="changeSelectedButton('protagonist')">
                <i class="fas fa-user-secret mr-1"></i>|Protagonista
            </button>

            <button class="btn"
                    :class="selectedButton === 'ratings' ? 'btn-outline-primary' : 'btn-outline-secondary'"
                    @click="changeSelectedButton('ratings')">
                <i class="fas fa-skull mr-1"></i>|Calificaciones
            </button>

            <button class="btn"
                    :class="selectedButton === 'reviews' ? 'btn-outline-primary' : 'btn-outline-secondary'"
                    @click="changeSelectedButton('reviews')">
                <i class="fas fa-sticky-note mr-1"></i>|Reseñas
            </button>
        </div>

        <!-- Loading -->
        <div v-if="loadingInfo" class="info-wrapper text-center mt-2">
            <loading-gadget-component />
        </div>

        <!-- Contenido -->
        <div v-else class="mt-2">

            <!-- Autor -->
            <div v-if="selectedButton === 'author'" class="info-wrapper">
                <b>Nombre:</b> {{ info.author.pseudonym }}<br>
                <b>Casa:</b> {{ info.author.house }}
            </div>

            <!-- Protagonista -->
            <div v-if="selectedButton === 'protagonist'" class="info-wrapper">
                <b>Nombre:</b> {{ info.protagonist.fullName }}<br>
                <b>Edad:</b> {{ info.protagonist.age }}<br>
                <b>Descripción:</b> {{ info.protagonist.description }}
            </div>

            <!-- 🔥 CALIFICACIONES -->
            <div v-if="selectedButton === 'ratings'" class="info-wrapper">

                <!-- 💀 PROMEDIO CON CALAVERAS (AQUÍ VA) -->
                <div class="mb-3">
                    <div class="text-2xl tracking-widest">
                        {{ skullRating }}
                    </div>
                    <div class="text-sm text-gray-600">
                        💀 {{ info.ratings.avgRaiting.toFixed(1) }} / 5
                        · {{ votesCount }} votos
                    </div>
                </div>

                <!-- Calificación personal -->
                <ratings-gadget-component
                    v-if="currentUser && !isPublic"
                    :set-rating="true"
                    :current-user="currentUser"
                    :token="token"
                    :artwork="artwork"
                    :current-user-rate="info.ratings.myRating"
                    @setRating="setRating"
                />

                <p v-else class="text-muted">
                    Inicia sesión para calificar esta obra
                </p>
            </div>

            <!-- Reseñas -->
            <div v-if="selectedButton === 'reviews'" class="info-wrapper">
                <info-reviews-gadget-component
                    v-if="currentUser"
                    :current-user="currentUser"
                    :token="token"
                    :artwork="artwork"
                    :infoRoute="infoRoute"
                />
                <p v-else class="text-muted">
                    Inicia sesión para dejar una reseña
                </p>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "ArtworkInfoGadgetComponent",

    props:{
        artwork: { type: Object, required: true },
        currentUser: { type: Object, default: null },
        token: { type: String, default: null },
        infoRoute: { type: String, required: true },
        isPublic: { type: Boolean, default: false }
    },

    data() {
        return {
            selectedButton: 'author',
            loadingInfo: false,
            info: {
                author: { pseudonym: '', house: '' },
                protagonist: { fullName: '', age: 0, description: '' },
                ratings: {
                    avgRaiting: 0,
                    allRatings: [],
                    myRating: {}
                }
            }
        }
    },

    computed: {
        // 💀 Genera calaveras según el promedio
        skullRating() {
            const rating = Math.round(this.info.ratings.avgRaiting);
            let skulls = '';
            for (let i = 1; i <= 5; i++) {
                skulls += i <= rating ? '💀' : '☆';
            }
            return skulls;
        },

        // 📊 Número de votos
        votesCount() {
            return this.info.ratings.allRatings
                ? this.info.ratings.allRatings.length
                : 0;
        }
    },

    mounted() {
        this.getAuthor();
    },

    methods: {

        changeSelectedButton(value) {
            this.selectedButton = value;
            if (value === 'author') this.getAuthor();
            if (value === 'protagonist') this.getProtagonist();
            if (value === 'ratings') this.getRatings();
        },

        getAuthor() {
            if (!this.artwork?.artwork_id) return;
            this.loadingInfo = true;

            axios.get(`${this.infoRoute}/author`, {
                params: { artwork_id: this.artwork.artwork_id }
            })
            .then(res => {
                this.info.author = {
                    pseudonym: res.data.user,
                    house: res.data.house
                };
            })
            .finally(() => this.loadingInfo = false);
        },

        getProtagonist() {
            if (!this.artwork?.artwork_id) return;
            this.loadingInfo = true;

            axios.get(`${this.infoRoute}/protagonist`, {
                params: { artwork_id: this.artwork.artwork_id }
            })
            .then(res => {
                this.info.protagonist = res.data;
            })
            .finally(() => this.loadingInfo = false);
        },

        getRatings() {
            if (!this.artwork?.artwork_id) return;
            this.loadingInfo = true;

            const base = `${this.infoRoute}/rating`;

            Promise.all([
                axios.get(`${base}/avgRatings`, { params: { artwork_id: this.artwork.artwork_id }}),
                axios.get(`${base}/allRatings`, { params: { artwork_id: this.artwork.artwork_id }}),
                this.currentUser
                    ? axios.get(`${base}/getRating`, {
                        params: {
                            artwork_id: this.artwork.artwork_id,
                            user_id: this.currentUser.user_id
                        }
                    })
                    : Promise.resolve({ data: {} })
            ])
            .then(([avg, all, mine]) => {
                this.info.ratings.avgRaiting = avg.data || 0;
                this.info.ratings.allRatings = all.data || [];
                this.info.ratings.myRating = mine.data || {};

                // Emitir promedio para vista pública
                this.$emit('rating-updated', this.info.ratings.avgRaiting);
            })
            .finally(() => this.loadingInfo = false);
        },

        setRating(data) {
            if (!this.currentUser) return;

            axios.post(`${this.infoRoute}/rating/setRating`, data, {
                headers: { 'x-csrf-token': this.token }
            }).then(() => {
                this.getRatings();
            });
        }
    }
}
</script>

<style scoped>
.info-wrapper {
    background-color: #e3e1e1;
    border-radius: 15px;
    padding: 10px;
    min-height: 180px;
}
</style>
