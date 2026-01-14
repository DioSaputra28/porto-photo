@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('web.layouts.app')

@section('content')
<!-- Hero Section -->
<header class="min-h-[85vh] flex items-center py-16" id="about">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center text-center md:text-left">
            <!-- Content -->
            <div class="hero-content max-w-lg mx-auto md:mx-0">
                <span class="text-accent text-sm tracking-widest uppercase mb-4 block border-b-2 border-accent md:border-b-0 md:border-l-[3px] md:pl-3 w-fit mx-auto md:mx-0 pb-1 md:pb-0">Pro Photographer</span>
                <h1 class="font-heading text-6xl md:text-7xl leading-tight mb-4">
                    {{ get_site_name() }}
                </h1>
                <p class="text-muted text-lg mt-8">
                    Capturing moments is not just about clicking a button.
                    It's about freezing a feeling, a story, and a soul in a
                    single frame. My camera is my sketchbook.
                </p>
                <div class="mt-8 inline-flex items-center gap-2 border border-muted px-8 py-4 uppercase text-sm tracking-widest cursor-pointer hover:border-accent hover:text-accent transition-all duration-300">
                    Explore Works <i class="ri-arrow-right-line"></i>
                </div>
            </div>

            <!-- Image Wrapper -->
            <div class="relative w-4/5 mx-auto md:w-full order-first md:order-last">
                <img src="{{ get_site_profile_picture() ?? asset('assets/hero.png') }}" alt="{{ get_site_name() }}" class="arch-image w-full h-auto object-cover relative z-10" />

                <!-- Sticker -->
                <div class="absolute top-[10%] -right-5 md:-right-8 bg-brandyellow rounded-full w-[140px] h-[140px] flex items-center justify-center z-20 shadow-xl animate-spin-slow">
                    <svg viewBox="0 0 100 100" width="100" height="100" class="w-full h-full origin-center">
                        <defs>
                            <path id="circle" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" />
                        </defs>
                        <text font-size="11.5" font-weight="bold" letter-spacing="1">
                            <textPath xlink:href="#circle">
                                SHOOT FOR THE MOON • SHOOT FOR THE MOON •
                            </textPath>
                        </text>
                        <polygon points="50,40 60,60 40,60" fill="transparent" stroke="black" stroke-width="2" />
                    </svg>
                </div>

                <!-- Floating Card -->
                <div class="absolute bottom-12 -left-12 bg-[#252e2c] p-6 w-[280px] z-30 border-l-[3px] border-accent shadow-2xl hidden md:block">
                    <h5 class="text-muted text-xs uppercase mb-2 flex items-center gap-2"><i class="ri-camera-3-line"></i> Latest Gear</h5>
                    <p class="font-heading text-lg leading-snug">Exploring new perspectives with the Sony Alpha 1.</p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- History/Bio Section -->
