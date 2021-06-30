<!-- The View Section [add items ]-->
<!-- Header -->
<section class="content-header"  >
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">New Offer</li>
  </ol>
  <hr style="height:1px;width:100%;background-color:# #ff0000;">
</section>
<!-- end of header--> 
<section class="container-fluid">
<!-- start of adding items view -->
  <div class="box box-info">
    <div class="box-header">
      <h1 class="box-title">Add Offer</h1>
    </div>
    <div class="box-body">
      <form class="form" method="post" enctype="multipart/form-data">
        <?php token(); ?>
        <div class="input-group">
          <div class="input-group-btn" >
            <button type="button" class="btn btn-danger"  style="width:115px;">Title</button>
          </div>
          <input type="text" name="title" class="form-control" placeholder="Title">
        </div>
        <br>
        <div class="input-group">
          <div class="input-group-btn" >
            <button type="button" class="btn btn-danger"  style="width:115px;">City</button>
          </div>
          <input type="text" name="city" class="form-control" placeholder="City">
        </div>
        <br>
        <div class="input-group">
          <div class="input-group-btn" >
            <button type="button" class="btn btn-danger"  style="width:115px;">Quarter</button>
          </div>
          <input type="text" name="quarter" class="form-control" placeholder="Quarter">
        </div>
        <br>
        <div class="input-group">
          <div class="input-group-btn" >
            <button type="button" class="btn btn-danger"  style="width:115px;">Price</button>
          </div>
          <input type="text" name="price" class="form-control" placeholder="Price">
        </div>
        <br>
        <div class="input-group">
          <div class="input-group-btn" >
            <button type="button" class="btn btn-danger"  style="width:115px;">Distance</button>
          </div>
          <input type="text" name="distance" class="form-control" placeholder="Distance
          ">
        </div>
        <br>
        <span class="btn btn-danger" style="margin-bottom: 5px;width:115px;"> Description</span>
        <textarea class="ckeditor name="description" form-control" id="ckeditor" placeholder="Description"></textarea>
        <br>

        <div class="form-group">
          <label for="upload" id="upload">Images</label>
          <input type="file" class="upload" name="file0"  />         
          <label class="btn btn-info btn-sm" id="addFileUpload" onclick="addNewFileUpload()">
            <i class="fa fa-plus"></i>
          </label>                      
          <p class="help-block">Add Images to define more your offer.</p>
        </div>
        <br>

        <div class="form-group">
          <input type="submit" name="newoffer" class="btn btn-success form-control fa fa-plus" value="Add New Offer">
        </div>

      </form>
    </div>
  </div>
</section>
<!-- end of View [add items ]-->