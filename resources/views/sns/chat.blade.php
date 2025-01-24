@extends('sns.layouts.app')
@section('content-body')
    <div class="d-none" id="chat" data-page-title="{{ $pageTitle }}" data-user-avatar="{{ $userAvatar }}" data-faqs="{{ $faqs->toJson() }}" data-first-answer="{{ $firstAnswer }}"></div>
    <div id="chat-loader" style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center; background-color: white;">
        <div class="spinner-border text-primary" role="status">
            <span style="visibility: hidden;">Loading...</span>
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
        window.addEventListener('sns-chat-is-loaded', () => {
            const chat = document.getElementById('chat');
            const loader = document.getElementById('chat-loader');
            chat.style.opacity = '0';
            chat.classList.remove('d-none');
            chat.offsetHeight;
            chat.style.transition = 'opacity 0.3s ease';
            chat.style.opacity = '1';
            loader.style.transition = 'opacity 0.3s ease';
            loader.style.opacity = '0';
            loader.addEventListener('transitionend', () => {
                loader.classList.add('d-none');
                chat.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, { once: true });
        }, { once: true });
    </script>
@endsection

