<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return response()->json(['produtos' => $produtos]);
    }


    public function show($id)
    {
        return Produto::find($id);
    }

    public function store(Request $request)
    {
        $produto = Produto::create($request->all());
        return response()->json($produto, 201);
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
