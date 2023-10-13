@extends('dashboard.layouts.layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="timeline">
                @foreach ($datas as $data)
                <div>
                    <i class="fas fa-history"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> {{ date_format(date_create($data->created_at), 'd M Y H:i:s') }} </span>
                        <h3 class="timeline-header"><b>{{ $data->name_user }}</b></h3>

                        <div class="timeline-body">
                            {{ $data->name }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
