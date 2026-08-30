@extends('layouts.app')
@section('content')
    <x-layout.navbar :shop-name="$shopName" :cart-count="$cartCount ?? 0" />
    
    <x-sections.Header.header :images="$images" />

    <x-sections.preorder-header :shop-name="$shopName" :deadline="$deadline" />

    <x-sections.product-grid :products="$products" />

    <x-layout.whatsapp-button :number="$whatsappNumber" />
@endsection

