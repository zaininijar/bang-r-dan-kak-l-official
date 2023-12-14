<x-app-layout>
    <div
        x-data="{ isOpenModal: false, isOpenAlert: true, form: { isUpdate: false, data: { id: '', name: '', username: '', point: 0, no_absensi: '', password: '', password_confirmation: '' } } }">
        <x-validation-errors class="mb-4" />
        <div class="__container">
            <div class="py-4 md:py-7">
                @if ($message = Session::get('success'))
                <div x-show="isOpenAlert"
                    class="bg-green-50 text-green-500 px-6 py-4 mb-4 shadow-sm rounded-md flex justify-between items-center">
                    <span>{{ $message }}</span>
                    <div @click="isOpenAlert = false" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20"
                            height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </div>
                </div>
                @endif
                <div
                    class="flex flex-wrap items-center justify-center md:justify-between rounded-lg md:px-8 md:py-4 p-3 bg-indigo-50 border border-indigo-500 shadow-lg">
                    <h1
                        class="focus:outline-none text-base text-center md:py-0 py-2 md:text-start sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-indigo-600">
                        Semua Penukaran
                    </h1>
                    <div
                        class="flex  md:w-auto w-full  py-2 items-center md:justify-start justify-between text-base font-medium leading-none text-indigo-600 cursor-pointer rounded">
                        <p>Search</p>
                        <input id="searchInput" type="search" onkeyup="search(event)"
                            class="focus:text-indigo-600 text-base focus:outline-none bg-transparent ml-2 px-4 py-2 md:w-64 w-full rounded-md bg-white border-gray-300" />
                    </div>
                </div>
            </div>
            <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 rounded-lg border border-indigo-500 shadow-lg">
                <div class="mt-7 overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <th>
                                <tr
                                    class="focus:outline-none h-12 border-t border-b border-gray-100 rounded font-bold leading-none text-indigo-700 bg-indigo-50">
                                    <td class="pl-5">No</td>
                                    <td class="pl-5">Username</td>
                                    <td class="text-center">Metode Penukaran</td>
                                    <td class="pl-5">Ditukar Ke</td>
                                    <td class="pl-5">Identity</td>
                                    <td class="pl-5">Poin</td>
                                    <td class="pl-5"></td>
                                </tr>
                            </th>
                        </thead>
                        <tbody id="searchResults">
                            @foreach ($transactions as $key => $trans)
                            <tr tabindex="0" class="focus:outline-none h-16 border-b border-gray-100 rounded">
                                <td>
                                    <div class="ml-5">
                                        <div
                                            class="rounded-full w-5 h-5 flex flex-shrink-0 justify-center items-center relative">
                                            #{{ $key + 1 }}
                                        </div>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="flex items-center pl-5">
                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                            {{ $trans->user->username }}
                                        </p>
                                    </div>
                                </td>
                                <td class="">
                                    <p class="text-base font-medium leading-none text-center text-gray-700 mr-2">
                                        {{ $trans->exchange->exchange_type }}
                                    </p>
                                </td>
                                <td class="">
                                    <div class="flex items-center pl-5">
                                        <div
                                            class="flex gap-2 font-medium leading-none bg-indigo-50 text-indigo-600 mr-2 px-4 py-2 rounded-full text-sm">
                                            {{ $trans->exchange->exchanged_to }}
                                            @switch($trans->exchange->exchange_type)
                                            @case('ML')
                                            <img class="w-3" src="{{ asset('images/diamond.png') }}" alt="">
                                            @break

                                            @case('FF')
                                            <img class="w-3" src="{{ asset('images/Freefire_diamonds.png') }}" alt="">
                                            @break

                                            @case('E-WALLET')
                                            <img class="w-3" src="{{ asset('images/indonesian-rupiah.png') }}" alt="">
                                            @break

                                            @case('RBX')
                                            <img class="w-3" src="{{ asset('images/robux.png') }}" alt="">
                                            @break

                                            <img class="w-3" src="{{ asset('images/Freefire_diamonds.png') }}" alt="">

                                            @default
                                            @endswitch
                                        </div>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="flex items-center pl-5">
                                        <div class="text-base font-medium leading-none text-gray-700 mr-2">
                                            @if ($trans->exchange->exchange_type == 'RBX')
                                            <a class="text-indigo-500 underline"
                                                href="{{ $trans->account_identity }}">Visit Link</a>
                                            @else
                                            {{ $trans->account_identity }}
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="">
                                    <div class="flex items-center pl-5">
                                        <p class="text-base font-medium leading-none text-gray-700">
                                            {{ $trans->exchange->point }} Poin
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div x-data="{ isOpenAct: false }" class="relative px-5 pt-2 text-end">
                                        <button class="focus:ring-2 rounded-md focus:outline-none"
                                            @click="isOpenAct = !isOpenAct" role="button" aria-label="option">
                                            <svg class="dropbtn" xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" viewBox="0 0 20 20" fill="none">
                                                <path
                                                    d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z"
                                                    stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z"
                                                    stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z"
                                                    stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                        <div x-show="isOpenAct" x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-90"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-90" @click.away="isOpenAct = false"
                                            class="bg-white shadow mr-6 absolute flex top-2 right-6">
                                            <form action="{{ route('admin.exchange.destroy', $trans->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-1 px-4 cursor-pointer hover:text-white">
                                                    <p>Delete</p>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="h-3"></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    function search(e) {

        let query = e.target.value;
        var xhr = new XMLHttpRequest();

        xhr.open('GET', 'exchange/search/' + encodeURIComponent(query), true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                displayResults(data);
                console.log(data);
            } else if (xhr.readyState == 4 && xhr.status != 200) {
                console.error('Error:', xhr.statusText);
            }
        };

        xhr.send();
    }

    function displayResults(data) {
        var resultsDiv = document.getElementById('searchResults');
        resultsDiv.innerHTML = '';

        data.forEach(function(transaction, key) {
            let accountIdentity = transaction.exchange.exchange_type === 'RBX' ? `<a class="text-indigo-500 underline"
                                                        href="${transaction.account_identity}">Visit Link</a>` :
                transaction.account_identity

            let exchangeType = ""

            switch (transaction.exchange.exchange_type) {
                case 'ML':
                    exchangeType = `<img class="w-3" src="{{ asset('images/diamond.png') }}"
                                alt="">`
                    break

                case 'FF':
                    exchangeType = `<img class="w-3" src="{{ asset('images/Freefire_diamonds.png') }}"
                                alt="">`
                    break

                case 'E-WALLET':
                    exchangeType = `<img class="w-3" src="{{ asset('images/indonesian-rupiah.png') }}"
                                alt="">`
                    break

                case 'RBX':
                    exchangeType = `<img class="w-3" src="{{ asset('images/robux.png') }}"
                                alt="">`
                    break
                default:

                    exchangeType = `<img class="w-3" src="{{ asset('images/Freefire_diamonds.png') }}"
                                alt="">`

                    break;
            }

            resultsDiv.innerHTML += `<tr tabindex="0" class="focus:outline-none h-16 border-b border-gray-100 rounded">
                                            <td>
                                                <div class="ml-5">
                                                    <div
                                                        class="rounded-full w-5 h-5 flex flex-shrink-0 justify-center items-center relative">
                                                        #${key + 1}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                        ${transaction.user.username}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="">
                                                <p class="text-base font-medium leading-none text-center text-gray-700 mr-2">
                                                    ${transaction.exchange.exchange_type}
                                                </p>
                                            </td>
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <div
                                                        class="flex gap-2 font-medium leading-none bg-indigo-50 text-indigo-600 mr-2 px-4 py-2 rounded-full text-sm">
                                                        ${transaction.exchange.exchanged_to + exchangeType}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <div class="text-base font-medium leading-none text-gray-700 mr-2">
                                                        ${accountIdentity}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="text-base font-medium leading-none text-gray-700">
                                                    ${transaction.exchange.point} Poin
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div x-data="{isOpenAct: false}" class="relative px-5 pt-2 text-end">
                                                    <button class="focus:ring-2 rounded-md focus:outline-none"
                                                        @click="isOpenAct = !isOpenAct" role="button" aria-label="option">
                                                        <svg class="dropbtn" xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 20 20" fill="none">
                                                            <path
                                                                d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z"
                                                                stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path
                                                                d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z"
                                                                stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path
                                                                d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z"
                                                                stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                    <div x-show="isOpenAct" x-transition:enter="transition ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100"
                                                        x-transition:leave="transition ease-in duration-300"
                                                        x-transition:leave-start="opacity-100 scale-100"
                                                        x-transition:leave-end="opacity-0 scale-90" @click.away="isOpenAct = false"
                                                        class="bg-white shadow mr-6 absolute flex top-2 right-6">
                                                        <form action="{{ route('admin.user.destroy', $trans->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-1 px-4 cursor-pointer hover:text-white">
                                                                <p>Delete</p>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>`;
        });
    }
    </script>

</x-app-layout>