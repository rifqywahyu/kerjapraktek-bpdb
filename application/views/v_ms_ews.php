<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Master ews
	Version: 1
	Author: Elos
================================================================================ -->

<head>
    <?php include('inc/css.php') ?>
  <link href="<?php echo base_url()?>assets/js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>

<body id="layouts-horizontal">
    <!-- Start Page Loading -->
    <?php include("inc/header.php") ?>
    <!-- END HEADER -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">
            <!-- START LEFT SIDEBAR NAV-->
            <?php include("inc/sidebar.php") ?>
            <!-- END LEFT SIDEBAR NAV-->
            <!-- START CONTENT -->
            <section id="content">
              <!--chart dashboard start-->
              <div id="padding" style="padding-top:12px;">
                    <?php include("inc/info.php") ?>
              </div>
              <!--chart dashboard end-->
                <!--start container-->
                <div class="container">
                  <div class="row">
                    <div id="table-datatables">
                      <h4 class="header" style="text-align : center; margin-top:0px;">Master ews</h4>
                      <div class="row">
                        <div class="col s12 m12 l12">
                          <table id="example" class="table table-condensed table-hover datatable" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th style="width: 10%;">Nama</th>
                                  <th style="width: 7%;">Alamat</th>
                                  <!-- <th style="width: 7%;">Koordinat</th> -->
                                  <th style="width: 7%;">Kelurahan</th>
                                  <th style="width: 7%;">No. Tlpn</th>
                                  <th style="width: 7%;">Deskripsi</th>
                                  <th style="width: 7%;">Status</th>
                                  <th style="width: 7%;">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>

                          </tbody>
                      </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <a class="waves-effect waves-light btn modal-trigger light-blue" href="#modal1">Modal</a>
                    <a class="waves-effect waves-light btn light-blue" id="a">Modal 2</a>
                    -->
                    <div id="modal1" class="modal">
                      <div class="modal-header">
                          <h4 class="modal-title nama-delete" style="text-align:center;">Konfirmasi Hapus</h4>
                      </div>
                      <hr />
                      <div class="modal-content">
                        <p>Apakah Anda Yakin ?</p>
                      </div>
                      <div class="modal-footer">
                        <a class="btn waves-effect waves-light blue modal-close" type="submit" style="margin-left:5px;">Batal <i class="mdi-content-clear right"></i></a>
                        <a class="btn waves-effect waves-light " type="submit" id="button-modal-delete">Hapus <i class="mdi-content-send right"></i></a>
                      </div>
                    </div>

                    <div id="modal5" class="modal bottom-sheet" style="max-height:75%">
                      <div class="modal-content">
                        <div class="row">
                          <div class="col s12 m8 l8">
                            <h4 id="modal_title">Modal Header </h4>
                          </div>
                          <div class="col s12 m4 l4">
                            <a class="right btn waves-effect waves-light blue modal-close" type="submit" style="margin-left:5px;">Tutup <i class="mdi-content-clear right"></i></a>
                          </div>
                        </div>
                        <ul class="collection">
                          <li class="collection-item avatar">
                            <div id="mapCanvas_e">

                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>

                    <div id="modal_icon" class="modal">
                      <div class="modal-header">
                          <h4 class="modal-title" id="title_foto" style="text-align:center;"></h4>
                      </div>
                      <hr />
                      <div class="modal-content">
                        <div class="card-image waves-effect waves-block waves-light" style="text-align:center;">
                          <img class="activator" id="data_icon" src="images/office.jpg" alt="Icon">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <a class="btn waves-effect waves-light blue modal-close" type="submit" style="margin-left:5px;">Tutup <i class="mdi-content-clear right"></i></a>
                      </div>
                    </div>
                    <!--card widgets end-->
                    <!-- Floating Action Button -->
                    <?php if($akses['create'] == '1'){ ?>
                    <div class="fixed-action-btn tooltipped" style="bottom: 50px; right: 19px;" data-position="left" data-delay="50" data-tooltip="Tambah">
                        <a class="btn-floating btn-large" href="<?php echo base_url()?>ms_ews/tambah ">
                          <i class="mdi-content-add"></i>
                        </a>
                    </div>
                  <?php } ?>
                    <!-- Floating Action Button -->

                </div>
                <!--end container-->
            </section>
            <!-- END CONTENT -->

            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <!-- START RIGHT SIDEBAR NAV-->
            <?php include("inc/right_slidebar.php") ?>
            <!-- LEFT RIGHT SIDEBAR NAV-->

        </div>
        <!-- END WRAPPER -->

    </div>
    <!-- END MAIN -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <?php include("inc/footer.php") ?>
    <!-- END FOOTER -->


    <!-- ================================================
    Scripts
    ================================================ -->

    <?php include("inc/js.php") ?>
    <style>
      #mapCanvas_e {
        width: 100%;
        height: 400px;
        float: left;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?&libraries=places&key=AIzaSyBw5GDEZBg_Tpiza5HWY0q2FUHvUK0QzKQ"></script>
    <script>

      var map;
      function elos_ganteng(latitude, longitude) {
        //console.log(latitude+'_'+longitude);
        if(latitude == ''){
          latitude = '-7.724537'; longitude = '110.3499186';
        }

          console.log(latitude+'_'+longitude);
          var myLatlng = new google.maps.LatLng(latitude, longitude);

          var myOptions = {
              zoom: 13,
              center: myLatlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          map = new google.maps.Map(document.getElementById("mapCanvas_e"), myOptions);

          var marker = new google.maps.Marker({
              draggable: false,
              position: myLatlng,
              map: map,
              title: "Your location"
          });

      }
      // google.maps.event.addDomListener(window, "load", initialize());
    </script>
    <!-- data-tables -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/data-tables/data-tables-script.js"></script> -->
    <script>
    // $('.modal').modal();

    $("#a").click(function(a){
        $('#modal1').openModal();
    });

    $(".link_delete").click(function(a){
        a.preventDefault();
        $('#modal1').openModal();
    });

    $(document).on('click', '.link_delete', function (e) {
         var link = $(this).attr('href');
         var nama = $(this).attr('data-nama');
         $(".nama-delete").text("Konfirmasi Delete Data "+nama);
         $("#button-modal-delete").attr('href',link);
         $('#modal1').openModal();
        e.preventDefault();
     });

     $(document).on('click', '.link_foto', function (e) {
          var foto = $(this).attr('data-image');
          var nama = $(this).attr('data-nama');
          // console.log(link+"_"+nama);
          $("#title_foto").html("Foto ews "+nama);
          $("#data_icon").attr("src", "<?php echo base_url()?>uploads/ews/"+foto);
          $('#modal_icon').openModal();
         e.preventDefault();
      });

    //  $(document).on('click', '.dropdown-button', function (e) {
    //       console.log($(this).attr("id"));
    //
    //       $("#")
    //       // var link = $(this).attr('href');
    //       // var nama = $(this).attr('data-nama');
    //       // $(".nama-delete").text("Konfirmasi Delete Data "+nama);
    //       // $("#button-modal-delete").attr('href',link);
    //       // $('#modal1').openModal();
    //      e.preventDefault();
    //   });


     $(document).on('click', '.link_map', function (e) {
          var longitude = $(this).attr('data-longitude');
          var latitude = $(this).attr('data-latitude');
          var nama = $(this).attr('data-nama');
          $("#modal_title").text("Koordinat ews : "+nama);
          elos_ganteng(latitude, longitude);
          // console.log(link+"_"+nama);
          // $("#data_icon").attr("src", "<?php echo base_url()?>uploads/ews/"+icon);
          $('#modal5').openModal();
         e.preventDefault();
      });


    $("#example").dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "scrollY": 252,
        searchDelay: 700,
        "scrollX": true,
        serverSide: true,
        ajax: {
           type: "POST",
           url: "<?php echo base_url()?>Ms_ews/get_ews",
           dataType: 'json',
            beforeSend:function()
            {
              // $("#modal-loading").modal('show');
              //  $('#modal1').modal('open');
            },

        },
        fnInitComplete: function(oSettings, json)
        {
        //  $("#modal-loading").modal('hide');$('body').removeClass('modal-open'); $('.modal-backdrop').remove();
        },
        fnDrawCallback: function( oSettings ) {
        // $("#modal-loading").modal('hide');$('body').removeClass('modal-open'); $('.modal-backdrop').remove();
        }
        });
    </script>
</body>


<!-- Mirrored from demo.geekslabs.com/materialize/v3.1/layout-horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Sep 2017 01:45:31 GMT -->
</html>
