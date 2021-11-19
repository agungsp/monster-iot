@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'TEST')

{{-- TITLE CONTENT --}}
@section('title-content', 'TEST')

{{-- CONTENT --}}
@section('content')
    <x-accordion id="myAccordion">
        <x-accordion-item header-label="Header Satu" component-id="menuSatu" is-open="true">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed sit soluta eius iure numquam tempora ratione odio enim molestiae quidem odit dolorum, nihil illum recusandae ab dicta. Deleniti, exercitationem modi?
        </x-accordion-item>

        <x-accordion-item header-label="Header Dua" component-id="menuDua">
            nihil illum recusandae ab dicta. Deleniti, exercitationem modi?
        </x-accordion-item>
    </x-accordion>
@endsection

{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
@endsection
