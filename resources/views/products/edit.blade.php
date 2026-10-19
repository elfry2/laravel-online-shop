<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}: {{ $product->name }}
            </h2>
            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div>
                        <x-input-label for="name" :value="__('Product Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Price -->
                        <div>
                            <x-input-label for="price" :value="__('Price (Rp)')" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price', $product->price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <!-- Stock -->
                        <div>
                            <x-input-label for="stock" :value="__('Stock Quantity')" />
                            <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $product->stock)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                        </div>
                    </div>

                    <!-- Product Image -->
                    <div>
                        <x-input-label for="image" :value="__('Product Image')" />
                        
                        @if($product->image)
                            <div class="mb-3">
                                <span class="block text-xs font-medium text-gray-500 mb-1">Current Image:</span>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-20 w-20 object-cover rounded-md border border-gray-200">
                            </div>
                        @endif

                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        <p class="mt-1 text-xs text-gray-500">Leave blank to keep current image.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        <x-primary-button>
                            {{ __('Update Product') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>