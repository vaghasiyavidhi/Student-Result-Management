@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Notices</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Notices</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Notices</h3>
              </div>
              <!-- /.card-header -->
              <form action="{{URL('/admin/manage_notice')}}">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th style="width: 10px">Id</th>
                            <th>Notice Title</th>
                            <th>Description</th>
                            <th>Date Of Issue</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $notice)
                                <tr>
                                    <td>{{$notice->id}}</td>
                                    <td>{{$notice->title}}</td>
                                    <td>{{$notice->description}}</td>
                                    <td>{{$notice->issue_date}}</td>
                                    <td>{{$notice->expiry_date}}</td>
                                    <td>
                                        @if($notice->status == 'Active' || $notice->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{URL('/admin/edit_notice/'.$notice->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{URL('/admin/delete_notice/'.$notice->id)}}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </form>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                {{ $data->links() }}
              </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@include('admin/footer')
