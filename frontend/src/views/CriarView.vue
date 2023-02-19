<template>
    <div>
        <div class="bg-img">
  <form action="/action_page.php" class="container">
    <h1>Crie um novo contato</h1>

    <!-- Foto -->
    <label for="foto"><b>foto</b></label>
    <input type="text" placeholder="Foto" name="foto" required>

    <!-- Nome -->
    <label for="nome"><b>Nome</b></label>
    <input type="text" placeholder="Nome" name="nome" required>
  
    <!-- Numero -->
    <label for="num"><b>Número</b></label>
    <input type="number" placeholder="(11) 99832-5555" name="num" required>

    <!-- E-mail -->
    <label for="email"><b>E-mail</b></label>
    <input type="email" placeholder="E-mail" name="email" required>
    
    <button type="submit" class="btn">Criar</button>
  </form>
</div>
    </div>
</template>