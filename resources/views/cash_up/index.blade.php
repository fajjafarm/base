@extends('layouts.vertical', ['title' => 'Starter Page'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Starter'])

    <body>
    <div class="container mt-5">
        <h1 class="mb-4">End of Day Cash-Up</h1>
        <form action="{{ route('cash-up.submit') }}" method="POST">
            @csrf
            @foreach (['Juice Bar', 'Hotel Leisure', 'Playbarn', 'Spa Leisure'] as $department)
                <h2>{{ $department }}</h2>
                
                <!-- Cash Denominations -->
                <h3>Cash Denominations</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Denomination</th>
                            <th>Quantity</th>
                            <th>Total (£)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['50' => 50.00, '20' => 20.00, '10' => 10.00, '5' => 5.00, '2' => 2.00, '1' => 1.00, '0.50' => 0.50, '0.20' => 0.20, '0.10' => 0.10, '0.05' => 0.05, '0.02' => 0.02, '0.01' => 0.01] as $denom => $value)
                            <tr class="denomination-row">
                                <td>£{{ number_format($value, 2) }}</td>
                                <td>
                                    <input type="number" name="denominations[{{ $department }}][{{ $denom }}][quantity]" class="form-control denomination-quantity" min="0" value="0" data-value="{{ $value }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control denomination-total" value="0.00" readonly>
                                    <input type="hidden" name="denominations[{{ $department }}][{{ $denom }}][total]" class="denomination-total-hidden">
                                </td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="2">Total Cash Counted</td>
                            <td>
                                <input type="text" class="form-control department-cash-total" value="0.00" readonly>
                                <input type="hidden" name="totals[{{ $department }}][cash]" class="department-cash-total-hidden">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- PDQ and Amex -->
                <h3>PDQ and Amex</h3>
                <div class="mb-3">
                    <label for="{{ str_replace(' ', '_', $department) }}_pdq" class="form-label">{{ $department }} PDQ (£)</label>
                    <input type="number" step="0.01" name="totals[{{ $department }}][pdq]" id="{{ str_replace(' ', '_', $department) }}_pdq" class="form-control" min="0">
                </div>
                <div class="mb-3">
                    <label for="{{ str_replace(' ', '_', $department) }}_amex" class="form-label">{{ $department }} Amex (£)</label>
                    <input type="number" step="0.01" name="totals[{{ $department }}][amex]" id="{{ str_replace(' ', '_', $department) }}_amex" class="form-control" min="0">
                </div>

                <!-- X and Z Readings -->
                <h3>PDQ Machine Readings</h3>
                <div class="mb-3">
                    <label for="{{ str_replace(' ', '_', $department) }}_x_reading" class="form-label">X Reading</label>
                    <input type="number" step="0.01" name="readings[{{ $department }}][x]" id="{{ str_replace(' ', '_', $department) }}_x_reading" class="form-control" min="0">
                </div>
                <div class="mb-3">
                    <label for="{{ str_replace(' ', '_', $department) }}_z_reading" class="form-label">Z Reading</label>
                    <input type="number" step="0.01" name="readings[{{ $department }}][z]" id="{{ str_replace(' ', '_', $department) }}_z_reading" class="form-control" min="0">
                </div>

                <!-- Expected vs Counted -->
                <h3>Expected vs Counted</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Payment Type</th>
                            <th>Expected (£)</th>
                            <th>Counted (£)</th>
                            <th>Difference (£)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['cash', 'pdq', 'amex'] as $type)
                            <tr>
                                <td>{{ ucfirst($type) }}</td>
                                <td>{{ number_format($expectedTakings[$department][$type] ?? 0, 2) }}</td>
                                <td>
                                    <input type="text" class="form-control counted-{{ $type }}" value="0.00" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control difference-{{ $type }}" value="0.00" readonly>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach

            <button type="submit" class="btn btn-primary mt-3">Submit Cash-Up</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.denomination-quantity').forEach(input => {
            input.addEventListener('input', function () {
                const quantity = parseInt(this.value) || 0;
                const value = parseFloat(this.dataset.value);
                const total = (quantity * value).toFixed(2);
                const row = this.closest('tr');
                row.querySelector('.denomination-total').value = total;
                row.querySelector('.denomination-total-hidden').value = total;

                updateDepartmentTotal(this.closest('table'));
            });
        });

        function updateDepartmentTotal(table) {
            let total = 0;
            table.querySelectorAll('.denomination-total').forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            const totalInput = table.querySelector('.department-cash-total');
            const totalHidden = table.querySelector('.department-cash-total-hidden');
            totalInput.value = total.toFixed(2);
            totalHidden.value = total.toFixed(2);

            // Update counted cash and difference
            const departmentSection = table.closest('div.container').querySelector(`h2:contains("${table.closest('div').previousElementSibling.textContent}")`);
            const cashCounted = table.closest('div').querySelector('.counted-cash');
            cashCounted.value = total.toFixed(2);
            updateDifference(cashCounted);
        }

        function updateDifference(input) {
            const row = input.closest('tr');
            const expected = parseFloat(row.cells[1].textContent) || 0;
            const counted = parseFloat(input.value) || 0;
            const difference = (counted - expected).toFixed(2);
            const differenceInput = row.querySelector(`.difference-${input.classList[1].split('-')[1]}`);
            differenceInput.value = difference;
            differenceInput.classList.remove('difference-positive', 'difference-negative');
            if (difference > 0) {
                differenceInput.classList.add('difference-positive');
            } else if (difference < 0) {
                differenceInput.classList.add('difference-negative');
            }
        }

        // Update PDQ and Amex differences
        document.querySelectorAll('input[name*="[pdq]"], input[name*="[amex]"]').forEach(input => {
            input.addEventListener('input', function () {
                const type = this.name.includes('pdq') ? 'pdq' : 'amex';
                const departmentSection = this.closest('div.container').querySelector(`h2:contains("${this.closest('div').previousElementSibling.textContent}")`);
                const countedInput = departmentSection.nextElementSibling.querySelector(`.counted-${type}`);
                countedInput.value = parseFloat(this.value || 0).toFixed(2);
                updateDifference(countedInput);
            });
        });
    </script>
</body>
@endsection
