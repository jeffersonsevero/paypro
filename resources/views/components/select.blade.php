@props(['name', 'label', 'options', 'placeholder' => '', 'isRequired' => false])



<div class="flex w-full flex-col">
    <label
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white
         {{ $isRequired ? "after:content-['*'] after:text-red-base @endif" : '' }}"
        for="{{ $name }}">
        {{ $label }}
    </label>
    <select id="{{ $name }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        name="{{ $name }}" {{ $isRequired ? 'required' : '' }} {{ $attributes }}>
        @if (isset($placeholder))
            <option value="" disabled selected>{{ $placeholder }}</option>
        @endif
        @foreach ($options as $key => $value)
            <option value="{{ $key }}"
                @if (old($value) === $key) selected="selected"
                @elseif (isset($object) and $object->{$value} === $key)
                    selected="selected" @endif>
                {{ $value }}</option>
        @endforeach
    </select>
</div>
