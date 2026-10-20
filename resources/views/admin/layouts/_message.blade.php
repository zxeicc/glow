@if ($errors->any())
    <div class="alert alert-danger modern-alert" role="alert">

        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif


@if (session('success'))
    <div class="alert alert-success modern-alert" role="alert">
        {{ session('success') }}
    </div>
@endif


@if (session('error'))
    <div class="alert alert-danger modern-alert" role="alert">
        {{ session('error') }}
    </div>
@endif


@if (session('payment-error'))
    <div class="alert alert-danger modern-alert" role="alert">
        {{ session('payment-error') }}
    </div>
@endif


@if (session('warning'))
    <div class="alert alert-warning modern-alert" role="alert">
        {{ session('warning') }}
    </div>
@endif


@if (session('info'))
    <div class="alert alert-info modern-alert" role="alert">
        {{ session('info') }}
    </div>
@endif


@if (session('secondary'))
    <div class="alert alert-secondary modern-alert" role="alert">
        {{ session('secondary') }}
    </div>
@endif


@if (session('primary'))
    <div class="alert alert-primary modern-alert" role="alert">
        {{ session('primary') }}
    </div>
@endif


@if (session('light'))
    <div class="alert alert-light modern-alert" role="alert">
        {{ session('light') }}
    </div>
@endif