<div class="text-left">
    <!-- Desde 640 en adelante -->
    <button wire:click="create()" class="hidden lg:flex bg-green-300 hover:bg-green-400 text-white-900 font-bold py-2 px-4 mb-2 rounded" style="width: max-content;">
        <svg fill="#000000" height="20px" width="20px" class="h-6 w-6 mr-2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-51.2 -51.2 614.40 614.40" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <polygon points="289.391,222.609 289.391,0 222.609,0 222.609,222.609 0,222.609 0,289.391 222.609,289.391 222.609,512 289.391,512 289.391,289.391 512,289.391 512,222.609 "></polygon> </g> </g> </g></svg>
        {{ $slot }}
    </button>

    <!-- Menos 640 en adelante -->
    <button wire:click="create()" class="lg:hidden bg-green-300 hover:bg-green-400 text-white-900 font-bold py-1 px-1 mt-1 mb-2 rounded">
        <svg fill="#000000" height="20px" width="20px" class="h-6 w-6" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-51.2 -51.2 614.40 614.40" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <polygon points="289.391,222.609 289.391,0 222.609,0 222.609,222.609 0,222.609 0,289.391 222.609,289.391 222.609,512 289.391,512 289.391,289.391 512,289.391 512,222.609 "></polygon> </g> </g> </g></svg>
        {{-- {{ $slot }} --}}
    </button>
</div>