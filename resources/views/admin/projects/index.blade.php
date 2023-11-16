@extends('layouts.admin')

@section('content')
    @if (session('messaggio'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
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
                    <th class="text-center" scope="col">IMMAGINI</th>
                    <th class="text-center" scope="col">TITOLO</th>
                    <th class="text-center" scope="col">DESCRIZIONE</th>
                    <th class="text-center" scope="col">AUTORI</th>
                    <th class=" text-center" scope="col">COMANDI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td class="text-center">
                            @if ($project->thumb)
                                <img width="100" src="{{ asset('storage/' . $project->thumb) }}">
                            @else
                                N/A
                            @endif

                        </td>


                        <td class="text-center" scope="row">
                            @if ($project->title)
                                {{ $project->title }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($project->description)
                                {{ $project->description }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($project->authors)
                                {{ $project->authors }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">

                                <form action="{{ route('project.show', [$project->id]) }}">

                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa-solid fa-circle-info"></i></button>

                                </form>

                                <form class="mx-2" action="{{ route('project.edit', [$project->id]) }}">

                                    <button type="submit" class="btn btn-info"><i class="fa-solid fa-pencil"></i></button>

                                </form>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $project->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <div class="modal fade" id="modalId-{{ $project->id }}" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="modalId-{{ $project->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white justify-content-center">
                                                <h5 class="modal-title text-uppercase"
                                                    id="modalTitleId-{{ $project->id }}">Attenzione!</h5>
                                            </div>
                                            <div class="modal-body fs-5">
                                                Il progetto chiamato:</strong>
                                                <strong>{{ $project->title }}</strong> sta per essere eliminato!
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal">
                                                    <i class="fa-solid fa-arrow-left"></i> Torna ai progetti
                                                </button>


                                                <form action="{{ route('project.destroy', $project->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Elimina <i
                                                            class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <form action="{{ route('project.destroy', [$project->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form> --}}


                            </div>
                        </td>
                    </tr>
                @endforeach

                <div class="d-flex">
                    <form action="{{ route('project.create') }}">

                        <button type="submit" class="btn btn-success mb-3">Aggiungi un nuovo progetto</button>

                    </form>

                    <form class="mx-2" action="{{ route('project.recycle') }}">

                        <button type="submit" class="btn btn-warning mb-3 text-white">Eliminati di recente</button>

                    </form>
                </div>

            </tbody>
        </table>

    </div>
@endsection
