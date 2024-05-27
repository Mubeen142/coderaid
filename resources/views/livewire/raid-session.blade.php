<div class="w-3/4 xl:w-1/4 xl:w-1/4 lg:w-1/3 md:w-2/4 sm:w-3/4" wire:poll>
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
        <div id="more_session_options" style="display: none;">
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
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Session Password (optional)</label>
                <input type="password" wire:model="session_password" placeholder="Session Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    If set this password will be required to join the session. If you leave this blank anyone with the session link can join.
                </p>            
            </div>
        </div>
        
        <a href="#" onclick="toggleMoreOptions()" class="font-medium text-primary-600 dark:text-primary-500 hover:underline" id="more_session_options_btn">More options</a>

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
                <h1 data-tooltip-target="tooltip-currentcode-rank" class="mb-4 cursor-pointer text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white text-center">
                    @if(!$session->master_code_id)
                        {{ $user->currentCode->code }}
                    @else
                        <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">{{ $session->masterCode->code }}</span>
                    @endif
                </h1>
                <div id="tooltip-currentcode-rank" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    #{{ $user->currentCode->id }}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

                @if(! $session->master_code_id)
                    <p wire:click="triggerCodeFound()" wire:confirm="Are you sure you found the code? Everyone in the session will be notified that the code has been found" class="font-medium cursor-pointer text-center text-indigo-600 dark:text-indigo-500 hover:underline">Code Found</p>
                @else 
                    <p wire:click="triggerContinueSession()" wire:confirm="Are you sure you want to continue the session?" class="font-medium cursor-pointer text-center text-red-600 dark:text-red-500 hover:underline">Continue Session</p>
                @endif

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
            @foreach($session->users()->orderBy('total_guess_count', 'desc')->get() as $sessionUser)
            <li class="pb-3 pt-3 sm:pb-4">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                <div class="flex-shrink-0">
                    <img class="w-8 h-8 rounded-full" src="{{ $sessionUser->avatar }}" alt="{{ $sessionUser->nickname }}">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                        {{ $sessionUser->nickname }} @if($session->master_code_id AND $session->master_code_id == $sessionUser->current_code_id) <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">MVP</span> @endif
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                        {{ $sessionUser->total_guess_count }} guesses
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
    <form wire:submit="addUser">
        <div class="p-6 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nickname</label>
                <input type="text" wire:model="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Enter your nickname</p>            
            </div>
            @if($session->session_password)
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Session Password</label>
                <input type="password" wire:model="session_password" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Enter the session password to join the session    
                </p> 
            </div>
            @endif
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

    <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>

    <script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('code.found', (event) => {
        if(event[0] !== {{ $session->id }}) return;
            const duration = 10000,
            animationEnd = Date.now() + duration,
            defaults = { startVelocity: 30, spread: 360, ticks: 20, zIndex: 0 };

            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }

            const interval = setInterval(function () {
                const timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                const particleCount = 20 * (timeLeft / duration);

                // since particles fall down, start a bit higher than random
                confetti(
                    Object.assign({}, defaults, {
                        particleCount,
                        origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
                    })
                );
                confetti(
                    Object.assign({}, defaults, {
                        particleCount,
                        origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
                    })
                );
        }, 250);
       });
    });
    </script>

    <script>
        function copySessionUrl() {
            // copy value to clipboard
            navigator.clipboard.writeText('{{ route('session.view', $session) }}');
            document.getElementById('session_copy_text').innerText = 'Copied';
        }

        function toggleMoreOptions() {
            const moreOptions = document.getElementById('more_session_options');
            if (moreOptions.style.display === 'none') {
                moreOptions.style.display = '';
                document.getElementById('more_session_options_btn').innerText = 'Less options';
            } else {
                moreOptions.style.display = 'none';
                document.getElementById('more_session_options_btn').innerText = 'More options';
            }
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
