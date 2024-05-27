<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white block mt-6 p-6 pt-2 border-gray-300 rounded-md shadow-sm">
            <h2 class="text-2xl font-bold">{{ $contact->first_name }} {{ $contact->last_name }}</h2>
            @if ($contact->profile_photo_path)
                <img src="{{ asset('storage/' . $contact->profile_photo_path) }}" alt="Profile Photo" class="mt-4 rounded-md w-32 h-32">
            @endif
            <p class="mt-4"><strong>Teléfono:</strong> {{ $contact->phone }}</p>
            <p class="mt-2"><strong>Correo electrónico:</strong> {{ $contact->email }}</p>
            <p class="mt-2"><strong>Dirección:</strong> {{ $contact->address }}</p>
            <p class="mt-2"><strong>Notas:</strong> {{ $contact->notes }}</p>
        </div>
    </div>
</x-app-layout>
