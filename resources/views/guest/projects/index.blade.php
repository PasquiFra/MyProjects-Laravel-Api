@extends('layouts.app')
@section('title', 'Progetti')
@section('content')

<h1 class="text-center my-4">I miei progetti</h1>

<section id="guest-index" class="d-flex">

    <ul class="w-100">
        @forelse ($projects as $project)
        <li  class="project">
            <a href="{{route('guest.projects.show', $project->id)}}">
                <h3 class="text-center py-3">{{$project->title}}</h3>
                <div class="d-flex">
                    <picture class="col-3">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{$project->slug}}">
                    </picture>
                    <p class="text-center col-9"> {{$project->description}} </p>
                </div>
                <div>
                    Tipologia: <strong style="color:{{$project->type->color ? $project->type->color : ''}}">{{$project->type->label}}</strong> 
                </div>
                <div>
                    Vai a GitHub: <a href="{{$project->project_url}}" class="link">{{$project->project_url}}</a>
                </div>
            </a>
        </li>  
        @empty
            <h1>Non ci sono progetti da mostrare</h1>
        @endforelse
    </ul>

</section>

@endsection