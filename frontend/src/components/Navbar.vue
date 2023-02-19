<template>
    <div>
      <div id="nav">
        <div class="topnav" id="myTopnav">
            <router-link to="/" id="logo-url"><img src="/favicon.ico" class="logo" alt="Agendinha"></router-link>
            <router-link to="/">Todos</router-link> | 
            <router-link to="/criar">Novo Contato</router-link> | 
            <router-link to="/">Grupos</router-link>
        </div>
      </div>
    </div>
</template>
<script>
  export default {
    name: "Navbar"
}
</script>
<style>
img {
  width: 60px;
  float: left;
  display: block;
  text-align: center;
  padding: 14px 16px;
}

.topnav {  
  text-decoration: none;
}

.topnav a:hover {
    color: #61115b;    
    transition-duration: 0.5s;
}
</style>
