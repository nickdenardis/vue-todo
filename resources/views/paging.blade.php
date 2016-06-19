@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Paging and searching information</div>

            <div class="panel-body">
                <paging :list="sites"></paging>
            </div>
        </div>
    </div>
</div>
@endsection
