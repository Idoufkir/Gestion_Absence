@include('layout.partials.header')
@extends('layout')

@section('content')

<main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
      <div class="md:flex container border p-4">
                    <div class="md:flex-shrink-0">
                        <img class="rounded-lg md:w-56" src="https://peoplespheres.com/wp-content/uploads/2019/02/conges_absences.png" alt="Woman paying for a purchase">
                    </div>
                    <div class="mt-4 md:mt-0 md:ml-6">
                        <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">SEOCom</div>
                        <a href="{{ url('/') }}" class="block mt-1 text-lg leading-tight font-semibold text-gray-900 hover:underline">Gestion des Absences</a>
                        <p class="mt-2 text-gray-600">Exemple app Laravel / MySQL</p>
                    </div>
                </div>
      </main>
    </div>
  </div>
  <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
    <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ url('/images/image-bg.png') }}" alt="Image">
  </div>
</div>

@endsection