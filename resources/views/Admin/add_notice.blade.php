@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Notice Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Notice</li>
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
                <h3 class="card-title">Add Notice Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/insert_notice')}}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" name="id">
                <div class="card-body">
                  <div class="form-group">
                    <label for="noticeTitle">Notice Title</label>
                    <input type="text" class="form-control" id="noticeTitle" placeholder="Enter Notice Title" name="title">
                  </div>
                  <div class="form-group">
                    <label for="noticeDescription">Description</label>
                    <textarea class="form-control" id="noticeDescription" rows="3" placeholder="Enter Description" name="description"></textarea>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="issueDate">Date Of Issue</label>
                        <input type="date" class="form-control" id="issueDate" name="issue_date">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="expiryDate">Expiry Date</label>
                        <input type="date" class="form-control" id="expiryDate" name="expiry_date">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
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