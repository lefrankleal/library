@extends('layouts.app')

@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h3 class="jumbotron-heading">Harry books - tienda online</h3>
        <p>
            <a href="{{ route('cart') }}" class="btn btn-primary my-2">Ir al carrito de compras</a>
        </p>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>
                Libros disponibles
            </h1>
        </div>
        @if ($errors->any())
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        @forelse ($books as $book)
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-4 d-inline-block">
                    <img src="{{ asset('img/'.$book->image) }}" alt="{{ $book->name }}" class="img-thumbnail">
                </div>
                <div class="col-md-8 d-inline-block">
                    <div class="card-body">
                        <p class="card-text">{{ $book->name }}</p>
                        @if ($book->stock > 0)
                            <p class="card-text">Cantidad disponible {{ $book->stock }}</p>
                        @else
                            <p class="card-text">Agotado</p>
                        @endif
                        <p class="card-text">Precio {{ number_format($book->price, 2) }}</p>
                        @if ($book->stock > 0)
                            <p class="card-text">
                                <form method="POST" action="{{ route('add-to-cart', $book->id) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="number" name="quant" id="quant" value="1" min="1" max="{{ $book->stock }}">
                                        <input type="submit" value="Agregar al carrito">
                                    </div>
                                </form>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-11">
            <div class="card">
                No hay libros para mostrar
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
