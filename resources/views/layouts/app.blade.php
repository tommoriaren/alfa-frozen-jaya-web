<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - AFJ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-[#004B93] text-white hidden lg:block shadow-2xl">
            <div class="p-8 font-black italic uppercase tracking-tighter border-b border-white/10 text-xl">
                AFJ <span class="text-blue-300 italic">Admin</span>
            </div>
            <nav class="p-6 space-y-3">
                <a href="#" class="block px-6 py-3 rounded-2xl bg-white/10 text-[10px] font-black uppercase tracking-widest italic transition hover:bg-white/20">
                    Dashboard
                </a>
                <a href="#" class="block px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest italic text-blue-200 hover:bg-white/5 transition">
                    Kelola Katalog
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white h-20 border-b border-slate-100 flex items-center px-8 justify-between sticky top-0 z-40">
                <h2 class="font-black uppercase italic text-sm text-[#004B93] tracking-widest">Manajemen Data</h2>
                <div class="flex items-center gap-4">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Admin Bekasi</span>
                </div>
            </header>

            <main class="p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>