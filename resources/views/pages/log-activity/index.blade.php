@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>{{ __('menu.activity_log') }}</h5>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('field.timestamp') }}</th>
                    <th>{{ __('field.user') }}</th>
                    <th>{{ __('field.action') }}</th>
                    <th>{{ __('field.module') }}</th>
                    <th>{{ __('field.ip') }}</th>
                    <th>{{ __('field.browser') }}</th>
                    <th>{{ __('field.os') }}</th>
                    <th style="width: 50px"></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>

                    <td>
                        {{ $item->user?->name ?? 'Guest' }}
                    </td>

                    <td>
                        <span class="badge 
            @if($item->action_type == 'store') bg-label-success
            @elseif($item->action_type == 'update') bg-label-warning
            @elseif($item->action_type == 'delete') bg-label-danger
            @else bg-label-primary
            @endif">
                            {{ ucfirst($item->action_type) }}
                        </span>
                    </td>

                    <td>
                        {{ class_basename($item->table_name) }}
                    </td>

                    <td>{{ $item->ip }}</td>

                    <td>{{ $item->browser_name }}</td>

                    <td>{{ $item->platform }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-body">
        {!! $items->links() !!}
    </div>
</div>
@endsection