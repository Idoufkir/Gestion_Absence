@extends('layout')

@section('content')

<div class="border p-8 content-center">
<div class="bg-indigo-600">
  <div class="md:text-center max-w-7xl mx-auto py-3 px-3 lg:px-4">
      <form >
        <input value="Create Employe" class="btn btn-light" disabled/>
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
  <form class="bg-white shadow-md px-4 pt-6 pb-6 mb-6" method="post" action="{{ route('employes.store') }}">
    
  <div class="mb-4">
        @csrf
      <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="name">
          Name
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="name">
    </div>
    <div class="mb-4">
      <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="email">
        Email
      </label>
      <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"  type="email" name="email">
    </div>
    <div class="mb-4">
      <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="intitule">
      Intitulé
      </label>
      <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" name="intitule">
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
      Create Employe
      </button>
    </div>
    
  </form>
</div>
</div>
</div>
</div>
@endsection