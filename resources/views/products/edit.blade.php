<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 5px; }
        button { padding: 12px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Edit Product: {{ $product->name }}</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4">{{ $product->description }}</textarea>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
        </div>
        <div>
            <button type="submit">Update Product</button>
        </div>
    </form>
</body>
</html>