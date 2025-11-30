@extends('layouts')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Mes demandes de contributeur</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Motif</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($demandes as $d)
                <tr>
                    <td>{{ $d->motif }}</td>

                    <td>
                        @if($d->status == 'pending')
                            <span class="badge bg-warning">En attente</span>
                        @elseif($d->status == 'approved')
                            <span class="badge bg-success">Approuvée</span>
                        @else
                            <span class="badge bg-danger">Rejetée</span>
                        @endif
                    </td>

                    <td>{{ $d->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Aucune demande</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $demandes->links() }}

    </div>

</div>

@endsection
