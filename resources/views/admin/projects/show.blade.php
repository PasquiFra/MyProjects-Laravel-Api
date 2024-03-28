@extends('layouts.app')
@section('title', $project->title)
@section('content')

<h1 class="text-center my-3">{{$project->title}}</h1>

<section id="show-index" class="d-flex">
    <div class="edits">

        <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-warning">
            <i class="fa-solid fa-pen"></i>
            <span>Modifica</span>
        </a>
        <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" 
            class="btn btn-danger" id="form-delete">
            @method('delete')
            @csrf
            <i class="fa-solid fa-trash"></i>
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>

    </div>

    @include('admin.form.result-feedback')

    <div  class="project">
        <div>
            Descrizione: 
            <strong><p> {{$project->description}} </p></strong> 
        </div>
        <div class="" id="show-image">
            <img src="{{ asset('storage/' . $project->image) }}" alt="{{$project->slug}}">
        </div>
        <ul>
            <li>
                Vai a GitHub: <a href="{{$project->project_url}}" class="link">{{$project->project_url}}</a>
            </li>
            <li>
                Slug: <strong>{{$project->slug}}</strong> 
            </li>
            <li>
                Tipologia: <strong style="color:{{$project->type->color ? $project->type->color : ''}}">{{$project->type->label}}</strong> 
            </li>
            <li>
                Tecnologie: 
                @forelse ($project->technologies as $tech)
                <span style="color:{{$tech->color}}">{{$tech->label}}</span>
                  @if ($loop->last)
                  <span></span>
                  @else
                  <span>|</span>
                  @endif
                @empty
                @endforelse
            </li>

            <li>
                Stato: 
                <strong><span class="{{$project->is_published ? 'text-success' : 'text-warning'}}">{{$project->is_published ? 'Pubblicato' : 'Bozza'}}</span></strong>
            </li>
            <li>
                Creato il: <strong>{{$project->created_at}}</strong>
            </li>
            <li>
                Ultima modifica: <strong>{{$project->updated_at}}</strong>
            </li>
        </ul>
    </div>  
    
</section>

@endsection


@section('scripts')
    @include('scripts.delete-confirmation')
@endsection