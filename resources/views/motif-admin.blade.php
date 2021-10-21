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
        <div class="w-full max-w-xxl">
          <table class="table shadow-lg bg-blue-100 bg-opacity-60">
            <thead>
              <tr class="bg-gray-50">
                <td class="text-center">Date</td>
                <td class="text-center">Name</td>
                <td class="text-center">Motif</td>
                <td class="text-center">Durée</td>
                <td class="text-center">Comment</td>
                <td class="text-center"></td>
              </tr>
            </thead>
            <tbody>
              @foreach($motif as $motifs)
              <tr>
                <td class="text-center">{{ $motifs->created_at->format('d / m / Y') }}</td>
                <td class="text-center">{{$motifs->user->name}}</td>
                @php
                $mofiName = $motifs->Motifname;
                if ($mofiName == "Retard")
                    $valeur = "Minutes";
                else 
                    $valeur = "Jours";    
                
                @endphp
                <td class="text-center">{{$motifs->Motifname}}</td>
                <td class="text-center">{{$motifs->duration}} {{$valeur}}</td>
                <td class="text-center">{{$motifs->comment}}</td>
                @auth
                <td class="text-center">
                  <a href="{{ route('motifs.edit', $motifs->id)}}" class="btn btn-primary btn-sm">Edit</a>
                  <form action="{{ route('motifs.destroy', $motifs->id)}}" method="post"
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