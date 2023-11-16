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
                            <div class="d-flex justify-content-center">

                                <form action="{{ route('project.show', [$project->id]) }}">

                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-info"></i></button>

                                </form>

                                <form class="mx-2" action="{{ route('project.edit', [$project->id]) }}">

                                    <button type="submit" class="btn btn-info"><i class="fa-solid fa-pencil"></i></button>

                                </form>

                                <form action="{{ route('project.destroy', [$project->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                                <form class="mx-2" action="{{ route('project.recycle', [$project->id]) }}">

                                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-recycle"></i></i></button>

                                </form>

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
