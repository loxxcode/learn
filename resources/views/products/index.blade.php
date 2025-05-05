<?php
    $a =1;  
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="success">
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <div class="fail">
        @if(session()->has('fail'))
            <div>
                {{session('fail')}}
            </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{route('product.create')}}" class="button">Add Product</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th colspan="2">Action</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{$a++}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>
                        <a href="{{route('product.edit', ['id' => $product->id])}}" class="edit">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('product.destroy', ['id' => $product->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="delete" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <style>
        .button{
            display: flex;
            background: white;
            width: 150px;
            border-radius: 15px;
            padding: 1rem;
            margin: 2rem 10rem;
            text-align: center;
            justify-content: center
        }
        .button:hover{
            background: rgba(123, 123, 123, 0.2);
        }
        table,tr,td,th{
            border: 1px solid black;
            padding: 1rem;
        }
        table{
            margin: 0 20rem;
        }
        .success{
            position: absolute;
            margin-top: 3rem;
            margin-left: 30rem;
            color: green;
            font-weight: bolder;
            cursor: pointer;
        }
        .edit:hover{
            color: gray;
        }
        .delete{
            cursor: pointer;
        }
        .delete:hover{
            color: red;
        }
        .fail{
            position: absolute;
            margin-top: 3rem;
            margin-left: 30rem;
            color: red;
            font-weight: bolder;
            cursor: pointer;
        }
    </style>
</x-app-layout>