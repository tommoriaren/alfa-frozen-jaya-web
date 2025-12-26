<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-blue-100 h-20">
    <div class="max-w-7xl mx-auto px-6 h-full flex justify-between items-center">
        
        <a href="{{ route('home') }}" class="flex-shrink-0 group transition-transform duration-300 hover:scale-105">
            <img src="{{ asset('images/logoafj.jpg') }}" 
                alt="Alfa Frozen Jaya - Aneka Frozen & Sembako" 
                class="h-12 md:h-16 w-auto object-contain">
        </a>

        <nav class="hidden md:flex items-center space-x-8">
            @php 
                $navs = [
                    'home' => 'Beranda', 
                    'catalog' => 'Katalog', 
                    'about' => 'Tentang', 
                    'reseller' => 'Reseller'
                ]; 
            @endphp
            @foreach($navs as $route => $label)
                <a href="{{ route($route) }}" 
                   class="text-[11px] font-black uppercase tracking-widest transition-all duration-300 
                   {{ request()->routeIs($route) 
                      ? 'text-[#FF2800] border-b-2 border-[#FF2800] pb-1' 
                      : 'text-slate-400 hover:text-[#004B93]' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
    </div>
</header>

<nav class="md:hidden fixed bottom-0 left-0 z-50 w-full h-20 bg-white/95 backdrop-blur-xl border-t border-blue-50 flex items-center justify-around px-2 shadow-[0_-10px_30px_rgba(0,0,0,0.05)]">
    @php 
        $mobileNavs = [
            ['route' => 'home', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Beranda'],
            ['route' => 'catalog', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z', 'label' => 'Katalog'],
            ['route' => 'about', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Tentang'],
            ['route' => 'reseller', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'label' => 'Reseller']
        ];
    @endphp
    @foreach($mobileNavs as $nav)
        <a href="{{ route($nav['route']) }}" 
           class="flex flex-col items-center gap-1 w-1/4 transition-colors duration-300 {{ request()->routeIs($nav['route']) ? 'text-[#004B93]' : 'text-slate-400' }}">
            <div class="px-4 py-1.5 rounded-2xl {{ request()->routeIs($nav['route']) ? 'bg-blue-50' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $nav['icon'] }}"></path>
                </svg>
            </div>
            <span class="text-[8px] font-black uppercase tracking-tighter italic">{{ $nav['label'] }}</span>
        </a>
    @endforeach
</nav>