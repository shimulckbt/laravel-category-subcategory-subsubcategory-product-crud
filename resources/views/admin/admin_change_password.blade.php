@extends('admin.admin_master')

@section('main_content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">

   <!-- Main content -->
   <section class="content">

      <!-- Basic Forms -->
      <div class="box">
         <div class="box-header with-border">
            <h4 class="box-title">Change Password</h4>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <form method="post" action="{{route('admin.update.password')}}">
               @csrf
               <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                        <h5>Current Password <span class="text-danger">*</span></h5>
                        <div class="controls">
                           <input type="password" id="oldpassword" name="oldpassword" class="form-control" required>
                           <div class="help-block"></div>
                        </div>
                        <div class="form-control-feedback">
                        </div>
                     </div>

                     <div class="form-group">
                        <h5>New Password <span class="text-danger">*</span></h5>
                        <div class="controls">
                           <input type="password" id="password" name="password" class="form-control" required>
                           <div class="help-block"></div>
                        </div>
                        <div class="form-control-feedback">
                        </div>
                     </div>

                     <div class="form-group">
                        <h5>Confirm Password <span class="text-danger">*</span></h5>
                        <div class="controls">
                           <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                           <div class="help-block"></div>
                        </div>
                        <div class="form-control-feedback">
                        </div>
                     </div>
                  </div>

               </div>
               <div class=" text-xs-right">
                  <input type="submit" class="btn btn-rounded btn-info" value="Update">
               </div>
            </form>
            <!-- /.col -->
            <!-- /.row -->
         </div>
         <!-- /.box-body -->
      </div>
      <!-- /.box -->

   </section>
   <!-- /.content -->
</div>

@endsection