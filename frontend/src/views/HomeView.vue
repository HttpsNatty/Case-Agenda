<template>
  <div class="home">
    <div class="bg-img">
      <form action="/home" method="GET" class="container">
      <h3>Boas Vindas! Veja seus contatos!</h3>
        <input type="text" id="pesquisa" name="pesquisa" class="form-control" placeholder="Procurar...">
      </form>
    <div id="contato-list">
      <!-- if pesquisa true mostrar pesquisa/ false Todos -->
      <!-- foreach contato parece editar/ver/excluir  -->
    </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'
import axios from 'axios';

export default {
  name: 'HomeView',
  components: {
    HelloWorld
  }
}
</script>
<style>
* {
  box-sizing: border-box;
}

.bg-img {
  /* The image used */
  background-image: url("../bg.png");

  /* Control the height of the image */
  min-height: 380px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
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