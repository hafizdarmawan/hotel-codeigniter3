<link href="<?= base_url('assets/admin/') ?>/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/admin/') ?>/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark"><?= $page_title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                  <li class="breadcrumb-item active"><?= $page_title ?></li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <section class="content">
      <div class="container">
         <div class="col-md-12">
            <div class="card card-outline card-info shadow">
               <!-- <div class="card-header">
               </div> -->
               <h3 class="card-title"></h3>
               <div class="card-body">
                  <!-- <div class="box box-primary">
                        <div class="box-body no-padding"> -->
                  <form method="post">
                     <div class="form-group" style="padding:20px;">
                        <div class="row">
                           <div class="col-md-2">
                              <label>Tipe Kamar</label>
                           </div>
                           <div class="col-md-4">
                              <select name="id_tipe_kamar" class="form-control shadow" onchange="this.form.submit();">
                                 <option value="">Pilih Tipe Kamar</option>
                                 <?php foreach ($tipe_kamar as $rt) { ?>
                                    <option value="<?= $rt->id_tipe_kamar ?>" <?= ($rt->id_tipe_kamar == @$_POST['id_tipe_kamar']) ? 'selected="selected"' : ''; ?>><?= $rt->judul ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </form>
                  <!-- THE CALENDAR -->
                  <div id="calendar" class="shadow"></div>
               </div><!-- /.box-body -->
               <!-- </div>
               </div> -->
            </div>
         </div>
      </div>
   </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/') ?>/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script type="text/javascript">
   $(function() {

      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
         ele.each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
               title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
               zIndex: 1070,
               revert: true, // will cause the event to go back to its
               revertDuration: 0 //  original position after the drag
            });

         });
      }
      ini_events($('#external-events div.external-event'));

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
         m = date.getMonth(),
         y = date.getFullYear();
      $('#calendar').fullCalendar({
         header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
         },
         buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
         },
         //Random default events
         events: [
            <?php foreach ($calendar_result as $key   => $val) { ?> {
                  title: '<?= 'available'; ?> - <?= $val['available']; ?>',
                  start: '<?= $key; ?>',
                  backgroundColor: "<?= $setting->unoccupied ?>", //red
                  borderColor: "#FFF" //red
               },
               {
                  title: '<?= 'booked'; ?> - <?= $val['unavailable']; ?>',
                  start: '<?= $key; ?>',
                  backgroundColor: "red", //red
                  borderColor: "#FFF" //red
               },
            <?php } ?>
         ],
         editable: false,
         droppable: false, // this allows things to be dropped onto the calendar !!!
         drop: function(date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            copiedEventObject.borderColor = $(this).css("border-color");

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
               // if so, remove the element from the "Draggable Events" list
               $(this).remove();
            }

         }
      });

      /* ADDING EVENTS */
      var currColor = "#3c8dbc"; //Red by default
      //Color chooser button
      var colorChooser = $("#color-chooser-btn");
      $("#color-chooser > li > a").click(function(e) {
         e.preventDefault();
         //Save color
         currColor = $(this).css("color");
         //Add color effect to button
         $('#add-new-event').css({
            "background-color": currColor,
            "border-color": currColor
         });
      });
      $("#add-new-event").click(function(e) {
         e.preventDefault();
         //Get value and make sure it is not null
         var val = $("#new-event").val();
         if (val.length == 0) {
            return;
         }
         //Create events
         var event = $("<div />");
         event.css({
            "background-color": currColor,
            "border-color": currColor,
            "color": "#fff"
         }).addClass("external-event");
         event.html(val);
         $('#external-events').prepend(event);

         //Add draggable funtionality
         ini_events(event);

         //Remove event from text input
         $("#new-event").val("");
      });
   });
</script>