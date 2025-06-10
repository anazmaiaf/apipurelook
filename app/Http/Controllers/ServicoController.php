<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        $data = Servico::all();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'valor' => ['required', 'integer']
        ]);

        $servicoExistente = Servico::where('nome', $request->nome)->first();

        if ($servicoExistente) {
            return response()->json([
                'success' => false,
                'message' => 'Já existe um serviço com esse nome.'
            ], 400);
        }

        $create = Servico::create([
            'nome' => $request->nome,
            'valor' => $request->valor
        ]);

        if ($create) {
            return response()->json([
                'success' => true,
                'message' => 'Serviço criado com êxito.',
                'data' => $create
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao criar serviço.'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $servico = Servico::findOrFail($id);
        $servico->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Serviço atualizado com sucesso.',
            'data' => $servico
        ], 200);
    }

    public function destroy($id)
    {
        $servico = Servico::findOrFail($id);
        $servico->delete();

        return response()->json([
            'success' => true,
            'message' => 'Serviço removido com sucesso.'
        ], 204);
    }
}
