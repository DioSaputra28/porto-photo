@extends('web.layouts.app')

@section('content')
<!-- Header -->
<header class="pt-32 pb-12" id="service-header">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8 text-center">
        <span class="text-accent text-sm tracking-widest uppercase mb-4 block border-b pb-1 border-accent w-fit mx-auto">What We Offer</span>
        <h1 class="font-heading text-6xl md:text-7xl leading-tight mb-4">
            Our <span class="text-accent italic">Services</span>
        </h1>
        <p class="text-muted text-lg mt-4 max-w-2xl mx-auto">
            Professional photography solutions tailored to your unique needs.
        </p>
    </div>
</header>

<!-- Services Grid -->
<section class="py-12" id="service-grid">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-[#1a1a1a] p-8 rounded shadow-xl hover:-translate-y-2 transition-transform duration-300 border border-white/5 hover:border-accent/30 group">
                <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-accent text-3xl mb-6 group-hover:bg-accent group-hover:text-black transition-colors duration-300">
                    <i class="{{ $service['icon'] }}"></i>
                </div>

                <h3 class="font-heading text-2xl text-white mb-4">{{ $service['title'] }}</h3>
                <p class="text-muted text-sm leading-relaxed mb-6">
                    {{ $service['description'] }}
                </p>

                <div class="mt-auto pt-6 border-t border-white/10 flex items-center justify-between">
                    <span class="text-white font-bold">{{ $service['price'] }}</span>
                    <a href="{{ route('contact') }}" class="text-xs uppercase tracking-widest text-muted hover:text-accent transition-colors flex items-center gap-2">
                        Book Now <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Custom Request Banner -->
        <div class="mt-24 bg-primary border border-white/10 p-12 rounded relative overflow-hidden text-center">
            <div class="relative z-10">
                <h2 class="font-heading text-4xl mb-6">Need a Custom Package?</h2>
                <p class="text-muted text-lg max-w-2xl mx-auto mb-8">
                    We understand that every project is unique. Let's discuss your specific requirements and create a tailored solution just for you.
                </p>
                <a href="{{ route('contact') }}" class="inline-block bg-accent text-black font-bold tracking-[2px] uppercase py-4 px-8 hover:bg-white transition-colors duration-300 rounded">
                    Contact Us
                </a>
            </div>
            <!-- Abstract BG Shape -->
            <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-accent/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-[200px] h-[200px] bg-white/5 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>
        </div>
    </div>
</section>
@endsection