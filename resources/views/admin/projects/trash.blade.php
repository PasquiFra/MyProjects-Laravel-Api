@extends('layouts.app')
@section('title', 'Cestino')
@section('content')


<h1 class="text-center">I miei progetti</h1>

<div class="d-flex w-100">
  <a class="btn btn-info" href="{{route('admin.projects.create')}}">Aggiungi nuovo</a>
</div>


<section id="projects-index" class="d-flex">

  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Titolo</th>
        <th scope="col">Stato</th>
        <th scope="col">Creato il</th>
        <th scope="col">Ultima modifica</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @forelse ($projects as $project)
      <tr>
        <th scope="row">1</th>
        <td>{{$project->title}}</td>
        <td>{{$project->is_published ? 'Pubblicato' : 'Bozza'}}</td>
        <td>{{$project->created_at}}</td>
        <td>{{$project->updated_at}}</td>
        <td class="edits">
          <a href="{{route('admin.projects.show', $project->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>
          <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
          <a href="{{route('admin.projects.destroy', $project->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
        </td>
      </tr>
      @empty
      <h1>Non ci sono progetti da mostrare</h1>
      @endforelse
    </tbody>
  </table>

</section>

@endsection