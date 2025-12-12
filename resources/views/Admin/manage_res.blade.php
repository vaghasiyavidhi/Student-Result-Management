@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Results</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Results</li>
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
                <h3 class="card-title">View Results</h3>
              </div>
              <!-- /.card-header -->
              <form action="{{URL('/admin/manage_res')}}">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">Id</th>
                                <th>Student Name</th>
                                <th>Roll No</th>
                                <th>Class / Section</th>
                                <th>Declared Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $res)
                                <tr>
                                    <td>{{ $res->id }}</td>
                                    <td>{{ $res->stud_name }}</td>
                                    <td>{{ $res->roll_no }}</td>
                                    <td>{{ $res->class_name }}</td>
                                    <td>{{ $res->created_at }}</td>
                                <td>
                                    @php
                                      $status = $res->status ?? 'Declared';
                                      $status = ucfirst(strtolower($status));
                                      $badgeClass = match ($status) {
                                        'Declared' => 'badge-success',
                                        'Pending' => 'badge-warning',
                                        'Cancelled' => 'badge-danger',
                                        default => 'badge-secondary',
                                      };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                </td>
                                    <td style="min-width: 110px;">
                                        <div class="d-flex">
                                            <a href="{{URL('/admin/edit_res/'.$res->id)}}" class="btn btn-primary btn-sm mr-1">Edit</a>
                                            <a href="{{URL('/admin/delete_res/'.$res->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this result?');">Delete</a>
                                        </div>
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
