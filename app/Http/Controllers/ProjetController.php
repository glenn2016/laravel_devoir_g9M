<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\Projetencours;
use App\Models\Projets_termines;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProjetController extends Controller
{
    public function traitement_add(Request $request)
    {
        $user = Auth::user();

        // Créer un nouveau projet et associer l'utilisateur
        $projet = new Projet();
        $projet->libelle = $request->input('libelle');
        $projet->description = $request->input('description');
        $projet->datedebut = $request->input('datedebut');

        // Associer le projet à l'utilisateur
        $projet->user_id = $user->id;

        $projet->save();

        return redirect('/addtask')->with('message', 'Projet crée avec succès! Retrouver votre projet dans la section liste des projets');
    }

    public function form_listtask()
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = Auth::user();

        // Récupérer les projets associés à l'utilisateur
        $projets = $user->projets;
        return view('/listtask', compact('projets'));
    }

    public function destroy($id)
    {
        $element = Projet::findOrFail($id);
        $element->delete();
        return redirect()->back()->with('success', 'Projet supprimé avec succès');
    }

    public function destroy2($id)
    {
        $element = Projetencours::findOrFail($id);
        $element->delete();
        return redirect()->back()->with('success', 'Projet supprimé avec succès');
    }

    public function begintask($id)
    {
        $user = Auth::user();
        $projet = Projet::find($id);

        // Vérifiez si le projet existe
        if ($projet) {
            // Créez un nouvel enregistrement dans la table "projetencours"
            $projetEncours = new Projetencours();
            $projetEncours->user_id = $user->id;
            $projetEncours->id = $projet->id;
            $projetEncours->libelle = $projet->libelle;
            $projetEncours->description = $projet->description;
            $projetEncours->datedebut = $projet->datedebut;
            $projetEncours->save();

            // Supprimez le projet de la table "projets"
            $projet->delete();
        }

        // Redirigez vers la page d'origine ou une autre page appropriée
        return redirect()->back();
    }

    public function canceltaskencours($id)
    {
        $user = Auth::user();
        $projetencours = Projetencours::find($id);

        // Vérifiez si le projet existe
        if ($projetencours) {
            // Créez un nouvel enregistrement dans la table "projetencours"
            $projetEncours = new Projet();
            $projetEncours->user_id = $user->id;
            $projetEncours->id = $projetencours->id;
            $projetEncours->libelle = $projetencours->libelle;
            $projetEncours->description = $projetencours->description;
            $projetEncours->datedebut = $projetencours->datedebut;
            $projetEncours->save();

            // Supprimez le projet de la table "projetencours"
            $projetencours->delete();
        }

        // Redirigez vers la page d'origine
        return redirect()->back(); 
    }

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

    public function form_finishtask()
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = Auth::user();

        // Récupérer les projets en cours associés à l'utilisateur
        $projets_termines = $user->projets_termines;

        // Récupérer tous les projets en cours (pour l'admin par exemple)
        $allProjets_termines = Projets_termines::all();

        return view('finishtask', compact('projets_termines', 'allProjets_termines'));
    }

    public function destroy3($id)
    {
        $element = Projets_termines::findOrFail($id);
        $element->delete();
        return redirect()->back()->with('success', 'Projet supprimé avec succès');
    }

    public function finishtask($id)
    {
        $user = Auth::user();
        $projetencours = Projetencours::find($id);

        // Vérifiez si le projet existe
        if ($projetencours) {
            // Créez un nouvel enregistrement dans la table "projetencours"
            $projetEncours = new Projets_termines();
            $projetEncours->user_id = $user->id;
            $projetEncours->id = $projetencours->id;
            $projetEncours->libelle = $projetencours->libelle;
            $projetEncours->description = $projetencours->description;
            $projetEncours->datedebut = $projetencours->datedebut;
            // Ajoutez la date de fin en utilisant la fonction date() de PHP
            $projetEncours->datefin = date('Y-m-d');
            $projetEncours->save();

            // Supprimez le projet de la table "projetencours"
            $projetencours->delete();
        }

        // Redirigez vers la page d'origine
        return redirect()->back(); 
    }

    public function updatetask(Request $request, $id)
    {
        $projet = Projet::find($id);

        if ($projet) {
            $projet->libelle = $request->input('libelle');
            $projet->description = $request->input('description');
            $projet->datedebut = $request->input('datedebut');
            $projet->save();
        }

        return redirect()->back();
    }
}
