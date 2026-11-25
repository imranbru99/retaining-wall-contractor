@extends('layouts.site')
@section('title', 'Knowledge Base')
@section('content')
<div class="page-hero"><div class="wrap"><h1>Knowledge base</h1><p>Common issues, guides, admin manual, and troubleshooting for Crestlock projects.</p></div></div>
<section><div class="wrap">
    @php
        $labels = [
            'issues' => 'Common Issues',
            'guides' => 'Step-by-Step Guides',
            'admin' => 'Admin Manual',
            'troubleshooting' => 'Troubleshooting',
        ];
    @endphp
    @foreach ($labels as $key => $label)
        @if(($articles[$key] ?? collect())->isNotEmpty())
            <div class="kb-group">
                <h2>{{ $label }}</h2>
                @foreach ($articles[$key] as $article)
                    <a class="service-link" href="{{ route('knowledge.show', $article) }}">
                        <strong>{{ $article->title }}</strong>
                        <span>{{ $article->summary }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    @endforeach
</div></section>
@endsection
