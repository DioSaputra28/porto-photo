    <footer class="bg-[#1a1a1a] border-t border-white/5 pt-16 pb-8 text-sm">
        <div class="w-[90%] max-w-[1600px] mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand & Desc -->
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="font-heading text-2xl font-bold flex items-center gap-3 mb-6 text-white">
                        @if(get_site_logo())
                        <img src="{{ get_site_logo() }}" alt="{{ get_site_name() }} Logo" class="h-10 w-10 object-contain">
                        @else
                        <i class="ri-camera-lens-line text-accent"></i>
                        @endif
                        {{ get_site_name() }}
                    </a>
                    <p class="text-muted leading-relaxed mb-6">
                        Capturing life's most precious moments with artistic vision and professional excellence. Let's create something beautiful together.
                    </p>

                    <!-- Socials -->
                    <div class="flex gap-4">
                        @if(get_site_instagram())
                        <a href="{{ get_site_instagram() }}" target="_blank" class="w-[35px] h-[35px] rounded-full bg-white/5 flex items-center justify-center hover:bg-accent hover:text-black transition-all duration-300">
                            <i class="ri-instagram-line text-lg"></i>
                        </a>
                        @endif

                        @if(get_site_facebook())
                        <a href="{{ get_site_facebook() }}" target="_blank" class="w-[35px] h-[35px] rounded-full bg-white/5 flex items-center justify-center hover:bg-accent hover:text-black transition-all duration-300">
                            <i class="ri-facebook-line text-lg"></i>
                        </a>
                        @endif

                        @if(get_site_twitter())
                        <a href="{{ get_site_twitter() }}" target="_blank" class="w-[35px] h-[35px] rounded-full bg-white/5 flex items-center justify-center hover:bg-accent hover:text-black transition-all duration-300">
                            <i class="ri-twitter-x-fill text-lg"></i>
                        </a>
                        @endif

                        @if(get_site_youtube())
                        <a href="{{ get_site_youtube() }}" target="_blank" class="w-[35px] h-[35px] rounded-full bg-white/5 flex items-center justify-center hover:bg-accent hover:text-black transition-all duration-300">
                            <i class="ri-youtube-line text-lg"></i>
                        </a>
                        @endif

                        @if(get_site_tiktok())
                        <a href="{{ get_site_tiktok() }}" target="_blank" class="w-[35px] h-[35px] rounded-full bg-white/5 flex items-center justify-center hover:bg-accent hover:text-black transition-all duration-300">
                            <i class="ri-tiktok-fill text-lg"></i>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-heading text-lg mb-6">Quick Links</h4>
                    <ul class="flex flex-col gap-4 text-muted">
                        <li>
                            <a href="{{ route('home') }}" class="hover:text-accent transition-colors flex items-center gap-2">
                                <i class="ri-arrow-right-s-line text-accent"></i> Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services') }}" class="hover:text-accent transition-colors flex items-center gap-2">
                                <i class="ri-arrow-right-s-line text-accent"></i> Services
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gallery') }}" class="hover:text-accent transition-colors flex items-center gap-2">
                                <i class="ri-arrow-right-s-line text-accent"></i> Gallery
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="hover:text-accent transition-colors flex items-center gap-2">
                                <i class="ri-arrow-right-s-line text-accent"></i> Contact
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="lg:col-span-2">
                    <h4 class="text-white font-heading text-lg mb-6">Contact Us</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @if(get_site_email())
                        <div class="flex items-start gap-4">
                            <i class="ri-mail-line text-accent text-xl mt-1"></i>
                            <div>
                                <span class="block text-muted text-xs uppercase tracking-widest mb-1">Email</span>
                                <a href="mailto:{{ get_site_email() }}" class="text-white hover:text-accent transition-colors">{{ get_site_email() }}</a>
                            </div>
                        </div>
                        @endif

                        @if(get_site_whatsapp() || get_site_phone())
                        <div class="flex items-start gap-4">
                            <i class="ri-phone-line text-accent text-xl mt-1"></i>
                            <div>
                                <span class="block text-muted text-xs uppercase tracking-widest mb-1">Phone / WA</span>
                                <span class="text-white block">{{ get_site_whatsapp() ?? get_site_phone() }}</span>
                            </div>
                        </div>
                        @endif

                        @if(get_site_address())
                        <div class="flex items-start gap-4 sm:col-span-2">
                            <i class="ri-map-pin-line text-accent text-xl mt-1"></i>
                            <div>
                                <span class="block text-muted text-xs uppercase tracking-widest mb-1">Studio</span>
                                <p class="text-white leading-relaxed max-w-sm">{{ get_site_address() }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row items-center justify-between text-muted gap-4">
                <p>&copy; {{ date('Y') }} {{ get_site_name() }}. All Rights Reserved.</p>
                <p class="text-xs">
                    Designed with <i class="ri-heart-fill text-accent mx-1"></i> by OJJ.
                </p>
            </div>
        </div>
    </footer>