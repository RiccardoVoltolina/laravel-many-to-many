@extends('layouts.admin')

@section('content')


<div class="col-6 mx-auto">
    {{-- se il validation messo nella funzione store riscontra degli errori, allora stampo in pagina un messaggio di errore --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        <h1 class="my-3">CREA UN NUOVO PROGETTO</h1>


        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
            <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Scrivi un titolo per il tuo progetto" value="{{ old('title') }}">
            <small id="titleHelper" class="form-text text-muted">Scrivi un titolo per il tuo progetto</small>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
            <input type="text" class="form-control" name="description" id="description" aria-describedby="helpId" placeholder="Scrivi una descrizione per il tuo progetto" value="{{ old('description') }}">
            <small id="descriptionHelper" class="form-text text-muted">Scrivi una descrizione per il tuo progetto</small>
        </div>

        <div class="mb-3">
            <label for="githublink" class="form-label">Link Github</label>
            {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
            <input type="url" class="form-control" name="githublink" id="githublink" aria-describedby="helpId" placeholder="Scrivi una descrizione per il tuo progetto" value="{{ old('githublink') }}">
            <small id="githublinkHelper" class="form-text text-muted">Scrivi il link del tuo progetto github</small>
        </div>

        <div class="mb-3">
            <label for="projectlink" class="form-label">Link Progetto</label>
            {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
            <input type="url" class="form-control" name="projectlink" id="projectlink" aria-describedby="helpId" placeholder="Scrivi una descrizione per il tuo progetto" value="{{ old('projectlink') }}">
            <small id="projectlinkHelper" class="form-text text-muted">Scrivi il link del tuo progetto github</small>
        </div>

        <div class="mb-3">
            <label for="thumb" class="form-label">Scegli una immagine</label>
            <input type="file" class="form-control" name="thumb" id="thumb" placeholder="Scegli una immagine per il tuo progetto" aria-describedby="thumb_helper" value="{{ old('thumb') }}">
            <div id="thumb_helper" class="form-text">Inserisci una immagine</div>
        </div>

        <div class="mb-3">
            <label for="authors" class="form-label">Autore/i</label>
            {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
            <input type="text" class="form-control" name="authors" id="authors" aria-describedby="help" placeholder="Scrivi gli autori del tuo progetto" value="{{ old('authors') }}">
            <small id="authorsHelper" class="form-text text-muted">Scrivi gli autori del tuo progetto</small>
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Tecnologie:</label>
            <select class="form-select @error('type_id') is-invalid  @enderror" name="type_id" id="type_id">
                <option selected disabled>Seleziona una tecnologia</option>
                <option value="">Uncategorized</option>
        
                @forelse ($types as $type)
                <option value="{{$type->id}}" {{ $type->id == old('type_id') ? 'selected' : '' }}>{{$type->type}}</option>
                @empty
        
                @endforelse
        
        
            </select>
        </div>
        @error('type_id')
        <div class="text-danger">{{$message}}</div>
        @enderror


        <button type="submit" class="btn btn-primary">Aggiungi progetto</button>
    </form>
    <a class="nav-link my-2 text-end" href="{{route('project.index')}}">
        <button type="button" class="btn btn-warning">TORNA AI PROGETTI</button>
    </a>
</div>


@endsection