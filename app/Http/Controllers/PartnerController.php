<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return Partner::all();
    }

    public function show(Partner $partner)
    {
        return $partner;
    }

    public function store(Request $request)
    {
        Partner::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'dni' => $request->dni,
        ]);

        return response()->json(['message' => 'Socio registrado']);
    }

    public function update(Request $request, Partner $partner)
    {
        $partner->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'dni' => $request->dni,
        ]);

        return response()->json(['message' => 'Socio actualizado']);
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();

        return response()->json(['message' => 'Socio eliminado']);
    }
}
