@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subject Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Subject</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Subject Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/insert_sub')}}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" name="id">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject Code</label>
                                <input type="text" class="form-control" id="exampleInputEmail" placeholder="Subject Code" name="sub_code">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Subject Name" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Assign Class</label>
                                <select class="form-control" name="assign_class">
                                <option value="" disabled selected>Choose Class</option>
                                @foreach($subject as $sub)
                                    <option value="{{$sub->id}}">{{ $sub->name }} - {{ $sub-> section}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="save">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

        </div>
 
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@include('admin/footer')