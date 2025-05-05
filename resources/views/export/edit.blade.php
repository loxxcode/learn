<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit A import</h1>

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

    <form action="{{route('export.update', ['id' => $export])}}" method="post">
        @csrf
        @method('put')
        <div>
            <select name="product_id" id="">
                <option value="{{ $export->products->id }}">{{ $export->products->name }}</option>
                @foreach ($import as $imports)
                    <option value="{{ $imports->product_id }}">{{ $imports -> products -> name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Qty</label>
            <input type="text" name="quantity" placeholder="Qty"  value="{{$export->quantity}}">
        </div>
        <div>
            <label for="">Price</label>
            <input type="text" name="price" placeholder="Price"  value="{{$export->price}}">
        </div>
        <div>
            <label for="">Description</label>
            <input type="text" name="description" placeholder="Description"  value="{{$export->description}}">
        </div>
        <div>
            <input type="submit" name="submit" value="Update">
        </div>
    </form>
</body>
</html>