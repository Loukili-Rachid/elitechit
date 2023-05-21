<div>
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
                            <a 
                                href="{{route('remove_from_cart',$productId)}}"
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

   
</div>
