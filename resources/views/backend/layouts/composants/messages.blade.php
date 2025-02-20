@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>{{ Session::get('success') }}</span>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span>{{ Session::get('error') }}</span>
    </div>
@endif