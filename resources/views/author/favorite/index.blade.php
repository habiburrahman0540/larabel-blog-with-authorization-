@extends('layouts.backend.app')
@section('title','Favorite')
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
                                All Favorite post
                                <span class="badge bg-red">{{$favorites->count()}}</span>
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
                                           <th><i class="material-icons">favorite</i></th>
                                           <th><i class="material-icons">comment</i></th>
                                           <th><i class="material-icons">visibility</i></th>
                                            <th>Action</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($favorites as $key=>$favorite)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{str_limit($favorite->title,'20')}}</td>
                                            <td>{{$favorite->user->name}}</td>
                                            <td>{{$favorite->favorite_to_user->count()}}</td>
                                            <td></td>
                                            <td>{{$favorite->view_count}}</td>
                                            <td>
                                            <a href="{{route('admin.post.show',$favorite->id)}}"  class="btn btn-primary  waves-effect">
                                                <i class="material-icons">visibility</i> 
                                            </a>
                                             <button  type="submit" class="btn btn-danger  waves-effect" onclick="removepost({{$favorite->id}})">
                                            
                                            <i class="material-icons">delete</i>
                                        </button>  
                                        <form id="remove-form-{{$favorite->id}}" action="{{route('post.favorite',$favorite->id)}}" method="POST" style="display:none" ></style>>
                                            @csrf
                                           
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
     function removepost(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure ,you want to remove it?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
               
                event.preventDefault();
                document.getElementById('remove-form-'+id).submit();
               
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