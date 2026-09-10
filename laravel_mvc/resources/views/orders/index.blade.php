@php use App\Models\Order; @endphp
<x-layout>
    <div class="row">
        <div class="col" data-status="Pending">
            <h3>Pending</h3>
            @foreach(Order::status('Pending')->get() as $order)
                <div class="card my-2" style="width: 18rem;" draggable="true" data-id="{{$order->getKey()}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$order->users->username}}</h5>
                        <p class="card-text">
                            Date: {{$order->order_date->diffForHumans()}}
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col" data-status="In Progress">
            <h3>In Progress</h3>
            @foreach(Order::status('In Progress')->get() as $order)
                <div class="card my-2" style="width: 18rem;" draggable="true" data-id="{{$order->getKey()}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$order->users->username}}</h5>
                        <p class="card-text">
                            Date: {{$order->order_date->diffForHumans()}}
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col" data-status="Completed">
            <h3>Completed</h3>
            @foreach(Order::status('Completed')->get() as $order)
                <div class="card my-2" style="width: 18rem;" draggable="true" data-id="{{$order->getKey()}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$order->users->username}}</h5>
                        <p class="card-text">
                            Date: {{$order->order_date->diffForHumans()}}
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col" data-status="Cancelled">
            <h3>Cancelled</h3>
            @foreach(Order::status('Cancelled')->get() as $order)
                <div class="card my-2" style="width: 18rem;" draggable="true" data-id="{{$order->getKey()}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$order->users->username}}</h5>
                        <p class="card-text">
                            Date: {{$order->order_date->diffForHumans()}}
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @push('scripts')
        <script>
            let draggedId;
            const cards = document.querySelectorAll('.card');
            const rows = document.querySelectorAll('.col')
            cards.forEach(card => {
                card.addEventListener('dragstart', (ev) => {
                    draggedId = card.dataset.id
                    console.log(draggedId);
                })
            })
            rows.forEach(row => {
                row.addEventListener('dragover', (ev) => ev.preventDefault())
                row.addEventListener('drop', (ev) => {
                    const status = row.dataset.status;
                    const link = document.createElement('a');
                    link.href = `http://10.83.10.161/laravel_modal/public/orders/status/${draggedId}/${status}`;
                    link.click();
                })
            })
        </script>
    @endpush
</x-layout>

