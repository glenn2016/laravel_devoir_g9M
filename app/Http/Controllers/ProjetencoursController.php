<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Projetencours;
use App\Models\Projet;

use Illuminate\Http\Request;

class ProjetencoursController extends Controller
{
    public function form_taskencours()
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = Auth::user();

        // Récupérer les projets en cours associés à l'utilisateur
        $projetencours = $user->projetencours;

        // Récupérer tous les projets en cours (pour l'admin par exemple)
        $allProjetencours = Projetencours::all();

        return view('taskencours', compact('projetencours', 'allProjetencours'));
    }
}
