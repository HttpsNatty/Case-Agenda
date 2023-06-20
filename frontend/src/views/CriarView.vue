<template>
  <div class="container">
    <header>
      <img src="/img/logo.png" alt="" class="responsive" />
    </header>
    <!-- <form> -->
    <h1>Crie um novo contato</h1>
    <Message :msg="msg" v-show="msg" />
    <!-- Foto -->
    <br />
    <label for="foto"><b>Foto</b></label>
    <input
      type="file"
      name="image"
      id="image"
      accept="image/png, image/jpeg"
      @change="onFileSelected"
    />
    <br />

    <!-- Nome -->
    <br />
    <label for="nome"><b>Nome</b></label>
    <input
      type="text"
      placeholder="Nome"
      name="nome"
      id="nome"
      v-model="fd.nome"
      required
    />
    <br />

    <!-- numeroero -->
    <label for="numero"><b>Número</b></label>
    <input
      type="text"
      placeholder="1199832-5555"
      name="numero"
      id="numero"
      v-model="fd.numero"
      @input="handleNumericInput"
      required
      maxlength="11"
    />

    <!-- E-mail -->
    <br />
    <label for="email"><b>E-mail</b></label>
    <input
      type="email"
      placeholder="E-mail"
      name="email"
      id="email"
      v-model="fd.email"
      required
    />
    <br />

    <div class="btn-container">
      <router-link to="/">Voltar</router-link>
      <button type="submit" class="a" v-on:click="criarContato()">
        Criar Contato
      </button>
    </div>
    <!-- </form> -->
  </div>
</template>

<script>
import api from "@/services/api.js";
import Message from "@/components/Message.vue";

export default {
  name: "CriarView",

  data() {
    return {
      fd: {
        id: null,
        nome: "",
        numero: "",
        email: "",
        image: null,
      },
      contato: {},
      selectedFile: null,
      msg: null,
    };
  },

  components: {
    Message,
  },

  methods: {
    onFileSelected(event) {
      this.fd.image = event.target.files[0];
    },
    handleNumericInput() {
      this.fd.numero = this.fd.numero.replace(/\D/g, "");
    },

    criarContato() {
  if (this.fd.image) {
    const reader = new FileReader();
    reader.onload = () => {
      this.fd.image = reader.result; // Armazena a imagem como uma string codificada em base64
      this.enviarContato(); // Chama a função para enviar o contato para a API
    };
    reader.readAsDataURL(this.fd.image); // Lê o conteúdo da imagem como uma string base64

  } else {
    this.enviarContato(); // Se não houver imagem selecionada, envia o contato sem a imagem
  }
},

enviarContato() {
  const formData = new FormData(); // Crie um objeto FormData para enviar o formulário como dados de formulário multipart
  formData.append('image', this.fd.image); // Adicione a imagem ao objeto FormData

  // Adicione os outros campos do formulário ao objeto FormData
  formData.append('nome', this.fd.nome);
  formData.append('numero', this.fd.numero);
  formData.append('email', this.fd.email);

  console.log(formData); // Verifique os dados do formulário

  api
    .post("api/novocontato", formData) // Envie o objeto FormData em vez de this.fd
    .then(() => {
      console.log("Novo contato adicionado!");
      this.msg = `Contato adicionado!`;
      setTimeout(() => (this.msg = ""), 3000);
    })
    .catch((error) => {
      console.log(error.response.data);
    });
}
  },
};
</script>
<style>
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
