@extends("layouts.main")
@section('content')
    @isset($projets_termines)
        @if(count($projets_termines) > 0)
            @if(session('message'))
                <div id="myAlert" class="alert alert-success text-center" role="alert" style="display: none;">
                    {{ session('message') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <!-- <tr>
                        <th>Libellé</th>
                        <th>Description</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th class="text-center">Actions</th>
                    </tr> -->
                </thead>
                <tbody>
                    @foreach($projets_termines as $projet)
                        <tr>
                            <td>{{ $projet->libelle }}</td>
                            <td>{{ $projet->description }}</td>
                            <td>{{ $projet->datedebut }}</td>
                            <td>{{ $projet->datefin }}</td>
                            <td>
                                <div class="d-flex justify-content-center"> <!-- Utiliser "justify-content-center" ici -->
                                    <form method="POST" action="{{ route('delete_taskfinish', ['id' => $projet]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg bg-danger btn btn-danger mr-2" onclick="return confirm('Une fois le projet masqué vous ne pourrez plus le voir. Êtes-vous sûr de vouloir masquer ce projet ?')">
                                            Effacer
                                        </button>
                                    </form>
                                    <form method="" action="">
                                        <button type="submit" class="bg bg-primary btn btn-primary" onclick="return confirm('Confirmé pour imprimer le projet')">
                                            Imprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning text-center" role="alert">
                Aucun projet terminé!
            </div>
        @endif
    @else
        <div class="alert alert-warning text-center" role="alert">
            Aucun projet terminé!
        </div>
    @endisset

    <script>
        // Récupérer la div d'alerte
        const alertDiv = document.getElementById('myAlert');

        // Afficher la div d'alerte
        alertDiv.style.display = 'block';

        // Définir un délai de 5 secondes pour masquer la div d'alerte
        setTimeout(function() {
            alertDiv.style.display = 'none';
        }, 5000);
    </script>
@endsection
