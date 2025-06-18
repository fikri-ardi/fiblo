<div>
    {{-- Progressive blur post --}}
    <div x-data="{cardBlur: false}" @mouseover="cardBlur = true" @mouseleave="cardBlur = false" class="relative cursor-pointer w-[19.5rem] rounded-[32px] h-[450px] p-[0.65rem] overflow-hidden bg-cover bg-center"
    style="background-image: url(https://plus.unsplash.com/premium_photo-1690562161359-12c7332a6e30?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)"
    >
        {{-- Save Button --}}
        <button class="absolute z-40 top-0 right-0 bg-white bg-opacity-10 backdrop-blur-lg m-[0.78rem] p-[0.6rem] rounded-full">
            <i class="bi bi-bookmark-plus text-white"></i>
        </button>
        
        {{-- Content --}}
        <div class="relative z-40 h-full text-white flex flex-col justify-end">
            {{-- Header --}}
            <div class="flex justify-between items-center">
                <div class="text-[23px] font-bold">Impostor Syndrome</div>
                <div class="flex space-x-1 text-sm items-center backdrop-blur-lg py-1 px-2 rounded-full bg-white bg-opacity-10">
                    <i class="bi bi-eye"></i>
                    <span class="font-semibold">890</span>
                </div>
            </div>

            {{-- Body --}}
            <p class="text-[1rem] w-3/4 text-gray-300">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, commodi temporibus?</p>
            
            {{-- Footer --}}
            <div class="flex text-sm font-semibold space-x-2">
                <div class="backdrop-blur-lg b bg-white bg-opacity-10 py-1 px-2 rounded-full flex items-center space-x-1">
                    <i class="bi bi-bookmark"></i>
                    <span>Life</span>
                </div>
                <div class="backdrop-blur-lg b bg-white bg-opacity-10 py-1 px-2 rounded-full">1 min read</div>
                <div class="backdrop-blur-lg b bg-white bg-opacity-10 py-1 px-2 rounded-full">27 May</div>
            </div>

            <a href="#" class="bg-white w-full py-2 text-lg text-slate-900 rounded-full text-center font-bold mt-4">
                Read Now
            </a>
        </div>

        {{-- Progressive Blur --}}
        <div :class="cardBlur ? '!h-full' : ''" class="absolute left-0 right-0 bottom-0 w-full h-[63%] pointer-events-none transition-all duration-1000 ease-in-out">
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <!-- this gradient hides the glitching -->
            <div class="gradient absolute top-0 left-0 right-0 bottom-0 bg-gradient-to-t from-[#0000005a] to-transparent"></div>
        </div>
    </div>
</div>
<x-slot name="style">
    <style>
        .blur-filter {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        }

        .blur-filter:nth-child(1) {
        backdrop-filter: blur(1px);
        mask: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 1) 10%, rgba(0, 0, 0, 1) 30%, rgba(0, 0, 0, 0) 40%);
        }

        .blur-filter:nth-child(2) {
        backdrop-filter: blur(2px);
        mask: linear-gradient(rgba(0, 0, 0, 0) 10%, rgba(0, 0, 0, 1) 20%, rgba(0, 0, 0, 1) 40%, rgba(0, 0, 0, 0) 50%);
        }
        
        .blur-filter:nth-child(3) {
        backdrop-filter: blur(4px);
        mask: linear-gradient(rgba(0, 0, 0, 0) 15%, rgba(0, 0, 0, 1) 30%, rgba(0, 0, 0, 1) 50%, rgba(0, 0, 0, 0) 60%);
        }
        
        .blur-filter:nth-child(4) {
        backdrop-filter: blur(8px);
        mask: linear-gradient(rgba(0, 0, 0, 0) 20%, rgba(0, 0, 0, 1) 40%, rgba(0, 0, 0, 1) 60%, rgba(0, 0, 0, 0) 70%);
        }
        
        .blur-filter:nth-child(5) {
        backdrop-filter: blur(16px);
        mask: linear-gradient(rgba(0, 0, 0, 0) 40%, rgba(0, 0, 0, 1) 60%, rgba(0, 0, 0, 1) 80%, rgba(0, 0, 0, 0) 90%);
        }
        
        .blur-filter:nth-child(6) {
        backdrop-filter: blur(32px);
        mask: linear-gradient(rgba(0, 0, 0, 0) 60%, rgba(0, 0, 0, 1) 80%);
        }
        
        .blur-filter:nth-child(7) {
        z-index: 10;
        background-filter: blur(64px);
        mask: linear-gradient(rgba(0, 0, 0, 0) 70%, rgba(0, 0, 0, 1) 100%)
        }
    </style>
</x-slot>