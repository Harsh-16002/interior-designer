@extends('user.layout')

@section('title', 'Home')

@section('content')

    @include('user.partials.header',['values' => $values ,'contact'=>$contact])
    @include('user.partials.hero',['hero'=> $hero])
    @include('user.partials.about',['about'=>$about])
    @include('user.partials.project',['projects'=>$projects])
    @include('user.partials.services', [ 'services' => $services,'counter' => $counter])
    @include('user.partials.testimonial',['testimonials'=>$testimonials])
    @include('user.partials.team',['team'=>$team])
    @include('user.partials.why-us',['whyUS'=>$whyUs])
    @include('user.partials.footer', ['values' => $values, 'footer' => $footer ,'contact'=>$contact])
    
   
   
   
    
    {{-- @include('user.partials.latest') --}}


@endsection
