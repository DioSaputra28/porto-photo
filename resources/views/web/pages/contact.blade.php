@extends('web.layouts.app')

@section('content')
<!-- Header -->
<header class="pt-32 pb-12" id="contact-header">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8 text-center">
        <span class="text-accent text-sm tracking-widest uppercase mb-4 block border-b pb-1 border-accent w-fit mx-auto">Get In Touch</span>
        <h1 class="font-heading text-6xl md:text-7xl leading-tight mb-4">
            Let's Create <br /><span class="text-accent italic">Magic</span>
        </h1>
    </div>
</header>

<!-- Contact Content -->
<section class="py-12" id="contact-content">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-24 items-start">

            <!-- Left: Contact Information -->
            <div>
                <p class="text-muted text-lg mb-12">
                    Whether you have a specific project in mind or just want to explore possibilities, I'm here to listen. Reach out and let's start a conversation.
                </p>

                <div class="flex flex-col gap-10">
                    <!-- Email -->
                    @if(get_site_email())
                    <div class="flex items-start gap-6 group">
                        <div class="w-[50px] h-[50px] rounded-full bg-white/5 flex items-center justify-center text-text text-xl group-hover:bg-accent group-hover:text-black transition-colors duration-300">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div>
                            <span class="text-[0.7rem] tracking-widest uppercase text-muted block mb-1 font-semibold">EMAIL</span>
                            <a href="mailto:{{ get_site_email() }}" class="text-text font-heading text-xl hover:text-accent transition-colors">{{ get_site_email() }}</a>
                        </div>
                    </div>
                    @endif

                    <!-- Phone / WhatsApp -->
                    @if(get_site_whatsapp() || get_site_phone())
                    <div class="flex items-start gap-6 group">
                        <div class="w-[50px] h-[50px] rounded-full bg-white/5 flex items-center justify-center text-text text-xl group-hover:bg-accent group-hover:text-black transition-colors duration-300">
                            <i class="ri-whatsapp-line"></i>
                        </div>
                        <div>
                            <span class="text-[0.7rem] tracking-widest uppercase text-muted block mb-1 font-semibold">PHONE / WHATSAPP</span>
                            @if(get_site_whatsapp())
                            <a href="{{ get_site_whatsapp_url() }}" target="_blank" class="text-text font-heading text-xl hover:text-accent transition-colors block">{{ get_site_whatsapp() }}</a>
                            @endif
                            @if(get_site_phone() && get_site_phone() != get_site_whatsapp())
                            <span class="text-text font-heading text-xl block mt-1">{{ get_site_phone() }}</span>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Address -->
                    @if(get_site_address())
                    <div class="flex items-start gap-6 group">
                        <div class="w-[50px] h-[50px] rounded-full bg-white/5 flex items-center justify-center text-text text-xl group-hover:bg-accent group-hover:text-black transition-colors duration-300">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <div>
                            <span class="text-[0.7rem] tracking-widest uppercase text-muted block mb-1 font-semibold">STUDIO</span>
                            <p class="text-text font-body text-lg leading-relaxed max-w-xs">{!! nl2br(e(get_site_address())) !!}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Socials -->
                <div class="mt-16">
                    <span class="text-[0.7rem] tracking-widest uppercase text-muted block mb-6 font-semibold">FOLLOW ME</span>
                    <div class="flex gap-4">
                        @if(get_site_instagram())
                        <a href="{{ get_site_instagram() }}" target="_blank" class="w-[45px] h-[45px] rounded-full border border-white/20 flex items-center justify-center hover:border-accent hover:text-accent transition-all duration-300">
                            <i class="ri-instagram-line text-xl"></i>
                        </a>
                        @endif

                        @if(get_site_facebook())
                        <a href="{{ get_site_facebook() }}" target="_blank" class="w-[45px] h-[45px] rounded-full border border-white/20 flex items-center justify-center hover:border-accent hover:text-accent transition-all duration-300">
                            <i class="ri-facebook-line text-xl"></i>
                        </a>
                        @endif

                        @if(get_site_twitter())
                        <a href="{{ get_site_twitter() }}" target="_blank" class="w-[45px] h-[45px] rounded-full border border-white/20 flex items-center justify-center hover:border-accent hover:text-accent transition-all duration-300">
                            <i class="ri-twitter-x-fill text-xl"></i>
                        </a>
                        @endif

                        @if(get_site_youtube())
                        <a href="{{ get_site_youtube() }}" target="_blank" class="w-[45px] h-[45px] rounded-full border border-white/20 flex items-center justify-center hover:border-accent hover:text-accent transition-all duration-300">
                            <i class="ri-youtube-line text-xl"></i>
                        </a>
                        @endif

                        @if(get_site_tiktok())
                        <a href="{{ get_site_tiktok() }}" target="_blank" class="w-[45px] h-[45px] rounded-full border border-white/20 flex items-center justify-center hover:border-accent hover:text-accent transition-all duration-300">
                            <i class="ri-tiktok-fill text-xl"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="bg-[#1a1a1a] p-8 md:p-12 rounded shadow-2xl">
                <h3 class="font-heading text-2xl text-white mb-8">Send a Message</h3>
                <form id="contactForm" class="flex flex-col gap-6" onsubmit="handleContactSubmit(event)">
                    <div class="form-group">
                        <label class="text-[0.7rem] tracking-widest uppercase text-muted block mb-2 font-semibold">Name</label>
                        <input type="text" id="name" required class="w-full bg-black/20 border border-white/10 p-4 text-white font-body text-base outline-none focus:border-accent transition-colors duration-300 rounded">
                    </div>
                    <div class="form-group">
                        <label class="text-[0.7rem] tracking-widest uppercase text-muted block mb-2 font-semibold">Email</label>
                        <input type="email" id="email" required class="w-full bg-black/20 border border-white/10 p-4 text-white font-body text-base outline-none focus:border-accent transition-colors duration-300 rounded">
                    </div>
                    <div class="form-group">
                        <label class="text-[0.7rem] tracking-widest uppercase text-muted block mb-2 font-semibold">Message</label>
                        <textarea id="message" rows="4" required class="w-full bg-black/20 border border-white/10 p-4 text-white font-body text-base outline-none focus:border-accent transition-colors duration-300 rounded"></textarea>
                    </div>
                    <button type="submit" class="bg-accent text-black font-bold tracking-[2px] uppercase cursor-pointer py-4 px-8 mt-4 hover:bg-white transition-colors duration-300 w-full md:w-auto self-start rounded">
                        Send Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
