@extends('layouts.app')

@section('content')
<div class="row h-100">
    <!-- Product Section -->
    <div class="col-md-9 d-flex flex-column h-100 pe-4">
        <!-- Top Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold m-0" style="font-size: 2rem;">Welcome</h1>
            
            <div class="d-flex align-items-center gap-3 flex-grow-1 mx-5">
                 <div class="input-group rounded-pill border-0 shadow-sm" style="background-color: white; overflow: hidden; padding: 5px 15px;">
                    <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control bg-transparent border-0 shadow-none" placeholder="Search menu">
                 </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                 <a href="{{ route('cashier.history') }}" class="btn btn-light rounded-pill shadow-sm py-2 px-3 fw-bold d-flex align-items-center gap-2 text-decoration-none text-dark" style="background-color: #EAE5D9;">
                    <i class="bi bi-clock-history"></i> History
                 </a>
                 
                 <div class="fw-bold fs-5" id="clock">18.25</div>
                 
                 
                 <div class="d-flex align-items-center gap-2 ms-3">
                     <a href="{{ route('cashier.profile') }}" class="text-decoration-none text-dark d-flex align-items-center gap-2">
                         <div class="bg-dark rounded-circle text-white d-flex align-items-center justify-content-center" style="width:45px;height:45px; font-size: 1.2rem;">
                            <i class="bi bi-person-fill"></i>
                         </div>
                         <div style="line-height: 1.2;">
                             <div class="fw-bold">{{ Auth::user()->name }}</div>
                             <div class="small text-muted" style="font-size: 0.8rem;">+62xxxx789</div>
                         </div>
                     </a>
                 </div>
            </div>
        </div>

        <!-- Categories -->
        <ul class="nav nav-pills mb-4 gap-3" id="categoryTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 py-2 border" data-bs-toggle="pill" data-bs-target="#all">All Menu</button>
            </li>
            @foreach($categories as $category)
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2 border" data-bs-toggle="pill" data-bs-target="#cat-{{ $category->id }}">{{ $category->name }}</button>
            </li>
            @endforeach
        </ul>

        <!-- Product Grid -->
        <div class="tab-content flex-grow-1 overflow-auto" style="scrollbar-width: none;">
            <div class="tab-pane fade show active" id="all">
                <div class="row g-3">
                    @foreach($categories->flatMap->products as $product)
                        @include('cashier.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
            @foreach($categories as $category)
            <div class="tab-pane fade" id="cat-{{ $category->id }}">
                <div class="row g-3">
                    @foreach($category->products as $product)
                        @include('cashier.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Cart Section -->
    <div class="col-md-3 bg-white p-4 h-100 rounded-4 shadow-sm d-flex flex-column mt-5" style="transform: translateY(20px);">
        <h4 class="fw-bold mb-1">Customer Information</h4>
        <div class="text-muted small mb-3">Order ID #{{ rand(100000, 999999) }} / Dine In</div>

        <div class="mb-3">
            <input type="text" id="customerName" class="form-control mb-2" placeholder="Customer Name">
            <input type="text" id="tableNumber" class="form-control" placeholder="Table Number (Optional)">
        </div>

        <hr>

        <div class="flex-grow-1 overflow-auto mb-3" id="cartItems">
            <!-- Cart Items injected via JS -->
            <div class="text-center text-muted py-5" id="emptyCartMsg">
                <i class="bi bi-basket3 display-1"></i>
                <p class="mt-2">No items in cart</p>
            </div>
        </div>

        <div class="mt-auto">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Items (<span id="cartCount">0</span>)</span>
                <span class="fw-bold" id="cartSubtotal">Rp0</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Tax (10%)</span>
                <span class="fw-bold" id="cartTax">Rp0</span>
            </div>
            <hr class="border-dashed">
            <div class="d-flex justify-content-between mb-4">
                <span class="fw-bold fs-5">Total</span>
                <span class="fw-bold fs-5" id="cartTotal">Rp0</span>
            </div>
            <button class="btn btn-primary w-100 py-3 rounded-3 fw-bold" onclick="submitOrder()">Confirm Order</button>
        </div>
    </div>
</div>

<!-- Styling for specific components -->
<style>
    .nav-pills .nav-link { color: #555; background-color: white; }
    .nav-pills .nav-link.active { background-color: #C8BFAA; color: #333; font-weight: bold; border-color: #C8BFAA !important; }
    .product-card {
        transition: transform 0.2s;
        cursor: pointer;
        border: none;
    }
    .product-card:hover { transform: translateY(-3px); }
    .product-img {
        height: 140px;
        object-fit: cover;
        border-radius: 12px;
    }
    .cart-item-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>

@push('scripts')
<script>
    let cart = {};

    function addToCart(id, name, price, image) {
        if (cart[id]) {
            cart[id].quantity++;
        } else {
            cart[id] = { id, name, price, image, quantity: 1 };
        }
        renderCart();
    }

    function updateQty(id, change) {
        if (cart[id]) {
            cart[id].quantity += change;
            if (cart[id].quantity <= 0) {
                delete cart[id];
            }
            renderCart();
        }
    }

    function renderCart() {
        const cartContainer = document.getElementById('cartItems');
        const emptyMsg = document.getElementById('emptyCartMsg');
        cartContainer.innerHTML = '';
        
        let subtotal = 0;
        let count = 0;

        if (Object.keys(cart).length === 0) {
            cartContainer.appendChild(emptyMsg);
            emptyMsg.style.display = 'block';
        } else {
            emptyMsg.style.display = 'none'; // Hide if has items but keep in DOM just in case
            
            for (const [id, item] of Object.entries(cart)) {
                subtotal += item.price * item.quantity;
                count += item.quantity;

                const itemHtml = `
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="${item.image || 'https://via.placeholder.com/50'}" class="cart-item-img">
                        <div class="flex-grow-1">
                            <div class="fw-bold small">${item.name}</div>
                            <div class="text-muted small">Rp${new Intl.NumberFormat('id-ID').format(item.price)}</div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                             <button class="btn btn-sm btn-light border" onclick="updateQty(${id}, -1)">-</button>
                             <span class="small fw-bold">${item.quantity}</span>
                             <button class="btn btn-sm btn-dark text-white" onclick="updateQty(${id}, 1)">+</button>
                        </div>
                    </div>
                `;
                cartContainer.innerHTML += itemHtml;
            }
        }

        const tax = subtotal * 0.1;
        const total = subtotal + tax;

        document.getElementById('cartCount').innerText = count;
        document.getElementById('cartSubtotal').innerText = 'Rp' + new Intl.NumberFormat('id-ID').format(subtotal);
        document.getElementById('cartTax').innerText = 'Rp' + new Intl.NumberFormat('id-ID').format(tax);
        document.getElementById('cartTotal').innerText = 'Rp' + new Intl.NumberFormat('id-ID').format(total);
    }

    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('clock').innerText = `${hours}.${minutes}`;
    }
    setInterval(updateClock, 1000);
    updateClock();

    function submitOrder() {
        const customerName = document.getElementById('customerName').value;
        const tableNumber = document.getElementById('tableNumber').value;
        
        if (!customerName) {
            alert('Please enter customer name');
            return;
        }
        if (Object.keys(cart).length === 0) {
            alert('Cart is empty');
            return;
        }

        const items = Object.values(cart).map(item => ({
            id: item.id,
            quantity: item.quantity
        }));
        
        // Calculate total again to be safe/consistent with expectation
        let total = 0;
        Object.values(cart).forEach(i => total += (i.price * i.quantity));
        total = total * 1.1; // + Tax

        const data = {
            customer_name: customerName,
            table_number: tableNumber,
            items: items,
            total_amount: Math.round(total)
        };

        fetch('{{ route('cashier.order.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Order placed successfully!');
                cart = {};
                renderCart();
                document.getElementById('customerName').value = '';
                document.getElementById('tableNumber').value = '';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    }
</script>
@endpush
@endsection
