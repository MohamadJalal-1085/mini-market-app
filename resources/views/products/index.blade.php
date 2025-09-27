{{-- resources/views/products/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Market Products</title>
    
    {{-- Vite directive for Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Import Google Fonts specified in the style guide --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* * Defining the design tokens from the UI Style Guide as CSS variables.
         * These are used by Tailwind's arbitrary value system below.
        */
        :root {
            --bg: #0c1116; /*  */
            --card: #0f1720; /*  */
            --text: #e6edf3; /*  */
            --muted: #a2b3c5; /*  */
            --primary: #14B8A6; /*  */
            --primary-600: #0D9488; /*  */
            --border: rgba(255, 255, 255, 0.10); /*  */
            --ring: #99F6E4; /*  */
            --font-sans: 'Inter', sans-serif; /* [cite: 1382, 1388] */
            --radius: 16px; /*  */
            --shadow: 0 12px 30px rgba(0, 0, 0, 0.35); /*  */
        }
    </style>
</head>
<body class="bg-[var(--bg)] text-[var(--text)] font-['Inter'] antialiased">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 px-4 py-3 rounded-lg relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Header: Title and Add Product Button --}}
        <header class="flex flex-col sm:flex-row items-center justify-between mb-8">
            <h1 class="text-3xl font-semibold mb-4 sm:mb-0" style="font-size: clamp(22px, 3.4vw, 32px);">All Products</h1> 
            <a href="{{ route('products.create') }}" 
               class="w-full sm:w-auto text-center font-semibold text-[#051d1a] px-5 py-3 rounded-xl transition-transform active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[var(--bg)] focus:ring-[var(--ring)]"
               style="background: linear-gradient(180deg, var(--primary), var(--primary-600)); border-color: color-mix(in srgb, var(--primary) 70%, transparent); box-shadow: 0 10px 24px color-mix(in srgb, var(--primary) 30%, transparent);">
                + Add New Product
            </a>
        </header>

        {{-- Filters Section --}}
        <div class="mb-8 p-6 bg-[var(--card)] border border-[var(--border)] rounded-2xl">
            <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 items-end">
                {{-- Search Input --}}
                <div class="sm:col-span-2 md:col-span-4 lg:col-span-2">
                    <label for="search" class="block text-sm font-medium text-[var(--muted)] mb-1">Search by name</label>
                    <input type="text" name="search" id="search" placeholder="e.g., Wireless Headphones" value="{{ request('search') }}"
                           class="w-full bg-[#0b131c] border border-[var(--border)] rounded-xl px-4 py-2.5 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--ring)]/60 focus:outline-none transition-all">
                </div>
                {{-- Min Price Input --}}
                <div>
                    <label for="min_price" class="block text-sm font-medium text-[var(--muted)] mb-1">Min price</label>
                    <input type="number" name="min_price" id="min_price" placeholder="$0.00" step="0.01" value="{{ request('min_price') }}"
                           class="w-full bg-[#0b131c] border border-[var(--border)] rounded-xl px-4 py-2.5 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--ring)]/60 focus:outline-none transition-all">
                </div>
                {{-- Sort Select --}}
                <div>
                    <label for="sort" class="block text-sm font-medium text-[var(--muted)] mb-1">Sort by</label>
                    <select name="sort" id="sort"
                            class="w-full bg-[#0b131c] border border-[var(--border)] rounded-xl px-4 py-2.5 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--ring)]/60 focus:outline-none transition-all">
                        <option value="">Default</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </div>
                {{-- Action Buttons --}}
                <div class="flex items-center gap-2">
                    <button type="submit" class="w-full font-semibold text-[#051d1a] px-4 py-2.5 rounded-xl transition-transform active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[var(--bg)] focus:ring-[var(--ring)]"
                            style="background: linear-gradient(180deg, var(--primary), var(--primary-600));">Apply</button>
                    <a href="{{ route('products.index') }}" class="w-full text-center font-semibold bg-transparent text-[var(--muted)] border border-[var(--border)] hover:bg-white/5 px-4 py-2.5 rounded-xl transition-all">Clear</a>
                </div>
            </form>
        </div>

        {{-- Products Grid --}}
        @if ($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="flex flex-col bg-[var(--card)] border border-[var(--border)] rounded-[var(--radius)] shadow-[var(--shadow)] overflow-hidden transition-transform hover:-translate-y-1">
                        {{-- Product Image --}}
                        <div class="aspect-video bg-[#0b131c] overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                {{-- Using a placeholder to demonstrate the design --}}
                                <img src="https://source.unsplash.com/random/400x300?product,{{$loop->iteration}}" alt="Placeholder Image" class="w-full h-full object-cover">
                            @endif
                        </div>

                        {{-- Product Details --}}
                        <div class="p-5 flex flex-col flex-grow">
                            <h2 class="text-xl font-semibold mb-2 text-[var(--text)]" style="font-weight: 600;">{{ $product->name }}</h2>
                            <p class="text-[var(--muted)] text-sm mb-4 flex-grow">{{ $product->description ?? 'No description available.' }}</p>
                            
                            <div class="flex items-end justify-between mt-auto">
                                <div class="flex flex-col">
                                    <span class="text-xs text-[var(--muted)]">Price</span>
                                    <p class="text-2xl font-bold text-[var(--primary)]">${{ number_format($product->price, 2) }}</p>
                                </div>
                                <div class="text-right">
                                     <span class="text-xs text-[var(--muted)]">Stock</span>
                                     <p class="font-semibold">{{ $product->quantity }} units</p>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="grid grid-cols-3 border-t border-[var(--border)]">
                             <a href="{{ route('products.show', $product->id) }}" class="text-center p-3 text-sm font-medium text-[var(--muted)] hover:bg-white/5 transition-colors border-r border-[var(--border)]">View</a>
                             <a href="{{ route('products.edit', $product->id) }}" class="text-center p-3 text-sm font-medium text-amber-400 hover:bg-amber-400/10 transition-colors border-r border-[var(--border)]">Edit</a>
                             <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')" class="w-full text-center p-3 text-sm font-medium text-red-400 hover:bg-red-400/10 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-[var(--card)] border border-[var(--border)] rounded-2xl">
                <h3 class="text-xl font-semibold">No Products Found</h3>
                <p class="text-[var(--muted)] mt-2">Try adjusting your search filters or add a new product.</p>
            </div>
        @endif
        
        {{-- Pagination --}}
        <div class="mt-12">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>

</body>
</html>