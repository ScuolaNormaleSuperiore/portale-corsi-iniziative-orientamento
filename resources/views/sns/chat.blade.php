@extends('sns.layouts.app')
@section('content-body')
        <div id="chat" 
            data-page-title="{{ $pageTitle }}"
            data-user-avatar="{{ $userAvatar }}"
            data-faqs="{{ $faqs->toJson() }}"
            data-first-answer="{{ $firstAnswer }}"
        ></div>
@endsection
@section('extra-scripts')
    @foreach ($assets['js'] as $asset)
        <script src="{{ $asset }}" defer></script>
    @endforeach
    @foreach ($assets['css'] as $asset)
        <link data-chat-styles rel="stylesheet" href="{{ $asset }}">
    @endforeach
@endsection
