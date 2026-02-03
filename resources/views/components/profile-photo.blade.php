{{--
    Profile Photo Component
    
    Shows a user's profile picture or a default person icon.
    
    Examples:
    <x-profile-photo :user="$professional" size="lg" />
    <x-profile-photo :user="$user" size="sm" />
--}}

@props(['user', 'size' => 'lg'])

@php
    $sizeClasses = match($size) {
        'sm' => 'w-12 aspect-square',
        'md' => 'w-20 aspect-square',
        'lg' => 'w-[200px] aspect-square',
        default => 'w-[200px] aspect-square',
    };
@endphp

@if($user->profile_photo_path)
    <img class="rounded-full {{ $sizeClasses }} object-cover border-4 border-primary_color" 
         src="{{ asset('storage/' . $user->profile_photo_path) }}" 
         alt="{{ $user->name }}">
@else
    <div class="rounded-full {{ $sizeClasses }} bg-gray-200 flex items-center justify-center border-4 border-primary_color">
        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
    </div>
@endif
