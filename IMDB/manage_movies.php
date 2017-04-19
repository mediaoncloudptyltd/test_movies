
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MOVIES</title>

    <!-- Bootstrap -->
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="http://heena.mediaoncloud.com/Lacaban/admin/build/css/custom.min.css" rel="stylesheet">
  </head>
  
  <body>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Movies<small>Users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                        
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    </p>
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>duration</th>
                          <th>Genre</th>
                          <th>Actors</th>
                          <th>Writers</th>
                          <th>Directors</th>
                          <th>Description</th>
                          <th>Date</th>
                          <th>Top</th>
                          <th>Coming</th>
                        </tr>
                      </thead>
                      <tbody>
						  <?php $connection = mysqli_connect("localhost","c6heer","ccKcJ0!4","c6heer"); 
						  $sel ="select * from imdb_movies";
						  $query = mysqli_query($connection,$sel)or die(mysqli_error());
						  while($row = mysqli_fetch_array($query)){
						  
 ?>
 
                        <tr>
                          <td><?php echo $row['id']; ?></td>
                          <td><?php echo $row['title']; ?></td>
                          <td><?php echo $row['duration']; ?></td>
                          <td><?php echo $row['genre']; ?></td>
                          <td><?php echo $row['stars']; ?></td>
                          <td><?php echo $row['writer']; ?></td>
                          <td><?php echo $row['director']; ?></td>
                          <td><?php echo $row['description']; ?></td>
                          <td><?php echo $row['date']; ?></td>
                          <td><?php echo $row['top']; ?></td>
                          <td><?php echo $row['coming']; ?></td>
                         
                        </tr>
                        <?php } ?>
                        
                   
            
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
          
        </body>
   <!-- jQuery -->
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/jszip/dist/jszip.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="http://heena.mediaoncloud.com/Lacaban/admin/build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
  </body>
</html>
