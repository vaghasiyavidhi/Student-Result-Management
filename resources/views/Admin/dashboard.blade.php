@include('admin/header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @if (session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><i class="fa-solid fa-users"></i></h3>
                <p style="font-size:18px;">{{ $reg_user }}</p>
              </div>
              <a href="#" class="small-box-footer">Registered Users <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><i class="fa-solid fa-list"></i></h3>
                <p style="font-size:18px;">{{ $total_subjects }}</p>
              </div>
              <a href="{{URL('/admin/manage_sub')}}" class="small-box-footer">Subjects List <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><i class="fa-solid fa-building-columns"></i></h3>
                <p style="font-size:18px;">{{ $total_classes }}</p>
              </div>
              <a href="{{URL('/admin/manage_class')}}" class="small-box-footer">Total Classes List <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><i class="fa-solid fa-square-poll-horizontal"></i></h3>
                <p style="font-size:18px;">{{ $total_results }}</p>
              </div>
              <a href="{{URL('/admin/manage_res')}}" class="small-box-footer">Results Declared <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content mt-5">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Declared Results</h3>
              </div>
              <!-- /.card-header -->
              <form>
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
                            @foreach($dec_results as $res)
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
            </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('admin/footer')

<script>
    setTimeout(function() {
        var alert = document.getElementById('success-alert');
        if(alert) {
            alert.style.display = 'none';
        }
    }, 3000);
</script>
