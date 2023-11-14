@extends('layouts.admin')

@section('content')
    @if (session('messaggio'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Congratulazioni!</strong> {{ session('messaggio') }}
        </div>
    @endif

    <div class="table-responsive mt-5">

        <h1>PROGETTI</h1>



        {{-- impaginazione eseguita tramite la funzione index situata nel ProjectController --}}

        {{ $projects->links('pagination::bootstrap-5') }}

        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">IMMAGINI</th>
                    <th scope="col">TITOLO</th>
                    <th scope="col">DESCRIZIONE</th>
                    <th scope="col">AUTORI</th>
                    <th class=" text-center" scope="col">COMANDI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>
                            @if ($project->thumb)
                            <img width="100" src="{{ asset('storage/' . $project->thumb) }}">
                            @else
                            N/A
                            @endif

                        </td>

                        <td scope="row">{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->authors }}</td>
                        <td>
                            <div class="d-flex">

                                <form action="{{ route('project.show', [$project->id]) }}">

                                    <button type="submit" class="btn btn-primary">Dettagli</button>

                                </form>

                                <form class="mx-2" action="{{ route('project.edit', [$project->id]) }}">

                                    <button type="submit" class="btn btn-warning">Aggiorna</button>

                                </form>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Cancella
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">CANCELLA IL PROGETTO</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Sei sicuro di voler cancellare questo progetto?
                                                Questa azione è irreversibile!
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('project.destroy', [$project->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Cancella</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </td>
                    </tr>
                @endforeach

                <form class="mx-2" action="{{ route('project.create') }}">

                    <button type="submit" class="btn btn-success mb-3">Aggiungi un nuovo progetto</button>

                </form>
            </tbody>
        </table>

    </div>
@endsection
