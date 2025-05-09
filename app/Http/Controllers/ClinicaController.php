<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use Illuminate\Http\Request;

class ClinicaController extends Controller
{
    public function index()
    {
        return response()->json(Clinica::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
        ]);

        $clinica = Clinica::create($request->all());

        return response()->json($clinica, 201);
    }

    public function show($id)
    {
        $clinica = Clinica::find($id);

        if (!$clinica) {
            return response()->json(['mensagem' => 'Clínica não encontrada'], 404);
        }

        return response()->json($clinica, 200);
    }

    public function update(Request $request, $id)
    {
        $clinica = Clinica::find($id);

        if (!$clinica) {
            return response()->json(['mensagem' => 'Clínica não encontrada'], 404);
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
        ]);

        $clinica->update($request->all());

        return response()->json($clinica, 200);
    }

    public function destroy($id)
    {
        $clinica = Clinica::find($id);

        if (!$clinica) {
            return response()->json(['mensagem' => 'Clínica não encontrada'], 404);
        }

        $clinica->delete();

        return response()->json(['mensagem' => 'Clínica excluída com sucesso'], 200);
    }
}
