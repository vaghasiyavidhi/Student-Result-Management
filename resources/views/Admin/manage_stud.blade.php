@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Students</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Students</li>
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
                <h3 class="card-title">View Students</h3>
              </div>
              <!-- /.card-header -->
              <form action="{{URL('/admin/manage_stud')}}">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th style="width: 10px">Id</th>
                            <th>Student Name</th>
                            <th>Roll No</th>
                            <th>Class / Section</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Reg Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $stud)
                                <tr>
                                    <td>{{ $stud->id }}</td>
                                    <td>{{ $stud->name }}</td>
                                    <td>{{ $stud->roll_no }}</td>
                                    <td>{{ $stud->classInfo->full_name }}</td>
                                    <td>{{ $stud->email }}</td>
                                    <td>{{ $stud->phone }}</td>
                                    <td>{{ $stud->DOB }}</td>
                                    <td>{{ $stud->gender }}</td>
                                    <td>{{ $stud->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{URL('/admin/edit_stud/'.$stud->id)}}" class="btn btn-primary btn-sm mr-1">Edit</a>
                                            <a href="{{URL('/admin/delete_stud/'.$stud->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
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
