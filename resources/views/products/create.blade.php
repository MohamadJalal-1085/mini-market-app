{{-- resources/views/products/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    
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

    <div class="container mx-auto p-4 sm:p-6 lg:p-8 max-w-4xl">
        
        <header class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-semibold" style="font-size: clamp(22px, 3.4vw, 32px);">Add a New Product</h1>
             <a href="{{ route('products.index') }}" class="font-semibold bg-transparent text-[var(--muted)] border border-[var(--border)] hover:bg-white/5 px-5 py-3 rounded-xl transition-all">
                Cancel
            </a>
        </header>
        
        <div class="bg-[var(--card)] border border-[var(--border)] rounded-2xl shadow-[var(--shadow)] p-6 md:p-8">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Name --}}
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-[var(--muted)] mb-2">Product Name</label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                           class="w-full bg-[#0b131c] border border-[var(--border)] rounded-xl px-4 py-2.5 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--ring)]/60 focus:outline-none transition-all">
                </div>
                
                {{-- Description --}}
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-[var(--muted)] mb-2">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full bg-[#0b131c] border border-[var(--border)] rounded-xl px-4 py-2.5 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--ring)]/60 focus:outline-none transition-all">{{ old('description') }}</textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    {{-- Price --}}
                    <div>
                        <label for="price" class="block text-sm font-medium text-[var(--muted)] mb-2">Price</label>
                        <input type="number" id="price" name="price" step="0.01" required value="{{ old('price') }}"
                               class="w-full bg-[#0b131c] border border-[var(--border)] rounded-xl px-4 py-2.5 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--ring)]/60 focus:outline-none transition-all">
                    </div>
                    {{-- Quantity --}}
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-[var(--muted)] mb-2">Quantity</label>
                        <input type="number" id="quantity" name="quantity" required value="{{ old('quantity') }}"
                               class="w-full bg-[#0b131c] border border-[var(--border)] rounded-xl px-4 py-2.5 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--ring)]/60 focus:outline-none transition-all">
                    </div>
                </div>

                {{-- Image Upload --}}
                <div class="mb-8">
                    <label for="image" class="block text-sm font-medium text-[var(--muted)] mb-2">Product Image</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full bg-[#0b131c] border border-[var(--border)] rounded-xl file:mr-4 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:bg-white/5 file:font-semibold file:text-[var(--muted)] hover:file:bg-white/10">
                </div>
                
                {{-- Action Buttons --}}
                <div class="flex justify-end pt-6 border-t border-[var(--border)]">
                    <button type="submit"
                            class="text-center font-semibold text-[#051d1a] px-6 py-3 rounded-xl transition-transform active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[var(--card)] focus:ring-[var(--ring)]"
                            style="background: linear-gradient(180deg, var(--primary), var(--primary-600));">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>