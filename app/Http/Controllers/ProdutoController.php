<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;

class ProdutoController extends Controller
{
    public function index()
    {
        return response()->json(Produto::all());
    }

    public function store(StoreProdutoRequest $request)
    {
        $preco = str_replace(',', '.', $request->input('preco'));

        $produto = Produto::create([
            'nome' => $request->nome,
            'preco' => $preco,
            'quantidade' => $request->quantidade,
            'marca' => $request->marca,
        ]);

        return response()->json(['message' => 'Produto cadastrado com sucesso!', 'produto' => $produto], 201);
    }

    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado.'], 404);
        }

        return response()->json($produto);
    }

    public function update(StoreProdutoRequest $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado.'], 404);
        }

        $preco = str_replace(',', '.', $request->input('preco'));

        $produto->update([
            'nome' => $request->nome,
            'preco' => $preco,
            'quantidade' => $request->quantidade,
            'marca' => $request->marca,
        ]);

        return response()->json(['message' => 'Produto atualizado com sucesso!', 'produto' => $produto]);
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado.'], 404);
        }

        $produto->delete();

        return response()->json(['message' => 'Produto excluído com sucesso.']);
    }
}
