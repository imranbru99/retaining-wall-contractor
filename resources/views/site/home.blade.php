@extends('layouts.site')

@section('title', 'Crestlock Retaining')
@section('meta_description', 'Engineered retaining walls, terraces, and drainage systems for Denver and Front Range slopes. Free site walks with Crestlock Retaining Co.')

@section('content')
<section class="hero">
    <div class="hero-media" aria-hidden="true"></div>
    <div class="wrap hero-copy">
        <div class="eyebrow">Denver Front Range retaining walls</div>
        <h1>Crestlock Retaining</h1>
        <p>We design and build structural retaining walls that stop hillside creep, protect foundations, and create usable outdoor levels — with drainage engineered for Colorado freeze–thaw cycles.</p>
        <div class="cta-row">
            <a class="btn btn-primary" href="{{ route('contact') }}">Book a free site walk</a>
            <a class="btn btn-ghost" href="{{ route('services.index') }}" style="color:#fff;border-color:rgba(255,255,255,.4);">Explore wall systems</a>
        </div>
    </div>
</section>

<section>
    <div class="wrap">
        <div class="section-head">
            <h2>Hold the grade. Shape the yard.</h2>
            <p>From segmental block and boulder walls to poured concrete and timber systems, Crestlock matches wall type to soil, height, and drainage — then builds it to last.</p>
        </div>
        <div>
            @foreach ($services as $service)
                <a class="service-link" href="{{ route('services.show', $service) }}">
                    <strong>{{ $service->title }}</strong>
                    <span>{{ $service->summary }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section style="padding-top:0;">
    <div class="wrap about-split">
        <img src="https://images.unsplash.com/photo-1558904541-efa843a96f01?auto=format&fit=crop&w=1400&q=80" alt="Landscaped hillside with structured outdoor levels">
        <div>
            <div class="eyebrow" style="color:var(--cl-amber);">About Crestlock</div>
            <h2 style="color:var(--cl-slate);">Built for Colorado slopes</h2>
            <p>Front Range soils, snowmelt, and clay swell punish walls that skip drainage. Our crews start with geotech awareness, base prep, and weep systems — then stack beauty on top of structure.</p>
            <p>Homeowners and small builders hire us for failing wall replacements, new terraces, driveway edge walls, and HOA hillside repairs across Denver metro.</p>
            <a class="btn btn-primary" href="{{ route('knowledge.index') }}">Read the knowledge base</a>
        </div>
    </div>
</section>

<section>
    <div class="wrap">
        <div class="section-head">
            <h2>Operations dashboard preview</h2>
            <p>The same ERP your project lead uses — jobs, block inventory, invoices, and site walks in one slate-steel Filament workspace.</p>
        </div>
        <div class="visual-board">
            <div class="dash-preview">
                <img src="https://images.unsplash.com/photo-1466692476866-aef53dfb6c00?auto=format&fit=crop&w=1400&q=80" alt="Outdoor landscape terraces and planting beds">
            </div>
            <div style="display:grid;gap:.8rem;">
                <div class="metric"><b>{{ $stats['jobs'] }}</b> tracked wall jobs in demo ERP</div>
                <div class="metric"><b>{{ $stats['completed'] }}</b> completed builds</div>
                <div class="metric"><b>{{ number_format($stats['sqft']) }}</b> linear ft in pipeline data</div>
                <a class="btn btn-ghost" style="color:#fff;border-color:rgba(255,255,255,.35);" href="/admin">Open admin demo</a>
            </div>
        </div>
    </div>
</section>

<section style="padding-top:0;">
    <div class="wrap">
        <div class="section-head">
            <h2>From the field notes</h2>
            <p>Practical guidance on drainage, geogrid, permits, and freeze–thaw detailing.</p>
        </div>
        <div class="post-list">
            @foreach ($posts as $post)
                <article>
                    <a href="{{ route('blog.show', $post) }}">
                        <strong style="font-size:1.2rem;">{{ $post->title }}</strong>
                        <p style="margin:.35rem 0 0;color:#3d5360;">{{ $post->excerpt }}</p>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section>
    <div class="wrap grid-2">
        <div>
            <h2 style="color:var(--cl-slate);">Ready to lock your hillside?</h2>
            <p>Tell us wall height, soil conditions if known, and whether drainage is failing. We’ll schedule a Front Range site walk and scoped proposal.</p>
        </div>
        <div class="cta-row" style="align-items:center;">
            <a class="btn btn-primary" href="{{ route('contact') }}">Contact Crestlock</a>
            <a class="btn btn-ghost" href="https://wa.me/{{ config('services.whatsapp.number') }}" target="_blank" rel="noopener">WhatsApp</a>
        </div>
    </div>
</section>
@endsection
