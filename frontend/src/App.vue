<template>
<div>  
  <router-view/>
  <Footer />
  </div> 
</template>

<script>
import Footer from './components/Footer';

export default {
  data: function() {
    return {
      app_name: "Agenda",
    }    
  },

  name: "App",
  components: {
    Footer
  },
};
</script>

<style>

:root{
  --cor0 : #25AD86; /* Verde Base*/
  --cor1 : #61115b; /* Roxo Contraste */
  --cor2 : #e8d09c; /* Bege Fundo */
  --cor3 : #fff;    /* Branco Fundo */
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

body {
  background-image: url(../public/img/bg.jpg);
  background-position: center;
  background-size: cover;
  background-attachment: fixed;
}

button, a {
  background-color: var(--cor0);
  color: var(--cor3);
  padding: .3rem .6rem;
  font-size: 1rem;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  transition-duration: .5s;
}

button:hover {
  background-color: var(--cor5);
  color: var(--cor0);
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

h2 {
  padding: 0 1rem 1rem;
  border-bottom: 1px solid var(--cor1);
}
</style>
