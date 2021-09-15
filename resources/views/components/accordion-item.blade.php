<div class="accordion-item">
    <h2 class="accordion-header" id="{{ $attributes['component-id']."Header" ?? 'accordionHeader'}}">
        <button class="accordion-button {{ $isOpen ? '' : 'collapsed' }}" type="button" data{{ $withBs ? '-bs' : '' }}-toggle="collapse" data{{ $withBs ? '-bs' : '' }}-target="#{{ $attributes['component-id']."Body" ?? 'accordionBody' }}" aria-expanded="{{ $isOpen }}" aria-controls="{{ $attributes['component-id']."Body" ?? 'accordionBody' }}">
            {{ $attributes['header-label'] ?? $attributes['component-id']."HeaderLabel" ?? "HeaderLabel" }}
        </button>
    </h2>
    <div id="{{ $attributes['component-id']."Body" ?? 'accordionBody' }}" class="accordion-collapse collapse {{ $isOpen ? 'show' : '' }}" aria-labelledby="{{ $attributes['component-id']."Header" ?? 'accordionHeader' }}" @if (!empty($parentId)) data{{ $withBs ? '-bs' : '' }}-parent="#{{ $parentId }}" @endif>
        <div class="accordion-body">
            {{ $slot }}
        </div>
    </div>
</div>
