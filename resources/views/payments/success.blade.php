    <x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

            </h2>
        </x-slot>



        <div class="py-12" x-data="{ modalOpen: false }">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="bg-white p-8  rounded-lg">
                            <h1 class="text-2xl text-red-500 font-bold mb-4">Obrigado pela sua transação!</h1>
                            <p class="text-gray-700 mb-4">Agradecemos por escolher nossos serviços.</p>
                            <a href="{{ route('dashboard') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Voltar
                                à
                                Página Inicial</a>


                            @if ($payment['billingType'] === 'BOLETO')
                                <a class="cursor-pointer" href="{{ $payment['bankSlipUrl'] }}" target="_blanl"> Clique
                                    aqui
                                    pra acessar seu boleto </a>
                            @endif

                            @if ($payment['billingType'] === 'PIX')
                                <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                    Gerar QR Code
                                </button>

                                <div>

                                </div>
                            @endif




                            <!-- Main modal -->
                            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Seu QRCode está pronto
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="defaultModal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6 flex justify-center items-center">
                                            <img src="{{ $payment['qrCodeURL'] }}" alt="">

                                        </div>

                                    </div>
                                </div>
                            </div>




                        </div>






                    </div>
                </div>
            </div>
        </div>

        <script></script>

    </x-app-layout>
