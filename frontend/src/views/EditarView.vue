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
      <label for="nome"><b>Nome</b></label>
      <input type="text" name="nome" v-model="fd.nome" required />
      <br />
      <label for="numero"><b>Número</b></label>
      <input
        type="text"
        name="numero"
        v-model="fd.numero"
        maxlength="11"
        required
      />
      <br />
      <label for="email"><b>E-mail</b></label>
      <input type="email" name="email" v-model="fd.email" />
      <br />
      <div class="btn-container">
        <router-link to="/">Voltar</router-link>
        <button
          to="/"
          type="submit"
          class="btn"
          v-on:click="editarContato(fd.id)"
          >Salvar Contato</button
        >
      </div>
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
        numero: "",
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

  watch: {
  'fd.numero': function(newVal) {
    this.fd.numero = newVal.replace(/\D/g, "");
  }
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
          const { id, nome, numero, email, image } = response.data;
          this.fd = { id, nome, numero, email, image };
        })
        .catch((error) => {
          console.log(error);
        });
    },

    editarContato(id) {
      api
        .put(`api/contato/${id}`, this.fd)
        .then(() => {
          console.log(this.fd);
          this.msg = `Contato editado!`;
          setTimeout(() => (this.msg = ""), 3000);
          this.$router.push("/");
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
