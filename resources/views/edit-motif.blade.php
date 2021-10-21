
@extends('layout.mainlayout')
@section('content')

<div class="border p-8 content-center">
<div class="bg-indigo-600 p-6">

  <div class="md:text-center max-w-7xl mx-auto py-3 px-3 lg:px-4">
      <form >
        <input value="Edit & Update" class="btn btn-light" disabled/>
      </form>
    </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <div class="flex flex-col justify-center items-center">
<div class="w-full max-w-xl ">
  <form class="bg-white shadow-md bg-opacity-60 px-4 pt-6 pb-6 mb-6" method="post" action="{{ route('motifs.update', $motif->id) }}">
    
  <div class="mb-4">
        @csrf
        @method('PATCH')
      <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="Motifname">
        Motif Name
      </label>
  <select name="Motifname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    <option value="{{ $motif->Motifname }}" selected>{{ $motif->Motifname }}</option>                             
      <option value="Absent"{{($motif->Motifname === 'Absent') ? 'selected' : '' }} >Absent</option>
      <option value="Retard" {{ ($motif->Motifname === 'Retard'? 'selected' : '')}}>Retard</option>
      <option value="Jour férié" {{($motif->Motifname === 'Jour férié')? 'Jour férié' : ''}}>Jour  férié</option>
      <option value="congé" {{($motif->Motifname === 'congé')? 'congé' : ''}}>Congé</option>
    </select>    
    </div>
    <div class="mb-4">
      <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="duration">
        Duration
      </label>
      <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="duration" type="number" name="duration" value="{{ $motif->duration }}">
    </div>
    <div class="mb-4">
      <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="comment">
      Comment
      </label>
      <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="comment" type="text" name="comment" value="{{ $motif->comment }}">
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
      Update Motif
      </button>
    </div>
    
  </form>
</div>
</div>
</div>
</div>
@endsection