<section class="bg-secondary py-32" id="history">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-24 items-center">
            <!-- Left: Image -->
            <div class="relative">
                <img src="{{ asset('assets/history_moment.png') }}" alt="Photography Moment" class="w-full h-auto rounded shadow-2xl" />
                <div class="absolute -bottom-8 -right-8 bg-accent w-[100px] h-[100px] flex items-center justify-center shadow-xl transition-transform duration-300 hover:-translate-y-1">
                    <i class="ri-quill-pen-line text-3xl text-white"></i>
                </div>
            </div>

            <!-- Right: Content -->
            <div>
                <span class="flex items-center gap-4 text-accent text-xs tracking-[2px] uppercase mb-4">
                    <span class="w-8 h-[1px] bg-accent block"></span> MY HISTORY
                </span>
                <h2 class="font-heading text-5xl mb-8 font-normal">From a Hobbyist to a <br><span class="text-accent italic font-heading">Visual Storyteller</span>.</h2>

                <p class="text-muted text-lg mb-12">
                    I started my journey with a second-hand DSLR and a passion for street photography. Over the last decade, I have evolved into a professional specializing in editorial fashion and cinematic portraiture.
                </p>

                <div class="flex flex-col gap-8 border-l border-white/10 pl-8">
                    <div class="relative pl-4">
                        <div class="absolute -left-[2.35rem] top-[5px] w-[10px] h-[10px] bg-accent rounded-full"></div>
                        <span class="text-muted text-xs mb-1 block">2016 - 2018</span>
                        <h4 class="text-xl text-text mb-2 font-heading">Freelance Street Photographer</h4>
                        <p class="text-muted text-sm">Documenting the raw streets of London and Paris, learning the art of natural light.</p>
                    </div>
                    <div class="relative pl-4">
                        <div class="absolute -left-[2.35rem] top-[5px] w-[10px] h-[10px] bg-white rounded-full"></div>
                        <span class="text-muted text-xs mb-1 block">2018 - 2021</span>
                        <h4 class="text-xl text-text mb-2 font-heading">Studio Lead @ Vogue Indie</h4>
                        <p class="text-muted text-sm">Managed lighting setups and creative direction for emerging fashion brands.</p>
                    </div>
                    <div class="relative pl-4">
                        <div class="absolute -left-[2.35rem] top-[5px] w-[10px] h-[10px] bg-white rounded-full"></div>
                        <span class="text-muted text-xs mb-1 block">2021 - Present</span>
                        <h4 class="text-xl text-text mb-2 font-heading">Independent Creative Director</h4>
                        <p class="text-muted text-sm">Working globally with top-tier clients to create compelling visual narratives.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-24" id="portfolio">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8">
        <span class="text-accent text-sm tracking-[2px] uppercase mb-4 block">Selected Works</span>
        <h2 class="font-heading text-5xl mb-12 font-normal">Visual <span class="text-accent italic">Poetry</span></h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-12">
            @php
            $gridPatterns = [
            ['col' => 'md:col-span-1', 'height' => 'h-[300px] md:h-[400px]'],
            ['col' => 'md:col-span-2', 'height' => 'h-[300px] md:h-[400px]'],
            ['col' => 'md:col-span-2', 'height' => 'h-[300px] md:h-[400px]'],
            ['col' => 'md:col-span-1', 'height' => 'h-[300px] md:h-[400px]'],
            ['col' => 'md:col-span-3', 'height' => 'h-[300px] md:h-[500px]'],
            ];
            @endphp

            @forelse($galleries as $index => $gallery)
            @php
            $pattern = $gridPatterns[$index] ?? ['col' => 'md:col-span-1', 'height' => 'h-[300px] md:h-[400px]'];
            @endphp
            <div class="{{ $pattern['col'] }} {{ $pattern['height'] }} relative overflow-hidden group">
                <img src="{{ Storage::url($gallery->path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" />
            </div>
            @empty
            <div class="md:col-span-3 h-[300px] flex items-center justify-center">
                <p class="text-muted text-lg">No gallery images available yet.</p>
            </div>
            @endforelse
        </div>

        <!-- See More Button -->
        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center gap-2 text-text text-sm tracking-[2px] uppercase pb-1 border-b border-accent hover:text-accent hover:gap-4 transition-all duration-300">
                See More Works <i class="ri-arrow-right-line"></i>
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="bg-primary py-32 overflow-hidden text-left" id="contact">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-24 items-start">
            <!-- Left: Contact Info -->
            <div class="contact-info">
                <span class="text-accent text-xs tracking-[2px] uppercase mb-8 flex items-center gap-4">
                    <span class="w-8 h-[1px] bg-accent block"></span> GET IN TOUCH
                </span>
                <h2 class="font-heading text-5xl mb-8 font-normal leading-tight">Let's work <br>together.</h2>
                <p class="text-muted text-lg my-8 max-w-sm">
                    Have a project in mind? Looking for a specific aesthetic? Drop me a line and let's create magic.
                </p>

                <div class="flex flex-col gap-8 mb-16">
                    <div class="flex items-center gap-6">
                        <div class="w-[50px] h-[50px] rounded-full bg-white/5 flex items-center justify-center text-text text-xl">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div>
                            <span class="text-[0.7rem] tracking-widest uppercase text-muted block mb-1 font-semibold">EMAIL</span>
                            <a href="mailto:{{ get_site_email() }}" class="text-text font-heading text-xl">{{ get_site_email() }}</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="w-[50px] h-[50px] rounded-full bg-white/5 flex items-center justify-center text-text text-xl">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div>
                            <span class="text-[0.7rem] tracking-widest uppercase text-muted block mb-1 font-semibold">PHONE</span>
                            <span class="text-text font-heading text-xl">{{ get_site_phone() }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <span class="text-[0.7rem] tracking-widest uppercase text-muted block mb-4 font-semibold">FOLLOW ME</span>
                    <div class="flex gap-4">
                        @if(get_site_instagram())
                        <a href="{{ get_site_instagram() }}" target="_blank" class="w-[45px] h-[45px] rounded-full border border-white/20 flex items-center justify-center text-sm hover:border-accent hover:text-accent transition-all duration-300">IG</a>
                        @endif
                        @if(get_site_twitter())
                        <a href="{{ get_site_twitter() }}" target="_blank" class="w-[45px] h-[45px] rounded-full border border-white/20 flex items-center justify-center text-sm hover:border-accent hover:text-accent transition-all duration-300">TW</a>
                        @endif
                        @if(get_site_facebook())
                        <a href="{{ get_site_facebook() }}" target="_blank" class="w-[45px] h-[45px] rounded-full border border-white/20 flex items-center justify-center text-sm hover:border-accent hover:text-accent transition-all duration-300">FB</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="relative">
                <div class="absolute -top-[50px] -right-[50px] w-[200px] h-[200px] rounded-full bg-gradient-to-br from-[#e0e0e0] to-[#a0a0a0] z-0"></div>
                <div class="bg-accent p-16 relative z-10 shadow-2xl">
                    <h3 class="text-3xl mb-12 text-white font-heading">Send a Message</h3>
                    <form class="flex flex-col gap-8">
                        <div class="form-group">
                            <input type="text" placeholder="Your Name" required class="w-full bg-transparent border-b border-white/40 py-4 text-white font-body text-base outline-none placeholder-white/60 focus:border-white transition-colors duration-300">
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Email Address" required class="w-full bg-transparent border-b border-white/40 py-4 text-white font-body text-base outline-none placeholder-white/60 focus:border-white transition-colors duration-300">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Tell me about your project" class="w-full bg-transparent border-b border-white/40 py-4 text-white font-body text-base outline-none placeholder-white/60 focus:border-white transition-colors duration-300">
                        </div>
                        <button type="submit" class="bg-white text-accent border-none p-5 font-bold tracking-[2px] uppercase cursor-pointer mt-8 hover:-translate-y-0.5 hover:shadow-lg transition-transform duration-300">SEND REQUEST</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection