@php use Illuminate\Support\Facades\Storage; @endphp

@extends('web.layouts.app')

@section('content')
<!-- Gallery Header -->
<header class="min-h-[40vh] flex items-center pt-32 pb-12" id="gallery-header">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8 text-center">
        <span class="text-accent text-sm tracking-widest uppercase mb-4 block border-b pb-1 border-accent w-fit mx-auto">Portfolio</span>
        <h1 class="font-heading text-6xl md:text-7xl leading-tight mb-4">
            Captured <span class="text-accent italic">Moments</span>
        </h1>
        <p class="text-muted text-lg mt-4 max-w-2xl mx-auto">
            A collection of visual stories, frozen in time.
        </p>
    </div>
</header>

<!-- Gallery Grid -->
<section class="py-12" id="gallery-grid">
    <div class="w-[90%] max-w-[1600px] mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-container">
            @foreach($galleries as $index => $gallery)
            <div class="group relative bg-[#1a1a1a] rounded overflow-hidden gallery-item"
                data-index="{{ $index }}"
                data-image="{{ Storage::url($gallery->path) }}"
                data-title="{{ $gallery->title }}"
                data-id="{{ $gallery->id }}">

                <!-- Image Wrapper -->
                <div class="relative overflow-hidden aspect-[4/5] cursor-pointer" onclick="openLightbox({{ $index }})">
                    <img src="{{ Storage::url($gallery->path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    <!-- Overlay effect -->
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors duration-300">
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-accent/80 p-3 rounded-full text-white">
                                <i class="ri-zoom-in-line text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Info -->
                <div class="p-6 border-t border-white/10 flex items-center justify-between">
                    <h3 class="font-heading text-xl text-white">{{ $gallery->title }}</h3>

                    <div class="flex items-center gap-6 text-muted text-sm">
                        <div class="flex items-center gap-2" title="Views">
                            <i class="ri-eye-line text-lg"></i>
                            <span class="view-count-{{ $gallery->id }}">{{ number_format($gallery->total_click) }}</span>
                        </div>
                        <div class="flex items-center gap-2" title="Downloads">
                            <i class="ri-download-cloud-line text-lg hover:text-accent transition-colors cursor-pointer"></i>
                            <span>{{ number_format($gallery->total_download) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($galleries->hasPages())
        <div class="mt-16">
            {{ $galleries->links() }}
        </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none">
    <!-- Close Button -->
    <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors z-50">
        <i class="ri-close-line text-4xl"></i>
    </button>

    <!-- Main Content -->
    <div class="w-full h-full flex items-center justify-center p-4 md:p-12 relative">
        <!-- Navigation Prev -->
        <button onclick="changeImage(-1)" class="absolute left-4 md:left-8 text-white/50 hover:text-accent transition-colors hidden md:block group p-4">
            <i class="ri-arrow-left-line text-4xl group-hover:-translate-x-2 transition-transform duration-300"></i>
        </button>

        <!-- Image Container -->
        <div class="relative max-w-full max-h-full flex flex-col items-center justify-center">
            <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[85vh] object-contain shadow-2xl rounded opacity-0 scale-95 transition-all duration-500" />

            <div class="mt-6 text-center">
                <h3 id="lightbox-title" class="font-heading text-2xl md:text-3xl text-white mb-2 translate-y-4 opacity-0 transition-all duration-500 delay-100"></h3>

                <!-- Stats -->
                <div class="flex items-center justify-center gap-6 text-muted text-sm mt-3 opacity-0 translate-y-4 transition-all duration-500 delay-150" id="lightbox-stats">
                    <div class="flex items-center gap-2">
                        <i class="ri-eye-line"></i>
                        <span id="lightbox-views">0</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="ri-download-cloud-line"></i>
                        <span id="lightbox-downloads">0</span>
                    </div>
                </div>

                <!-- Download Button -->
                <button onclick="downloadImage()"
                    id="lightbox-download-btn"
                    class="mt-6 inline-flex items-center gap-2 bg-accent text-black font-bold px-6 py-3 rounded hover:bg-white transition-all duration-300 opacity-0 translate-y-4 delay-200">
                    <i class="ri-download-cloud-line text-xl"></i>
                    Download Image
                </button>
            </div>
        </div>

        <!-- Navigation Next -->
        <button onclick="changeImage(1)" class="absolute right-4 md:right-8 text-white/50 hover:text-accent transition-colors hidden md:block group p-4">
            <i class="ri-arrow-right-line text-4xl group-hover:translate-x-2 transition-transform duration-300"></i>
        </button>
    </div>
</div>

<!-- Lightbox Script & Styles -->
<script>
    // Get all gallery items from DOM
    const galleryElements = document.querySelectorAll('.gallery-item');
    const totalItems = galleryElements.length;
    let currentIndex = 0;
    let currentGalleryId = null;
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxStats = document.getElementById('lightbox-stats');
    const lightboxViews = document.getElementById('lightbox-views');
    const lightboxDownloads = document.getElementById('lightbox-downloads');
    const lightboxDownloadBtn = document.getElementById('lightbox-download-btn');

    function openLightbox(index) {
        currentIndex = index;
        updateLightboxContent();

        lightbox.classList.remove('hidden', 'pointer-events-none');
        // Small delay to allow display:block to apply before opacity transition
        setTimeout(() => {
            lightbox.classList.remove('opacity-0');
            lightboxImage.classList.remove('opacity-0', 'scale-95');
            lightboxTitle.classList.remove('opacity-0', 'translate-y-4');
            lightboxStats.classList.remove('opacity-0', 'translate-y-4');
            lightboxDownloadBtn.classList.remove('opacity-0', 'translate-y-4');
        }, 10);

        document.body.style.overflow = 'hidden'; // Prevent scrolling

        // Track View
        trackView(index);
    }

    function closeLightbox() {
        lightbox.classList.add('opacity-0');
        lightboxImage.classList.add('opacity-0', 'scale-95');
        lightboxTitle.classList.add('opacity-0', 'translate-y-4');
        lightboxStats.classList.add('opacity-0', 'translate-y-4');
        lightboxDownloadBtn.classList.add('opacity-0', 'translate-y-4');

        setTimeout(() => {
            lightbox.classList.add('hidden', 'pointer-events-none');
            document.body.style.overflow = '';
        }, 300);
    }

    function changeImage(direction) {
        // Fade out current content
        lightboxImage.classList.add('opacity-0', 'scale-95');
        lightboxTitle.classList.add('opacity-0', 'translate-y-4');
        lightboxStats.classList.add('opacity-0', 'translate-y-4');
        lightboxDownloadBtn.classList.add('opacity-0', 'translate-y-4');

        setTimeout(() => {
            currentIndex = (currentIndex + direction + totalItems) % totalItems;
            updateLightboxContent();

            // Fade in new content
            lightboxImage.classList.remove('opacity-0', 'scale-95');
            lightboxTitle.classList.remove('opacity-0', 'translate-y-4');
            lightboxStats.classList.remove('opacity-0', 'translate-y-4');
            lightboxDownloadBtn.classList.remove('opacity-0', 'translate-y-4');

            // Track View for new image
            trackView(currentIndex);
        }, 300);
    }

    function updateLightboxContent() {
        const currentElement = document.querySelector(`.gallery-item[data-index="${currentIndex}"]`);
        if (currentElement) {
            currentGalleryId = currentElement.dataset.id;
            lightboxImage.src = currentElement.dataset.image;
            lightboxTitle.textContent = currentElement.dataset.title;

            // Update stats from card
            const cardViewCount = document.querySelector(`.view-count-${currentGalleryId}`);
            const cardDownloadCount = cardViewCount?.closest('.flex.items-center.gap-6')?.querySelector('.flex.items-center.gap-2:last-child span');

            if (cardViewCount) {
                lightboxViews.textContent = cardViewCount.textContent;
            }
            if (cardDownloadCount) {
                lightboxDownloads.textContent = cardDownloadCount.textContent;
            }
        }
    }

    function trackView(index) {
        const currentElement = document.querySelector(`.gallery-item[data-index="${index}"]`);
        if (!currentElement) return;

        const id = currentElement.dataset.id;

        // Send tracking request
        fetch(`/gallery/${id}/track-view`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('View tracked:', data);
                // Update the view count in the UI
                if (data.success && data.total_clicks) {
                    const viewCountEl = document.querySelector(`.view-count-${id}`);
                    if (viewCountEl) {
                        viewCountEl.textContent = data.total_clicks.toLocaleString();
                    }
                    // Update lightbox stats
                    lightboxViews.textContent = data.total_clicks.toLocaleString();
                }
            })
            .catch(error => console.error('Error tracking view:', error));
    }

    function downloadImage() {
        if (!currentGalleryId) return;

        // Track download via AJAX
        fetch(`/gallery/${currentGalleryId}/track-download`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Download tracked:', data);

                if (data.success) {
                    // Update download count in card
                    const cardDownloadCount = document.querySelector(`.view-count-${currentGalleryId}`)
                        ?.closest('.flex.items-center.gap-6')
                        ?.querySelector('.flex.items-center.gap-2:last-child span');

                    if (cardDownloadCount && data.total_downloads) {
                        cardDownloadCount.textContent = data.total_downloads.toLocaleString();
                    }

                    // Update lightbox stats
                    if (data.total_downloads) {
                        lightboxDownloads.textContent = data.total_downloads.toLocaleString();
                    }

                    // Trigger download
                    if (data.download_url) {
                        window.location.href = data.download_url;
                    }
                }
            })
            .catch(error => {
                console.error('Error tracking download:', error);
                // Even if tracking fails, try to download
                window.location.href = `/gallery/${currentGalleryId}/download`;
            });
    }

    // Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        if (lightbox.classList.contains('hidden')) return;

        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') changeImage(-1);
        if (e.key === 'ArrowRight') changeImage(1);
    });

    // Close on background click
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) closeLightbox();
    });
</script>
@endsection