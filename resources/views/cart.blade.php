@extends('layouts.app')

@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h3 class="jumbotron-heading">Harry carts - tienda online</h3>
        <!-- <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p> -->
        <p>
            <a href="{{ route('home') }}" class="btn btn-primary my-2">Seguir comprando</a>
        </p>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <h1>
                Carrito de compras
            </h1>
        </div>
        <table class="col-md-12 table">
            <thead>
                <tr>
                    <th class="text-center">Acciones</th>
                    <th class="text-center">Libro</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Valor unitario</th>
                    <th class="text-center">Valor total</th>
                    <th class="text-center">Agregar</th>
                </tr>
            </thead>
            @php
                $totalPrice = 0;
            @endphp
            @forelse ($carts as $cart)
            <tr>
                <td>
                    <form method="POST" action="{{ route('remove-item', $cart->id) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" value="Eliminar">
                    </form>
                </td>
                <td>{{ $cart->bookName }}</td>
                <td>{{ $cart->inCart }}</td>
                <td>{{ number_format($cart->bookPrice, 2) }}</td>
                <td>{{ number_format($cart->bookPrice*$cart->inCart, 2) }}</td>
                <td class="text-center">
                    @if ($cart->bookStock > 1)
                    <form method="POST" action="{{ route('update-cart', $cart->id) }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <input type="number" name="quant" id="quant" value="1" max="{{ $cart->bookStock }}">
                        <input type="submit" value="Agregar">
                    </form>
                    @endif
                </td>
            </tr>
            @php
                $totalPrice = $totalPrice + ($cart->bookPrice*$cart->inCart);
            @endphp
            @empty
            <tr>
                <td>
                    No se han agregado nada al carrito
                </td>
            </tr>
            @endforelse
            <tr>
                <td class="padding">Valor total de la compra</td>
                <td colspan="5" class="text-right">{{ number_format($totalPrice, 2) }}</td>
            </tr>
        </table>
        @if($totalPrice > 0)
        <div class="col-xs-6 text-left">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#cancel">
                Cancelar compra
            </a>
        </div>
        <div class="col-xs-6 text-right">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#confirm">
                Confirmar compra
            </a>
        </div>
        @endif
    </div>
</div>
<div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="cancel-cart">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="cancel-cart">Cancelar compra</h4>
            </div>
            <div class="modal-body">
                ¿Esta seguro que desea cancelar esta compra?
                <form action="{{ route('cancel-cart') }}" method="post" style="display: none;" id="cancel-form" >
                {{ csrf_field() }}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('cancel-form').submit();">Cancelar compra</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirm-cart">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="confirm-cart">Confirmar compra</h4>
            </div>
            <div class="modal-body">
                ¿Esta seguro que desea confirmar la compra?
                <form action="{{ route('confirm-cart') }}" method="post" style="display: none;" id="confirm-form" >
                {{ csrf_field() }}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="document.getElementById('confirm-form').submit();">Confirmar</button>
            </div>
        </div>
    </div>
</div>
@endsection