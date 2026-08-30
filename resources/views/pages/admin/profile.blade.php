@extends('layouts.app')
@section('content')
<x-layout.Admin.navbar :shop-name="$shopName"/>
<x-layout.Admin.sidebar />

<main class="max-w-[1200px] mx-auto px-4 md:px-16 py-6 pt-20 md:pt-24">
    <x-sections.profile.content :admin="$admin" :stats="$stats" :reviews="$reviews" />
</main>
@endsection