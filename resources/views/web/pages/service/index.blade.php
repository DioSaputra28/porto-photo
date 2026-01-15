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
        @if($services->isEmpty())
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <div class="relative mb-8">
                <!-- Animated Circle Background -->
                <div class="absolute inset-0 bg-accent/10 rounded-full blur-3xl animate-pulse"></div>

                <!-- Icon -->
                <div class="relative bg-[#1a1a1a] border-2 border-white/10 rounded-full p-8">
                    <i class="ri-service-line text-6xl text-accent"></i>
                </div>
            </div>

            <h3 class="font-heading text-3xl md:text-4xl text-white mb-4">
                No Services Available
            </h3>

            <p class="text-muted text-lg max-w-md mb-8">
                We're currently updating our service offerings. Please check back soon or contact us for custom packages.
            </p>

            <a href="{{ route('contact') }}"
                class="inline-flex items-center gap-2 bg-accent text-black font-bold px-8 py-3 rounded-full hover:bg-white transition-all duration-300">
                Contact Us
            </a>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-[#1a1a1a] p-8 rounded shadow-xl hover:-translate-y-2 transition-transform duration-300 border border-white/5 hover:border-accent/30 group">

                <h3 class="font-heading text-2xl text-white mb-4">{{ $service->name }}</h3>

                <div class="text-muted text-sm leading-relaxed mb-6 line-clamp-4">
                    {!! Str::limit(strip_tags($service->description), 150) !!}
                </div>

                <div class="mt-auto pt-6 border-t border-white/10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-white font-bold text-xl">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                        @if($service->is_featured)
                        <span class="bg-accent/20 text-accent text-xs px-3 py-1 rounded-full font-medium">Featured</span>
                        @endif
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('service.show', $service->slug) }}"
                            class="flex-1 text-center text-xs uppercase tracking-widest bg-white/5 hover:bg-white/10 text-white py-3 px-4 rounded transition-colors border border-white/10 hover:border-accent">
                            Detail
                        </a>
                        @if($settings->site_whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->site_whatsapp) }}?text={{ urlencode('Halo, saya tertarik dengan layanan ' . $service->name) }}"
                            target="_blank"
                            class="flex-1 text-center text-xs uppercase tracking-widest bg-accent hover:bg-white text-black py-3 px-4 rounded transition-colors font-bold">
                            Book Now
                        </a>
                        @else
                        <a href="{{ route('contact') }}"
                            class="flex-1 text-center text-xs uppercase tracking-widest bg-accent hover:bg-white text-black py-3 px-4 rounded transition-colors font-bold">
                            Book Now
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($services->hasPages())
        <div class="mt-16">
            {{ $services->links() }}
        </div>
        @endif
        @endif

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