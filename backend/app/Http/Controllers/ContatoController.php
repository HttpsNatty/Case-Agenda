<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contato;

class ContatoController extends Controller
{
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
    
    
    public function index() {

        $contatos = Contato::all();
        
        return view('welcome', ['contatos' => $contatos]);
    }

    public function create() {
        return view('contato/criar');
    }

    public function destroy($id){

        // Procura o contato pelo ID
        Contato::findOrFail($id)->delete();

        // Feedback de exclusão com sucesso
        // return redirect(route('admin.painel'))->with('msg', 'Promoção excluída com sucesso!');
    }
}
