</section>
      </div>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Powred by </b> Abdellah Oulahyane
        </div>
        <strong>Copyright © <script type="text/javascript">var d = new Date();document.write(d.getFullYear());</script> .</strong> All rights reserved.
      </footer>
    </div>

    <script src="<?=  assets('plugins/jQuery/jQuery-2.1.3.min.js');  ?>"  						type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" 								type="text/javascript"></script>
    <script src="<?=  assets('bootstrap/js/bootstrap.min.js');  ?>" 								type="text/javascript"></script>    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js" 				type="text/javascript"></script>
    <script src="<?=  assets('plugins/morris/morris.min.js');  ?>" 								type="text/javascript"></script>
    <script src="<?=  assets('plugins/sparkline/jquery.sparkline.min.js');  ?>" 					type="text/javascript"></script>
    <script src="<?=  assets('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');  ?>" 			type="text/javascript"></script>
    <script src="<?=  assets('plugins/jvectormap/jquery-jvectormap-world-mill-en.js');  ?>" 		type="text/javascript"></script>
    <script src="<?=  assets('plugins/knob/jquery.knob.js');  ?>" 								type="text/javascript"></script>
    <script src="<?=  assets('plugins/daterangepicker/daterangepicker.js');  ?>" 					type="text/javascript"></script>
    <script src="<?=  assets('plugins/datepicker/bootstrap-datepicker.js');  ?>" 					type="text/javascript"></script>
    <script src="<?=  assets('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');  ?>" type="text/javascript"></script>
    <script src="<?=  assets('plugins/iCheck/icheck.min.js');  ?>" 								type="text/javascript"></script>
    <script src="<?=  assets('plugins/slimScroll/jquery.slimscroll.min.js');  ?>" 				type="text/javascript"></script>
    <script src="<?=  assets('plugins/fastclick/fastclick.min.js');  ?>" 							type="text/javascript"></script>
    <script src="<?=  assets('dist/js/app.min.js');  ?>" 											type="text/javascript"></script>
    <script src="<?=  assets('dist/js/pages/dashboard.js');  ?>" 									type="text/javascript"></script>
    <script src="<?=  assets('dist/js/demo.js');  ?>" 											type="text/javascript"></script>
    <script src="<?=  assets('plugins/datatables/jquery.dataTables.js');  ?>" 					type="text/javascript"></script>
    <script src="<?=  assets('plugins/datatables/dataTables.bootstrap.js');  ?>" 					type="text/javascript"></script>
    <script src="<?=  assets('plugins/ckeditor/ckeditor.js');  ?>" 								type="text/javascript"></script>
    <script>
      var index=1;
      $('table.table').DataTable();
      change_layout("fixed");
      $.widget.bridge('uibutton', $.ui.button);
      function addNewFileUpload(){
          
         $('#addFileUpload').before('<input type="file" name="file'+index+'">');
         index++;
      }
      function resizeTables(){
        $('table').css('width','100%');
      }
    </script>
  </body>
</html>