<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // GET /api/produtos
    public function index()
    {
        return Produto::all();
    }

    // GET /api/produtos/{id}
    public function show($id)
    {
        return Produto::find($id);
    }

    // POST /api/produtos
    public function store(Request $request)
    {
        $produto = Produto::create($request->all());
        return response()->json($produto, 201);
    }

    // PUT /api/produtos/{id}
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return response()->json($produto, 200);
    }

    // DELETE /api/produtos/{id}
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json(null, 204);
    }
}
