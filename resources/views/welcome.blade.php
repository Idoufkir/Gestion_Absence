@include('layout.partials.header')
@extends('layout')

@section('content')

<main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
    <div class="md:flex container border p-4">
        <div class="md:flex-shrink-0">
            <img class="rounded-lg md:w-56"
                src="https://peoplespheres.com/wp-content/uploads/2019/02/conges_absences.png"
                alt="Woman paying for a purchase">
        </div>
        <div class="mt-4 md:mt-0 md:ml-6">
            <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">SEOCom</div>
            <div class="content-center mx-2.5">
                <a href="{{ url('/') }}" class="leading-tight font-semibold text-gray-900">Gestion des Absences</a>
            </div>
            <p class="mt-2 text-gray-600">Exemple app Laravel / MySQL</p>
        </div>
    </div>
    @auth
    <div class="p-3">
        <form action="{{ route('motifs.store') }}" method="POST" style="display: inline-block">
            @csrf
            <button onclick="openModal(true)"
                class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none" type="submit">
                Présent(e)
            </button>
        </form>
    </div>
    <!-- overlay -->
    <div id="modal_overlay"
        class="hidden absolute inset-0 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0">

        <!-- modal -->
        <div id="modal"
            class="bg-blue-500 hover:bg-red-600 opacity-0 transform -translate-y-full scale-150  relative w-6/8 md:w-1/2 h-1/2 md:h-1/5 bg-white rounded shadow-lg transition-opacity transition-transform duration-300">

            <!-- button close -->
            <button onclick="openModal(false)"
                class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
                &cross;
            </button>
            <!-- header -->
            <div class="px-4 py-3 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-600">Validation de présence</h2>
            </div>

            <!-- body -->
            <div class="w-full p-3">
                Présence réussie
            </div>

        </div>

    </div>

    <script>
    const modal_overlay = document.querySelector('#modal_overlay');
    const modal = document.querySelector('#modal');

    function openModal(value) {
        const modalCl = modal.classList
        const overlayCl = modal_overlay

        if (value) {
            overlayCl.classList.remove('hidden')
            setTimeout(() => {
                modalCl.remove('opacity-0')
                modalCl.remove('-translate-y-full')
                modalCl.remove('scale-150')
            }, 100);
        } else {
            modalCl.add('-translate-y-full')
            setTimeout(() => {
                modalCl.add('opacity-0')
                modalCl.add('scale-150')
            }, 100);
            setTimeout(() => overlayCl.classList.add('hidden'), 300);
        }
    }
    </script>

    @endauth
</main>
</div>
</div>
<div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
    <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ url('/images/image-bg.png') }}"
        alt="Image">
</div>
</div>

@endsection