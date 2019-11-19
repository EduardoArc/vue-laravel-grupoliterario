<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mb-2" v-for=" noticia in noticias">
          <div class="card-header">
            <div class="text-right">
              <span class="badge badge-pill badge-secondary">{{noticia.created_at}}</span>
            </div>
            <h3 class="card-title">{{ noticia.titulo }}</h3>
          </div>
          <div class="card-body">
            <img
              :src="'noticias/imagen/' + noticia.imagen"
              class="img-fluid mb-3"
              alt="Responsive image"
            />
            <h4 class="card-subtitle">{{ noticia.subtitulo }}</h4>

          </div>
          <div class="card-footer text-muted text-center">
            <a :href="'/noticias/' + noticia.id">
              <button class="btn btn-primary">Leer</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      noticias: []
    };
  },
  mounted() {
    this.obtenerNoticias();
    console.log("Component mounted.");
  },
  methods: {
    obtenerNoticias() {
      axios
        .get("/noticias")
        .then(res => {
          console.log(res.data);
          this.noticias = res.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
