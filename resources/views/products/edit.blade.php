<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit A Product</h1>

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

    <form action="{{route('product.update', ['id' => $product])}}" method="post">
        @csrf
        @method('put')
        <div>
            <label for="">Name</label>
            <input type="text" name="name" placeholder="Name" value="{{$product->name}}">
        </div>
        <div>
            <label for="">Description</label>
            <input type="text" name="description" placeholder="Description"  value="{{$product->description}}">
        </div>
        <div>
            <input type="submit" name="submit" value="Update">
        </div>
    </form>
</body>
</html>