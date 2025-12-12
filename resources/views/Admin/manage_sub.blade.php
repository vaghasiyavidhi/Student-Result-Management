@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Subjects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Subjects</li>
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
                <h3 class="card-title">View Subjects</h3>
              </div>
              <!-- /.card-header -->
              <form action="{{URL('/admin/manage_sub')}}">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">Id</th>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Assign Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $sub)
                                <tr>
                                    <td>{{ $sub->id }}</td>
                                    <td>{{ $sub->sub_code }}</td>
                                    <td>{{ $sub->name }}</td>
                                    <td>{{ $sub->class_name }} - {{ $sub->section }}</td>
                                    <td>
                                        <a href="{{URL('/admin/edit_sub/'.$sub->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{URL('/admin/delete_sub/'.$sub->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subject?');">Delete</a>
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