@php use Illuminate\Support\Facades\Storage; @endphp

<div>
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

    <!-- Category Filter -->
    <section class="py-8 border-b border-white/10" id="category-filter">
        <div class="w-[90%] max-w-[1600px] mx-auto px-8">
            <div class="flex items-center gap-4 overflow-x-auto scrollbar-hide pb-2">
                <!-- All Categories Button -->
                <button wire:click="selectCategory(null)"
                    class="category-filter-btn {{ !$selectedCategory ? 'active' : '' }} flex-shrink-0 px-6 py-2.5 rounded-full border-2 transition-all duration-300 font-medium text-sm tracking-wide uppercase
                          {{ !$selectedCategory ? 'bg-accent border-accent text-black' : 'border-white/20 text-white/70 hover:border-accent hover:text-accent' }}">
                    All
                </button>

                <!-- Category Buttons -->
                @foreach($categories as $category)
                <button wire:click="selectCategory({{ $category->id }})"
                    class="category-filter-btn {{ $selectedCategory == $category->id ? 'active' : '' }} flex-shrink-0 px-6 py-2.5 rounded-full border-2 transition-all duration-300 font-medium text-sm tracking-wide uppercase
                          {{ $selectedCategory == $category->id ? 'bg-accent border-accent text-black' : 'border-white/20 text-white/70 hover:border-accent hover:text-accent' }}">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-12" id="gallery-grid">
        <div class="w-[90%] max-w-[1600px] mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-container">
                @foreach($galleries as $index => $gallery)
                <div wire:key="gallery-{{ $gallery->id }}"
                    class="group relative bg-[#1a1a1a] rounded overflow-hidden gallery-item"
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
                                <i class="ri-download-cloud-line text-lg hover:text-accent transition-colors cursor-pointer"
                                    onclick="downloadFromCard({{ $gallery->id }})"></i>
                                <span class="download-count-{{ $gallery->id }}">{{ number_format($gallery->total_download) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($galleries->isEmpty())
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="relative mb-8">
                    <!-- Animated Circle Background -->
                    <div class="absolute inset-0 bg-accent/10 rounded-full blur-3xl animate-pulse"></div>

                    <!-- Icon -->
                    <div class="relative bg-[#1a1a1a] border-2 border-white/10 rounded-full p-8">
                        <i class="ri-camera-off-line text-6xl text-accent"></i>
                    </div>
                </div>

                <h3 class="font-heading text-3xl md:text-4xl text-white mb-4">
                    No Photos Found
                </h3>

                <p class="text-muted text-lg max-w-md mb-8">
                    @if($selectedCategory)
                    There are no photos in this category yet. Check back soon or explore other categories.
                    @else
                    The gallery is currently empty. New photos will be added soon.
                    @endif
                </p>

                @if($selectedCategory)
                <button wire:click="selectCategory(null)"
                    class="inline-flex items-center gap-2 bg-accent text-black font-bold px-8 py-3 rounded-full hover:bg-white transition-all duration-300 group">
                    <i class="ri-arrow-left-line text-xl group-hover:-translate-x-1 transition-transform"></i>
                    View All Photos
                </button>
                @endif
            </div>
            @endif

            <!-- Load More Button -->
            @if($hasMore)
            <div class="text-center mt-16" id="load-more-container">
                <button wire:click="loadMore"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center gap-3 bg-accent text-black font-bold px-10 py-4 rounded-full hover:bg-white transition-all duration-300 group disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="loadMore">Load More</span>
                    <span wire:loading wire:target="loadMore">Loading...</span>
                    <i class="ri-arrow-down-line text-xl group-hover:translate-y-1 transition-transform" wire:loading.remove wire:target="loadMore"></i>
                    <i class="ri-loader-4-line text-xl animate-spin" wire:loading wire:target="loadMore"></i>
                </button>
            </div>
            @endif
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
        /* Hide scrollbar for category filter */
        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari and Opera */
        }
    </style>

    <!-- Lightbox Modal (wire:ignore to prevent Livewire from updating it) -->
    <div wire:ignore>
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
                <div class="relative max-w-full max-h-full flex items-center justify-center">
                    <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[90vh] object-contain shadow-2xl rounded opacity-0 scale-95 transition-all duration-500" />
                </div>

                <!-- Navigation Next -->
                <button onclick="changeImage(1)" class="absolute right-4 md:right-8 text-white/50 hover:text-accent transition-colors hidden md:block group p-4">
                    <i class="ri-arrow-right-line text-4xl group-hover:translate-x-2 transition-transform duration-300"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Lightbox Script & Styles -->
    <script>
        // Gallery items for lightbox
        let totalItems = 0;
        let currentIndex = 0;
        let currentGalleryId = null;
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');

        // Update total items after Livewire updates
        document.addEventListener('livewire:init', () => {
            Livewire.hook('morph.updated', () => {
                updateTotalItems();
            });
            updateTotalItems();
        });

        function updateTotalItems() {
            totalItems = document.querySelectorAll('.gallery-item').length;
        }

        function openLightbox(index) {
            currentIndex = index;
            updateLightboxContent();

            lightbox.classList.remove('hidden', 'pointer-events-none');
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
                lightboxImage.classList.remove('opacity-0', 'scale-95');
            }, 10);

            document.body.style.overflow = 'hidden'; // Prevent scrolling

            // Track View
            trackView(index);
        }

        function closeLightbox() {
            lightbox.classList.add('opacity-0');
            lightboxImage.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                lightbox.classList.add('hidden', 'pointer-events-none');
                document.body.style.overflow = '';
            }, 300);
        }

        function changeImage(direction) {
            // Fade out current content
            lightboxImage.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                currentIndex = (currentIndex + direction + totalItems) % totalItems;
                updateLightboxContent();

                // Fade in new content
                lightboxImage.classList.remove('opacity-0', 'scale-95');

                // Track View for new image
                trackView(currentIndex);
            }, 300);
        }

        function updateLightboxContent() {
            const currentElement = document.querySelector(`.gallery-item[data-index="${currentIndex}"]`);
            if (currentElement) {
                currentGalleryId = currentElement.dataset.id;
                lightboxImage.src = currentElement.dataset.image;
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
                    }
                })
                .catch(error => console.error('Error tracking view:', error));
        }

        function downloadFromCard(galleryId) {
            // Track download via AJAX
            fetch(`/gallery/${galleryId}/track-download`, {
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
                        const downloadCountEl = document.querySelector(`.download-count-${galleryId}`);
                        if (downloadCountEl && data.total_downloads) {
                            downloadCountEl.textContent = data.total_downloads.toLocaleString();
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
                    window.location.href = `/gallery/${galleryId}/download`;
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
</div>