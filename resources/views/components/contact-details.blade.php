<div class="bg-white block mt-6 p-6 border-gray-300 hover:border-indigo-300 hover:ring hover:ring-indigo-200 hover:ring-opacity-50 rounded-md shadow-sm">
    <div class="flex justify-end">
        <x-dropdown>
            <x-slot name="trigger">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link :href="route('contacts.show', $contact)">
                    Ver
                </x-dropdown-link>
                <x-dropdown-link :href="route('contacts.edit', $contact)">
                    Editar
                </x-dropdown-link>
                <form method="POST" action="{{ route('contacts.destroy', $contact) }}">
                    @csrf
                    @method('delete')
                    <x-dropdown-link :href="route('contacts.destroy', $contact)" onclick="event.preventDefault(); this.closest('form').submit();">
                        Eliminar
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
    <div class="flex items-center">
        <div class="flex-shrink-0">
            @if ($contact->profile_photo_path)
                <img src="{{ asset('storage/' . $contact->profile_photo_path) }}" alt="Profile Photo" class="h-12 w-12 rounded-full object-cover">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-600 -scale-x-100" viewBox="0 0 24 24" xml:space="preserve">
                    <path d="M12 20H0v-3.5c0-2.4 1.3-4.5 3.2-5.6C2.5 10.2 2 9.2 2 8.1c0-2.2 1.8-4 4-4s4 1.8 4 4c0 1.1-.4 2.1-1.2 2.8 1.9 1.1 3.2 3.3 3.2 5.6V20zM2 18h8v-1.5c0-2.4-1.8-4.5-4-4.5-2.1 0-4 2.1-4 4.5V18zM6 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm18 11H14v-2h10v2zm-3-4h-7v-2h7v2zm3-4H14V7h10v2z"/>
                </svg>
            @endif
        </div>
        <div class="flex-1 min-w-0 ms-4">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-black">{{ $contact->first_name }} {{ $contact->last_name }}</p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">{{ $contact->email }}</p>
        </div>
        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-black">{{ $contact->phone }}</div>
    </div>
</div>
