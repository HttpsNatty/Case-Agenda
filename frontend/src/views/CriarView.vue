<template>
  <div class="container">
    <header>
      <img src="/img/logo.png" alt="" class="responsive">
    </header>
    <!-- <form> -->
    <h1>Crie um novo contato</h1>
    <Message :msg="msg" v-show="msg" />
    <!-- Foto -->
    <br>
    <label for="foto"><b>foto</b></label>
    <input type="file" name="image" id="image" v-on:change="fd.image">
    <br>

    <!-- Nome -->
    <br>
    <label for="nome"><b>Nome</b></label>
    <input type="text" placeholder="Nome" name="nome" id="nome" v-model="fd.nome" required>
    <br>
  
    <!-- Numero -->
    <label for="num"><b>Número</b></label>
    <input type="number" placeholder="1199832-5555" name="num" id="num" v-model="fd.num" pattern="(?=.*\d)(?=.*[1-9]).{11,}" required>

    <!-- E-mail -->
    <br>
    <label for="email"><b>E-mail</b></label>
    <input type="email" placeholder="E-mail" name="email" id="email" v-model="fd.email" required>
    <br>

    <router-link to="/">Voltar</router-link>
    <button type="submit" class="btn" v-on:click="criarContato()">Criar Contato</button>
  <!-- </form> -->
</div>
</template>

<script>
import api from '@/services/api.js';
import Message from '@/components/Message.vue';


export default {
  name: 'CriarView',

  data(){
    return{
      fd: {
        id: null,
        nome: '',
        num: '',
        email: '',
        image: null    
      },
      contato: {},
      selectedFile: null,
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

  criarContato(){
    // const formdata = new FormData();
    // formdata.append('image', this.selectedFile, this.selectedFile.name);
    console.log(this.fd);
     api
      .post("api/novocontato", this.fd).then(()=>{
        console.log('Novo contato adicionado!');
        this.msg = `Contato adicionado!`;
        setTimeout(() => this.msg = "", 3000);
      })
      .catch((error)=>{
        console.log(error.response.data)
      })
    }    
  }
}
</script>
<style>
.responsive {
  width: 100%;
  height: auto;
}
</style>