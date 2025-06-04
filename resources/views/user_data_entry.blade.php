@extends('welcome')

@section('title', 'entry')

@section('style')
<style>
    .error {
        border: 1px solid red;
    }

    #debitField,
    #creditField {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-3"></div>
    <div class="col-6 card m-5">
        <form action="{{ route('entry.save') }}" class="m-5" method="post" id="entryForm">
            @csrf

            <label for="entryDate">Date</label>
            <input type="date" name="entryDate" id="entryDate" class="form-control"
                value="{{ \Carbon\Carbon::today()->toDateString() }}">
            <div class="text-danger error-message" id="entryDateError"></div>
            <br>
            @auth
            @if(auth()->user()->is_admin)
            <label for="user_id">Select User</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->f_name }}</option>
                @endforeach
            </select>
            @endif
            @endauth

            <label for="type_id">Type</label>
            <select name="type_id" id="type" class="form-control">
                <option value="">-- Select Type --</option>
                @foreach ($types as $type)
                <option
                    value="{{ $type->id }}"
                    data-credit-or-debit="{{ $type->credit_or_debit }}"
                    data-user-id="{{ $type->user_id }}"
                    >
                    {{ $type->title }}
                </option>
                @endforeach
            </select>

            <div class="text-danger error-message" id="typeError"></div>
            <br>
            <label for="payment_method_id">Payment Method</label>
            <select name="payment_method_id" id="payment_method_id" class="form-control">
                <option value="">-- Select Payment Method --</option>
                @foreach ($paymentMethods as $method)
                <option value="{{ $method->id }}">{{ $method->title }}</option>
                @endforeach
            </select>
            <div class="text-danger error-message" id="paymentMethodError"></div>

            <br>

            <div id="debitField">
                <label for="debit">Debit</label>
                <input type="number" name="debit" id="debit" class="form-control" style="background-color:rgba(255, 0, 0, 0.3)">
                <div class="text-danger error-message" id="debitError"></div>
                <br>
            </div>

            <div id="creditField">
                <label for="credit">Credit</label>
                <input type="number" name="credit" id="credit" class="form-control" style="background-color:rgba(0, 255, 0, 0.3);">
                <div class="text-danger error-message" id="creditError"></div>
                <br>
            </div>

            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control">
            <!-- <div class="text-danger error-message" id="descriptionError"></div> -->
            <br>

            <input type="hidden" name="id" value="{{ $userid }}">
            <button type="submit" class="btn btn-primary sm">Submit</button>
        </form>
    </div>
</div>
<script>
    const typeSelect = document.getElementById('type');
    const debitField = document.getElementById('debitField');
    const creditField = document.getElementById('creditField');
    const debitInput = document.getElementById('debit');
    const creditInput = document.getElementById('credit');
    const form = document.getElementById('entryForm');

    function toggleFields() {
        const selectedOption = typeSelect.options[typeSelect.selectedIndex];
        const type = selectedOption.getAttribute('data-credit-or-debit');

        if (type === 'debit') {
            debitField.style.display = 'block';
            creditField.style.display = 'none';
            creditInput.value = '';
        } else if (type === 'credit') {
            debitField.style.display = 'none';
            creditField.style.display = 'block';
            debitInput.value = '';
        } else {
            debitField.style.display = 'none';
            creditField.style.display = 'none';
            debitInput.value = '';
            creditInput.value = '';
        }
    }

    typeSelect.addEventListener('change', toggleFields);
    document.addEventListener('DOMContentLoaded', toggleFields);

    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        [debitInput, creditInput, typeSelect].forEach(el => el.classList.remove('error'));

        const selectedOption = typeSelect.options[typeSelect.selectedIndex];
        const type = selectedOption.getAttribute('data-credit-or-debit');
        const paymentMethodSelect = document.getElementById('payment_method_id');
        paymentMethodSelect.classList.remove('error');
        if (!paymentMethodSelect.value) {
            document.getElementById('paymentMethodError').textContent = "Please select a payment method.";
            paymentMethodSelect.classList.add('error');
            isValid = false;
        }

        if (!type) {
            document.getElementById('typeError').textContent = "Please select a type.";
            typeSelect.classList.add('error');
            isValid = false;
        }
        if (type === 'debit') {
            if (!debitInput.value || parseFloat(debitInput.value) <= 0) {
                document.getElementById('debitError').textContent = "Enter a valid debit amount.";
                debitInput.classList.add('error');
                isValid = false;
            }
        }

        if (type === 'credit') {
            if (!creditInput.value || parseFloat(creditInput.value) <= 0) {
                document.getElementById('creditError').textContent = "Enter a valid credit amount.";
                creditInput.classList.add('error');
                isValid = false;
            }
        }

        if (!isValid) e.preventDefault();
    });
    const userSelect = document.getElementById('user_id');

    function filterTypes() {
        const selectedUserId = userSelect.value;

        // Always show the "-- Select Type --" option
        Array.from(typeSelect.options).forEach(option => {
            if (option.value === "") {
                option.style.display = "block";
                return;
            }

            const optionUserId = option.getAttribute('data-user-id');

            if (!selectedUserId || optionUserId === selectedUserId) {
                option.style.display = "block";
            } else {
                option.style.display = "none";
            }
        });

        // Reset the selected type if not matching
        typeSelect.value = "";
        toggleFields(); // Hide Debit/Credit fields when resetting
    }

    userSelect.addEventListener('change', filterTypes);
    document.addEventListener('DOMContentLoaded', filterTypes);
    document.addEventListener('DOMContentLoaded', function () {
        $('#user_id').select2({ placeholder: "Select User" });
        $('#type').select2({ placeholder: "Select Type" });
        $('#payment_method_id').select2({ placeholder: "Select Payment Method" });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection