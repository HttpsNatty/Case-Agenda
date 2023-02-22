<template>
    <div class="container">
        <div v-show="mostra_contato">
        <!-- <form> -->
            <Message :msg="msg" v-show="msg" />
            <h1>Edite o contato</h1>
            <!-- Foto -->
            <br>
            <label for="foto"><b>foto</b></label>
            <input type="file" name="image" @change="onFileSelected" id="image">
            <img src="/img/eun.jpg" alt="Avatar" class="avatar">
            <br>

            <!-- Nome -->
            <br>
            <label for="nome"><b>Nome</b></label>
            <input type="text" name="nome" v-model="fd.nome" required>
            <br>
  
            <!-- Numero -->
            <label for="num"><b>Número</b></label>
            <input type="number" name="num" v-model="fd.num" required>

            <!-- E-mail -->
            <br>
            <label for="email"><b>E-mail</b></label>
            <input type="email" name="email" value="{{ contato.email }}">
            <br>

            <router-link to="/">Voltar</router-link>
            <br>
            <router-link to="/" type="submit" class="btn" v-on:click="editarContato(contato.id)">Salvar Contato</router-link>
        <!-- </form> -->
    </div>
    </div>
</template>

<script>
import api from '@/services/api.js';
import Message from '@/components/Message.vue';


export default {
    name: 'EditarView',

    data(){
        return{
            fd: {
                id: null,
                nome: '',
                num: '',
                email: '',
                image: null    
            },
            selectedFile: null,
            contatos: Array,
            mostra_contato: true,
            contato: Array,
            contato_id: null,
            msg: null
        }
    },

    components:{
        Message
    },

    methods:{
        onFileSelected(event){
            this.selectedFile = event.target.files[0]
            console.log(event);
        },
        editarContato(id){
            api.put(`api/update/${id}`, this.fd).then(() => {
                console.log('Edição do contato!');
                this.msg = `Contato editado!`;
                setTimeout(() => this.msg = "", 3000);
            })
            .catch((error) => {
                console.log(error);
            })
        }
    },

    mounted() {
        // this.getContato(id);
    }
}
</script>