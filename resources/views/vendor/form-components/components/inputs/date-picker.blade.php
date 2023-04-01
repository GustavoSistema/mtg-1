<div
    x-data="datePicker({
        @if ($hasWireModel())
            value: @entangle($attributes->wire('model')),
        @elseif ($hasXModel())
            value: {{ $attributes->first('x-model' ) }},
        @else
            value: {{ \Illuminate\Support\Js::from($value) }},
        @endif

        options: {{ \Illuminate\Support\Js::from($options) }},

        config: { {{ $config ?? '' }} },
    })"
    wire:ignore.self

    @if ($hasXModel())
        {{ $attributes->whereStartsWith('x-model') }}
        x-modelable="__value"
    @endif

    class="date-picker-root"
>
    <div
        class="{{ $containerClass }}"
        x-date-picker:container

        {{-- we are going to use a MutationObserver on this element to clone these attributes to the input since it is being wire:ignored --}}
        @if ($hasErrorsAndShow($name))
            aria-invalid="true"
        @endif
        {!! $ariaDescribedBy() !!}    >
        
        
        @includeWhen(! $toggleIcon, 'form-components::partials.leading-addons')
            
        <input
            @if ($name) name="{{ $name }}" @endif
            @if ($id) id="{{ $id }}" @endif
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            {{ $attributes->except(['type', 'aria-describedby'])->whereDoesntStartWith(['wire:model', 'x-model'])->class($inputClass) }}
            x-date-picker:input
            wire:ignore
            {{ $extraAttributes ?? '' }}       
        />       
        
    </div>

    {{ $end ?? '' }}
</div>
