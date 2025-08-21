@extends('sns.layouts.app')
@section('content-body')
<h1 class="visually-hidden">{{ $pageTitle }}</h1>
<div id="chat-container">
    <div class="d-none" id="chat" data-page-chat-title="{{ $chatTitle }}" data-user-avatar="{{ $userAvatar }}"
        data-faqs="{{ $faqs->toJson() }}" data-first-answer="{{ $firstAnswer }}"
        data-questions-title="{{ $questionsTitle }}" data-info="{{ $info->toJson() }}"></div>
    <div id="chat-loader"
        style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; background-color: white; position: absolute; top: 0; left: 0; z-index: 10;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
@foreach ($assets['js'] as $asset)
<script src="{{ $asset }}" defer></script>
@endforeach
@foreach ($assets['css'] as $asset)
<link data-chat-styles rel="stylesheet" href="{{ $asset }}">
@endforeach
<script>
    document.addEventListener('DOMContentLoaded', () => {
            const chat = document.getElementById('chat');

            // Pre-position the chat component in the container
            chat.style.opacity = '0';
            chat.style.position = 'absolute';
            chat.style.top = '0';
            chat.style.left = '0';
            chat.style.width = '100%';
            chat.style.height = '100%';
            chat.style.zIndex = '5';
            chat.style.outline = 'none'; // Prevent blue outline on focus
            chat.style.border = 'none'; // Ensure no border is applied
        });

        window.addEventListener('sns-chat-is-loaded', () => {
            const chat = document.getElementById('chat');
            const loader = document.getElementById('chat-loader');

            chat.classList.remove('d-none');
            chat.offsetHeight; // Force reflow
            chat.style.transition = 'opacity 0.3s ease';
            chat.style.opacity = '1';

            // Ensure no focus outline appears
            chat.style.outline = 'none';
            chat.style.border = 'none';

            loader.style.transition = 'opacity 0.3s ease';
            loader.style.opacity = '0';

            loader.addEventListener('transitionend', () => {
                loader.style.display = 'none';
            }, { once: true });
        }, { once: true });
</script>
<style>
    /* Additional CSS to prevent any focus outlines or borders */
    #chat {
        outline: none !important;
        box-shadow: none !important;
    }

    #chat-container {
        outline: none !important;
        border-bottom: 1px solid #dee2e6 !important;
        border-top: 1px solid #dee2e6 !important;
        height: 524px;
        width: 100%;
        position: relative;

        @media (width > 768px) {
            height: 727px;
        }
    }
</style>
@endsection