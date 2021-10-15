@extends('layout')

@section('content')



<div class="border p-8 content-center">
  <div class="bg-indigo-600 p-6">
    <div class="md:text-center max-w-7xl mx-auto py-3 px-3 lg:px-4">
    @auth
      <form action="{{ route('employes.create') }}">
        <input type="submit" value="Create Employe" class="btn btn-light" />
        @csrf
      </form>
    @endauth
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
        <div class="w-full max-w-xl">

          <table class="table shadow-lg bg-blue-100 bg-opacity-60">
            <thead>
              <tr class="bg-gray-50">
              @auth
                <td class="text-center">#</td>
                @endauth
                <td class="text-center">Name</td>
                <td class="text-center">Email</td>
                <td class="text-center">Intitulé</td>
                @auth
                <td class="text-center">Action</td>
                @endauth
              </tr>
            </thead>
            <tbody>
              @foreach($employe as $employes)
              <tr>
              @auth
                <td class="text-center">{{$employes->id}}</td>
                @endauth
                <td class="text-center">{{$employes->name}}</td>
                <td class="text-center">{{$employes->email}}</td>
                <td class="text-center">{{$employes->intitule}}</td>
                @auth
                <td class="text-center">
                  <a href="{{ route('employes.edit', $employes->id)}}" class="btn btn-primary btn-sm">Edit</a>
                  <form action="{{ route('employes.destroy', $employes->id)}}" method="post"
                    style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
                </td>
                @endauth
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

    @endsection