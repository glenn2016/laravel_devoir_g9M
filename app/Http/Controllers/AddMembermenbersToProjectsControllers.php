<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Users;
use Illuminate\Http\Request;

class AddMembermenbersToProjectsControllers extends Controller
{
    //


    public function addMembersToProject(Request $request, $projectId)
{
    $project = Project::find($projectId);

    // Récupérez les identifiants des utilisateurs sélectionnés à partir du formulaire
    $selectedUsers = $request->input('users');

    // Associez les utilisateurs sélectionnés au projet
    $project->users()->attach($selectedUsers);

    // Récupérez la liste mise à jour des utilisateurs associés au projet
    $users = $project->users;

    // Faites d'autres opérations ou affichez la liste des utilisateurs associés au projet

    return view('project.show', compact('project', 'users'));
}

}
