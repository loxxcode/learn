<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create A Product') }}
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
    <div>
        @if (session()->has("error"))
            <div>{{ session("error") }}</div>
        @endif
    </div>

    <form action="{{route('export.store')}}" class="myform" method="post">
        @csrf
        @method('post')
        <div>
            <select name="product_id" id="" required>
                <option value="#">select product</option>
                @foreach ($import as $imports)
                    <option value="{{ $imports->product_id }}">{{ $imports->products->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Quantity</label>
            <input type="number" name="quantity" required placeholder="Qty">
        </div>
        
        <div>
            <label for="">Price</label>
            <input type="number" name="price" required placeholder="Price">
        </div>
        <div>
            <label for="">Description</label>
            <input type="text" name="description" placeholder="Description">
        </div>
        <div>
            <input type="submit" name="submit" value="Save a New Export">
        </div>
    </form>
    <style>
        .myform{
            margin: 1rem 33rem;
            background: white;
            padding: 1rem 2rem;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            line-height: 2rem;
        }
        select{
            width: 100%;
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 1rem;
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
            margin: 0 2rem;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover{
            background: #45a049;
        }
    </style>
</x-app-layout>