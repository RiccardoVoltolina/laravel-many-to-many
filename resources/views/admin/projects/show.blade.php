@extends('layouts.admin')

@section('content')

<h1 class="text-center my-3">PROGETTO</h1>


<div class="table-responsive mt-5">
    <table class="table table-primary">
        <thead>
            <tr>
                <th class="text-center" scope="col">IMMAGINI</th>
                <th class="text-center" scope="col">TITOLO</th>
                <th class="text-center" scope="col">DESCRIZIONE</th>
                <th class="text-center" scope="col">AUTORI</th>
                <th class="text-center" scope="col">LINK GITHUB</th>
                <th class="text-center" scope="col">LINK AL PROGETTO</th>
                <th class="text-center" scope="col">TECNOLOGIA UTILIZZATA</th>


            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        @if ($project->thumb)
                            <img width="100" src="{{ asset('storage/' . $project->thumb) }}">
                            @else
                            N/A
                            @endif
                    </td>
                    <td scope="row">{{$project->title}}</td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->authors}}</td>
                    <td class="text-center"><a href="{{$project->githublink}}"><i class="fa-brands fa-github text-black"></i></a></td>
                    <td class="text-center"><a href="{{$project->projectlink}}"><i class="fa-solid fa-diagram-project text-black"></i></a></td>

                    {{-- seleziono la tabella type, relazionata precedentemente con il modello del progetto, se esiste, entro nel project->seleziono la tabella type e seleziono la colonna type --}}

                    <td class="text-center">{{$project->type ? $project->type->type : 'Nessuna tecnologia selezionata'}}</td>

                </tr>

        </tbody>
    </table>
</div>
<a class="nav-link my-2 text-end" href="{{route('project.index')}}">
    <button type="button" class="btn btn-primary">TORNA AI PROGETTI</button>
</a>

@endsection