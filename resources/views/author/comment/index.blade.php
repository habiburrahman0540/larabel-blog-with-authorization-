@extends('layouts.backend.app')
@section('title','Comments')
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
                               All Comment
                            </h2>
                         
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Comments Info</th>
                                            <th>Post Info</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($posts as $key=>$post)
                                        @foreach($post->comments as $key=>$comment)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href=""><img class="media-object" src="{{Storage::disk('public')->url('profile/'.$comment->user->image)}}" alt="" height="64" width="64"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media heading">{{$comment->user->name}}
                                                        <small>on {{$comment->created_at->diffForHumans()}}</small>
                                                    </h4>
                                                    <p>{{$comment->comment}}</p>
                                                    <a target="/blank" href="{{route('post.details',$comment->post->slug.'#comments')}}">Reply</a>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                                <div class="media">
                                                <div class="media-right">
                                                    <a href="{{route('post.details',$comment->post->slug)}}"><img class="media-object" src="{{Storage::disk('public')->url('post/'.$comment->post->image)}}" alt="" height="64" width="64"></a>
                                                </div>
                                                <div class="media-body">
                                                <a href="{{route('post.details',$comment->post->slug)}}">
                                                        <h4 class="media-heading">{{str_limit($comment->post->title,'40') }}</h4>
                                                    </a>
                                                    <p>By <strong>{{$comment->post->user->name}}</strong> </p>
                                                </div>
                                            </div>
                                            
                                            </td>
                                           
                                            <td>
                                             <button  type="submit" class="btn btn-danger  waves-effect" onclick="removecomment({{$comment->id}})">
                                            
                                            <i class="material-icons">delete</i>
                                        </button>  
                                        <form id="remove-form-{{$comment->id}}" action="{{route('author.comment.destroy',$comment->id)}}" method="POST" style="display:none" ></style>>
                                            @csrf
                                            @method('DELETE')
                                           
                                        </form> 
                                        </td>  
                                    </tr>
                                       @endforeach
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
     function removecomment(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure ,you want to delete it?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
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