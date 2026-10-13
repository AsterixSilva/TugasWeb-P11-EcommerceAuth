<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center justify-between">
                    <span>{{ __("You're logged in!") }}</span>
                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-gray-100 text-gray-700 uppercase">
                        Role: {{ Auth::user()->role ?? 'user' }}
                    </span>
                </div>
            </div>

            {{-- Ringkasan Produk — tampil untuk SEMUA role (admin, editor, user) --}}
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Total Produk</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $totalProducts ?? 0 }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Kategori</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $totalCategories ?? 0 }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Stok Tersedia</div>
                    <div class="text-2xl font-bold text-green-600">{{ $inStockCount ?? 0 }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Stok Habis</div>
                    <div class="text-2xl font-bold text-red-600">{{ $outOfStockCount ?? 0 }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Stok Menipis (&lt;10)</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $lowStockCount ?? 0 }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Produk per Kategori</h3>
                        <ul class="space-y-2">
                            @forelse($productsPerCategory ?? [] as $category)
                                <li class="flex items-center justify-between text-sm">
                                    <span class="text-gray-700">{{ $category->name }}</span>
                                    <span class="font-semibold px-2 py-1 bg-gray-100 rounded">{{ $category->products_count }} produk</span>
                                </li>
                            @empty
                                <li class="text-sm text-gray-500">Belum ada kategori.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Aksi Cepat</h3>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700">
                                Lihat Produk
                            </a>
                            <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-semibold rounded-md text-gray-700 hover:bg-gray-50">
                                Lihat Kategori
                            </a>
                        </div>
                        <p class="mt-4 text-sm text-gray-500">Menu Produk &amp; Kategori bisa diakses semua role yang sudah login.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-lg text-gray-800">Produk Terbaru</h3>
                        <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">Lihat semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-500">Nama</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-500">Kategori</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-500">Harga</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-500">Stok</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($latestProducts ?? [] as $product)
                                    <tr>
                                        <td class="px-4 py-2 text-gray-900">{{ $product->name }}</td>
                                        <td class="px-4 py-2 text-gray-500">{{ $product->category->name ?? '-' }}</td>
                                        <td class="px-4 py-2 text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2">
                                            @if($product->stock === 0)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Habis</span>
                                            @elseif($product->stock < 10)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">{{ $product->stock }} (Menipis)</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">{{ $product->stock }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-gray-500">Belum ada produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
