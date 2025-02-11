@extends('layouts.operateur-dash')
@php($route = request()->route()->action['as'])
@section('content2')
    @livewireStyles
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <x-session key="success" :time="10000"></x-session>
                    </div>

                    <livewire:user-recompense :$service />
                </div>
            </div>
        </div>

    </div>
    @livewireScripts
    <!-- END MAIN CONTENT-->
@endsection
