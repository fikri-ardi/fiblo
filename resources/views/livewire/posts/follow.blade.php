<button wire:click="follow" class="text-gray-500 hover:text-gray-600">
    <span class="bi bi-person-{{ auth()->user()->wasFollow($author) ? 'check' : 'plus' }}-fill mr-1"></span>
</button>