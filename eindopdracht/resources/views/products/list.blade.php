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
            <a href="{{ route('products.create') }}" class="bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700">Create</a>
        </div>

        <div>
            @if (Session::has('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-full bg-white mx-auto text-center">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/6 py-2">ID</th>
                            <th class="w-1/6 py-2">Image</th>
                            <th class="w-1/6 py-2">Name</th>
                            <th class="w-1/6 py-2">Sku</th>
                            <th class="w-1/6 py-2">Price</th>
                            <th class="w-1/6 py-2">Publish Date</th>
                            <th class="w-1/6 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->isNotEmpty())
                            @foreach ($products as $product)
                                <tr class="border-b">
                                    <td class="py-3 px-4 text-center">{{ $product->id }}</td>
                                    <td class="py-3 px-4 text-center">
                                        @if ($product->image != "")
                                            <img width="50" src="{{ asset('uploads/products/' . $product->image) }}" alt="" class="mx-auto">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">{{ $product->name }}</td>
                                    <td class="py-3 px-4 text-center">{{ $product->sku }}</td>
                                    <td class="py-3 px-4 text-center">${{ $product->price }}</td>
                                    <td class="py-3 px-4 text-center">{{ $product->publish_date ? \Carbon\Carbon::parse($product->publish_date)->format('d M, Y') : 'N/A' }}</td>
                                    <td class="py-3 px-4 text-center flex justify-center space-x-2">
                                        <a href="{{ route('products.edit',$product->id) }}" class="bg-gray-800 text-white py-1 px-3 rounded hover:bg-gray-700">Edit</a>
                                        <form action="{{route('products.destroy',$product->id)}}" method="post" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded hover:bg-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-4">No products found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
