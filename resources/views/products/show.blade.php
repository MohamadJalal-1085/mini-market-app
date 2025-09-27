{{-- resources/views/products/show.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details: {{ $product->name }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #0c1116;
            --card: #0f1720;
            --text: #e6edf3;
            --muted: #a2b3c5;
            --primary: #14B8A6;
            --primary-600: #0D9488;
            --border: rgba(255, 255, 255, 0.10);
            --ring: #99F6E4;
            --font-sans: 'Inter', sans-serif;
            --radius: 16px;
            --shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
        }
    </style>
</head>
<body class="bg-[var(--bg)] text-[var(--text)] font-['Inter'] antialiased">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">

        <header class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-semibold" style="font-size: clamp(22px, 3.4vw, 32px);">Product Details</h1>
            <a href="{{ route('products.index') }}" class="font-semibold bg-transparent text-[var(--muted)] border border-[var(--border)] hover:bg-white/5 px-5 py-3 rounded-xl transition-all">
                &larr; Back to Products
            </a>
        </header>

        <div class="bg-[var(--card)] border border-[var(--border)] rounded-2xl shadow-[var(--shadow)] overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-6 md:p-8">
                
                {{-- Image Column --}}
                <div class="md:col-span-1">
                    <div class="aspect-square bg-[#0b131c] rounded-xl overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://source.unsplash.com/random/400x400?product,tech" alt="Placeholder Image" class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                {{-- Details Column --}}
                <div class="md:col-span-2 flex flex-col">
                    <h2 class="text-4xl font-bold mb-3 text-[var(--text)]">{{ $product->name }}</h2>
                    <p class="text-[var(--muted)] text-base mb-6">{{ $product->description ?? 'No description provided.' }}</p>

                    <div class="grid grid-cols-2 gap-6 mt-auto">
                        <div>
                            <span class="block text-sm text-[var(--muted)]">Price</span>
                            <p class="text-3xl font-bold text-[var(--primary)]">${{ number_format($product->price, 2) }}</p>
                        </div>
                         <div>
                            <span class="block text-sm text-[var(--muted)]">Stock</span>
                            <p class="text-3xl font-bold">{{ $product->quantity }} <span class="text-base font-normal text-[var(--muted)]">units</span></p>
                        </div>
                    </div>

                     {{-- Action Buttons --}}
                    <div class="flex items-center gap-4 mt-10 border-t border-[var(--border)] pt-6">
                        <a href="{{ route('products.edit', $product->id) }}"
                           class="w-full sm:w-auto text-center font-semibold text-amber-900 bg-amber-400 hover:bg-amber-300 px-5 py-3 rounded-xl transition-transform active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[var(--card)] focus:ring-amber-300">
                            Edit Product
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')"
                                    class="w-full sm:w-auto text-center font-semibold text-red-400 border border-red-400/50 hover:bg-red-400/10 px-5 py-3 rounded-xl transition-all">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>