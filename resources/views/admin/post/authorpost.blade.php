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
                                All Posts
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
                                            
                                            <td>
                                            @if($post->is_approved == true)
               <button type="button" class="btn btn-danger pull-right" onclick="unapprovepost({{ $post->id}})"><i class="material-icons">done</i> 
               <span>Unapprove</span> </button>
               
              
                  <form id="unapprove-form-{{$post->id}}" action="{{route('admin.post.unapprove',$post->id)}}" method="POST" style="display:none" ></style>>
                                            @csrf
                                            @method('PUT')
                                        </form> 
                                        @else
                                        <button type="button" class="btn btn-success pull-right" onclick="approvepost({{ $post->id}})"><i class="material-icons">done</i> 
               <span>Approve</span> </button>
               <form id="approve-form-{{$post->id}}" action="{{route('admin.post.approve',$post->id)}}" method="POST" style="display:none" ></style>>
                                            @csrf
                                            @method('PUT')
                                        </form> 
               @endif
                                        </td>
                                            <td>
                                            <a href="{{route('admin.post.show',$post->id)}}"  class="btn btn-primary  waves-effect">
                                                <i class="material-icons">visibility</i> 
                                            </a>
                                            <a href="{{route('admin.post.edit',$post->id)}}"  class="btn btn-primary  waves-effect">
                                                <i class="material-icons">edit</i> 
                                            </a>
                                           
                                            <button  type="submit" class="btn btn-danger  waves-effect" onclick="deletepost({{ $post->id}})">
                                            
                                            <i class="material-icons">delete</i>
                                        </button>  
                                        <form id="delete-form-{{$post->id}}" action="{{route('admin.post.destroy',$post->id)}}" method="POST" style="display:none" ></style>>
                                            @csrf
                                            @method('DELETE')
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
     function deletepost(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure ,you want to delete it?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
               
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
               
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
    function unapprovepost(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure ,you want to unapprove it?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, unapprove it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
               
                event.preventDefault();
                document.getElementById('unapprove-form-'+id).submit();
               
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