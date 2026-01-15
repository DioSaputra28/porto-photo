@extends('web.layouts.app')

@section('content')
<!-- Hero Header -->
<section class="pt-32 pb-16 bg-primary">
    <div class="w-[90%] max-w-[1400px] mx-auto px-8 text-center">
        <span class="text-accent text-xs tracking-[0.2em] uppercase mb-4 block">Service Detail</span>
        <h1 class="font-heading text-6xl md:text-7xl lg:text-8xl leading-[0.9] mb-6 text-white">
            {{ $service->name }}
        </h1>
        @if($service->category)
        <div class="inline-flex items-center gap-2 bg-accent/10 px-5 py-2 rounded-full border border-accent/30">
            <i class="ri-bookmark-line text-accent text-sm"></i>
            <span class="text-white text-sm font-medium">{{ $service->category->name }}</span>
        </div>
        @endif
    </div>
</section>

<!-- Main Content Section -->
<section class="py-16 md:py-20">
    <div class="w-[90%] max-w-[1400px] mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            <!-- Description Content -->
            <div class="lg:col-span-8">
                <div class="mb-10">
                    <h2 class="font-heading text-4xl md:text-5xl text-white mb-3">Description</h2>
                    <div class="w-24 h-1.5 bg-accent rounded-full"></div>
                </div>

                <!-- Rich Text Content -->
                <div class="prose prose-invert prose-lg max-w-none
                            prose-headings:font-heading prose-headings:text-white
                            prose-h1:text-4xl prose-h1:mb-4
                            prose-h2:text-3xl prose-h2:mb-3 prose-h2:mt-8 prose-h2:text-accent
                            prose-h3:text-2xl prose-h3:mb-2 prose-h3:mt-6
                            prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-4
                            prose-a:text-accent prose-a:no-underline hover:prose-a:underline
                            prose-strong:text-white prose-strong:font-bold
                            prose-ul:list-disc prose-ul:list-inside prose-ul:my-4 prose-ul:space-y-2
                            prose-ol:list-decimal prose-ol:list-inside prose-ol:my-4 prose-ol:space-y-2
                            prose-li:text-gray-300
                            prose-blockquote:border-l-4 prose-blockquote:border-accent prose-blockquote:pl-4 prose-blockquote:italic prose-blockquote:text-gray-400
                            prose-code:bg-white/5 prose-code:px-2 prose-code:py-1 prose-code:rounded prose-code:text-accent prose-code:text-sm
                            prose-pre:bg-[#1a1a1a] prose-pre:border prose-pre:border-white/10 prose-pre:rounded prose-pre:p-4
                            prose-img:rounded prose-img:shadow-xl">
                    {!! $service->description !!}
                </div>
            </div>

            <!-- Sticky Price Card -->
            <div class="lg:col-span-4">
                <div class="lg:sticky lg:top-32">
                    <div class="bg-gradient-to-br from-[#1a1a1a] to-[#0f0f0f] p-8 rounded-2xl border border-accent/20 shadow-2xl">
                        <!-- Price Section -->
                        <div class="mb-8 pb-6 border-b border-white/10">
                            <span class="text-muted text-xs uppercase tracking-wider block mb-2">Starting From</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-5xl font-bold text-accent">{{ number_format($service->price / 1000, 0) }}K</span>
                                <span class="text-muted text-sm">IDR</span>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        @if($settings->site_whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->site_whatsapp) }}?text={{ urlencode('Halo, saya tertarik dengan layanan ' . $service->name . '. Boleh minta info lebih lanjut?') }}"
                            target="_blank"
                            class="group flex items-center justify-center gap-3 w-full bg-accent text-black font-bold uppercase tracking-widest py-4 px-6 rounded-xl hover:bg-white transition-all duration-300 shadow-lg hover:shadow-accent/50">
                            <i class="ri-whatsapp-fill text-2xl group-hover:scale-110 transition-transform"></i>
                            <span>Book Now</span>
                        </a>
                        @else
                        <a href="{{ route('contact') }}"
                            class="group flex items-center justify-center gap-3 w-full bg-accent text-black font-bold uppercase tracking-widest py-4 px-6 rounded-xl hover:bg-white transition-all duration-300 shadow-lg hover:shadow-accent/50">
                            <i class="ri-mail-fill text-2xl group-hover:scale-110 transition-transform"></i>
                            <span>Book Now</span>
                        </a>
                        @endif

                        <!-- Additional Info -->
                        <div class="mt-6 pt-6 border-t border-white/10 space-y-3">
                            <div class="flex items-center gap-3 text-sm text-gray-400">
                                <i class="ri-shield-check-line text-accent text-lg"></i>
                                <span>Secure booking guaranteed</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-400">
                                <i class="ri-customer-service-2-line text-accent text-lg"></i>
                                <span>Custom packages available</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-400">
                                <i class="ri-time-line text-accent text-lg"></i>
                                <span>Fast response time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sample Works Section (Real Gallery Images) -->
<section class="py-20 bg-[#151515] border-t border-white/5">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8">
        <div class="text-center mb-16">
            <span class="text-accent text-sm tracking-widest uppercase mb-2 block">Portfolio</span>
            <h2 class="font-heading text-4xl md:text-5xl text-white">Sample <span class="text-accent italic">Works</span></h2>
            @if($service->category)
            <p class="text-muted mt-2">From {{ $service->category->name }} Category</p>
            @endif
        </div>

        @if($sampleImages->isNotEmpty())
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($sampleImages as $index => $image)
            <div class="group relative aspect-[4/5] overflow-hidden rounded bg-black/50 {{ $index % 2 == 1 ? 'md:translate-y-8' : '' }}">
                <img src="{{ Storage::url($image->path) }}"
                    alt="{{ $image->title }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/60">
                    <i class="ri-image-line text-3xl text-white mb-2"></i>
                    <span class="text-white text-sm font-medium px-4 text-center">{{ $image->title }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="inline-block bg-white/5 rounded-full p-6 mb-4">
                <i class="ri-image-line text-5xl text-muted"></i>
            </div>
            <p class="text-muted text-lg">No sample works available for this category yet.</p>
        </div>
        @endif
    </div>
</section>

<!-- Add Storage facade -->
@php use Illuminate\Support\Facades\Storage; @endphp
@endsection