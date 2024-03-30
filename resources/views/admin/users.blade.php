<x-app-layout>

    <div x-data="{
        isOpenModal: false,
        isOpenModalPoint: false,
        isOpenAlert: true,
        userIdSelected: [],
        isSelectAll: false,
        form: {
            isUpdate: false,
            data: { id: '', name: '', username: '', point: 0, no_absensi: '', password: '', password_confirmation: '' }
        }
    }">
        <x-validation-errors class="mb-4" />
        <div class="__container">
            <div class="py-4 md:py-7">
                @if ($message = Session::get('success'))
                    <div x-show="isOpenAlert"
                        class="bg-green-50 text-green-500 px-6 py-4 mb-4 shadow-sm rounded-md flex justify-between items-center">
                        <span>{{ $message }}</span>
                        <div @click="isOpenAlert = false" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20"
                                height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                        Semua User
                    </h1>
                    <div
                        class="flex md:w-auto w-full py-2 items-center md:justify-start justify-between text-base font-medium leading-none text-indigo-600 cursor-pointer rounded">
                        <p>Search</p>
                        <input id="searchInput" type="search" onkeyup="search(event)"
                            class="focus:text-indigo-600 text-base focus:outline-none bg-transparent ml-2 px-4 py-2 md:w-64 w-full rounded-md bg-white border-gray-300" />
                    </div>
                </div>
            </div>
            <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 rounded-lg border border-indigo-500 shadow-lg">
                <div class="flex gap-4 justify-end">
                    <div class="sm:flex items-center justify-between">
                        <div class="flex items-center">
                        </div>
                        <button @click="isOpenModal = true, form.isUpdate = false"
                            class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                            <p class="text-sm font-medium leading-none text-white">Add User</p>
                        </button>
                    </div>
                    <div class="sm:flex items-center justify-between">
                        <div class="flex items-center">
                        </div>
                        <button @click="isOpenModalPoint = true"
                            class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                            <p class="text-sm font-medium leading-none text-white">Add Point to User selected</p>
                        </button>
                    </div>
                </div>
                <div class="mt-7 overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <th>
                                <tr
                                    class="focus:outline-none h-12 border-t border-b border-gray-100 rounded font-bold leading-none text-indigo-700 bg-indigo-50">
                                    <td class="pl-5">
                                        <input type="checkbox" x-model="isSelectAll"
                                            @click="!isSelectAll ?
                                                () => {
                                                    let userIdSelectedEl = document.querySelectorAll('#userIdSelected')
                                                    userIdSelectedEl.forEach(item => userIdSelected.push(`${item.value}`))
                                                } : userIdSelected = []
                                            ">
                                    </td>
                                    <td class="pl-5">No</td>
                                    <td class="pl-5">Name</td>
                                    <td class="pl-5">Username</td>
                                    <td class="pl-5">No Absensi</td>
                                    <td class="pl-5">Poin</td>
                                    <td class="pl-5"></td>
                                </tr>
                            </th>
                        </thead>
                        <tbody id="searchResults">
                            @foreach ($users as $key => $user)
                                <tr tabindex="0" class="focus:outline-none h-16 border-b border-gray-100 rounded">
                                    <td>
                                        <div class="ml-5">
                                            <input id="userIdSelected" type="checkbox" value="{{ $user->id }}"
                                                x-model="userIdSelected">
                                        </div>
                                    </td>
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
                                                {{ $user->name }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="flex items-center pl-5">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                {{ $user->username }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="flex items-center pl-5">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                {{ $user->no_absensi }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="flex items-center pl-5">
                                            <p class="text-base font-medium leading-none text-gray-700">
                                                {{ $user->point }}
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
                                            <div x-show="isOpenAct"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-300"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-90"
                                                @click.away="isOpenAct = false"
                                                class="bg-white shadow mr-6 absolute flex top-2 right-6">
                                                <div @click="form.isUpdate = true, form.data = { id: '{{ $user->id }}', name: '{{ $user->name }}', username: '{{ $user->username }}', point: '{{ $user->point }}', no_absensi: '{{ $user->no_absensi }}', password: '', password_confirmation: '' }, isOpenModal = true"
                                                    class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-1 px-4 cursor-pointer hover:text-white">
                                                    <p>Edit</p>
                                                </div>
                                                <form action="{{ route('admin.user.destroy', $user->id) }}"
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

        <div>
            <div x-show="isOpenModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90" x-on:click.away="isOpenModal = false"
                class="flex items-center py-12 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 backdrop-blur-sm bg-gray-100/30"
                id="modal">
                <div x-show="isOpenModal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    x-on:click.away="isOpenModal = false" role="alert"
                    class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
                    <form
                        x-bind:action="form.isUpdate ? '{{ route('admin.user.update') }}' : '{{ route('admin.user.store') }}'"
                        method="post">
                        @csrf
                        <input type="hidden" name="id" x-model="form.isUpdate ? form.data.id : ''">
                        <input type="hidden" name="_method" x-bind:value="form.isUpdate ? 'put' : 'post'">
                        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded">
                            <div class="w-full flex justify-start text-gray-600 mb-3">
                                <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M14 14.252V16.3414C13.3744 16.1203 12.7013 16 12 16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z"
                                        fill="rgba(75,85,99,1)">
                                    </path>
                                </svg>
                            </div>
                            <h1 x-show="form.isUpdate"
                                class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">
                                Update data user
                            </h1>
                            <h1 x-show="!form.isUpdate"
                                class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">
                                Masukkan data user
                            </h1>
                            <div>
                                <label for="name"
                                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                    Name
                                </label>
                                <input id="name" name="name" autocomplete="name"
                                    x-model="form.isUpdate ? form.data.name : ''"
                                    class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                    placeholder="Fullname" />
                            </div>
                            <div>
                                <label for="username"
                                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                    Username
                                </label>
                                <div class="relative mb-5 mt-2">
                                    <div class="absolute text-gray-600 flex items-center px-4 border-r h-full">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M11 1V2H7C5.34315 2 4 3.34315 4 5V8C4 10.7614 6.23858 13 9 13H15C17.7614 13 20 10.7614 20 8V5C20 3.34315 18.6569 2 17 2H13V1H11ZM6 5C6 4.44772 6.44772 4 7 4H17C17.5523 4 18 4.44772 18 5V8C18 9.65685 16.6569 11 15 11H9C7.34315 11 6 9.65685 6 8V5ZM9.5 9C10.3284 9 11 8.32843 11 7.5C11 6.67157 10.3284 6 9.5 6C8.67157 6 8 6.67157 8 7.5C8 8.32843 8.67157 9 9.5 9ZM14.5 9C15.3284 9 16 8.32843 16 7.5C16 6.67157 15.3284 6 14.5 6C13.6716 6 13 6.67157 13 7.5C13 8.32843 13.6716 9 14.5 9ZM6 22C6 18.6863 8.68629 16 12 16C15.3137 16 18 18.6863 18 22H20C20 17.5817 16.4183 14 12 14C7.58172 14 4 17.5817 4 22H6Z"
                                                fill="rgba(75,85,99,1)"></path>
                                        </svg>
                                    </div>
                                    <input id="username" name="username" autocomplete="username"
                                        x-model="form.isUpdate ? form.data.username : ''"
                                        class="text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-16 text-sm border-gray-300 rounded border"
                                        placeholder="Roblox username" />
                                </div>
                            </div>
                            <div>
                                <label for="point"
                                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                    Point
                                </label>
                                <div class="relative mb-5 mt-2">
                                    <div
                                        class="absolute right-0 text-gray-600 flex items-center pr-3 h-full cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-info-circle" width="20"
                                            height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <line x1="12" y1="8" x2="12.01" y2="8">
                                            </line>
                                            <polyline points="11 12 12 12 12 16 13 16"></polyline>
                                        </svg>
                                    </div>
                                    <input id="point" name="point"
                                        x-model="form.isUpdate ? form.data.point : ''" type="number"
                                        class="mb-8 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                        placeholder="0000" />
                                </div>
                            </div>
                            <div>
                                <label for="no_absensi"
                                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                    No Absensi
                                </label>
                                <div class="relative mb-5 mt-2">
                                    <input id="no_absensi" name="no_absensi" autocomplete="no_absensi"
                                        x-model="form.isUpdate ? form.data.no_absensi : ''"
                                        class="mb-8 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                        placeholder="Input No Absensi" />
                                </div>
                            </div>
                            <div x-show="form.isUpdate" class="bg-red-50 text-red-500 p-3 text-xs mb-5">
                                Jika tidak ingin merubah passwordnya kosongkan input di bawah ini
                            </div>
                            <div>
                                <label for="password"
                                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                    Password
                                </label>
                                <input id="password" type="password" name="password"
                                    class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                    placeholder="*****" />
                            </div>
                            <div>
                                <label for="password_confirmation"
                                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                    Confirm Password
                                </label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                    placeholder="*****" autocomplete="new-password" />
                            </div>
                            <div class="flex items-center justify-start w-full">
                                <button type="submit"
                                    class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                                <button type="button"
                                    class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm"
                                    @click="isOpenModal = false">Cancel</button>
                            </div>
                            <button type="button"
                                class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                                @click="isOpenModal = false" aria-label="close modal" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <div x-show="isOpenModalPoint" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90" x-on:click.away="isOpenModalPoint = false"
                class="flex items-center py-12 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 backdrop-blur-sm bg-gray-100/30"
                id="modal">
                <div x-show="isOpenModalPoint" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    x-on:click.away="isOpenModalPoint = false" role="alert"
                    class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
                    <form action="{{ route('admin.user.addPoint') }}" method="post">
                        @csrf
                        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded">
                            <div class="w-full flex justify-start text-gray-600 mb-3">
                                <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M14 14.252V16.3414C13.3744 16.1203 12.7013 16 12 16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z"
                                        fill="rgba(75,85,99,1)">
                                    </path>
                                </svg>
                            </div>

                            <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">
                                Masukkan Jumlah Penambahan Point pada user yang di pilih
                            </h1>

                            <input name="userIdSelected" type="hidden" x-model="userIdSelected">

                            <div>
                                <label for="point"
                                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                    Point
                                </label>
                                <div class="relative mb-5 mt-2">
                                    <div
                                        class="absolute right-0 text-gray-600 flex items-center pr-3 h-full cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-info-circle" width="20"
                                            height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <line x1="12" y1="8" x2="12.01" y2="8">
                                            </line>
                                            <polyline points="11 12 12 12 12 16 13 16"></polyline>
                                        </svg>
                                    </div>
                                    <input id="point" name="point" type="number"
                                        class="mb-8 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                        placeholder="0000" />
                                </div>
                            </div>

                            <div class="flex items-center justify-start w-full">
                                <button type="submit"
                                    class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Tambahkan</button>
                                <button type="button"
                                    class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm"
                                    @click="isOpenModalPoint = false">Cancel</button>
                            </div>
                            <button type="button"
                                class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                                @click="isOpenModalPoint = false" aria-label="close modal" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function search(e) {

            let query = e.target.value;
            var xhr = new XMLHttpRequest();

            xhr.open('GET', 'user/search/' + encodeURIComponent(query), true);
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

            data.forEach(function(user, key) {

                resultsDiv.innerHTML += `<tr tabindex="0" class="focus:outline-none h-16 border-b border-gray-100 rounded">
        <td>
            <div class="ml-5">
                <div class="rounded-full w-5 h-5 flex flex-shrink-0 justify-center items-center relative">
                    #${ key + 1 }
                </div>
            </div>
        </td>
        <td class="">
            <div class="flex items-center pl-5">
                <p class="text-base font-medium leading-none text-gray-700 mr-2">
                    ${ user.name }
                </p>
            </div>
        </td>
        <td class="">
            <div class="flex items-center pl-5">
                <p class="text-base font-medium leading-none text-gray-700 mr-2">
                    ${ user.username }
                </p>
            </div>
        </td>
        <td class="">
            <div class="flex items-center pl-5">
                <p class="text-base font-medium leading-none text-gray-700 mr-2">
                    ${ user.no_absensi }
                </p>
            </div>
        </td>
        <td class="">
            <div class="flex items-center pl-5">
                <p class="text-base font-medium leading-none text-gray-700">
                    ${ user.point }
                </p>
            </div>
        </td>
        <td>
            <div x-data="{ isOpenAct: false }" class="relative px-5 pt-2 text-end">
                <button class="focus:ring-2 rounded-md focus:outline-none" @click="isOpenAct = !isOpenAct"
                    role="button" aria-label="option">
                    <svg class="dropbtn" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 20 20" fill="none">
                        <path
                            d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z"
                            stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path
                            d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z"
                            stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path
                            d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z"
                            stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </svg>
                </button>
                <div x-show="isOpenAct" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    @click.away="isOpenAct = false" class="bg-white shadow mr-6 absolute flex top-2 right-6">
                    <div @click="form.isUpdate = true, form.data = { id: '${ user.id }', name: '${ user.name }', username: '${ user.username }', point: '${ user.point }', no_absensi: '${ user.no_absensi }', password: '', password_confirmation: '' }, isOpenModal = true"
                        class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-1 px-4 cursor-pointer hover:text-white">
                        <p>Edit</p>
                    </div>
                    <form action="admin/user/', ${user.id}" method="post">
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
    <tr class="h-3"></tr>`;
            });
        }
    </script>
</x-app-layout>
