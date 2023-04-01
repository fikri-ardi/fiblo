<button wire:click="follow"
    class="{{ auth()->user()->wasFollow($targetUser) ? 'text-slate-800 bg-slate-200' : 'text-slate-200 bg-slate-800' }} px-3 py-2 rounded-full hover:bg-opacity-80">
    <span wire:loading class="bi bi-arrow-clockwise animate-spin"></span>
    <span wire:loading.remove>{{ auth()->user()->wasFollow($targetUser) ? 'Following' : 'Follow' }}</span>
</button>