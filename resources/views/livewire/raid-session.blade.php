<div>
    @if($session->users()->count() == 0)
    <form wire:submit="updateSession">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Raid Session Details</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Fill out the details below to help share with your team</p>
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nickname</label>
            <input type="text" wire:model="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Enter your nickname</p>            
        </div>
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Server IP or Name (optional)</label>
            <input type="text" wire:model="server" placeholder="Server IP or Name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Enter the rust server IP or name to share with your friends</p>            
        </div>
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Base Location (optional)</label>
            <input type="text" wire:model="location" placeholder="Base Location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Enter the base location to share with your friends for example "L11"</p>            
        </div>
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-800">
                Start Raiding
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </button>
        </div>
    </div>
    </form>
    @else
    @if($user)
    <div class="p-4 flex justify-evenly mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        @foreach($session->getPastCodes(3) as $code)
        <p class="text-base text-gray-400">
            {{ $code->code }}
        </p>
        @endforeach
        <p class="text-base text-white">
            {{ $session->getHighestUser()->currentCode->code }}
        </p>
        @foreach($session->getFutureCodes(3) as $code)
        <p class="text-base text-gray-400">
            {{ $code->code }}
        </p>
        @endforeach
    </div>

    <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between p-3">
            <svg wire:click="previousCode()" class="w-16 h-16 mr-4 text-gray-800 dark:text-white cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M13.729 5.575c1.304-1.074 3.27-.146 3.27 1.544v9.762c0 1.69-1.966 2.618-3.27 1.544l-5.927-4.881a2 2 0 0 1 0-3.088l5.927-4.88Z" clip-rule="evenodd"/>
            </svg>
            <div class="flex flex-col">
                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white text-center">
                    {{ $user->currentCode->code }}
                </h1>
                <p class="text-center rtl:text-right text-base text-gray-500 dark:text-gray-400">
                    #{{ $user->currentCode->id }}
                </p>
            </div>
            <svg wire:click="nextCode()" class="w-16 h-16 ml-4 text-gray-800 dark:text-white cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M10.271 5.575C8.967 4.501 7 5.43 7 7.12v9.762c0 1.69 1.967 2.618 3.271 1.544l5.927-4.881a2 2 0 0 0 0-3.088l-5.927-4.88Z" clip-rule="evenodd"/>
            </svg> 
        </div>

        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">


        <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
            <div class="flex flex-col pb-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Session</dt>
                <dd class="text-lg font-semibold overflow-hidden text-ellipsis whitespace-nowrap cursor-pointer" onclick="copySessionUrl()" data-tooltip-target="tooltip-copy-session">
                    {{ route('session.view', $session) }}
                    <div id="tooltip-copy-session" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        <span id="session_copy_text">Copy</span>
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </dd>
            </div>
            
            @if($session->server)
            <div class="flex flex-col py-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Server</dt>
                <dd class="text-lg font-semibold">{{ $session->server }}</dd>
            </div>
            @endif
            @if($session->location)
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Location</dt>
                <dd class="text-lg font-semibold">{{ $session->location }}</dd>
            </div>
            @endif
        </dl>

    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($session->users as $sessionUser)
            <li class="pb-3 sm:pb-4">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                <div class="flex-shrink-0">
                    <img class="w-8 h-8 rounded-full" src="{{ $sessionUser->avatar }}" alt="Neil image">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                        {{ $sessionUser->nickname }}
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                        #1
                    </p>
                </div>
                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                    {{ $sessionUser->currentCode->code }}
                </div>
            </div>
            </li>
            @endforeach
        </ul>
    </div>
    @else
    <form wire:submit="createUser">
        <div class="p-6 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nickname</label>
                <input type="text" wire:model="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Enter your nickname</p>            
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-800">
                    Start Raiding
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
            </div>
        </div>
    </form>
    @endif
    @endif

    <script>
        function copySessionUrl() {
            // copy value to clipboard
            navigator.clipboard.writeText('{{ route('session.view', $session) }}');
            document.getElementById('session_copy_text').innerText = 'Copied';
        }

        // sessionTimerStart();

        // function sessionTimerStart()
        // {
        //     // start a timer that shows how long the session has been running and count up from there
        //     const start = new Date('{{ $session->started_at }}');
        //     setInterval(() => {
        //         const now = new Date();
        //         const elapsed = now - start;

        //         const hours = Math.floor((elapsed % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        //         const minutes = Math.floor((elapsed % (1000 * 60 * 60)) / (1000 * 60));
        //         const seconds = Math.floor((elapsed % (1000 * 60)) / 1000);

        //         document.getElementById('session_countdown').innerText = `${hours}h ${minutes}m ${seconds}s`;
        //     }, 1000);
        // }
    </script>
</div>
