    <div class="w-[90%] max-w-[1600px] mx-auto px-8">
        <nav class="py-8 flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-heading text-2xl font-bold flex items-center gap-2">
                <i class="ri-camera-lens-line text-accent"></i>
                {{ get_site_name() }}
            </a>
            <div class="hidden md:flex gap-12 text-sm tracking-widest uppercase ml-auto">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-accent border-b border-accent pb-1' : 'text-text hover:text-accent' }} transition-all duration-300">
                    Home
                </a>
                <a href="{{ route('services') }}"
                    class="{{ request()->routeIs('services') ? 'text-accent border-b border-accent pb-1' : 'text-text hover:text-accent' }} transition-all duration-300">
                    Services
                </a>
                <a href="{{ route('gallery') }}"
                    class="{{ request()->routeIs('gallery') ? 'text-accent border-b border-accent pb-1' : 'text-text hover:text-accent' }} transition-all duration-300">
                    Gallery
                </a>
                <a href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'text-accent border-b border-accent pb-1' : 'text-text hover:text-accent' }} transition-all duration-300">
                    Contact
                </a>
            </div>
        </nav>
    </div>