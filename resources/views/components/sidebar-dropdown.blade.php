@props(['active' => false])

<div class="space-y-1" x-data="{ open: @json($active) }">
    <button @click="open = !open" class="flex items-center w-full px-3 py-2 text-sm font-medium rounded-md text-gray-400 hover:text-white hover:bg-gray-700">
        {{ $trigger }}
        <svg class="w-5 h-5 ml-auto transform transition-transform duration-200" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    <div x-show="open" x-collapse class="pl-8 space-y-1">
        {{ $content }}
    </div>
</div>
