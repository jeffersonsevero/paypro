    <x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Checkout
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="bg-white p-8  rounded-lg">

                            <section class="bg-white dark:bg-gray-900">
                                <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Preencha os dados
                                    </h2>
                                    <form method='post' action="{{ route('credit.card', ['value' => $value]) }}"
                                        x-data={}>
                                        @csrf()
                                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                            <div class="sm:col-span-2">
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Nome no cartão</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ old('name') }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="John Doe">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                            </div>
                                            <div class="w-full">
                                                <label for="number"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                                                <input x-mask='9999 9999 9999 9999' type="text" name="number"
                                                    value="{{ old('number') }}" id="number"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="0000 0000 0000 0000">
                                                <x-input-error :messages="$errors->get('number')" class="mt-2" />

                                            </div>
                                            <div class="w-full">
                                                <label for="cep"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                                                <input x-mask="99999-999" type="text" name="cep" id="cep"
                                                    value="{{ old('cep') }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="">
                                                <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                                            </div>
                                            <div class='w-full'>
                                                <x-select :options="$months" name="expiry-month"
                                                    label='Mês de expiração'>
                                                </x-select>
                                                <x-input-error :messages="$errors->get('expiry-month')" class="mt-2" />


                                            </div>
                                            <div class='w-full'>
                                                <x-select :options="$years" name="expiry-year" label='Ano de expiração'>
                                                </x-select>
                                                <x-input-error :messages="$errors->get('expiry-year')" class="mt-2" />


                                            </div>

                                            <div class="w-full">
                                                <label for="ccv"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CCV</label>
                                                <input type="text" x-mask='9999' name="ccv" id="ccv"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="9999">
                                                <x-input-error :messages="$errors->get('ccv')" class="mt-2" />

                                            </div>

                                            <div class="w-full">
                                                <label for="home-number"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número
                                                    da casa</label>
                                                <input type="text" x-mask='9999' name="home-number" id="home-number"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="9999">
                                                <x-input-error :messages="$errors->get('home-number')" class="mt-2" />

                                            </div>


                                            <div class='w-full'>
                                                <label for="phone-number"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número
                                                    de telefone</label>
                                                <input x-mask="(99)9 9999-9999" placeholder='(00)0 0000-0000'
                                                    type="text" name="phone-number" id="phone-number"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <x-input-error :messages="$errors->get('phone-number')" class="mt-2" />
                                            </div>
                                        </div>
                                        <x-primary-button class="mt-4">
                                            Enviar
                                        </x-primary-button>
                                    </form>
                                </div>
                            </section>


                        </div>

                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>
