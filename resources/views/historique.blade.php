@extends('layout')

@section('content')



<div class="border p-8 content-center">
  <div class="bg-indigo-600 p-6">
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
                <td class="text-center">Name</td>
                <td class="text-center">Intitule</td>
                <td class="text-center">Retard</td>
                <td class="text-center">Absent</td>
                <td class="text-center">Conge</td>
                <td class="text-center"></td>
              </tr>
            </thead>
            <tbody>
              @foreach($historique as $historiques)
              <tr>
                <td class="text-center">{{$historiques->user->name}}</td>
                <td class="text-center">{{$historiques->user->intitule}}</td>
                <td class="text-center">{{$historiques->retard}} Minutes</td>
                <td class="text-center">{{$historiques->absent}} Jours</td>
                <td class="text-center">{{$historiques->conge}} Jours</td>
                {{-- <td class="text-center">
                  <a href="{{ route('historiques.edit', $historiques->id)}}" class="btn btn-primary btn-sm">Edit</a>
                  <form action="{{ route('historiques.destroy', $historiques->id)}}" method="post"
                    style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
                </td> --}}

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

    @endsection