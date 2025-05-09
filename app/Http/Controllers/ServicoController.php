<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        return response()->json(Servico::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'valor' => 'required|numeric'
        ]);

        $servico = Servico::create($request->all());
        return response()->json($servico, 201);
    }

    public function show($id)
    {
        $servico = Servico::findOrFail($id);
        return response()->json($servico);
    }

    public function update(Request $request, $id)
    {
        $servico = Servico::findOrFail($id);
        $servico->update($request->all());
        return response()->json($servico);
    }

    public function destroy($id)
    {
        Servico::destroy($id);
        return response()->json(null, 204);
    }
}
