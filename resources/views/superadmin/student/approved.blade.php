@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Approved Students</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
            <th>Name</th>
                <th>Email</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
               
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">No approved students yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection