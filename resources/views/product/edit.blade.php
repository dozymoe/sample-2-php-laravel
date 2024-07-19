@extends(
    'layouts.app',
    [
      'title' => 'Edit Product ' . $object->name . ' - ' . config('app.name'),
      'description' => 'Editing product',
      'titleContent' => 'Edit Product',
    ]);

@section('content')
<form method="POST" enctype="multipart/form-data" action="" class="edit-product">
  @csrf

  @error('')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  <div class="mb-3">
    <label for="code">Code</label>
    <input name="code" value="{{ old('code', $object->code) }}" type="text"
        id="code" required class="form-control @error('code') is-invalid @enderror">

    @error('code')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="name">Name</label>
    <input name="name" value="{{ old('name', $object->name) }}" type="text"
        id="name" required class="form-control @error('name') is-invalid @enderror">

    @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="stock">Stock</label>
    <input name="stock" value="{{ old('stock', $object->stock) }}" type="number"
        id="stock" required class="form-control @error('stock') is-invalid @enderror">

    @error('stock')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="price">Price</label>
    <input name="price" value="{{ old('price', $object->price) }}" type="number"
        id="price" required class="form-control @error('price') is-invalid @enderror">

    @error('price')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id"
        class="form-control @error('category_id') is-invalid @enderror">
      <option value="">--Select Category--</option>
      @foreach ($categories as $category)
        <option value="{{ $category->id }}"
            @if (old('category_id', $object->categories->first()?->id) == $category->id) selected @endif>
          {{ $category->name }}
        </option>
      @endforeach
    </select>

    @error('category_id')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="description">Description</label>
    <textarea name="description" id="description"
        class="form-control @error('description') is-invalid @enderror"
        >{{ old('description', $object->description) }}</textarea>

    @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="image">Image</label>
    <input name="image" value="{{ old('image') }}" type="file"
        id="image" class="form-control @error('image') is-invalid @enderror">

    @error('image')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="image_alt">Image Description</label>
    <textarea name="image_alt" id="image_alt"
        class="form-control @error('image_alt') is-invalid @enderror"
        >{{ old('image_alt', $object->image_alt) }}</textarea>

    @error('image_alt')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Save</button>

</form>
@endsection
