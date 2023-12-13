<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <script>
    var chartData = @json($chartData);
    </script>

    <div class="py-12">
        <div class="__container">
            <div class="flex gap-4 mb-8">
                <div class="w-full">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-indigo-50 border border-indigo-500 p-8 rounded-lg mb-4 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div
                                    class="relative w-full pr-4 max-w-full flex-grow flex-1 flex flex-col justify-center gap-3">
                                    <h5 class="text-indigo-600 uppercase font-bold text-lg">Total User</h5>
                                    <span class="font-bold text-3xl">{{ $userCount }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div
                                        class="text-white p-3 text-center inline-flex items-center justify-center w-24 h-24 shadow-lg rounded-full  bg-indigo-500">
                                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M2 22C2 17.5817 5.58172 14 10 14C14.4183 14 18 17.5817 18 22H16C16 18.6863 13.3137 16 10 16C6.68629 16 4 18.6863 4 22H2ZM10 13C6.685 13 4 10.315 4 7C4 3.685 6.685 1 10 1C13.315 1 16 3.685 16 7C16 10.315 13.315 13 10 13ZM10 11C12.21 11 14 9.21 14 7C14 4.79 12.21 3 10 3C7.79 3 6 4.79 6 7C6 9.21 7.79 11 10 11ZM18.2837 14.7028C21.0644 15.9561 23 18.752 23 22H21C21 19.564 19.5483 17.4671 17.4628 16.5271L18.2837 14.7028ZM17.5962 3.41321C19.5944 4.23703 21 6.20361 21 8.5C21 11.3702 18.8042 13.7252 16 13.9776V11.9646C17.6967 11.7222 19 10.264 19 8.5C19 7.11935 18.2016 5.92603 17.041 5.35635L17.5962 3.41321Z"
                                                fill="rgba(255,254,254,1)"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" w-full">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-teal-50 border border-teal-500 p-8 rounded-lg mb-4 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div
                                    class="relative w-full pr-4 max-w-full flex-grow flex-1 flex flex-col justify-center gap-3">
                                    <h5 class="text-teal-600 uppercase font-bold text-lg">Total Penukaran</h5>
                                    <span class="font-bold text-3xl">{{ $transactionCount }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div
                                        class="text-white p-3 text-center inline-flex items-center justify-center w-24 h-24 shadow-lg rounded-full  bg-teal-500">
                                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M2 12H4V21H2V12ZM5 14H7V21H5V14ZM16 8H18V21H16V8ZM19 10H21V21H19V10ZM9 2H11V21H9V2ZM12 4H14V21H12V4Z"
                                                fill="rgba(255,255,255,1)"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-8 overflow-hidden shadow-xl rounded-lg border border-indigo-500">
                <h1 class="font-bold text-lg">Grafik Penukaran Tahun 2023</h1>
                <div>
                    <canvas id="myChart"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>