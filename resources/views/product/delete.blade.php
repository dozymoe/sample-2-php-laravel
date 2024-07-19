@extends(
    'layouts.app',
    [
      'title' => 'Delete Product ' . $object->name . ' - ' . config('app.name'),
      'description' => 'Deleting product',
      'titleContent' => 'Delete Product',
    ]);

@section('content')
<form method="POST" action="" class="delete-product">
  @csrf

  @error('')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  <p>Do you really want to delete this product: {{ $object->name }}?</p>

  <button type="submit" class="btn btn-primary">Delete</button>

</form>
@endsection
