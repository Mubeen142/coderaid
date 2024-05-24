@extends('wrapper')

@section('content')
<div class="fullscreen-video-background">
    <div class="_pattern-overlay"></div>
    <div id="_buffering-background"></div>
    <div id="_youtube-iframe-wrapper">
        <div id="_youtube-iframe" data-youtubeurl="kfCvrVURW0g">
        </div>
    </div>
</div>

<section class="background">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        <h1 class="mb-4 mt-16 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">The unethical way of raiding in Rust</h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-300">This tool helps you code raid bases in Rust</p>
        <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <a href="{{ route('session.create') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                Create Session
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
            <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                Watch video
            </a>  
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.1/velocity.min.js"></script>
<script>
    const tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    const _youtube_id = document.getElementById('_youtube-iframe');

    function onYouTubeIframeAPIReady() {
        youtubePlayer = new YT.Player('_youtube-iframe', {
            videoId: _youtube_id.dataset.youtubeurl,
            playerVars: {
                cc_load_policy: 0,
                controls: 0,
                disablekb: 0,
                iv_load_policy: 3,
                playsinline: 1,
                rel: 0,
                showinfo: 0,
                modestbranding: 3
            },
            events: {
                'onReady': onYoutubePlayerReady,
                'onStateChange': onYoutubePlayerStateChange
            }
        });
    }

    function onYoutubePlayerReady(event) {
        event.target.mute();
        event.target.playVideo();
    }

    function onYoutubePlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING) {
            Velocity(document.getElementById('_buffering-background'), {
                opacity: 0
            }, 500);
        }

        if (event.data == YT.PlayerState.ENDED) {
            event.target.playVideo();
        }
    }
</script>

<style>
    @media only screen and (min-width: 1250px) {
        .body {
            background-color: transparent !important;
        }

        .fullscreen-video-background {
            background: #000;
            position: absolute;
            width: 100%;
            z-index: -99;
            overflow: hidden;
            height: 100vh;
        }

        .fullscreen-video-background ._pattern-overlay {
            position: absolute;
            top: 0;
            width: 100%;
            opacity: 0.15;
            bottom: 0;
            z-index: 2;
        }

        .fullscreen-video-background #_buffering-background {
            position: absolute;
            width: 100%;
            top: 0;
            bottom: 0;
            background: #222;
            z-index: 1;
        }

        .fullscreen-video-background #_youtube-iframe-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            position: absolute;
            height: 100%;
        }

        .fullscreen-video-background #_youtube-iframe-wrapper #_youtube-iframe {
            position: absolute;
            pointer-events: none;
            margin: 0 auto;
            height: 300vh;
            width: 120vw;
        }
    }

    @media only screen and (max-width: 1250px) {
        body {
            background-color: #1f1f1f;
        }

        .fullscreen-video-background {
            display: none;
        }

        .fullscreen-video-background ._pattern-overlay {
            display: none;
        }

        .fullscreen-video-background #_buffering-background {
            display: none;
        }

        .fullscreen-video-background #_youtube-iframe-wrapper {
            display: none;
        }

        .fullscreen-video-background #_youtube-iframe-wrapper #_youtube-iframe {
            display: none;
        }
    }
</style>
@endsection