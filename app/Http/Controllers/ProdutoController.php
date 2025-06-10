<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\ProdutoResource;


class ProdutoController extends Controller
{
    public function index()
    {
        $data = Produto::all();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'marca' => ['required', 'string', 'max:255'],
            'preco' => ['required', 'integer'],
            'quantidade' => ['required', 'integer']
        ]);

        $produtoExistente = Produto::where('nome', $request->nome)->first();

        if ($produtoExistente) {
            return response()->json([
                'success' => false,
                'message' => 'Já existe um produto com esse nome.'
            ], 400);
        }

        $create = Produto::create([
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
