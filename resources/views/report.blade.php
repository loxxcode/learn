<?php
    $a = 1;
?>
<x-app-layout>
    <x-slot name="header">
        <div class="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products Report') }}
            </h2>
            <form action="{{ route('report') }}" method="GET" class="d-flex align-items-center">
                <select name="period" class="form-select me-2" onchange="this.form.submit()">
                    <option value="">All Time</option>
                    <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>Weekly Report</option>
                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Monthly Report</option>
                </select>
            </form>
        </div>
    </x-slot>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Consolidated Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Total Imports</th>
                                            <th>Total Exports</th>
                                            <th>Current Stock</th>
                                            <th>Import Price</th>
                                            <th>Export Price</th>
                                            <th>Total Import Value</th>
                                            <th>Total Export Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product as $item)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->imports->sum('quantity') }}</td>
                                                <td>{{ $item->exports->sum('quantity') }}</td>
                                                <td>{{ $item->imports->sum('quantity') - $item->exports->sum('quantity') }}</td>
                                                <td>{{ number_format($item->imports->avg('price'), 2) }}</td>
                                                <td>{{ number_format($item->exports->avg('price'), 2) }}</td>
                                                <td>{{ number_format($item->imports->sum('total_price'), 2) }}</td>
                                                <td>{{ number_format($item->exports->sum('total_price'), 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .header{
        display: flex;
        justify-content: space-between;
    }
    select{
        display: flex;
        width: 100%;
        margin-top: -10px;
        padding: 0.5rem;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 1rem;
    }
    table,tr,td,th{
        border: 1px solid black;
        padding: 0.5rem;
    }
    table{
        width: 100%;
        border-collapse: collapse;
        margin: 2rem;
    }
</style>
</x-app-layout>
