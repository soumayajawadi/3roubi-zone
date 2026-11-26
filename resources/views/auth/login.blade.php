@extends('layouts.app')

@section('title', 'Connexion - 3roubi Zone')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center align-items-center">
        
        <div class="col-md-5">
            <div class="bg-white p-5 rounded-4 border-0" style="box-shadow: 0 20px 40px rgba(220, 38, 38, 0.15);">
                <div class="text-center mb-4">
                    <img src="https://i.pinimg.com/736x/ae/2d/db/ae2ddb41289492c17f9851b0833588f7.jpg" alt="Logo" style="height: 70px; width: 70px; object-fit: contain; border-radius: 50%; filter: drop-shadow(0 4px 8px rgba(220, 38, 38, 0.4));">
                    <h2 class="fw-bold mt-3 text-dark">Bon retour !</h2>
                    <p class="text-muted">Connectez-vous pour continuer vos achats.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email</label>
                        <input id="email" type="email" class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Entrez votre email" style="box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold small text-uppercase text-muted">Mot de passe</label>
                        <input id="password" type="password" class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Entrez votre mot de passe" style="box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small" for="remember">Se souvenir de moi</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="small text-decoration-none fw-bold" href="{{ route('password.request') }}" style="color: #dc2626;">Mot de passe oublié ?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-lg w-100 fw-bold rounded-pill py-3 text-white" style="background-color: #dc2626; border: none; box-shadow: 0 8px 20px rgba(220, 38, 38, 0.4); transition: all 0.3s;">LOG IN</button>
                </form>
            </div>
        </div>

        
        <div class="col-md-6 d-none d-md-block">
        
            <div class="rounded-4" style="height: 550px; background-image: url('https://i.pinimg.com/736x/ae/2d/db/ae2ddb41289492c17f9851b0833588f7.jpg'); background-size: cover; background-position: center; position: relative; overflow: hidden; box-shadow: 0 20px 50px rgba(220, 38, 38, 0.3);">
               
                <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(to bottom, rgba(220, 38, 38, 0.7), rgba(0, 0, 0, 0.7));"></div>
                
                <div class="text-white text-center p-5 d-flex flex-column justify-content-center h-100" style="position: relative; z-index: 2;">
                    <h1 class="display-3 fw-bold mb-3 text-uppercase" style="letter-spacing: 2px; text-shadow: 0 4px 10px rgba(0,0,0,0.5);">3roubi Zone</h1>
                    <p class="fs-4 fw-light">Le goût authentique de la Tunisie, livré chez vous.</p>
                    <p class="fs-5 text-white mt-3" dir="rtl">نكهات تونس الأصيلة في كل بيت</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection