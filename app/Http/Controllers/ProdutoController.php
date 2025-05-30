<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public readonly Produto $produtos;

    public function __construct()
    {
        $this->produtos = new Produto();

    }

    public function index()
    {
        $data = $this->produtos->all();
        return response()->json(["data"=>$data]);
    }

    public function show($id)
    {
        return Produto::find($id);
    }

    public function store(Request $request)
    {
        // $create = $this->produtos->create([
        //     'nome' => $request->nome,
        //     'marca' => $request->marca,
        //     'preco' => $request->preco,
        //     'quantidade' => $request->quantidade
        // ]);
        
        // return response()->json($create, 201);

        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'marca' => ['required', 'string', 'max:255'],
            'preco' => ['required', 'integer'],
            'quantidade' => ['required', 'integer']
        ]);

        $produtoExistente = $this->produtos->where('nome', $request->nome)->first();

        if ($produtoExistente) {
            return response()->json([
                'success' => false,
                'message' => 'Já existe um produto com esse nome.'
            ], 400);
        }

        $create = $this->produtos->create([
            'nome' => $request->nome,
            'marca' => $request->marca,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade
        ]);

        if ($create) {
            return response()->json([
                'success' => true,
                'message' => 'Produto criado com êxito.'
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao criar produto'
            ], 500);
        }
    }

    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return response()->json($produto, 200);
        
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json(null, 204);
    }
}
