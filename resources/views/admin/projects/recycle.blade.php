@extends('layouts.admin')

@section('content')
    @if (session('reciclo'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Congratulazioni!</strong> {{ session('reciclo') }}
        </div>
    @endif

    <h1 class="text-center my-3">PROGETTI ELIMINATI:</h1>


    <div class="table-responsive mt-5">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th class="text-center" scope="col">IMMAGINI</th>
                    <th class="text-center" scope="col">TITOLO</th>
                    <th class="text-center" scope="col">AUTORE/I</th>
                    <th class="text-center" scope="col">DATA DI ELIMINAZIONE:</th>
                    <th class="text-center" scope="col">RECUPERA</th>




                </tr>
            </thead>
            <tbody>
                @foreach ($project_trash as $project)
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
                            @if ($project->authors)
                                {{ $project->authors }}
                            @else
                                N/A
                            @endif
                        </td> 
                        <td class="text-center">{{$project->deleted_at}}</td>



                        <td class=" text-center">
                            <form class="mx-2" action="{{ route('project.restore', [$project->id]) }}">

                                <button type="submit" class="btn btn-warning"><i
                                        class="fa-solid fa-recycle"></i></i></button>

                            </form>
                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    <a class="nav-link my-2 text-end" href="{{ route('project.index') }}">
        <button type="button" class="btn btn-primary">TORNA AI PROGETTI</button>
    </a>
@endsection
