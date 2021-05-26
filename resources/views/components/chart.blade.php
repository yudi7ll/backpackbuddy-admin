@props(['slot', 'icon', 'class' => '', 'bg' => 'bg-primary'])

<div class="col-sm-6 col-md-4 {{ $class }}">
    <div class="{{ $bg }} shadow-sm py-3 rounded">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-right">
                    <i class="fa fa-fw {{ $icon }}" style="font-size: 4rem;"></i>
                </div>
                <div class="col-md-9">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
