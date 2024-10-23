<div x-data="notif" class="z-50 relative top-full left-0 w-full flex justify-center">
    <div x-on:user-updated.window="showNotif" style="z-index: 9999;"
        id="notif"
        class="@if(session('message')) slide @endif fixed -translate-y-full bg-slate-100 bg-opacity-10 text-slate-900 rounded-3xl backdrop-blur-lg shadow-lg px-3 py-2 flex items-center justify-center space-x-2 ease-in-out">
        <span class="bi bi-bell text-xl text-slate-700 bg-slate-200 p-2 rounded-full"></span>
        <span class="text-sm">{{ $message ?? session('message') }}</span>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('notif', () => ({
                notif: document.querySelector("#notif"),
                slideFrames: [
                    {
                        transform: "translateY(-100%)",
                        filter: "blur(6px)",
                    },
                    {
                        transform: "translateY(20%)", 
                        filter: "blur(3px)",
                        offset: 0.03
                    },
                    {
                        transform: "translateY(30%)", 
                        filter: "blur(0px)",
                        offset: 0.05
                    },
                    {
                        transform: "translateY(32%)",
                        offset: 0.1
                    },
                    {
                        transform: "translateY(40%)", 
                        filter: "blur(0px)",
                        offset: 0.5
                    },
                    {
                        transform: "translateY(40%)", 
                        filter: "blur(0.4px)",
                        offset: 0.95
                    },
                    {
                        transform: "translateY(-200%)", 
                        filter: "blur(5px)",
                        offset: 1
                    },
                ],
                slideTiming: {
                    duration: 5000,
                    timingFunction: "ease-in-out",
                },

                showNotif(event) {
                    this.notif.animate(this.slideFrames, this.slideTiming);  
                },
            }))
        })
    </script>
</div>