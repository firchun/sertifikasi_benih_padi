<div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-{{ $color ?? 'primary' }} h-100">
        <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
                <div class="avatar me-2">
                    <span class="avatar-initial rounded bg-label-{{ $color ?? 'primary' }}"><i
                            class="bx bxs-{{ $icon ?? 'folder' }}"></i></span>
                </div>
                <h4 class="ms-1 mb-0">{{ number_format($count ?? 0) }}</h4>
            </div>
            <p class="mb-1">{{ $title ?? 'Title' }}</p>
            <p class="mb-0">
                <small class="text-muted">{{ $subtitle ?? 'Subtitle' }}</small>
            </p>
        </div>
    </div>
</div>
