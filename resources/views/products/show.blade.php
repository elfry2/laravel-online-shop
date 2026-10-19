<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('products.edit', $product) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Edit
                </a>
                <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-80 object-cover rounded-lg shadow">
                        @else
                            <div class="w-full h-80 bg-gray-100 flex items-center justify-center rounded-lg text-gray-400">
                                No Image Available
                            </div>
                        @endif
                    </div>
                    <div class="space-y-4">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                        <p class="text-3xl font-semibold text-indigo-600">${{ number_format($product->price, 2) }}</p>
                        
                        <div>
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ')' : 'Out of Stock' }}
                            </span>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <h3 class="text-sm font-medium text-gray-500">Description</h3>
                            <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $product->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>