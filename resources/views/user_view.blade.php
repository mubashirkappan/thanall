@extends('welcome')

@section('title', 'Passbook')

@section('content')
<div class="row mt-5">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card p-4 shadow">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Passbook</h4>
                @if($id)
                <a href="{{ route('user.entry', $id) }}" class="btn btn-primary">+ New Entry</a>
                @endif
            </div>

            <!-- Filter Form -->
            <form method="GET" action="{{ route('user.view', $id) }}" class="mb-4">
                <div class="row">
                    @auth
                    @if(auth()->user()->is_admin)
                    <div class="col-md-4 mb-3">
                        <label for="user_id" class="form-label">Select User</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">All Users</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->f_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @endauth

                    <div class="col-md-4 mb-3">
                        <label for="payment_method_id" class="form-label">Select Payment Method</label>
                        <select name="payment_method_id" id="payment_method_id" class="form-select">
                            <option value="">All Payment Methods</option>
                            @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}" {{ request('payment_method_id') == $method->id ? 'selected' : '' }}>
                                {{ $method->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="debit_or_credit" class="form-label">Transaction Type</label>
                        <select name="debit_or_credit" id="debit_or_credit" class="form-select">
                            <option value="">All</option>
                            <option value="debit" {{ request('debit_or_credit') == 'debit' ? 'selected' : '' }}>Debit</option>
                            <option value="credit" {{ request('debit_or_credit') == 'credit' ? 'selected' : '' }}>Credit</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="time_filter" class="form-label">Time Filter</label>
                        <select name="time_filter" id="time_filter" class="form-select">
                            <option value="">Select Time Filter</option>
                            <option value="weekly" {{ request('time_filter') == 'weekly' ? 'selected' : '' }}>This Week</option>
                            <option value="monthly" {{ request('time_filter') == 'monthly' ? 'selected' : '' }}>This Month</option>
                            <option value="yearly" {{ request('time_filter') == 'yearly' ? 'selected' : '' }}>This Year</option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                        <a href="{{ route('user.view', $id) }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>

            <!-- Buttons for Export -->
            <div class="mb-3">
                <button id="downloadPdf" class="btn btn-danger">Download PDF</button>
                <button id="downloadExcel" class="btn btn-success">Download Excel</button>
                <button id="downloadCsv" class="btn btn-primary">Download CSV</button>
            </div>

            <!-- Passbook Table -->
            <table class="table table-bordered text-center">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Date</th>
                        @auth
                        @if(auth()->user()->is_admin)
                        <th>User</th>
                        @endif
                        @endauth
                        <th class="bg-danger">Debit</th>
                        <th class="bg-success">Credit</th>
                        <th>Balance</th>
                        <th>Payment Method</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($entries as $entry)
                    <tr>
                        <td>{{ $entry->entry_date }}</td>
                        @auth
                        @if(auth()->user()->is_admin)
                        <td>{{ $entry->user->f_name ?? 'N/A' }}</td>
                        @endif
                        @endauth
                        <td style="background-color: rgba(255, 0, 0, 0.2);">{{ $entry->debit }}</td>
                        <td style="background-color: rgba(0, 128, 0, 0.2);">{{ $entry->credit }}</td>
                        <td>{{ $entry->balance }}</td>
                        <td>{{ $entry->paymentMethod?->title ?? 'N/A' }}</td>
                        <td>{{ $entry->description }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">No entries found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>


    // Download PDF
    document.getElementById('downloadPdf').addEventListener('click', function() {
        console.log("Download PDF clicked");

        const {
            jsPDF
        } = window.jspdf;

        html2canvas(document.querySelector("table")).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF();
            pdf.addImage(imgData, 'PNG', 10, 10);
            pdf.save('passbook.pdf');
        }).catch(function(error) {
            console.error("Error in creating PDF", error);
        });
    });

    // Download Excel
    document.getElementById('downloadExcel').addEventListener('click', function() {
        console.log("Download Excel clicked");

        let table = document.querySelector('table');
        let wb = XLSX.utils.table_to_book(table, {
            sheet: "Passbook"
        });
        XLSX.writeFile(wb, 'passbook.xlsx');
    });

    // Download CSV
    document.getElementById('downloadCsv').addEventListener('click', function() {
        console.log("Download CSV clicked");

        let table = document.querySelector('table');
        let wb = XLSX.utils.table_to_book(table, {
            sheet: "Passbook"
        });
        XLSX.writeFile(wb, 'passbook.csv');
    });
</script>
@endsection