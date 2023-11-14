<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // passo tutti i risultati in pagina in ordine decrescente

        $projects = Project::orderByDesc('id')->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // passo tutti i dati del model Type alla variabile types

        $types = Type::all();

        $technologies = Technology::all();
        
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:50|min:2',
            'description' => 'nullable|max:1000|min:2',
            'authors' => 'nullable|max:50|min:2',
            'thumb' => 'nullable|mimes:jpg,bmp,png|max:300',
            'githublink' => 'nullable|url:http,https',
            'projectlink' => 'nullable|url:http,https',
        ]);

        $project = new Project();

     

        if ($request->has('thumb')) {
            $file_path =  Storage::put('projects_images', $request->thumb);
            $project ->thumb = $file_path;
        }

        $project->githublink = $request->githublink;
        $project->projectlink = $request->projectlink;
        $project->description = $request->description;
        $project->title = $request->title;
        $project->authors = $request->authors;
        
        

        // aggiungo anche il campo del type_id, per inviarlo al database

        $project->type_id = $request->type_id;


        $project->save();

        // IMPORTANTE: prima di usare atach, bisogna eseguire il save del progetto, senò non funziona!

        // prendo i dati della richiesta e lo passo nel model Technology e tramite attach, creo il collegamento nella tabella condivisa tra project e tecnology
        
        $project->technologies()->attach($request->technologies);

        return to_route('project.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        $technologies = Technology::all();

        return view('admin.projects.show', compact('project', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // passo tutti i dati del model Type alla variabile types

        $types = Type::all();

        $technologies = Technology::all();


        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     * RICORDARSI DI AGGIUNGERE $FILLABLE NEL MODEL
     */
    public function update(Request $request, Project $project)
    {

        $validated = $request->validate([
            'title' => 'required|max:50|min:2',
            'description' => 'nullable|max:1000|min:2',
            'authors' => 'nullable|max:50|min:2',
            'thumb' => 'nullable|mimes:jpg,bmp,png|max:300',
            'githublink' => 'nullable|url:http,https',
            'projectlink' => 'nullable|url:http,https',
        ]);
        
        
        
        $data = $request->all();

        // prendo le richieste hanno una immagine
        
        if ($request->has('thumb')) {

            // aggiungo a $file_path l'immagine e la mette nello storage nella cartella projects_images

            $file_path =  Storage::put('projects_images', $request->thumb);

            // prendo il $data, che contiene tutte le richieste, seleziono il thumb e gli dico che è ugiuale a $file_path

            $data["thumb"] = $file_path;
        }

        // eseguo un detach per rimuovere tutti i vecchi collegamenti con le tecnologie

        $project->technologies()->detach();


        // aggiorno i dati del mio progetto
        $project->update($data);


        // prendo i dati della richiesta e lo passo nel model Technology e tramite attach, creo il collegamento nella tabella condivisa tra project e tecnology

        $project->technologies()->attach($request->technologies);

        return redirect()->route('project.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();

        $project->delete();
        
        return redirect()->route('project.index')->with('messaggio', 'hai cancellato il progetto con successo!');    }
}
