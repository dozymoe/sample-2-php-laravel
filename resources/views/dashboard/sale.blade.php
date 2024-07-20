@extends(
    'layouts.app',
    [
      'title' => 'Sales - ' . config('app.name'),
      'description' => 'Sale listing',
      'titleContent' => 'Sales',
    ])

@section('content')
<div class="row justify-content-center mb-4">
  <form method="GET" action="">
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
        <option value="sumq"
            @if (Request::query('sort') == 'sumq') selected @endif>
          SUM ascending
        </option>
        <option value="-sumq"
            @if (Request::query('sort') == '-sumq') selected @endif>
          SUM descending
        </option>
        <option value="avgq"
            @if (Request::query('sort') == 'avgq') selected @endif>
          AVG ascending
        </option>
        <option value="-avgq"
            @if (Request::query('sort') == '-avgq') selected @endif>
          AVG descending
        </option>
        <option value="maxq"
            @if (Request::query('sort') == 'maxq') selected @endif>
          MAX ascending
        </option>
        <option value="-maxq"
            @if (Request::query('sort') == '-maxq') selected @endif>
          MAX descending
        </option>
        <option value="minq"
            @if (Request::query('sort') == 'minq') selected @endif>
          MIN ascending
        </option>
        <option value="-minq"
            @if (Request::query('sort') == '-minq') selected @endif>
          MIN descending
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
        <th colspan="4">Jumlah Terjual</th>
        <th>Jenis Barang</th>
      </tr>
      <tr>
        <th colspan="2"></th>
        <th>SUM</th>
        <th>AVG</th>
        <th>MAX</th>
        <th>MIN</th>
        <th/>
      </tr>
    </thead>
    <tbody>
    @foreach ($objects as $object)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $object->product_name }}</td>
        <td>{{ $object->sum_quantity }}</td>
        <td>{{ $object->avg_quantity }}</td>
        <td>{{ $object->max_quantity }}</td>
        <td>{{ $object->min_quantity }}</td>
        <td>{{ $object->category_name }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection
