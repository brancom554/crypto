<div class="accordion accordion-clean" id="faqs-accordion">
@foreach ($faqs as $faq)
    <div class="card mb-3">
        <div class="card-header">
            <a href="#" class="card-title btn{{ $loop->index > 0 ? " collapsed" : '' }}" data-bs-toggle="collapse" data-bs-target="#v1-q{{ $loop->index }}">
                <i class="fas fa-angle-down angle"></i>
                {{ $faq['question'] }}
            </a>
        </div>

        <div id="v1-q{{ $loop->index }}" class="collapse {{ $loop->index === 0 ? "show" : '' }}" data-bs-parent="#faqs-accordion">
            <div class="card-body">{{ $faq['answer'] }}</div>
        </div>
    </div>
@endforeach
</div>
