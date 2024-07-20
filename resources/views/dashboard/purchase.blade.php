@extends(
    'layouts.app',
    [
      'title' => 'Purchase - ' . config('app.name'),
      'description' => 'Purchase history',
      'titleContent' => 'Purchase',
    ])

@section('content')
<div class="row justify-content-center mb-4">
  <form method="GET" action="">
    <div class="form-group">
      <label for="search">Search</label>
      <input name="search" id="search" class="form-control" type="text"
        value="{{ Request::query('search') }}" />
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select name="category" id="category" class="form-control">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
          <option value="{{ $category->code }}"
              @if (Request::query('category') == $category->code) selected @endif>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="d-flex justify-content-between">
      <div class="form-group w-100">
        <label for="min_date">Minimum Date: </label>
        <input name="min_date" id="min_date" class="form-control" type="date"
            value="{{ Request::query('min_date') }}" />
      </div>
      <div class="form-group w-100">
        <label for="max_date">Maximum Date: </label>
        <input name="max_date" id="max_date" class="form-control" type="date"
            value="{{ Request::query('max_date') }}" />
      </div>
    </div>
    <div class="form-group">
      <label for="sort">Sort</label>
      <select name="sort" id="sort" class="form-control">
        <option value="name"
            @if (Request::query('sort') == 'name') selected @endif>
          Name ascending
        </option>
        <option value="-name"
            @if (Request::query('sort') == '-name') selected @endif>
          Name descending
        </option>
        <option value="date"
            @if (Request::query('sort') == 'date') selected @endif>
          Date ascending
        </option>
        <option value="-date"
            @if (Request::query('sort') == '-date') selected @endif>
          Date descending
        </option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">
      Search
    </button>
  </form>
</div>
<div class="row justify-content-center mb-4">
  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Jumlah Terjual</th>
        <th>Tanggal Transaksi</th>
        <th>Jenis Barang</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($objects as $object)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $object->product_name }}</td>
        <td>{{ $object->product_stock }}</td>
        <td>{{ $object->quantity }}</td>
        <td>{{ MyDate::format($object->created_at) }}</td>
        <td>{{ $object->category_name }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection
