@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <alerts :list="alerts"></alerts>

            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.

                    <button class="btn btn-default" type="submit" @click="addAlert">Alert!</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
