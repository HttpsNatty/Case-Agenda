<template>
  <div class="container">
    <header>
      <img src="/img/logo.png" alt="" class="responsive">
    </header>
    <div>
      <Message :msg="msg" v-show="msg" />
      <!-- <h2>Busque por um contato</h2> -->
      <!-- <form>
        <input type="text" id="pesquisa" name="pesquisa" class="form-control" placeholder="Procurar..." v-model="pesquisa">
      </form> -->
      
    <div id="contato-list">
      <router-link to="/criar">Novo Contato</router-link>
      <!-- <h3>{{ $numcontatos}} contatos salvos!</h3> -->
      <h2>Veja todos os contatos</h2>
      <div v-for="contato in contatos" :key="contato.id">
        <div>
          <img src="/img/eun.jpg" alt="Avatar" class="avatar">
        <h3>{{ contato.image }}</h3>
        <h3>{{ contato.nome }}</h3>
        <h3>+{{ contato.numero }}</h3>
        <h3>{{ contato.email }}</h3>
        <router-link to="/editar" type="button" v-on:click="edicao(contato.id)">Editar</router-link>
        <br>
        <router-link to="/" type="button" v-on:click="destroy(contato.id)">Excluir</router-link>
        </div>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import api from '@/services/api.js';
import Message from '@/components/Message.vue';

export default {
  name: 'HomeView',
  
  data(){
    return {
      contatos: Array,
      contato: {},
      contato_id: null,
      pesquisa: null,
      msg: null
    }
  },

  components:{
    Message
  },

  methods: {
    pesquisaContato(){
      api.get('api/contatos/busca', this.pesquisa).then(response =>{
        this.pesquisa = response.data;
        console.log(response.data)})
    },
    getContato() {
      api.get('api/contatos').then(response =>{
        this.contatos = response.data;
        console.log(response.data);
      }).catch((error)=>{
        console.log(error);
      })
    },
    edicao(id){
      api.get(`api/contato/editar/${id}`).then(response =>{
        this.contato = response.data;
        console.log(response.data);
      }).catch((error)=>{
        console.log(error);
      })
    },
    destroy(id) {
      api.delete(`api/contato/delete/${id}`).then(() => {
          console.log("Excluiu contato");
          this.msg = `Contato excluido!`;
          setTimeout(() => this.msg = "", 3000);
      });
    }
  },
  mounted() {
    this.getContato();
  }
}
</script>
<style>
* {
  box-sizing: border-box;
}

img {
  width: 500px;
}

a {
  background-color: var(--cor0);
  color: var(--cor3);
  padding: .3rem .6rem;
  font-size: 1rem;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
}

a:hover {
  background-color: var(--cor5);
  color: var(--cor0);
}

/* Papel */
.container {
    max-width: 600px;
    margin: 3rem auto;
    background-color: var(--cor3);
    padding: 1.5rem;
    border-color: var(--cor0);
    border-radius: 15px;
}

.container header{
    text-align: center;
    padding: 0 1rem 1rem;
    border-bottom: 1px solid var(--cor3);
}

/* Full-width input fields */
  input[type=text], input[type=email], input[type=number] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=email], input[type=number]:focus {
  background-color: #ddd;
  outline: none;
}

/* Foto de avatar */
.avatar {
  vertical-align: middle;
  width: 120px;
  height: 120px;
  border-radius: 50%;
  max-width: 100%;
  height: auto;
}

.responsive {
  width: 100%;
  height: auto;
}
</style>