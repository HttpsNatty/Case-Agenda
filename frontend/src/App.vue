<template>
<div>
  <nav>
  <Navbar /></nav>
  <router-view/>
  <div id="bg" class="bg"></div>
  <Footer />
  </div>
</template>

<script>
import Navbar from './components/Navbar';
import Footer from './components/Footer';

export default {
  data: function() {
    return {
      app_name: "Agenda",
    }    
  },

  name: "App",
  components: {
    Navbar,
    Footer
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

body, html {
  height: 100%;
}

.bg {
  /* The image used */
  /* background-image: url("images/bg.png"); */

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #25AD86;
}

nav a:hover {
  color: #61115b;
}
</style>
