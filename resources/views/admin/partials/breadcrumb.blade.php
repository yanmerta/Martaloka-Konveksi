<!-- resources/views/components/breadcrumb.blade.php -->
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a> <!-- Link ke Dashboard -->
    </li>

    <!-- Segment pertama dari URL -->
    @if (request()->segment(1) && request()->segment(1) !== 'dashboard')
        <li class="breadcrumb-item">
            <a href="{{ url(request()->segment(1)) }}">
                {{ ucfirst(request()->segment(1)) }}
            </a>
        </li>
    @endif

    <!-- Segment kedua dari URL -->
    @if (request()->segment(2))
        <li class="breadcrumb-item active">
            {{ ucfirst(request()->segment(2)) }}
        </li>
    @endif
</ol>
