@if (is_array($errors))
    <div class="alert alert-danger">
        <h4>Produk dengan Stok Tidak Mencukupi:</h4>
        <ul>
            @foreach ($errors as $error)
                <li> <b> {{ $error['nama_produk'] }}</b> : Stok tersedia: {{ $error['stok_tersedia'] }}, Jumlah yang dipesan:
                     <b> {{ $error['qty_dipesan'] }}</b></li>
            @endforeach
        </ul>
    </div>
@else
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('info'))
        <div class="alert alert-info alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endif
