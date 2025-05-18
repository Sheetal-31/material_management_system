@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Materials</h1>
    <a href="{{ route('materials.create') }}" class="btn btn-primary">Add New Material</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Opening Balance</th>
                    <th>Current Balance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materials as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->category->name }}</td>
                    <td>{{ $material->name }}</td>
                    <td>{{ number_format($material->opening_balance, 2) }}</td>
                    <td>{{ number_format($material->current_balance, 2) }}</td>
                    <td>
                        <a href="{{ route('materials.edit', $material) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('materials.destroy', $material) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 