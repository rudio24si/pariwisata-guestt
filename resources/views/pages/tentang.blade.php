@extends('layouts.guest.app')

@section('content')
<main class="bg-white overflow-hidden">

    <section class="relative h-[60vh] md:h-[75vh] flex items-center justify-center text-center text-white bg-fixed bg-center bg-cover bg-no-repeat"
             style="background-image: url('https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-slate-900/50 mix-blend-multiply"></div>
        
        <div class="relative z-10 container mx-auto px-4" data-aos="zoom-in" data-aos-duration="1000">
            <span class="block text-blue-300 font-semibold tracking-wider uppercase mb-4">Tentang Kami</span>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                Menemukan Keajaiban <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-green-400">Pesona Indonesia</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto">
                Jembatan Anda menuju surga tersembunyi dan pengalaman menginap lokal yang autentik di seluruh nusantara.
            </p>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1" d="M0,64L48,80C96,96,192,128,288,128C384,128,480,96,576,90.7C672,85,768,107,864,122.7C960,139,1056,149,1152,133.3C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4 text-center max-w-3xl" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-slate-800 mb-6">Lebih Dari Sekadar Perjalanan</h2>
            <p class="text-slate-600 text-lg leading-relaxed mb-8">
                Kami percaya bahwa pariwisata terbaik adalah yang menghubungkan hati pelancong dengan jiwa destinasi tersebut. Platform kami dirancang untuk memperkenalkan Anda pada keindahan alam Indonesia yang ikonik sekaligus memberikan kenyamanan seperti di rumah sendiri melalui jaringan homestay pilihan kami.
            </p>
            <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
        </div>
    </section>

    <section class="py-16 overflow-visible">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                <div class="lg:w-1/2 relative" data-aos="fade-right">
                    <div class="absolute top-8 -left-8 w-4/5 h-full rounded-3xl overflow-hidden shadow-xl bg-slate-200 z-0 transform -rotate-3 opacity-50 md:opacity-100 hidden md:block">
                        <img src="https://images.unsplash.com/photo-1537956968969-893291350203?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover grayscale opacity-60" alt="Candi Indonesia">
                    </div>
                    <div class="relative z-10 rounded-[40px] overflow-hidden shadow-2xl border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1552442319-593174429d56?auto=format&fit=crop&w=800&q=80" 
                             alt="Destinasi Air Terjun Indonesia" class="w-full h-[500px] object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-2xl shadow-lg z-20 hidden md:block">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                <i class="bi bi-geo-alt-fill text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">100+ Destinasi</h4>
                                <p class="text-sm text-slate-500">Tersebar di Nusantara</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2" data-aos="fade-left">
                    <span class="text-blue-600 font-bold uppercase tracking-wider text-sm mb-2 block">Jelajahi Alam</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Destinasi Wisata yang <br> <span class="text-blue-600">Memanjakan Mata</span></h2>
                    <p class="text-slate-600 text-lg mb-6 leading-relaxed">
                        Indonesia adalah kanvas keindahan alam yang tak terbatas. Dari birunya laut Raja Ampat, megahnya Gunung Bromo, hingga hijaunya sawah terasering di Ubud. Kami mengkurasi destinasi terbaik agar Anda dapat merasakan petualangan yang sesungguhnya.
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-slate-700">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3"></i> Wisata Alam & Bahari
                        </li>
                        <li class="flex items-center text-slate-700">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3"></i> Warisan Budaya & Sejarah
                        </li>
                        <li class="flex items-center text-slate-700">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3"></i> Spot Foto Instagramable
                        </li>
                    </ul>
                    <a href="#" class="inline-flex items-center font-bold text-blue-600 hover:text-blue-700 transition-colors group">
                        Lihat Semua Destinasi 
                        <i class="bi bi-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-50 relative">
         <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/3 opacity-10 pointer-events-none">
             <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-[600px] h-[600px] text-green-300 fill-current">
                <path d="M44.7,-76.4C58.8,-69.2,71.8,-59.1,82.3,-46.4C92.7,-33.7,100.6,-18.5,100.7,-3.3C100.8,11.9,93.1,27.1,84.7,41.2C76.3,55.3,67.2,68.4,54.6,77.9C42,87.4,25.9,93.3,9.4,94.3C-7.1,95.3,-25.2,91.4,-41.5,85.6C-57.8,79.8,-72.3,72.1,-83.1,60C-93.9,47.9,-101,31.4,-103.9,14.3C-106.9,-2.8,-105.7,-20.5,-99.8,-36.9C-93.9,-53.3,-83.3,-68.4,-69.3,-76.2C-55.4,-84,-38.1,-84.5,-23.2,-87.3C-8.3,-90.1,4.2,-95.2,17.3,-93.8C30.4,-92.4,44,-84.5,44.7,-76.4Z" transform="translate(100 100)" />
            </svg>
         </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row-reverse items-center gap-12 lg:gap-20">
                 <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="relative group">
                        <div class="absolute inset-0 border-4 border-green-200 translate-x-4 translate-y-4 rounded-tr-[80px] rounded-bl-[80px] group-hover:translate-x-2 group-hover:translate-y-2 transition-transform duration-300"></div>
                        <img src="https://images.unsplash.com/photo-1598935898639-38f8fb91365f?auto=format&fit=crop&w=800&q=80" 
                             alt="Homestay Nyaman Indonesia" 
                             class="relative z-10 w-full h-[500px] object-cover rounded-tr-[80px] rounded-bl-[80px] shadow-xl">
                    </div>
                </div>

                <div class="lg:w-1/2" data-aos="fade-right">
                    <span class="text-green-600 font-bold uppercase tracking-wider text-sm mb-2 block">Kenyamanan Lokal</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Homestay Autentik, <br> <span class="text-green-600">Serasa di Rumah</span></h2>
                    <p class="text-slate-600 text-lg mb-6 leading-relaxed">
                        Beristirahatlah dalam kenyamanan yang sesungguhnya. Homestay kami dipilih tidak hanya berdasarkan fasilitasnya, tetapi juga karakter dan kehangatan pemiliknya. Rasakan keramahan khas Indonesia dan bangun pagi dengan pemandangan yang menakjubkan tepat di depan jendela Anda.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 flex items-start">
                            <i class="bi bi-house-heart text-2xl text-green-600 mr-3"></i>
                            <div>
                                <h5 class="font-bold text-slate-800">Desain Khas</h5>
                                <p class="text-sm text-slate-500">Sentuhan arsitektur lokal.</p>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 flex items-start">
                            <i class="bi bi-cup-hot text-2xl text-green-600 mr-3"></i>
                            <div>
                                <h5 class="font-bold text-slate-800">Kuliner Lokal</h5>
                                <p class="text-sm text-slate-500">Sarapan otentik buatan tuan rumah.</p>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="button button--primary shadow-lg shadow-blue-200/50">
                        Cari Penginapan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-blue-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div data-aos="zoom-in" data-aos-delay="0">
                    <h3 class="text-4xl md:text-5xl font-extrabold mb-2 text-blue-300">200+</h3>
                    <p class="text-blue-100 font-medium">Homestay Terdaftar</p>
                </div>
                <div data-aos="zoom-in" data-aos-delay="100">
                    <h3 class="text-4xl md:text-5xl font-extrabold mb-2 text-green-300">50+</h3>
                    <p class="text-blue-100 font-medium">Kota & Kabupaten</p>
                </div>
                <div data-aos="zoom-in" data-aos-delay="200">
                    <h3 class="text-4xl md:text-5xl font-extrabold mb-2 text-yellow-300">15k+</h3>
                    <p class="text-blue-100 font-medium">Tamu Bahagia</p>
                </div>
                <div data-aos="zoom-in" data-aos-delay="300">
                    <h3 class="text-4xl md:text-5xl font-extrabold mb-2 text-red-300">4.9</h3>
                    <p class="text-blue-100 font-medium">Rating Rata-rata</p>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

@push('styles')
<style>
    /* Tambahan CSS khusus jika diperlukan, 
       tapi sebagian besar sudah dicover oleh Tailwind di atas */
    .bg-fixed {
        /* Fix untuk parallax di mobile device tertentu */
        background-attachment: fixed;
    }
    @media (pointer: coarse) {
        .bg-fixed {
            background-attachment: scroll;
        }
    }
</style>
@endpush