<div class="mt-5 container card">
    <div class="mt-3 alert alert-secondary d-flex justify-content-end" >
        <div  style="display: flex; align-items: center">
            <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i> Cart 
            ({{ $cart_counter }})
        </div>
    </div>
    <div style="overflow: auto; white-space: nowrap;">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @forelse ($cart as $productId => $item)
                    <tr>
                        <th style="vertical-align: middle;"  scope="row">{{ $loop->index+1 }}</th>
                        <td style="vertical-align: middle;"> {{ $item['title'] }}</td>
                        <td style="vertical-align: middle;"> ${{ number_format( $item['price'], 2) }}</td>
                        <td>
                            <button class="btn"
                                wire:click="decrementQuantity({{ $productId }})"
                            >
                            -
                            </button>
                            <span class="px-1 px-md-4">{{ $item['quantity'] }}</span>
                            <button class="btn"
                                wire:click="incrementQuantity({{ $productId }})"
                            >
                                    +
                            </button>
                        </td>
                        <td style="vertical-align: middle;">
                            <a style="cursor: pointer"
                                wire:click="removeProduct({{ $productId }})"
                            >
                            <i class="text-md fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>  
                @empty
                    <tr>
                        <td colspan="3">No
                            products found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end pb-3 px-3 font-weight-bolder">
        Total:  ${{ number_format(  $total , 2) }}
    </div>
    <div class="d-flex justify-content-between pb-3 px-3 font-weight-bolder">
        <a class="mr-2 btn"
        >
        <i class="fa-sharp fa-solid fa-arrow-left"></i> continue shopping
        </a>
        @if ($checkout)
            @auth('client')
                <a href="#Auth"  class="btn"
                >
                    <i class="fa-solid fa-bag-shopping"></i> checkout
                </a>
            @else
                <a href="{{route('showRegistrationForm')}}" class="btn"
                >
                    <i class="fa-solid fa-bag-shopping"></i> checkout
                </a>
            @endauth
        @endif
    </div>
</div>
