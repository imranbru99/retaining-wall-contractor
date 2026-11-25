@extends('layouts.site')
@section('title', 'Contact')
@section('content')
<div class="page-hero"><div class="wrap"><h1>Contact Crestlock</h1><p>Free site walks across Denver and the Front Range.</p></div></div>
<section><div class="wrap grid-2">
    <div class="form-card">
        <form method="post" action="{{ route('contact.store') }}">
            @csrf
            <label for="name">Name</label>
            <input id="name" name="name" value="{{ old('name') }}" required>
            @error('name')<div style="color:#b91c1c;margin-top:-.6rem;margin-bottom:.8rem;">{{ $message }}</div>@enderror

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')<div style="color:#b91c1c;margin-top:-.6rem;margin-bottom:.8rem;">{{ $message }}</div>@enderror

            <label for="phone">Phone</label>
            <input id="phone" name="phone" value="{{ old('phone') }}">

            <label for="subject">Subject</label>
            <input id="subject" name="subject" value="{{ old('subject') }}" placeholder="e.g. 6ft hillside wall + drainage">

            <label for="message">Project details</label>
            <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
            @error('message')<div style="color:#b91c1c;margin-top:-.6rem;margin-bottom:.8rem;">{{ $message }}</div>@enderror

            <button class="btn btn-primary" type="submit">Send message</button>
        </form>
    </div>
    <div>
        <h2 style="color:var(--cl-slate);">Yard office</h2>
        <p>4820 Brighton Blvd<br>Denver, CO 80216</p>
        <p><a href="tel:+13035550192">(303) 555-0192</a><br>
        <a href="mailto:hello@crestlock.example">hello@crestlock.example</a></p>
        <p>Prefer chat? <a href="https://wa.me/{{ config('services.whatsapp.number') }}" target="_blank" rel="noopener"><strong>WhatsApp Crestlock</strong></a></p>
        <img src="https://images.unsplash.com/photo-1444858291040-58f756a3bdd1?auto=format&fit=crop&w=1200&q=80" alt="Hillside landscape ready for retaining" style="border-radius:16px;margin-top:1rem;width:100%;min-height:240px;object-fit:cover;">
    </div>
</div></section>
@endsection
