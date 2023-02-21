<template>
<div>  
  <!-- <Navbar /> -->
  <Agenda />
  <router-view/>
  <Footer />
  </div> 
</template>

<script>
import Navbar from './components/Navbar';
import Footer from './components/Footer';
import Agenda from './components/Agenda';

export default {
  data: function() {
    return {
      app_name: "Agenda",
    }    
  },

  name: "App",
  components: {
    Navbar,
    Agenda,
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
  /* height: 100%; */
  background-color: #e8d09c;
  text-align: center;
}

button{
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

button:hover{
    background-color: var(--cor5);
    color: var(--cor0);
}

/* .bg {
  /* The image used */
  /* background-image: url("images/bg.png"); */

  /* Full height */
  /* height: 100%; */



/* Centered text */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: var(--cor0);
}

nav a:hover {
  color: #61115b;
}
</style>
