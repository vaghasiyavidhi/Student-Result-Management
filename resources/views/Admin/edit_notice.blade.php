@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Notice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{URL('/admin/manage_notice')}}">Manage Notices</a></li>
              <li class="breadcrumb-item active">Edit Notice</li>
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
                <h3 class="card-title">Edit Notice Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/edit_notice/'.$notice->id)}}">
                @CSRF
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Notice Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Notice Title" name="title" value="{{ $notice->title }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Notice Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter ...">{{ $notice->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="issue_date">Issue Date</label>
                        <input type="date" class="form-control" id="issue_date" name="issue_date" value="{{ $notice->issue_date }}">
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ $notice->expiry_date }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="Active" {{ $notice->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $notice->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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