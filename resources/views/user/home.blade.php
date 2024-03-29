<x-user-layout title="Home">
    <section class="__container min-h-[80vh]  flex items-center w-full">
        <div class="flex  items-center gap-16">
            <div class="md:w-8/12 w-full flex flex-col gap-6 h-full justify-between ">
                <div class="">
                    <h1 class="text-4xl font-bold">Bang R dan Kak L - Official</h1>
                    <p class="my-5 text-xl font-normal text-gray-700">
                        Halo semuanya, selamat datang di Website kami! Temukan keuntungan lebih dengan menukar poin
                        Anda. Pastikan untuk login terlebih dahulu untuk pengalaman yang lebih istimewa!
                    </p>
                </div>
                @auth
                <div class="flex">
                    <a href="{{ route('user.profile') }}"
                        class="bg-indigo-600 text-neutral-50 px-6 py-3 flex justify-center items-center gap-2 rounded-full font-bold">
                        <span>Cek Poin Anda</span>
                    </a>
                </div>
                @else
                <div class="flex">
                    <a href="/login"
                        class="bg-indigo-600 text-neutral-50 px-6 py-3 flex justify-center items-center gap-2 rounded-full font-bold">
                        <span>Login Sekarang</span>
                    </a>
                </div>
                @endauth
            </div>
            <div class="w-4/12 aspect-square md:block hidden">
                <img class="object-contain object-center w-full h-full" src="{{ asset('images/char.png') }}" alt="">
            </div>
        </div>
    </section>
    <section class="__container mt-8 mb-16">
        <h2 class="text-center text-2xl underline font-semibold text-indigo-700">Tutorial Mendapatkan Poin</h2>
        <div class="flex flex-wrap md:flex-nowrap md:gap-x-5 gap-x-0 md:gap-y-5 gap-y-5 mt-10 text-center">
            <div class="border md:p-16  p-5 flex flex-col justify-center md:w-6/12 w-full rounded-lg bg-white">
                <h2 class="text-2xl pt-5 font-semibold">Jangan lupa ya, Ikuti selalu tutorial dari kami.</h2>
                <p class="pt-2 pb-5">
                    Selalu teruskan perjalanan pembelajaran Anda dengan mengikuti tutorial kami.
                    Temukan wawasan, pengetahuan, dan keterampilan baru untuk mengembangkan diri Anda. Bersama, kita
                    menjelajahi dunia pembelajaran yang tak terbatas. Mari belajar bersama!
                </p>
            </div>
            <div class="border md:p-16  p-5 flex flex-col justify-center md:w-6/12 w-full rounded-lg bg-white">
                <h2 class="text-2xl pt-5 font-semibold">Masuk kedalam grup khusus untuk dapatkan poin extra.</h2>
                <p class="pt-2 pb-5">
                    Bergabunglah dalam grup eksklusif kami dan raih poin ekstra! Temukan keuntungan istimewa, akses
                    informasi eksklusif, dan raih kesempatan unik yang hanya bisa didapatkan di dalam grup ini. Jangan
                    lewatkan kesempatan untuk meningkatkan pengalaman Anda. Segera bergabung dan dapatkan poin ekstra
                    secara eksklusif!
                </p>
            </div>
        </div>
    </section>
</x-user-layout>