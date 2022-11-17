<script src="https://maps.googleapis.com/maps/api/js?&libraries=places&key=AIzaSyBw5GDEZBg_Tpiza5HWY0q2FUHvUK0QzKQ"></script>
<?php include("js.php") ?>
<script>
    $("#formValidate").validate({
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100,
        max: new Date(),
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        format: 'dd-mm-yyyy',
        closeOnSelect: true // Close upon selecting a date,
    });

    $("#map").click(function(e) {
        var lat = $("#lat").val();
        var lng = $("#long").val();
        elos_ganteng(lat, lng);
        $('#modal_map').openModal();
    });
</script>
<script type="text/javascript">
    function initialize() {
        //add map, the type of map
        var mapOptions = {
            zoom: 11,
            animation: google.maps.Animation.DROP,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: new google.maps.LatLng(-7.6760857, 110.4224622)
        };
        var mapElement = document.getElementById('map_canvas');
        var map = new google.maps.Map(mapElement, mapOptions);

        var locations = [
            <?php
            foreach ($data as $row) { ?>['<div id="iw-container">' +
                    '<div class="iw-title">' + '<?php echo strtoupper($row->nama_bencana) ?>' + ' DI DUSUN ' + '<?php echo strtoupper($row->nama_dusun) ?>' + ',RT ' + '<?php echo strtoupper($row->rt) ?>' + ', RW ' + '<?php echo strtoupper($row->rw) ?>' + ',DESA ' + '<?php echo strtoupper($row->nama_kelurahan) ?>' + '</div>' +
                    '<div class="iw-title">' + ' ID KEJADIAN ' + '<?php echo strtoupper($row->idtbllaporan) ?>' + '</div>' +
                    '<div class="iw-content">' +

                    '<div class="iw-subTitle">Tanggal & Waktu Kejadian</div>' +
                    '<p><?php echo strtoupper($row->tgl_kejadian) ?></p>' +

                    '<div class="iw-subTitle">Status Penanganan</div>' +
                    '<p><?php echo strtoupper($row->status) ?></p>' +


                    '<div class="iw-subTitle">Rangkuman Dampak & korban</div>' +

                    '<p><?php echo strtoupper($row->dampak) ?>. <?php echo strtoupper($row->rangkuman_korban) ?></p>' +
                    '<div class="iw-subTitle">Gambar & Video</div>' +
                    <?php $data_detail = $this->db->get_where("tbllaporan_galery", array("idtbllaporan" => $row->idtbllaporan))->result(); ?> <?php foreach ($data_detail as $rows) { ?> <?php if ($rows->type == '1') { ?> '<img src="<?php echo base_url() . 'uploads/kejadian/' . $rows->picture_name ?>" data-nama="<?php echo strtoupper($row->nama_bencana) ?>' + ' DI DUSUN ' + '<?php echo strtoupper($row->nama_dusun) ?>" class="img" height="120" width="100%"><br />' +
                        <?php } else { ?> '<video width="100%" height="100%" src="<?php echo base_url() . 'uploads/kejadian/' . $rows->picture_name ?>" class="video" data-nama="<?php echo strtoupper($row->nama_bencana) ?>' + ' DI DUSUN ' + '<?php echo strtoupper($row->nama_dusun) ?>" controls><source src="<?php echo base_url() . 'uploads/kejadian/' . $row->idtbllaporan . '/' . $rows->picture_name ?>" type="video/mp4">Your browser does not support HTML5 video </video>' +
                        <?php } ?> <?php } ?> '</div>' +
                    '<div class="iw-bottom-gradient"></div>' +
                    '</div>',
                    <?php echo $row->latitude ?>, <?php echo $row->longitude ?>, '<?php echo base_url() . 'uploads/bencana/' . $row->icon ?>'],
            <?php } ?>
        ];
        //declare marker call it 'i'
        var marker, i;
        //declare infowindow
        var infowindow = new google.maps.InfoWindow();
        //add marker to each locations
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: locations[i][3]
            });
            //click function to marker, pops up infowindow
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

        google.maps.event.addListener(infowindow, 'domready', function() {

            // Reference to the DIV that wraps the bottom of infowindow
            var iwOuter = $('.gm-style-iw');

            /* Since this div is in a position prior to .gm-div style-iw.
             * We use jQuery and create a iwBackground variable,
             * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
             */
            var iwBackground = iwOuter.prev();

            // Removes background shadow DIV
            iwBackground.children(':nth-child(2)').css({
                'display': 'none'
            });

            // Removes white background DIV
            iwBackground.children(':nth-child(4)').css({
                'display': 'none'
            });

            if ($(window).width() <= 500) {
                iwOuter.parent().parent().css({
                    left: '106px'
                });
            } else {
                // Moves the infowindow 163px to the right.
                iwOuter.parent().parent().css({
                    left: '163px'
                });
            }
            // Moves the shadow of the arrow 76px to the left margin.
            iwBackground.children(':nth-child(1)').attr('style', function(i, s) {
                return s + 'left: 76px !important;'
            });

            // Moves the arrow 76px to the left margin.
            iwBackground.children(':nth-child(3)').attr('style', function(i, s) {
                return s + 'left: 76px !important;'
            });

            // Changes the desired tail shadow color.
            iwBackground.children(':nth-child(3)').find('div').children().css({
                'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px',
                'z-index': '1'
            });

            // Reference to the div that groups the close button elements.
            var iwCloseBtn = iwOuter.next();

            // Apply the desired effect to the close button
            iwCloseBtn.css({
                opacity: '1',
                right: '38px',
                top: '3px',
                border: '7px solid #48b5e9',
                'border-radius': '13px',
                'box-shadow': '0 0 5px #3990B9'
            });

            // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
            if ($('.iw-content').height() < 140) {
                $('.iw-bottom-gradient').css({
                    display: 'none'
                });
            }

            // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
            iwCloseBtn.mouseout(function() {
                $(this).css({
                    opacity: '1'
                });
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script>
    $(document).on('click', '.img,.video', function(e) {
        var foto = $(this).attr('src');
        var nama = $(this).attr('data-nama');
        var myClass = $(this).attr("class");
        // console.log(link+"_"+nama);
        if (myClass == 'img') {
            $("#title_foto").html("Foto Kejadian " + nama);
            $("#data_icon").attr("src", foto);
            $('#modal5').openModal();
        } else {
            // $("#title_video").html("Foto Kejadian "+nama);
            // $("#data_video").attr("src", foto);
            // var video = $('#vid').get()[0];
            // video.addEventListener('loadeddata', function() {
            //     video.play();
            // });
            // $('#modal_video').openModal();
        }
    });
</script>