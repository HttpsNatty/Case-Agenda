<template>
  <div class="container">
    <header>
      <img src="/img/logo.png" alt="" class="responsive" />
    </header>
    <div>
      <Message :msg="msg" v-show="msg" />
      <div>
        <div id="contato-list">
          <router-link to="/criar">Novo Contato</router-link>
          <div>
            <input
              type="text"
              v-model="pesquisa"
              placeholder="Pesquisar por nome, número ou email"
              @keyup="pesquisaContato"
            />
          </div>
          <h2 style="margin: 0">
            <span v-if="!termoPesquisa">Veja todos os contatos</span>
            <span v-else>Buscando por "{{ termoPesquisa }}"</span>
          </h2>
          <div v-if="mostrarMensagemVazia">
            <p>Você ainda não tem contato com "{{ termoPesquisa }}"</p>
          </div>
          <div v-else-if="contatos.length === 0">
            <p>Você ainda não tem contato!</p>
          </div>

          <div v-else>
            <div
              v-for="contato in contatos"
              :key="contato.id"
              style="margin: 0.3rem"
            >
              <div>
                <div class="contato">
                  <img :src="'/avatar' + contato.image" alt="Avatar" class="avatar" />
                  {{ contato.image }}
                  <div class="contato-info">
                    <h4 style="margin-top: 1; margin-bottom: 0">
                      Nome: {{ contato.nome }}
                    </h4>
                    <h4 style="margin: 5">Telefone: +{{ contato.numero }}</h4>
                    <h4 style="margin-top: 0; margin-bottom: 1">
                      Email: {{ contato.email }}
                    </h4>
                  </div>
                </div>
                <div class="btn-container">
                  <router-link
                    :to="`/editar/${contato.id}`"
                    class="btn"
                    v-on:click="edicao(contato.id)"
                    >Editar</router-link
                  >
                  <router-link
                    to="/"
                    class="btn"
                    v-on:click="destroy(contato.id)"
                    >Excluir</router-link
                  >
                </div>
                <hr />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import api from "@/services/api.js";
import Message from "@/components/Message.vue";

export default {
  name: "HomeView",

  data() {
    return {
      contatos: Array,
      contato: {},
      contato_id: null,
      pesquisa: null,
      msg: null,
      mostrarMensagemVazia: false,
      termoPesquisa: null, 
    };
  },

  components: {
    Message,
  },

  watch: {
    pesquisa(value) {
      if (value === "") {
        this.getContato();
      }
    },
  },

  methods: {
    pesquisaContato() {
      if (this.pesquisa.trim() !== "") {
        api
          .get("api/contatos/busca", { params: { pesquisa: this.pesquisa } })
          .then((response) => {
            this.contatos = response.data.contatos;
            this.termoPesquisa = this.pesquisa;
            this.mostrarMensagemVazia = this.contatos.length === 0;
            console.log(response.data.contatos);
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.getContato();
        this.termoPesquisa = null;
        this.mostrarMensagemVazia = false;
      }
    },
    getContato() {
      api
        .get("api/contatos")
        .then((response) => {
          this.contatos = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    edicao(id) {
      api
        .get(`api/contato/editar/${id}`)
        .then((response) => {
          this.contato = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    destroy(id) {
      api
        .delete(`api/contato/delete/${id}`)
        .then(() => {
          console.log("Excluiu contato");
          this.msg = `Contato excluído!`;
          setTimeout(() => (this.msg = ""), 3000);

          // Remover o contato da lista
          this.contatos = this.contatos.filter((contato) => contato.id !== id);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getContato();
  },
};
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
  padding: 0.3rem 0.6rem;
  font-size: 1rem;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
  border-radius: 5px;
}

a:hover {
  background-color: var(--cor5);
  color: var(--cor0);
  border-radius: 5px;
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

.container header {
  /* text-align: center; */
  padding: 0 1rem 1rem;
  border-bottom: 1px solid var(--cor3);
}

/* Full-width input fields */
input[type="text"],
input[type="email"]{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  border-radius: 5px;
}

input[type="text"]:focus,
input[type="email"]:focus {
  background-color: #ddd;
  outline: none;
  border-radius: 5px;
}

/* Foto de avatar */
/* .avatar {
  vertical-align: middle;
  width: 120px;
  height: 120px;
  border-radius: 50%;
  max-width: 100%;
  height: auto;
} */

.contato {
  display: flex;
  text-align: left;
}

.avatar {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  margin-right: 10px;
  margin-top: 2px;
}

.contato-info {
  display: flex;
  flex-direction: column;
}

.responsive {
  width: 100%;
  height: auto;
}

.btn-container {
  display: flex;
  justify-content: center; /* Centralizar horizontalmente */
  align-items: center; /* Centralizar verticalmente */
  gap: 10px; /* Espaçamento entre os botões */
}

.btn {
  background-color: var(--cor0);
  color: var(--cor3);
  padding: 0.3rem 0.6rem;
  font-size: 1rem;
  cursor: pointer;
  text-decoration: none;
}

.btn:hover {
  background-color: var(--cor5);
  color: var(--cor0);
}
</style>
