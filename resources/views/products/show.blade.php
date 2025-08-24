<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details: {{ $product->name }}</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; }
        .product-card { border: 1px solid #ddd; padding: 20px; border-radius: 8px; background-color: #f8f9fa; }
        h1 { margin-bottom: 10px; }
        p { color: #555; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="product-card">
        <h1>{{ $product->name }}</h1>
        <p><strong>Description:</strong> {{ $product->description ?? 'N/A' }}</p>
        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
        <p><strong>Quantity in stock:</strong> {{ $product->quantity }}</p>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="200">
        @else
            <p>No image available.</p>
        @endif
    </div>
    <br>
    <a href="{{ route('products.index') }}" style="text-decoration: none;">← Back to all products</a>
</body>
</html>