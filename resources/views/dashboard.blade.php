<x-app-layout>

<div class="container">
    <div class="product">
        <h2>Products</h2>
        <p>{{ $product }}</p>
    </div>
    
    <div class="product">
        <h2>Imports</h2>
        <p>{{ $import }}</p>
    </div>
    
    <div class="product">
        <h2>Exports</h2>
        <p>{{ $export }}</p>
    </div>
</div>
<style>
    .container{
        display: flex;
        gap: 5rem;
        justify-content: center;
        text-align: center;
        margin: 10rem 0;
    }
    .product{
        /* background-color: #f0f0f0; */
        background: #ffffff;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        width: 200px;
        height: 120px;
    }
    h2{
        font-size: larger;
    }
    p{
        font-size: 24px;
    }
</style>
</x-app-layout>
