<!-- Preview Start -->
<section class="scroll-section" id="preview">
    <div class="card mb-5">
        <div class="card-body">
            <h2 class="small-title">Preview</h2>
            <p>Client ID: {{ $client_id }}</p>
            <p>Client Name: {{ $client_name }}</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Equipment Serial Number</th>
                        <th>Equipment Name</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['equipment_serial_number'] }}</td>
                            <td>{{ $item['equipment_name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['cost'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form method="POST" action="{{ route('invoice.store') }}">
                @csrf
                <input type="hidden" name="client_id" value="{{ $client_id }}">
                <input type="hidden" name="items" value="{{ json_encode($items) }}">
                <button class="btn btn-lg btn-icon btn-icon-start btn-secondary mb-1" type="submit">
                    <i data-cs-icon="arrow-bottom-right"></i>
                    <span>Submit</span>
                </button>
            </form>
        </div>
    </div>
</section>
<!-- Preview End -->
