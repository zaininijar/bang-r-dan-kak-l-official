<x-user-layout title="Penukaran Point">
    <section class="bg-indigo-50/40">
        <div class="__container py-24"
            x-data="{exchange_type: '', exchange_id: '', account_identity: {main: '', second: ''}, isSuccess: true}">
            @if ($errors->any())
            <div class="bg-red-50 px-4 py-2 rounded-md mt-8 text-red-500 border mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="list-disc list-inside">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <span x-text="account_identity.second"></span>
            @if (session('success'))
            <div x-show="isSuccess"
                class="flex min-h-screen w-full fixed z-10 inset-0 items-center justify-center bg-slate-700/10 backdrop-blur-md">
                <div class="rounded-lg bg-gray-50 px-16 py-14 relative">
                    <svg class="w-5 h-5 absolute top-3 right-3 cursor-pointer" @click="isSuccess = false"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M11.9997 10.5865L16.9495 5.63672L18.3637 7.05093L13.4139 12.0007L18.3637 16.9504L16.9495 18.3646L11.9997 13.4149L7.04996 18.3646L5.63574 16.9504L10.5855 12.0007L5.63574 7.05093L7.04996 5.63672L11.9997 10.5865Z"
                            fill="rgba(0,0,0,1)"></path>
                    </svg>
                    <div class="flex justify-center">
                        <div class="rounded-full bg-green-200 p-6">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-500 p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="my-4 text-center text-3xl font-semibold text-gray-700">Selamat Ya!!!</h3>
                    <p class="w-[230px] text-center font-normal text-gray-600">{{ session('success') }}</p>
                    <a href="{{ route('user.penukaran-point.history') }}"
                        class="mx-auto mt-10 block rounded-xl border-4 border-transparent bg-indigo-600 px-6 py-2 text-center text-base font-medium text-indigo-50 outline-8 hover:outline hover:duration-300">
                        Cek Penukaran
                    </a>
                </div>
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-50 px-4 py-2 rounded-md mt-8 text-red-500 border mb-4">
                <div class="list-disc list-inside">{{ session('error') }}</div>
            </div>
            @endif

            <div class="text-2xl font-bold">
                Halaman Penukaran
            </div>
            <div>
                Point Anda : <span
                    class="text-indigo-500 bg-indigo-50 p-1 rounded-md text-sm">{{ Auth::user()->point }}</span>
            </div>
            <form action="{{ route('user.penukaran-point.store') }}" method="post"
                class="border rounded-lg md:p-8 py-8 px-4 mt-8 grid grid-cols-1 gap-8 bg-white">
                @csrf
                <div>
                    <h3 class="font-bold">Pilih Penukaran</h3>
                    <input type="hidden" name="exchange_type" x-model="exchange_type">
                    <input type="hidden" name="exchange_id" x-model="exchange_id">
                    <ul class="flex gap-3 mt-2">
                        <li @click="exchange_type = 'ML', account_identity.main = '', account_identity.second = '', exchange_id = ''"
                            :class="exchange_type == 'ML' ? 'bg-blue-200 border border-blue-500' : ''"
                            class="bg-indigo-50 text-indigo-500 px-4 py-2 rounded-md cursor-pointer hover:bg-indigo-100">
                            ML
                        </li>
                        <li @click="exchange_type = 'FF', account_identity.main = '', account_identity.second = '', exchange_id = ''"
                            :class="exchange_type == 'FF' ? 'bg-blue-200 border border-blue-500' : ''"
                            class="bg-indigo-50 text-indigo-500 px-4 py-2 rounded-md cursor-pointer hover:bg-indigo-100">
                            FF
                        </li>
                        <li @click="exchange_type = 'RBX', account_identity.main = '', account_identity.second = '', exchange_id = ''"
                            :class="exchange_type == 'RBX' ? 'bg-blue-200 border border-blue-500' : ''"
                            class="bg-indigo-50 text-indigo-500 px-4 py-2 rounded-md cursor-pointer hover:bg-indigo-100">
                            Roblox
                        </li>
                        <li @click="exchange_type = 'E-WALLET', account_identity.main = '', account_identity.second = 'DANA', exchange_id = ''"
                            :class="exchange_type == 'E-WALLET' ? 'bg-blue-200 border border-blue-500' : ''"
                            class="bg-indigo-50 text-indigo-500 px-4 py-2 rounded-md cursor-pointer hover:bg-indigo-100">
                            E-Wallet
                        </li>
                    </ul>
                </div>
                <div :class="exchange_type !== '' ? '' : 'hidden'">
                    <h3 x-show="exchange_type == 'ML'">
                        Masukkan ID dan Server
                        <span class="font-bold">Mobile Legend BB</span>
                    </h3>
                    <h3 x-show="exchange_type == 'FF'">Masukkan ID <span class="font-bold">Free Fire</span></h3>
                    <h3 x-show="exchange_type == 'RBX'">Masukkan Link Gamepass <span class="font-bold">Roblox</span>
                    </h3>
                    <h3 x-show="exchange_type == 'E-WALLET'">Masukkan No <span class="font-bold">E-Wallet</span></h3>
                    <div :class="exchange_type !== '' ? 'mt-2 flex gap-3' : 'hidden'">
                        <input name="account_identity_main" x-model="account_identity.main" type="text"
                            class="bg-white md:w-1/3 w-full font-bold text-indigo-500 px-2 py-2 rounded-md focus:bg-indigo-50 border-indigo-400" />
                        <select x-model="account_identity.second" x-show="exchange_type == 'E-WALLET'"
                            class="bg-white font-bold text-indigo-500 px-2 py-2 rounded-md focus:bg-indigo-50 border-indigo-400 w-[100px]">
                            <option value="DANA">DANA</option>
                            <option value="OVO">OVO</option>
                            <option value="GOPAY">GOPAY</option>
                        </select>
                        <input x-model="account_identity.second" type="hidden" name="account_identity_second">
                        <input x-model="account_identity.second" x-show="exchange_type == 'ML'" type="number"
                            class="bg-white font-bold text-indigo-500 px-2 py-2 rounded-md focus:bg-indigo-50 border-indigo-400 w-[100px]" />
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8">
                    <div
                        :class="exchange_type !== 'RBX' ? 'cursor-not-allowed' : 'p-4 order-first bg-indigo-100/20 border border-indigo-500 rounded-lg'">
                        <div class="flex gap-3">
                            <h3 class="font-bold">Tukar Ke Robux</h3>
                            <img class="w-6" src="{{ asset('images/robux.png') }}" alt="">
                        </div>
                        <ul class="flex flex-wrap gap-3 mt-2"
                            :class="exchange_type !== 'RBX' ? 'cursor-not-allowed' : ''">
                            @foreach ($exchanges['RBX'] as $rbx)
                            <li :class="exchange_type !== 'RBX' ? 'cursor-not-allowed' : ''"
                                @click="exchange_type == 'RBX' ? exchange_id = {{ $rbx->id }} : ''">
                                <div class="text-sm px-4 py-2">
                                    {{ $rbx->point }} Point
                                </div>
                                <div :class="exchange_id == {{ $rbx->id }} && exchange_type == 'RBX' ? 'bg-blue-200 border border-blue-500' : ''"
                                    class="flex gap-3 bg-indigo-50 text-indigo-500 px-4 py-2 rounded-md cursor-pointer hover:bg-indigo-100">
                                    <h3>{{ $rbx->exchanged_to }}</h3>
                                    <img class="w-6" src="{{ asset('images/robux.png') }}" alt="">
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div
                        :class="exchange_type !== 'E-WALLET' ? 'cursor-not-allowed' : 'p-4 order-first bg-indigo-100/20 border border-indigo-500 rounded-lg'">
                        <div class="flex gap-3">
                            <h3 class="font-bold">Tukar Ke E-Wallet</h3>
                            <img class="w-6" src="{{ asset('images/indonesian-rupiah.png') }}" alt="">
                        </div>
                        <ul class="flex flex-wrap gap-3 mt-2">
                            @foreach ($exchanges['E-WALLET'] as $ewallet)
                            <li :class="exchange_type !== 'E-WALLET' ? 'cursor-not-allowed' : ''"
                                @click="exchange_type == 'E-WALLET' ? exchange_id = {{ $ewallet->id }} : ''">
                                <div class="text-sm px-4 py-2">
                                    {{ $ewallet->point }} Point
                                </div>
                                <div :class="exchange_id == {{ $ewallet->id }} && exchange_type == 'E-WALLET' ? 'bg-blue-200 border border-blue-500' : ''"
                                    class="flex gap-3 bg-indigo-50 text-indigo-500 px-4 py-2 rounded-md cursor-pointer hover:bg-indigo-100">
                                    <h3>{{ $ewallet->exchanged_to }}</h3>
                                    <img class="w-6" src="{{ asset('images/indonesian-rupiah.png') }}" alt="">
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div
                        :class="exchange_type !== 'ML' ? 'cursor-not-allowed' : 'p-4 order-first bg-indigo-100/20 border border-indigo-500 rounded-lg'">
                        <div class="flex gap-3">
                            <h3 class="font-bold">Tukar Ke Diamond Mobile Legends</h3>
                            <img class="w-6 h-6" src="{{ asset('images/diamond.png') }}" alt="">
                        </div>
                        <ul class="flex flex-wrap gap-3 mt-2">
                            @foreach ($exchanges['ML'] as $ml)
                            <li :class="exchange_type !== 'ML' ? 'cursor-not-allowed' : ''"
                                @click="exchange_type == 'ML' ? exchange_id = {{ $ml->id }} : ''">
                                <div class="text-sm px-4 py-2">
                                    {{ $ml->point }} Point
                                </div>
                                <div :class="exchange_id == {{ $ml->id }} && exchange_type == 'ML' ? 'bg-blue-200 border border-blue-500' : ''"
                                    class="flex gap-3 bg-indigo-50 text-indigo-500 px-4 py-2 rounded-md cursor-pointer hover:bg-indigo-100">
                                    <h3>{{ $ml->exchanged_to }}</h3>
                                    <img class="w-6" src="{{ asset('images/diamond.png') }}" alt="">
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div
                        :class="exchange_type !== 'FF' ? 'cursor-not-allowed' : 'p-4 order-first bg-indigo-100/20 border border-indigo-500 rounded-lg'">
                        <div class="flex gap-3">
                            <h3 class="font-bold">Tukar Ke Diamond Free Fire</h3>
                            <img class="w-6" src="{{ asset('images/Freefire_diamonds.png') }}" alt="">
                        </div>
                        <ul class="flex flex-wrap gap-3 mt-2">
                            @foreach ($exchanges['FF'] as $ff)
                            <li :class="exchange_type !== 'FF' ? 'cursor-not-allowed' : ''"
                                @click="exchange_type == 'FF' ? exchange_id = {{ $ff->id }} : ''">
                                <div class="text-sm px-4 py-2">
                                    {{ $ff->point }} Point
                                </div>
                                <div :class="exchange_id == {{ $ff->id }} && exchange_type == 'FF' ? 'bg-blue-200 border border-blue-500' : ''"
                                    class="flex gap-3 bg-indigo-50 text-indigo-500 px-4 py-2 rounded-md cursor-pointer hover:bg-indigo-100">
                                    <h3>{{ $ff->exchanged_to }}</h3>
                                    <img class="w-6" src="{{ asset('images/Freefire_diamonds.png') }}" alt="">
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div>
                    <label class="relative flex gap-3 cursor-pointer items-center rounded-full md:py-3 py-0"
                        for="checkbox" data-ripple-dark="true">
                        <input type="checkbox" required
                            class="before:content[''] peer relative h-5 w-5 bg-indigo-50 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-indigo-500 checked:bg-indigo-600 checked:before:bg-indigo-600 hover:before:opacity-10"
                            id="checkbox" />
                        <div
                            class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                fill="currentColor" stroke="currentColor" stroke-width="1">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="md:text-base text-sm">
                            Yakin anda menukar point ya kesana?
                        </div>
                    </label>
                </div>
                <div>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 md:w-auto w-full rounded-lg">
                        Lanjutkan
                    </button>
                </div>
            </form>
        </div>

    </section>


</x-user-layout>