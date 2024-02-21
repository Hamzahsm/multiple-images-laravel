@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product</h2>
            </div>
            <div class="pull-right mb-3">
                @can('product-create')
                    <a href="{{ route('products.create') }}" class="btn btn-success"> Create New Product</a>
                @endcan
            </div> 
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif 

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->detail }}</td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST "></form>
                         <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Show</a>
                         @can('product-edit')
                             <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                         @endcan
    
                         @csrf 
                         @method('DELETE')
                         @can('product-delete')
                             <button class="btn-danger btn" type="submit">Delete</button>
                         @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {!! $products->links() !!}

</div>



@endsection