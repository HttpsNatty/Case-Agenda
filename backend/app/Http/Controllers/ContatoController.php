<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    // Função de criar um novo contato
    public function create(Request $request) {
        
        // Novo Contato
        $contato = new Contato;

        // Variaveis para completar
        // $nome = $request->input('nome');
        // $num = $request->input('num');
        // $email = $request->input('email');
        
        // // Confere se a data foi preenchida
        
        // Pegando os valores
        $contato->nome = $request->nome;
        $contato->numero = $request->num;
        $contato->email = $request->email;
        $contato->image = $request->image;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('avatar/avatar'), $imageName);

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

        $dados = $request->only(['nome', 'num', 'email']);

        if ($request->nome == null) {
            return redirect(url('contato/editar/' . $id));
        }

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
