<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


use App\Models\Contato;

class ContatoController extends Controller
{
    // Função de Busca
    public function search()
    {
        $pesquisa = request('pesquisa');

        if ($pesquisa) {
            $contatos = Contato::where('nome', 'like', '%' . $pesquisa . '%')
            ->orWhere('numero', 'like', '%' . $pesquisa . '%')
            ->orWhere('email', 'like', '%' . $pesquisa . '%')
            ->get();
        } else {
            $contatos = Contato::all();
        }

        return ['contatos' => $contatos, 'pesquisa' => $pesquisa];
    }
    
    // Função de mostrar todos
    public function index() {

        $contatos = Contato::all();
        
        return ($contatos);
    }

    public function create(Request $request)
    {
        // Novo Contato
        $contato = new Contato;

        // Preenchendo os valores
        $contato->nome = $request->input('nome');
        $contato->numero = $request->input('numero');
        $contato->email = $request->input('email');

        // Upload da imagem
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->store('avatar', 'public');
            $contato->image = $imageName;
        }


        // Salvando o contato no banco
        $contato->save();
    }


    // Função ver aquele contato, não implementada
    public function show($id)
    {
        $contato = Contato::findOrFail($id);

        return response()->json($contato);
    }

    // Função para abrir a edição
    public function edit($id) {

        // Procura o id do Contato
        $contato = Contato::findOrFail($id);

        // Direciona para edição
        return ($contato);
    }

    // Função de atualizar contato
    public function update(Request $request, $id)
    {
        $contato = Contato::find($id);

        if (!$contato) {
            return response()->json(['message' => 'Contato não encontrado'], 404);
        }

        $dados = $request->only(['nome', 'numero', 'email']);

        $contato->update($dados);

        return response()->json(['message' => 'Contato atualizado com sucesso']);
    }

    // Função de excluir contato
    public function destroy($id){

        // Procura o contato pelo ID
        Contato::findOrFail($id)->delete();

        // return ($contatos);
    }
}
