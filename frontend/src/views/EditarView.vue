<template>
  <div class="container">
    <div v-show="mostra_contato">
      <Message :msg="msg" v-show="msg" />
      <h1>Edite o contato</h1>
      <br />
      <label for="foto"><b>foto</b></label>
      <input type="file" name="image" @change="onFileSelected" id="image" />
      <img :src="fd.image" alt="Avatar" class="avatar" />
      <br />
      <br />
      <label for="nome"><b>Nome</b></label>
      <input type="text" name="nome" v-model="fd.nome" required />
      <br />
      <label for="num"><b>Número</b></label>
      <input type="number" name="num" v-model="fd.num" required />
      <br />
      <label for="email"><b>E-mail</b></label>
      <input type="email" name="email" v-model="fd.email" />
      <br />
      <router-link to="/">Voltar</router-link>
      <br />
      <router-link
        to="/"
        type="submit"
        class="btn"
        v-on:click="editarContato(fd.id)"
        >Salvar Contato</router-link
      >
    </div>
  </div>
</template>

<script>
import api from "@/services/api.js";
import Message from "@/components/Message.vue";

export default {
  name: "EditarView",

  data() {
    return {
      fd: {
        id: null,
        nome: "",
        num: "",
        email: "",
        image: null,
      },
      selectedFile: null,
      mostra_contato: true,
      msg: null,
    };
  },

  components: {
    Message,
  },

  methods: {
    onFileSelected(event) {
      this.selectedFile = event.target.files[0];
      console.log(event);
    },
    getContato(id) {
      api
        .get(`api/contato/editar/${id}`)
        .then((response) => {
          console.log(response.data);
          this.fd.id = response.data.id;
          this.fd.nome = response.data.nome;
          this.fd.num = response.data.num;
          this.fd.email = response.data.email;
          this.fd.image = response.data.image;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    editarContato(id) {
      api
        .put(`api/update/${id}`, this.fd)
        .then(() => {
          console.log("Edição do contato!");
          this.msg = `Contato editado!`;
          setTimeout(() => (this.msg = ""), 3000);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  mounted() {
    const id = this.$route.params.id;
    this.getContato(id);
  },
};
</script>
