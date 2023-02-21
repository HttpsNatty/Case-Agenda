<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contato;

class ContatoController extends Controller
{
    // Função de Busca
    public function search() {

        $pesquisa = request('pesquisa');

        if($pesquisa) {

            $contatos = Contato::where([
                ['nome', 'like', '%'.$pesquisa.'%']
            ])->get();

        } else {
            $contatos = Contato::all();
        }        
    
        return view('welcome',['contatos' => $contatos, 'pesquisa' => $pesquisa]);
    }
    
    // Função de mostrar todos
    public function index() {

        $contatos = Contato::all();
        
        return view('welcome');
    }

    // Função de criar um novo contato
    public function create(Request $request) {
        
        // Novo Contato
        $contato = new Contato;

        // Variaveis para completar
        $nome = $request->input('nome');
        $num = $request->input('num');
        $email = $request->input('email');
        
        // Confere se a data foi preenchida
        if($nome==null || $num==null || $email==null){
            return redirect(route('promo.create'))->with('error', 'Promoção incompleta');
        }

        // Pegando os valores
        $promocoe->nome = $request->nome;
        $promocoe->descricao = $request->descricao;

        // Salvando a promo no banco
        $promocoe->save();

        // Feedback de sucesso
        return redirect(route('admin.painel'))->with('msg', 'Promoção criada com sucesso!');
    }

    // Função ver aquele contato
    public function show() {

        $contato = Contato::findOrFail($id);

        return ($contato);
    }

    // Função de atualizar contato
    public function update(Request $request) {

        // Puxa todos os dados do contato em forma de array
        $dados = $request->all();

        if($request->nome==null ||$request->desricao){
            return redirect(url('contato/edit/' . $request->id ));
        }
        // Procura o id da promocao e atualiza os dados
        Promocoe::findOrFail($request->id)->update($dados);
    }

    // Função de excluir contato
    public function destroy($id){

        // Procura o contato pelo ID
        Contato::findOrFail($id)->delete();
    }
}
