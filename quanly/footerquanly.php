 </div>
 <footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2020 Nguyễn Lê Trí Thức</strong>
</footer>

</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable();
  } );
</script>

<script>
    $(document).ready(function() {
            var nf = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
            $(".price").text(function(){
                    return nf.format($(this).html());
            });
    });
</script>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;
for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
    dropdownContent.style.display = "none";
    } else {
    dropdownContent.style.display = "block";
    }
  });
}
</script>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn-2");
var i;
for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
    dropdownContent.style.display = "none";
    } else {
    dropdownContent.style.display = "block";
    }
  });
}
</script>

      <script language="javascript">
            // Chức năng chọn hết
            document.getElementById("checkall").onclick = function () 
            {
                // Lấy danh sách checkbox
                var status = $('#checkall').is(':checked');
                console.log(status);
                if(status){
                  var checkboxes = document.getElementsByName('id[]');
                  // Lặp và thiết lập checked
                  for (var i = 0; i < checkboxes.length; i++){
                    checkboxes[i].checked = true;
                  }
                }else{
                  var checkboxes = document.getElementsByName('id[]');
                  // Lặp và thiết lập Uncheck
                  for (var i = 0; i < checkboxes.length; i++){
                    checkboxes[i].checked = false;
                }

              }
            };
          </script>





<script type="text/javascript" src="js1/jquery-3.3.1.min.js"></script>

<script src="Admin2/plugins/jQuery/jQuery-2.2.0.min.js"></script>

<!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
<script src="js/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>









<script src="bootstrap1/js/bootstrap.min.js"></script>

<script src="Admin2/plugins/sparkline/jquery.sparkline.min.js"></script>

<script src="Admin2/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="Admin2/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="Admin2/plugins/knob/jquery.knob.js"></script>

<script src="Admin2/plugins/daterangepicker/daterangepicker.js"></script>

<script src="Admin2/plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="Admin2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="Admin2/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script src="Admin2/plugins/fastclick/fastclick.js"></script>

<script src="Admin2/dist/js/app.min.js"></script>

<script src="Admin2/dist/js/demo.js"></script>



<script src="js/sb-admin-datatables.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="datatables/js/dataTables.bootstrap.min.js"></script>
<script language="Javascript" src="datatables/js/jquery.dataTables.js"></script>




<script type="text/javascript" src="jqueryvalidation/dist/bootstrapvalidator.min.js"></script>
<script  src="jstest/index.js"></script>

</body>
</html>

