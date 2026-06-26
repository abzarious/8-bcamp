@extends('layouts.frontend')

@section('content')
<div class="max-w-4xl mx-auto my-6 space-y-6">
    <div class="p-6 bg-white shadow-xs rounded-xl border border-gray-100">
        <div class="max-w-2xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-6 bg-white shadow-xs rounded-xl border border-gray-100">
        <div class="max-w-2xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="p-6 bg-white shadow-xs rounded-xl border border-gray-100">
        <div class="max-w-2xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection