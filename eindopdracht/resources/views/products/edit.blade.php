<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="bg-gray-800 py-3">
        <h3 class="text-white text-center text-xl">CRUD</h3>
    </div>

    <div class="container mx-auto mt-8">
        <div class="flex justify-end mb-4">
            <a href="{{ route('products.index') }}" class="bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700">Back</a>
        </div>

        <div>
            <div class="bg-white shadow-md rounded my-6 p-6">
                <div class="bg-gray-800 text-white p-4 rounded-t">
                    <h3 class="text-xl">Edit Product</h3>
                </div>
                <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="post" class="space-y-6">
                    @method('put')
                    @csrf
                    <div>
                        <label class="block text-lg font-medium text-gray-700">Name</label>
                        <input value="{{ old('name', $product->name) }}" type="text" name="name" placeholder="Name"
                            class="@error('name') border-red-500 @enderror w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-gray-300">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-medium text-gray-700">Sku</label>
                        <input value="{{ old('sku', $product->sku) }}" type="text" name="sku"
                            class="@error('sku') border-red-500 @enderror w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-gray-300">
                        @error('sku')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-medium text-gray-700">Price</label>
                        <input value="{{ old('price', $product->price) }}" type="text" name="price" placeholder="Price"
                            class="@error('price') border-red-500 @enderror w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-gray-300">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-medium text-gray-700">Description</label>
                        <textarea name="description" cols="30" rows="5" placeholder="Description"
                            class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-gray-300">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-lg font-medium text-gray-700">Image</label>
                        <input type="file" name="image"
                            class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-gray-300">
                        @if ($product->image != "")
                            <img class="w-32 my-4" src="{{ asset('uploads/products/' . $product->image) }}" alt="">
                        @endif
                    </div>

                    <div>
                        <label class="block text-lg font-medium text-gray-700">Publish Date</label> <!-- Nieuwe label voor publish_date -->
                        <input value="{{ old('publish_date', $product->publish_date) }}" type="date" name="publish_date" 
                            class="@error('publish_date') border-red-500 @enderror w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-gray-300">
                        @error('publish_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
