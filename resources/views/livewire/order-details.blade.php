<div>
      <!-- Modal -->
    <div class="modal fade @if($display)show @endif" id="exampleModal" style="background-color: rgba(31, 30, 30, 0.596);display:@if($display) block @endif"  aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 10%">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rating</h5>
                <button type="button" class="close" aria-label="Close"  wire:click="closeModel()">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="rating">
                            @for ($i = 5; $i >= 1; $i--)
                                <span style="font-size:20px" wire:click="setRating({{ $i }})" class="{{ $i <= $rating ? 'rated' : '' }}">&#9733;</span>
                            @endfor
                        </div>
                        <span>({{ $rating }})</span>
                    </div>
                    <p class="text-secondary">choose a rate for this product <b class="text-dark">"{{ $product->title ?? '' }}"</b> !</p>
                   
                        <div class="form-group">
                          <label>Comment</label>
                          <textarea wire:model="comment" value="{{ old('comment') }}"  name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" cols="30" rows="5"  data-error="Write your comment"></textarea>
                          <div class="help-block with-errors"></div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn " wire:click="closeModel()">Close</button>
                <button type="button" class="btn " wire:click="storeRating({{ $rating }})" >Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 container card">
        <div style="overflow: auto; white-space: nowrap;">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($order->products as $product)
                        <tr>
                            <th style="vertical-align: middle;"  scope="row">{{ $loop->index+1 }}</th>
                            
                            <td style="vertical-align: middle;">
                                {{ $product->title }} 
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $product->pivot->quantity }}
                            </td>
                            <td style="vertical-align: middle;">
                                ${{ number_format($product->price, 2) }}
                            </td>
                            @if($order->status->name =="received")
                                <td>
                                    <button type="button" class="btn" style="padding: 5px"
                                        wire:click="setProductId({{ $product->id }})"
                                    >
                                        rate &#9733;
                                    </button>
                                </td>
                            @endif
                        </tr>  
                    @empty
                        <tr>
                            <td colspan="3">No
                                Orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
