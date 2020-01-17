@extends('layouts.backend.app')
@section('title','Category')
@push('css')
<link href="{{asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/backend/css/sweetalert2.min.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="container-fluid">
            <div class="block-header">
                
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Pendind Posts
                                <span class="badge bg-red">{{$posts->count()}}</span>
                            </h2>
                         
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th> <i class="material-icons">visibility</i> </th>
                                            <th>In Approved</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($posts as $key=>$post)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{str_limit( $post->title,'15')}}</td>
                                            <td>{{$post->user->name}}</td>
                                            <td>{{$post->view_count}}</td>
                                            <td>
                                                @if($post->is_approved == true)
                                                <span class="badge bg-blue">Approved</span>
                                                    @else
                                                    <span class="badge bg-pink">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                            @if($post->status == true)
                                                <span class="badge bg-blue">Published</span>
                                                    @else
                                                    <span class="badge bg-pink">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{$post->created_at}}</td>
                                            <td>{{$post->updated_at}}</td>
                                            <td>
                                            @if($post->is_approved == false)
               <button type="button" class="btn btn-success pull-right" onclick="approvepost({{ $post->id}})"><i class="material-icons">done</i> 
               <span>Approve</span> </button>
               
               @endif
                  <form id="approve-form-{{$post->id}}" action="{{route('admin.post.approve',$post->id)}}" method="POST" style="display:none" ></style>>
                                            @csrf
                                            @method('PUT')
                                        </form> 
                                        </td>
                                            
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
  
            
@endsection
@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>

    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/js/sweetalert2.all.min.js')}}"></script>

    <!-- Custom Js -->
    
    <script src="{{asset('public/assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script type="text/javascript">
     function approvepost(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure ,you want to approve it?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
               
                event.preventDefault();
                document.getElementById('approve-form-'+id).submit();
               
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })
    }
    </script>
@endpush