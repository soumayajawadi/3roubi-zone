@extends('layouts.app')

@section('title', 'Contact - 3roubi Zone')

@section('content')
<div class="container mt-5 mb-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-4 text-danger">📞 Contactez-nous</h1>
        <p class="fs-5 text-muted">Une question ? Une réclamation ? Nous sommes là pour vous aider.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white p-5 rounded-4 shadow-sm border">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nom complet</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Sujet</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Message</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold">Envoyer le message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection