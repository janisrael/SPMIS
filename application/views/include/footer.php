</main>

<style>
.fa-2x {
    padding: 11px !important;
}

.footer-right-items {
  margin-top:0px !important;
  margin-bottom: 0px !important;
}

.grey.darken-3 {
    background-color: #1f1f1f !important;
}
.greens{
  background-color: transparent !important;
}

</style>
  <footer class="page-footer greens darken-4">

    <div class="footer-copyright grey darken-3">
      <div class="container">
        <h6>Property Inventory System by <a class="orange-text text-lighten-3" href="<?php echo base_url('about/view'); ?>">PMO</a> <small>v2.0</small></h6>

      </div>
    </div>
  </footer>




  <!--  Scripts-->
  <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>


  <script>
    $(document).ready(function(){
      var pathArray = window.location.pathname.split( '/' );
      //alert(pathArray[2]);
      if ("home" == pathArray[2]) {
        document.title = "Home | SPPMO";
      }else if ("summaries" == pathArray[2]) {
        document.title = "Summaries | SPPMO";
      }else if ("user" == pathArray[2]) {
        document.title = "Login | SPPMO";
      }else if ("supply" == pathArray[2]) {
        document.title = "Property Section | SPPMO";
      }else if ("settings" == pathArray[2]) {
        document.title = "Config | SPPMO";
      }else if ("about" == pathArray[2]) {
        document.title = "About | SPPMO";
      }
      $('meta[name="description"]').attr("content", "Hi");
    });
  </script>

  <script src="<?php echo base_url('assets/js/materialize.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/init.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/liveSearch.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/dataTable.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/ajax.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/select2.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/edit.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/year-select.js');?>"></script>
    <script src="<?php echo base_url('assets/js/JsBarcode.all.min.js');?>"></script>
  <script type="text/javascript">
            $(document).ready(function(e) {
                $('.yearselect').yearselect();

                $('.yrselectdesc').yearselect({step: 1, order: 'desc'});
                $('.yrselectasc').yearselect({order: 'asc'});
            });
  </script>
  <script>


// window.onload = function() {
//      document.getElementById("username").focus();
// };

  $(document).ready(function(){



    getLastSeq();


      $("#load").hide();

      var pathArray = window.location.pathname.split( '/' );
      if((pathArray[1]=="sppmo" && ""==pathArray[2]) || "home" == pathArray[2]){
          let wrapper = document.getElementById('wrapper');
          let topLayer = wrapper.querySelector('.top');
          let handle = wrapper.querySelector('.handle');
          let skew = 0;
          let delta = 0;
          if(wrapper.className.indexOf('skewed') != -1){
            skew = 1000;
          }

          wrapper.addEventListener('mousemove', function(e){
            delta = (e.clientX - window.innerWidth / 2) * 0.5;

            handle.style.left = e.clientX + delta + 'px';

            topLayer.style.width= e.clientX + skew + delta + 'px';
          });

      }
      if ($(document).scrollTop() < 50 && ((pathArray[1]=="sppmo" && ""==pathArray[2]) || "home" == pathArray[2])) {
        $('nav').addClass('large');
        $('#btnUp').addClass('scale-out');
        
      } else {
        $('nav').removeClass('large');
        $('#btnUp').removeClass('scale-out');
      }
      $('.parallax').parallax();

      // inserted code for search

  
    // end
      var dataTable = $('#myTable').DataTable({
           
           "bLengthChange":false,
           "pageLength": 10,
           "processing":true,
           "serverSide":true,
           "order":[],
           "responsive": true,
           "ajax":{
                url:"<?php echo base_url().'supply/fetchData'; ?>",
                type:"POST",
           },
           "columnDefs":[
                {
                    "targets": [6],
                    "orderable": false
                }
           ],
           "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
             if ( aData[5].indexOf("FORWARDED")==22 )
             {
               $('td', nRow).css('background-color', '#d9edf7');
             }
             else if ( aData[5].indexOf("CANCELLED")==22 )
             {
               $('td', nRow).css('background-color', '#f2dede');
             }
           }
      });




      var dataTable2= $('#iarTable').DataTable({
        "bLengthChange":false,
        "pageLength": 20,
        "processing":true,
        "serverSide":true,
        "order":[],
        "responsive": true,
        "ajax":{
             url:"<?php echo base_url().'supply/fetchIar'; ?>",
             type:"POST",
        },
        "columnDefs":[
             {
                 "targets": [5],
                 "orderable": false
             }
        ],
      });


      $('.modal').modal();
      //default Property Head
      $('.head option[value="242"]').attr("selected",true);
      //$('select').material_select();
      $(".select2").select2();
      /*$( ".head" ).change(function() {
        $('.head').material_select('destroy');
        //alert($(".head").val( ));
        $('.head').material_select();
      });*/

      $(".select3").material_select();
      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 20, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true, // Close upon selecting a date,
        format: 'mmmm dd, yyyy',
        formatSubmit: 'yyyy-mm-dd'
      });
      $('.datepicker2').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 20, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true, // Close upon selecting a date,
        format: 'yyyy-mm-dd',
      });
      /*$('.collapsible').collapsible({
        accordion: false, // A setting that changes the collapsible behavior to expandable instead of the default accordion style
        onOpen: function(el) { alert('Open'); }, // Callback for Collapsible open
      });*/


    });



    $('.transmitForm').toggle();
    // $('.transmitSend').toggle();
    $('.propForm').toggle();
    // $('.propSend').toggle()



    var select = document.getElementById('newFuncCode');
          
    function myFunction(event) {
              var color = '';

              if (select.selectedIndex > 0) {
                color = select.item(select.selectedIndex).className;
              }
              
              document.getElementById('parNumberEC').value = color;
            }

    select.addEventListener('click', myFunction);

    myFunction();

    var selected = document.getElementById('newoffCode');
          
    function myFunctions(event) {
              var color = '';

              if (selected.selectedIndex > 0) {
                color = selected.item(selected.selectedIndex).className;
              }
              
              document.getElementById('parNumberOC').value = color;
            }

    selected.addEventListener('click', myFunctions);

    myFunctions();

    function genPropNumber() {
    var text = "";
    var i;
    var combi = document.getElementById('parNumberEC').value + "-" + document.getElementById('fundCodePn').value + "-" + document.getElementById('thisDate').value + "-" + document.getElementById('parNumberOC').value;
    var theInput =document.getElementById('qty2').value;
    
    for (i = 1; i <= theInput; i++) {
        text += "<input disabled='disabled' name='pNumber[]' value='" + combi + "-" + i + "'/>";
    }
    document.getElementById("propertyNumbers").innerHTML = text;
}


function handleEnter(e){
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
        // alert('You pressed enter! - plain javascript');
        $("#searchBtn").click();
    }
}


// function _search_by_PN(){
   // alert('you press enter! - from btn');
// }


  </script>

  </body>
</html>
