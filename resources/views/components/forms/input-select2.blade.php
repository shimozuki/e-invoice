@php
$name = $attributes->get('name');
$options = $attributes->get('options', []);
$value = old($name, $attributes->get('value'));
$multiple = $attributes->has('multiple');
@endphp

<div>
    <label for="{{ $name }}" class="form-label">
        {{ __('field.' . $name) }}
    </label>

    <select
        id="{{ $name }}"
        name="{{ $multiple ? $name.'[]' : $name }}"
        {{ $multiple ? 'multiple' : '' }}
        class="form-select select2 @error($name) is-invalid @enderror">
        {{-- Placeholder --}}
        @unless($multiple)
        <option value="">{{ __('label.choose') }}</option>
        @endunless

        @foreach($options as $key => $label)
        <option value="{{ (string) $key }}"
            @if($multiple)
            {{ in_array($key, (array) $value) ? 'selected' : '' }}
            @else
            {{ (string) $value === (string) $key ? 'selected' : '' }}
            @endif>
            {{ $label }}
        </option>
        @endforeach
    </select>

    @error($name)
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror
</div>