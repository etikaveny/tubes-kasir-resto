@extends('layouts.app')

@section('content')
    <div class="row h-100">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-3">
                    <h2 class="fw-bold m-0">Riwayat Transaksi</h2>
                </div>

                <form action="{{ route(auth()->user()->role . '.history') }}" method="GET" class="d-flex gap-3">
                    <select name="sort" class="form-select border-0 shadow-sm rounded-pill ps-3 pe-5"
                        onchange="this.form.submit()" style="width: auto;">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>

                    <input type="month" name="filter_month" class="form-control border-0 shadow-sm rounded-pill px-3"
                        value="{{ request('filter_month') }}" onchange="this.form.submit()"
                        style="width: 170px; background-color: #fff; cursor: pointer;"
                        onclick="try{this.showPicker()}catch(e){}">

                    <input type="text" name="search" class="form-control border-0 shadow-sm rounded-pill px-3"
                        placeholder="Cari nama, id, produk..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-dark rounded-pill px-3 shadow-sm"><i
                            class="bi bi-search"></i></button>
                </form>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Type/Table</th>
                            <th>Items</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>
                                    @if($order->order_type == 'dine_in')
                                        <span class="badge bg-primary">Dine In</span> <br> <small class="text-muted">Table
                                            {{ $order->table_number }}</small>
                                    @else
                                        <span class="badge bg-warning text-dark">Take Away</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($order->items as $item)
                                            <li class="small text-muted">{{ $item->product->name }} x{{ $item->quantity }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="fw-bold">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td><span class="badge bg-success">Paid</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($orders->isEmpty())
                    <div class="text-center py-5 text-muted">No history found.</div>
                @endif

                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection