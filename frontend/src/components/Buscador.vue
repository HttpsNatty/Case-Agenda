<template>
    <div class="CardapioPesquisa">
        <div id="pesquisadiv" class="pesquisadiv">
            <h1>Busque</h1>
            <input type="text" id="pesquisa" v-onclick="pesquisaShow()" name="pesquisa" class="form-control" placeholder="Procurar...">
            <h2 v-show="pesquisa">{{ textoPesquisa }}</h2>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Buscador',
    
    data(){
        return {
            textoPesquisa: '',
            pesquisa: null
        }
    },
    methods: {
        pesquisaShow(){
            if(pesquisa != ''){
                this.textoPesquisa = 'Teste'
                "Buscando por: {{ pesquisa }}"
            }
            else{
                this.textoPesquisa = 'confira'
                "Confira nosso menu completoo"
            }
        }
    },
    mounted () {
    this.pesquisaShow()
  } 
}
</script>