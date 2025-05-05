<?php
    $a = 1;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exported Products') }}
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
            <a href="{{route('export.create')}}" class="button">Export Product</a>
        </div>
        <table border='1'>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Product Qty</th>
                <th>Product Price</th>
                <th>Product Total Price</th>
                <th>Product Description</th>
                <th colspan="2">Action</th>
            </tr>
            @foreach($export as $exports)
                <tr>
                    <td>{{$a++}}</td>
                    <td>{{ $exports->products ->name }}</td>
                    <td>{{$exports->quantity}}</td>
                    <td>{{$exports->price}}</td>
                    <td>{{$exports->total_price}}</td>
                    <td>{{$exports->description}}</td>
                    <td>
                        <a href="{{route('export.edit', ['id' => $exports->id])}}" class="edit">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('export.destroy', ['id' => $exports->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="delete">
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