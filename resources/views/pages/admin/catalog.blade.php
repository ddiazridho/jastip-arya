@extends('layouts.app')
@section('content')
    <x-layout.Admin.navbar :shop-name="$shopName"/>
    <x-layout.Admin.sidebar />

    <x-sections.Header.header :images="$images" />

    <x-sections.Admin.preorder-header :shop-name="$shopName" :deadline="$deadline" />

    <x-sections.Admin.product-grid :products="$products" />

    <x-layout.whatsapp-button :number="$whatsappNumber" />
@endsection

