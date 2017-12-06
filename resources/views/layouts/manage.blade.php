@extends('layouts/main')

@section('content')
    <div class="container">
        <section>
            <div class="row">

                @include('manage.includes.manage-nav')

                <div class="col-md-9 col-sm-8 col-md-push-0">

                    @yield('table-items')

                </div>
            </div>
        </section>

        <div class="modal fade" id="openModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">@yield('name-of-open-modal')</h4>

                    </div>
                    <div class="modal-body">

                        @yield('body-of-open-modal')

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">@yield('name-of-add-modal')</h4>

                    </div>
                    <div class="modal-body">

                        @yield('body-of-add-modal')

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">@yield('name-of-edit-modal')</h4>    {{-- Название модального изменения --}}

                    </div>
                    <div class="modal-body">

                        @yield('body-of-edit-modal')

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection