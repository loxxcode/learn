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

    <form action="{{route('export.store')}}" method="post">
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
            <input type="submit" name="submit" value="Save a New Product">
        </div>
    </form>
</x-app-layout>