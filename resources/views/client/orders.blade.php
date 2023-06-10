@extends('layouts.app')
@section('content')

<!-- Quote Section -->
@include('components.quote')

<!-- Breadcrumb Sec Start -->
<section class="breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9">
          <div class="page-title">
            <h1>My Orders</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-start justify-content-md-end align-items-center">
          <div class="page-breadcumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcrumb Sec End -->
@if(Session::has('success'))
<div class="alert alert-success container mt-4">
  {{Session::get('success')}}
</div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
      {{Session::get('error')}}
    </div>
@endif
<div class="mt-5 container card">
    <div style="overflow: auto; white-space: nowrap;">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th>
                <th scope="col">Total</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @forelse ($orders as $orderId => $item)
                    <tr>
                        <th style="vertical-align: middle;"  scope="row">{{ $loop->index+1 }}</th>
                        <td style="vertical-align: middle;">
                            @switch($item->status->name)
                                @case('paid')
                                    <span class="badge badge-success">{{ $item->status->name }}</span>
                                    @break
                                @case('confirmed')
                                    <span class="badge badge-primary">{{ $item->status->name }}</span>
                                    @break
                                @case('shipped')
                                    <span class="badge badge-info">{{ $item->status->name }}</span>
                                    @break
                                @case('received')
                                    <span class="badge badge-secondary">{{ $item->status->name }}</span>
                                    @break
                                @default
                                    <span class="badge badge-dark">{{ $item->status->name }}</span>
                            @endswitch
                        </td>
                        <td style="vertical-align: middle;"> ${{ number_format( $item['total'], 2) }}</td>
                        <td>
                            @if ($item->status->name !== 'received')
                                <form action="{{ route('orders.update', $item) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" style="padding: 5px" class="btn ">Received
                                        <i class="pl-2 fa-solid fa-check"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                        <td style="vertical-align: middle;">
                            <a href="{{ route('order.details', $item->id) }}" class="btn btn-info">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
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
    <div class="d-flex border-top mt-3">
        <div class="px-5 m-auto py-3">
            {{ $orders->links() }}</div>
    </div>
</div>

@if(setting('site.Call_To_Action_Section'))
  @include('components.cta')
@endif
@if(setting('site.Client_Testimonials_Section'))
  @include('components.teatimonials')
@endif

@if(setting('site.Pricing_table_Section'))
  @include('components.pricing')
@endif
@endsection