<div>
    <h1 class="text-3xl text-blue-700 text-center">Selecione o valor a ser pago e forma de pagamento
    </h1>

    <form action="{{ route('payment.handle') }}" method="post" x-data={}>
        @csrf
        <div class="mt-4 grid grid-cols-1 gap-5 md:grid-cols-2">
            <div>
                <x-input-label class="text-lg" for="price" value="Informe o valor" />
                <x-text-input  id="price" class="block mt-1 w-full" type="text"
                    name="price" :value="old('price')" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div>
                <label for="payment-type" class="block text-sm font-medium leading-6 text-gray-900">Forma de
                    pagamento</label>
                <select id="payment-type" name="payment-type" value="{{ old('payment-type') }}"
                    class=" block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option selected>Selecione uma opção</option>
                    <option value="billet">Boleto</option>
                    <option value="pix">PIX</option>
                    <option value="card">Cartão de crédito</option>
                </select>
                <x-input-error :messages="$errors->get('payment-type')" class="mt-2" />

            </div>
        </div>

        <x-primary-button class="mt-4">
            Enviar
        </x-primary-button>
    </form>

</div>
