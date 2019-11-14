<template>
    <div v-if="noticia">
        <img  :src="'imagen/' + noticia.imagen" class="img-fluid" alt="Responsive image">
        <h1>{{ noticia.titulo }}</h1>
        <span class="badge badge-pill badge-secondary">{{noticia.created_at}}</span>
        <h3>{{ noticia.subtitulo }}</h3>
        <p>{{ noticia.cuerpo }}</p>
    </div>
</template>
<script>
export default {
    data(){
        return {
            noticia : null
            }
    },
    methods : {
        getNoticia(){
            console.log(this.id);
            axios.get('/detalle/'+this.id).then((res) => {
                console.log(res);
                this.noticia = res.data.noticia;
                console.log(this.noticia.titulo);

            }).catch((error) => {
                console.log(error);

            })

        }
    },
    mounted () {
        this.getNoticia();
    },
    props : ['id']
}
</script>