@if(get_site_gmaps_embed())
<section class="pb-0 h-[400px] w-full filter grayscale hover:grayscale-0 transition-all duration-500">
    <div class="w-full h-full iframe-container">
        {!! get_site_gmaps_embed() !!}
    </div>
</section>

<style>
    .iframe-container iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0;
    }
</style>
@endif

<script>
    function handleContactSubmit(e) {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const message = document.getElementById('message').value;

        const whatsappNumber = "{{ get_site_whatsapp() }}"; // e.g. 08123456789 or 628123456789

        if (whatsappNumber) {
            // Remove non-numeric chars
            const cleanNumber = whatsappNumber.replace(/\D/g, '');

            // Construct WhatsApp Message
            const waMessage = `Hello, my name is ${name} (${email}).\n\n${message}`;
            const waUrl = `https://wa.me/${cleanNumber}?text=${encodeURIComponent(waMessage)}`;

            window.open(waUrl, '_blank');
        } else {
            // Fallback to Mailto
            const siteEmail = "{{ get_site_email() }}";
            const mailtoSubject = `Contact Request from ${name}`;
            const mailtoBody = `Name: ${name}\nEmail: ${email}\n\nMessage:\n${message}`;

            window.location.href = `mailto:${siteEmail}?subject=${encodeURIComponent(mailtoSubject)}&body=${encodeURIComponent(mailtoBody)}`;
        }
    }
</script>
@endsection