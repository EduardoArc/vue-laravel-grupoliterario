<template>
<div>
    <div class="alert alert-success" role="alert" v-if="success">
    Noticia Publicada con exito
    </div>
    <div class="alert alert-danger" role="alert" v-if="error">
    ERROR al Publicar la Noticia!
    </div>
    <form @submit.prevent="agregar" id="formulario">
        <input type="file" @change="agregarImagen($event)" placeholder="Imagen" class="form-control mb-2">
        <input type="text" v-model="noticia.titulo"  placeholder="Titulo" class="form-control mb-2">
        <input type="text" v-model="noticia.subtitulo"  placeholder="Subtitulo" class="form-control mb-2">
        <textarea name="" v-model="noticia.cuerpo"  placeholder="Cuerpo" id="" cols="30" rows="10" class="form-control mb-2"></textarea>
        <button type="submit" class="btn btn-success">Publicar</button>
    </form>
</div>
</template>

<script>
import { log } from 'util';
export default {
    data(){
        return {
            noticias : [],
            noticia : { imagen : {}, titulo:'', subtitulo:'', cuerpo:''},
            imagen : {},
            success : false,
            error : false
        }
    },
    methods : {
        agregar(){

            let contenido = new FormData(); //tipo de dato para enviar formularios
            contenido.set('titulo' , this.noticia.titulo);
            contenido.set('subtitulo' , this.noticia.subtitulo);
            contenido.set('cuerpo' , this.noticia.cuerpo);
            contenido.set('imagen', this.imagen);



            axios.post('/noticias', contenido).then((res) => {
                this.success = true;
                this.error = false;

                document.getElementById('formulario').reset();

                //console.log(this.noticia);

                this.noticia.titulo = '';
                this.noticia.subtitulo = '';
                this.noticia.cuerpo = '';


            }).catch((error) => {
                this.error = true;
                this.success = false;
                console.log(error);

            })
        },
        agregarImagen(event){
            this.imagen = event.target.files[0];

            //console.log(this.imagen);
        }

    }
}
</script>>
