@extends('layouts.app')

@section('title', 'À Propos - 3roubi Zone')

@section('content')
<div class="container mt-5">
    <h1 class="fw-bold text-center mb-5">À Propos de 3roubi Zone</h1>
    
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <img src="https://i.pinimg.com/736x/ae/2d/db/ae2ddb41289492c17f9851b0833588f7.jpg" class="img-fluid rounded-4 shadow" style="max-height: 300px;">
        </div>
        <div class="col-md-6">
            <h3 class="fw-bold">Notre Mission</h3>
            <p class="text-muted">Retrouvez le goût authentique de la Tunisie, où que vous soyez. Nous vous livrons les meilleurs produits tunisiens directement chez vous.</p>
            <p class="text-muted">Basé à Charguia 1, Tunis, notre boutique en ligne vous propose une sélection de produits artisanaux, épices, et pâtisseries.</p>
        </div>
    </div>

    <div class="card p-4 shadow-sm border-0">
        <h4 class="fw-bold mb-3">📍 Notre Localisation</h4>
        <!-- HNA EL FIX: Google Maps Iframe -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3238.895269776568!2d10.272247315368302!3d36.84768998093733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd351e3c3a3a3b%3A0x3a3a3a3a3a3a3a3a!2sCharguia%201%2C%20Tunis!5e0!3m2!1sen!2stn!4v1620000000000!5m2!1sen!2stn" width="100%" height="400" style="border:0; border-radius: 15px;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>
@endsection