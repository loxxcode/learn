<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit A Product') }}
        </h2>
    </x-slot>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
        @endif
    </div>

    <form action="{{route('product.update', ['id' => $product])}}" class="myform" method="post">
        @csrf
        @method('put')
        <div>
            <label for="">Product Name</label>
            <input type="text" name="name" placeholder="Name" value="{{$product->name}}">
        </div>
        <div>
            <label for="">Product Description</label>
            <input type="text" name="description" placeholder="Description"  value="{{$product->description}}">
        </div>
        <div>
            <input type="submit" name="submit" value="Update Product">
        </div>
    </form>
    <style>
        .myform{
            margin: 7rem 33rem;
            background: white;
            padding: 2rem;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            line-height: 2rem;
        }
        input[type="text"],
        input[type="number"]{
            width: 100%;
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 1rem;
        }
        input[type="submit"]{
            background: #4CAF50;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            margin: 0 3rem;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover{
            background: #45a049;
        }
    </style>
</x-app-layout>