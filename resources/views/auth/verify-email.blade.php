@extends('layouts.app')
@section('title', 'Vérification email')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 px-4 py-12">
    <div class="w-full max-w-md text-center">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-envelope text-indigo-600 text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Vérifiez votre email</h2>
            <p class="text-gray-500 text-sm mb-6">
                Un lien de vérification a été envoyé à votre adresse email. Cliquez sur le lien pour activer votre compte.
            </p>
            <form action="{{ route('verification.resend') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-semibold hover:bg-indigo-700 transition mb-4">
                    Renvoyer le lien de vérification
                </button>
            </form>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-gray-400 hover:text-gray-600">Se déconnecter</button>
            </form>
        </div>
    </div>
</div>
@endsection
