@extends('layouts.app')
@section('title', 'Modifier mon profil')
@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('profile.show') }}" class="text-sm text-indigo-600 hover:underline">
            <i class="fas fa-arrow-left"></i> Mon profil
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Modifier mon profil</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            {{-- Avatar --}}
            <div class="flex items-center gap-4 pb-5 border-b">
                <div class="w-16 h-16 rounded-full bg-indigo-100 overflow-hidden flex items-center justify-center text-2xl font-bold text-indigo-600">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Photo de profil</label>
                    <input type="file" name="avatar" accept="image/*"
                        class="text-sm text-gray-500">
                    <p class="text-xs text-gray-400 mt-0.5">JPG, PNG — Max 1Mo</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nom complet *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('name') border-red-500 @enderror">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('email') border-red-500 @enderror">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Téléphone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                    placeholder="+33 6 00 00 00 00"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse de livraison</label>
                <textarea name="address" rows="2"
                    placeholder="Votre adresse complète..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none">{{ old('address', $user->address) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Bio</label>
                <textarea name="bio" rows="3"
                    placeholder="Quelques mots sur vous..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none">{{ old('bio', $user->bio) }}</textarea>
            </div>

            {{-- Password change --}}
            <div class="border-t pt-5">
                <h3 class="font-semibold text-gray-800 mb-4">Changer le mot de passe <span class="text-sm font-normal text-gray-400">(optionnel)</span></h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mot de passe actuel</label>
                        <input type="password" name="current_password" placeholder="••••••••"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('current_password') border-red-500 @enderror">
                        @error('current_password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nouveau mot de passe</label>
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirmer</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-1"></i> Enregistrer
                </button>
                <a href="{{ route('profile.show') }}"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
