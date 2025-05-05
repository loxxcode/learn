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

    <form action="{{route('import.store')}}" method="post">
        @csrf
        @method('post')
        <div>
            <select name="product_id" id="">
                <option value="#">select Product Name</option>
                @foreach ($product as $products)
                    <option value="{{ $products -> id }}">{{ $products -> name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Qty</label>
            <input type="number" name="quantity" placeholder="Qty">
        </div>
        <div>
            <label for="">Price</label>
            <input type="number" name="price" placeholder="Price">
        </div>
        <div>
            <label for="">Description</label>
            <input type="text" name="description" placeholder="Description">
        </div>
        <div>
            <input type="submit" name="submit" value="Save a New Product">
        </div>
    </form>
</x-app-layout>