<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Market Products</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; padding: 20px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; text-align: left; padding: 12px; }
        th { background-color: #f8f9fa; }
        .actions a, .actions button { margin-right: 5px; text-decoration: none; padding: 5px 10px; border-radius: 5px; }
        .actions button { cursor: pointer; }
        .controls-container { margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; background-color: #f8f9fa; }
        .controls-form { display: flex; gap: 15px; align-items: center; }
        .controls-form input, .controls-form select, .controls-form button, .controls-form a { padding: 8px; border-radius: 5px; border: 1px solid #ccc; }
    </style>
</head>
<body>

    <h1>All Products</h1>

    @if (session('success'))
        <div style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="controls-container">
        <form action="{{ route('products.index') }}" method="GET" class="controls-form">
            <input type="text" name="search" placeholder="Search by name..." value="{{ request('search') }}">
            <input type="number" name="min_price" placeholder="Min price..." step="0.01" value="{{ request('min_price') }}">
            <select name="sort">
                <option value="">Sort by...</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
            </select>
            <button type="submit">Apply</button>
            <a href="{{ route('products.index') }}" style="text-decoration: none;">Clear</a>
        </form>
    </div>

    <a href="{{ route('products.create') }}" style="display: inline-block; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">
        + Add New Product
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="60">
                        @else
                            No image
                        @endif
                    </td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td class="actions">
                        <a href="{{ route('products.show', $product->id) }}" style="background-color: #007bff; color: white;">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" style="background-color: #ffc107; color: black;">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" style="background-color: #dc3545; color: white; border: none;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $products->appends(request()->query())->links() }}
    </div>

</body>
</html>