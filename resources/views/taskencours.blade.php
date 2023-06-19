@extends("layouts.main")
@section('content')
    @isset($projetencours)
        @if(count($projetencours) > 0)
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
                        <th>Actions</th>
                    </tr> -->
                </thead>
                <tbody>
                    @foreach($projetencours as $projet)
                        <tr>
                            <td>{{ $projet->libelle }}</td>
                            <td>{{ $projet->description }}</td>
                            <td>{{ $projet->datedebut }}</td>
                            <td>
                                <!-- <button type="button" class="p-3 mb-2 bg-transparent text-dark btn-options" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </button> --> 
                                <div class="d-flex justify-content-between">
                                    <form method="POST" action="{{ route('delete_taskencours', ['id' => $projet]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger bg bg-danger btn-block w-100 mr-3" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')"> Suppr. </button>
                                    </form>
                                    <form method="POST" action="{{ route('cancel_taskencours', ['id' => $projet->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-warning bg bg-warning btn-block w-100 mr-">Interr.</button>
                                    </form>
                                    <form method="" action="">
                                        <button type="submit" class="btn btn-info bg bg-info btn-block w-100 mr-2">Étapes</button>
                                    </form>
                                    <form method="POST" action="{{ route('finish_task', ['id' => $projet->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success bg bg-success btn-block w-100 mb-2">Term.</button>
                                    </form>
                                </div>
                                <!-- <form method="" action="">
                                    <button type="submit" class="btn btn-secondary bg bg-secondary btn-block w-100 mb-2">Etapes &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</button>
                                </form>
                                <form method="" action="">
                                    <button type="submit" class="btn btn-primary bg bg-primary btn-block w-100 mb-2">Terminer &nbsp; &nbsp; &nbsp; &nbsp;</button>
                                </form> -->
                            </td>
                        </tr>
                        <!-- Modal Option -->
                        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Options • TaskEasy</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('delete_taskencours', ['id' => $projet]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger bg bg-danger btn-block w-100 mb-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">Supprimer</button>
                                        </form>
                                        <form method="POST" action="{{ route('cancel_taskencours', ['id' => $projet->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-warning bg bg-warning btn-block w-100 mb-2">Interrompre</button>
                                        </form>
                                        <form method="" action="">
                                            <button type="submit" class="btn btn-secondary bg bg-secondary btn-block w-100 mb-2">Etapes &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</button>
                                        </form>
                                        <form method="" action="">
                                            <button type="submit" class="btn btn-primary bg bg-primary btn-block w-100 mb-2">Terminer &nbsp; &nbsp; &nbsp; &nbsp;</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning text-center" role="alert">
                Aucun projet en cours!
            </div>
        @endif
    @else
            <div class="alert alert-warning text-center" role="alert">
                Aucun projet en cours!
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