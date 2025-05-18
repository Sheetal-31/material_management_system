@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Add New Transaction</h1>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back to List</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="material_id" class="form-label">Material</label>
                <select class="form-select @error('material_id') is-invalid @enderror" id="material_id" name="material_id" required>
                    <option value="">Select Material</option>
                </select>
                @error('material_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="transaction_date" class="form-label">Date</label>
                <input type="date" class="form-control @error('transaction_date') is-invalid @enderror" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                @error('transaction_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity (use negative values for outward)</label>
                <input type="number" step="0.01" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Transaction</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Function to load materials based on selected category
    function loadMaterials(categoryId) {
        if (!categoryId) {
            $('#material_id').html('<option value="">Select Material</option>');
            return;
        }

        $.get(`/api/categories/${categoryId}/materials`, function(materials) {
            let options = '<option value="">Select Material</option>';
            materials.forEach(function(material) {
                options += `<option value="${material.id}">${material.name}</option>`;
            });
            $('#material_id').html(options);
        });
    }

    // Load materials when category changes
    $('#category_id').change(function() {
        loadMaterials($(this).val());
    });

    // Load materials for initial category selection
    if ($('#category_id').val()) {
        loadMaterials($('#category_id').val());
    }
});
</script>
@endsection 