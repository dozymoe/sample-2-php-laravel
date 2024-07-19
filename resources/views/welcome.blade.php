@extends(
    'layouts.app',
    [
      'title' => 'Welcome - ' . config('app.name'),
      'description' => 'Product listing',
      'titleContent' => 'Products',
    ])

@section('content')
<div class="row justify-content-center">
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
        <label for="min_price">Minimum Price: </label>
        <input name="min_price" id="min_price" class="form-control" type="number"
            value="{{ Request::query('min_price') }}" />
      </div>
      <div class="form-group w-100">
        <label for="max_price">Maximum Price: </label>
        <input name="max_price" id="max_price" class="form-control" type="number"
            value="{{ Request::query('max_price') }}" />
      </div>
    </div>
    <button type="submit" class="btn btn-primary">
      Search
    </button>
  </form>
</div>

<div class="row justify-content-center">
  @foreach ($products as $product)
  <div class="col-md-4 col-lg-3 col-xl-4 mb-4 mt-4">
    <div class="card text-black">
      <img src="{{ route('product.image', ['filename' => $product->image_path]) }}"
          class="card-img-top" alt="{{ $product->image_alt }}">
      <div class="card-body">
        <div class="text-center">
          <h5 class="card-title">{{ $product->name }}</h5>
          @if ($product->description)
          <p class="text-muted mb-4">{{ $product->description }}</p>
          @endif
        </div>
        <div>
          <div class="d-flex justify-content-between">
            <span>Stock</span> <span>{{ $product->stock }}</span>
          </div>
        </div>
        <div class="d-flex justify-content-between total font-weight-bold mt-4">
          <span>Total</span> <span>{{ $product->price }}</span>
        </div>
      </div>
      @if (Auth::user()?->can('update', $product) || Auth::user()?->can('delete', $product))
      <div class="card-footer">
        @can('update', $product)
        <a href="{{ route('product.update', ['object' => $product]) }}"
            class="btn btn-link btn-sm">
          Edit
        </a>
        @endcan

        @can('delete', $product)
        <a href="{{ route('product.delete', ['object' => $product]) }}"
            class="btn btn-link btn-sm">
          Delete
        </a>
        @endcan
      </div>
      @endif
    </div>
  </div>
  @endforeach
</div>
@endsection
