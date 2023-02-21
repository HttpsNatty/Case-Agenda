<template>
  <div class="home-container">
    <header>
      <h1>Agendinha!</h1>
    </header>
    <div>
      <h2>Busque por um contato</h2>
      <form action="/home" method="GET">
        <input type="text" id="pesquisa" name="pesquisa" class="form-control" placeholder="Procurar...">
      </form>
    <div id="contato-list">
      <router-link to="/criar">Novo Contato</router-link>
      <!-- <h3>{{ $numcontatos}} contatos salvos!</h3> -->
      <h2>Veja todos</h2>
      <div v-for="contato in contatos" :key="contato.id">
        <div>
        <h3>{{ contato.nome }}</h3>
        <button>Ver detalhes</button>
        <button>Editar</button>
        <button type="button" @click="destroy(contato.id)">Excluir</button>
      <!-- if pesquisa true mostrar pesquisa/ false Todos -->
      <!-- foreach contato parece editar/ver/excluir  -->
      </div>
      </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Agenda from '@/components/Agenda.vue'
import api from '@/services/api.js';

export default {
  name: 'HomeView',
  components: {
    Agenda
  },

  data(){
    return {
      contatos: Array,
      contato_id: null
    }
  },

  methods: {
    getContato() {
      api.get('api/contatos').then(response =>{
        this.contatos = response.data;
      }).catch((error)=>{
        console.log(error);
      })
    },
    destroy(id) {
      api.delete('api/contato/delete/',{id}).then(response => {
          console.log(response.data);
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

/* Todo header*/
.home-container {
    max-width: 600px;
    margin: 3rem auto;
    background-color: var(--cor3);
    padding: 1.5rem;
    border-color: var(--cor0);
    border-radius: 15px;
}

.home-container header{
    text-align: center;
    padding: 0 1rem 1rem;
    border-bottom: 1px solid var(--cor3);
}


/* body */

.bg-img {
  /* The image used */
  background-image: url("../bg.png");
  
  /* Control the height of the image */
  min-height: 200px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  /* background-size: cover; */
  /* position: relative; */
}

/* Add styles to the form container */
.container {
  position: absolute;
  right: 0;
  margin: 20px;
  max-width: 300px;
  padding: 16px;
  background-color: white;
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

/* Set a style for the submit button */
.btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>