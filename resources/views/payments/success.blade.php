    <x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

            </h2>
        </x-slot>



        <div class="py-12">
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
                                <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                                    href="{{ $payment['bankSlipUrl'] }}" target="_blanl"> Clique
                                    aqui
                                    pra acessar seu boleto </a>
                            @endif

                            @if ($payment['billingType'] === 'PIX')
                                <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                    Gerar QR Code
                                </button>

                                <x-flow-modal class="flex" title='Seu QRCode já está disponível'>
                                    <div class="flex flex-col" x-data="{ content: '{{ $payment['payload'] }}' }">
                                        <img src="{{ $payment['qrCodeURL'] }}" alt="">


                                        <button x-on:click="navigator.clipboard.writeText(content)"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">Clique
                                            aqui para pegar código</button>
                                    </div>

                                </x-flow-modal>
                            @endif


                        </div>






                    </div>
                </div>
            </div>
        </div>


    </x-app-layout>
