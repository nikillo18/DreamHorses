@if (session('success'))
    <x-alert type="success" :message="session('success')" {{ $attributes }} />
@elseif (session('error'))
    <x-alert type="error" :message="session('error')" {{ $attributes }} />
@elseif (session('warning'))
    <x-alert type="warning" :message="session('warning')" {{ $attributes }} />
@elseif (session('info'))
    <x-alert type="info" :message="session('info')" {{ $attributes }} />
@endif
