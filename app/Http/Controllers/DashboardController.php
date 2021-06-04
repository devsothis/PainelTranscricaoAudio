<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vistoria;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $vistorias = Vistoria::where('createdAt', now())->get();
        return view('dashboard.index', compact('vistorias'));
    }

    public function filtrarPorData(Request $request)
    {
        $de = Carbon::parse($request->get('de'));
        $ate = Carbon::parse($request->get('ate'));
        $vistorias =  Vistoria::when($de, function ($query) use ($de) {
            $query->where('createdAt', '>=', $de);
        })->when($ate, function ($query) use ($ate) {
            $query->where('createdAt', '<=', $ate);
        })->get();
        return $vistorias;
    }
}
