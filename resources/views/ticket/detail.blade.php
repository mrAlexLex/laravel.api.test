@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a>Ticket #{{$ticket['id']}}</h2>
            </div>
            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <span class="me-3">{{$ticket['created_at']}}</span>
                                    <span class="badge rounded-pill bg-info">Создано</span>
                                </div>
                                <div>
                                    <span class="me-3">{{$ticket['updated_at']}}</span>
                                    <span class="badge rounded-pill bg-info">Обновлено</span>
                                </div>
                                <div class="d-flex">
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 text-muted" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-printer"></i> Print</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex mb-2">
                                            <div class="flex-lg-grow-1 ms-3">
                                                <h6 class="small mb-0">
                                                    UID
                                                </h6>
                                                <span class="small">
                                                    {{$ticket['uid']}}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex mb-2">
                                            <div class="flex-lg-grow-1 ms-3">
                                                <h6 class="small mb-0">
                                                    Subject
                                                </h6>
                                                <span class="small">
                                                    {{$ticket['subject']}}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2">User name</td>
                                    <td class="text-end">{{$ticket['user_name']}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">User email</td>
                                    <td class="text-end">{{$ticket['user_email']}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Message</td>
                                    @foreach($ticket['messages'] as $message)
                                    <td class="text-end">{{$message['content']}}</td>
                                    @endforeach
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
