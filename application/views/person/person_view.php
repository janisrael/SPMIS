<!DOCTYPE html>
<html lang="en">
 <head>
      <title>SPPMO</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon-logo.ico'); ?>" />
    <link href="<?php echo base_url('assets/person/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/person/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/person/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/materialize.min.css'); ?>" rel="stylesheet" media="screen,projection"/>

    <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" media="screen,projection"/>




  <style>

input[type=search]:not(.browser-default) {
         margin: 0 0 0 0 !important;
         height: 2rem !important;
         text-indent: 10px !important;
}
    .pagination li a {
        font-size: 12px !important;
    }


      ul.hide-on-med-and-down>li a:hover {
        color: #ffffff !important;
    }
    .cusBtnSuccess{
        background-color: #1B5E20 !important;
    }

    .cusBtnSuccess:hover {
        background-color: #449d44 !important;
    }

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
    div#modal_form {
        padding-right: 0px !important;
    }

    /*action buttons*/
    .actionEdit{

    }

    .actionDelete{
/*        color: red !important;*/
    }

    .actionEdit, .actionDelete {
        padding: 0 7px !important;
    }

    .actionWrapper{
        text-align: center;
    }
    /*action buttons*/
    .row {
        margin-bottom: 0px !important;
    }
    .colorWhite {
        color: #ffffff !important;
    }

    .modal-body {
        position: relative;
        padding: 2% 5%;
    }

    .modal-header {
  /*      background-color: #35c53f !important;*/
    }

    .form-group {
        margin-bottom: 0px !important;
    }

     nav {
    background-color: #1B5E20 !important;
    }

    .modal .modal-footer {
        padding: 15px !important;
    }

 /*   nav ul a {
        padding: 25px 15px !important;
    }*/

    .btn i {
        font-size: 1rem !important;
    }

    .modal-dialog {
        width: 100% !important;
        margin: 0px !important;
        box-shadow: none !important;
        border: none !important;
    }

    .modal {
        width: 90% !important;
        max-height: 90% !important;
    }

    .modal-content {
        border: none !important;
        box-shadow: none !important;
    }

    .modal .modal-content {
        padding: 0px !important;
    }

    .cusInput>input {
   
    height: 1.5rem !important;
    border: 1px solid rgba(0, 0, 0, 0.19) !important;
    margin: 0 0 20px 0;
    padding: 6px !important;
    border-radius: 3px !important;
    width: 90% !important;
    }

    .cusInput>select {
    background-color: rgba(255,255,255,0.9) !important;
    border: 1px solid rgba(0, 0, 0, 0.19) !important;
    height:2.5rem !important;
    width: 90% !important;

    }

    .mdc-select__native-control {
    display: inline-block !important;
    }

    textarea.form-control {
        max-width: 100% !important;
    }

    .btn-primary {
    color: #fff !important;
    background-color: #337ab7 !important;
    border-color: #2e6da4 !important;
    }

    .btn-danger {
    color: #fff !important;
    background-color: #d9534f !important;
    border-color: #d43f3a !important;
    }

</style>
 </head>   

<body>
<header>
  <div class="navbar-fixed <?php if($this->router->class!="home" ) echo "navnorm"; ?>">
    <nav class="<?php if($this->router->class=="home") echo "large"; ?>" role="navigation">
      <div class="nav-wrapper container">
        <a style="height: 2em" id="logo-container" href="<?php echo base_url('home'); ?>" class="brand-logo">
          <img class='imglogo' style="height: 2em" src="<?php echo base_url('assets/images/logo/vsulogo.png'); ?>" alt="Visayas State University">
        </a>
        <ul class="right hide-on-med-and-down">
          <li>
              <a href="<?php echo base_url('home/'); ?>" data-toggle="tooltip" title="Home" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Home"><div class="fa fa-lg fa-home"></div></a>
          </li>

          <li>
              <a href="<?php echo base_url('summaries/enduser'); ?>" data-toggle="tooltip" title="Summary"  class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Summary"><div class="fa fa-clipboard"></div></a>
          </li>
          <?php if($this->session->userdata('sppmo')): ?>
          <li>
              <a href="<?php echo base_url('supply/view'); ?>" data-toggle="tooltip" title="Property Section" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Property Section">
                <div class="fa fa-lg fa-television">
                </div>
              </a>
          </li>

          <!-- personel section btn -->

          <li>
              <a href="<?php echo base_url('person/view'); ?>" data-toggle="tooltip" title="Personnel Section" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Personel Section">
                <div class="fa fa-lg fa-user">
                </div>
              </a>
          </li>

          <!-- personel section btn -->

          <?php endif; ?>
          <?php if(!$this->session->userdata('sppmo')): ?>
            <li><a href="<?php echo base_url('user/login'); ?>" data-toggle="tooltip" title="Login" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Login"><div class="fa fa-lg fa-sign-in"></div></a></li>
          <?php endif; ?>
          <?php if($this->session->userdata('sppmo')): ?>
            <li><a href="<?php echo base_url('settings/view'); ?>" data-toggle="tooltip" title="Config" class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Config"><div class="fa fa-lg fa-gear"></div></a></li><?php endif; ?>
          <?php if($this->session->userdata('sppmo')): ?>
            <li><a href="<?php echo base_url('user/logout'); ?>"  data-toggle="tooltip" title="Logout"  class="tooltipped" data-position="bottom" data-delay="1" data-tooltip="Logout"><div class="fa fa-lg fa-sign-out"></div></a></li>
          <?php endif; ?>
        </ul>

        <ul id="nav-mobile" class="side-nav">
          <li><div  class="user-view green darken-4">
              <img src="<?php echo base_url('assets/images/logo/vsulogo.png'); ?>">
          </div></li>
          <li><a href="<?php echo base_url('home'); ?>"><div class="fa fa-lg fa-home"></div> Home</a></li>
          <li><a href="<?php echo base_url('summaries/enduser'); ?>"><div class="fa fa-clipboard"></div> 
          Summary</a></li>
     

          <?php if($this->session->userdata('sppmo')): ?><li><a href="<?php echo base_url('supply/view'); ?>"><div class="fa fa-lg fa-television"></div> Property Section</a></li><?php endif; ?>
          <?php if(!$this->session->userdata('sppmo')): ?><li><a href="<?php echo base_url('user/login'); ?>"><div class="fa fa-lg fa-sign-in"></div> Login</a></li><?php endif; ?>
          <?php if($this->session->userdata('sppmo')): ?><li><a href="<?php echo base_url('settings/view'); ?>"><div class="fa fa-lg fa-gear"></div> Config</a></li><?php endif; ?>
          <?php if($this->session->userdata('sppmo')): ?><li><a href="<?php echo base_url('user/logout'); ?>"><div class="fa fa-lg fa-sign-out"></div> Logout</a></li><?php endif; ?>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><div class="fa fa-lg fa-bars"></div></a>
      </div>
    </nav>
  </div>
</header>



    <div class="container">
<!--         <h1 style="font-size:20pt">Ajax CRUD with Bootstrap modals and Datatables with Server side Validation</h1>
 
        <h3>Person Data</h3> -->


        <br />
        <button class="btn btn-success cusBtnSuccess" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> <b>Add Personnel</b></button>
    <!--     <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button> -->
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #e6e6e6;">
                    <th>ID Number</th>
                    <th>Emp No</th>
                    <th>Family Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th style="width:60px !important;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
 <!-- 
            <tfoot>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Action</th>
            </tr>
            </tfoot> -->
        </table>
        <br/>
        <br/>
    </div>


<script src="<?php echo base_url('assets/person/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/person/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/person/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/person/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/person/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>

<script type="text/javascript">
 
var save_method; //for save method string
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('person/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
 
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
 
});
 
 
 
function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add New Personnel'); // Set Title to Bootstrap modal title
}
 
function edit_person(personID)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('person/ajax_edit/')?>/" + personID,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="personID"]').val(data.personID);
            $('[name="IDNum"]').val(data.IDNum);
            $('[name="EmpNo"]').val(data.EmpNo);
            $('[name="surName"]').val(data.surName);
            $('[name="firstName"]').val(data.firstName);
            $('[name="middleName"]').val(data.middleName);
            $('[name="suffixName"]').val(data.suffixName);
            $('[name="nameTitleID"]').val(data.nameTitleID);
            $('[name="bday"]').datepicker('update',data.bday);
            $('[name="bplace"]').val(data.bplace);
            $('[name="sex"]').val(data.sex);
            $('[name="civilStatID"]').val(data.civilStatID);
            $('[name="addHome"]').val(data.addHome);
            $('[name="addEmail"]').val(data.addEmail);
            $('[name="officeID"]').val(data.officeID);
            $('[name="positionID"]').val(data.positionID);
            $('[name="shiftID"]').val(data.shiftID);
            $('[name="appointID"]').val(data.appointID);
            // $('[name="middleName"]').datepicker('update',data.middleName);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Personnel'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('person/ajax_add')?>";
    } else {
        url = "<?php echo site_url('person/ajax_update')?>";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
                // alert ("Data Updated");
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_person(personID)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('person/ajax_delete')?>/"+personID,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
                // alert ("Deleted!"+surName);
                // Materialize.toast('<b><div class="fa fa-user fa-lg" style="color:green"></div> asdasdasdasd</b>', 2000, 'rounded white black-text flow-text');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data, This Personnel is an active Enduser on PAR/ICS record');
            }
        });
 
    }
}
 
</script>
 
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <b><p class="modal-title">Person Form</p></b>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="personID"/> 
                    <div class="form-body">

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ID Number</label>
                            <div class="cusInput">
                                <input name="IDNum" placeholder="ID Number" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Eployee Number</label>
                            <div class="cusInput">
                                <input name="EmpNo" placeholder="Employee Number" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Family Name</label>
                           <div class="cusInput">
                                <input name="surName" placeholder="Family Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">First Name</label>
                            <div class="cusInput">
                                <input name="firstName" placeholder="First Name" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">Middle Name</label>
                            <div class="cusInput">
                                <input name="middleName" placeholder="Middle Name" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label">Suffix</label>
                            <div class="cusInput">
                                <input name="suffixName" placeholder="Suffix" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div> <!--  end of row -->

                    <div class="row">
                        <div class="form-group col-md-2">
                          <label class="control-label">Name Title</label>
                          <div class="cusInput">
                          <select class="mdc-select__native-control" name="nameTitleID" id="nameTitleID" style="display: inline-block !important;">
                            <option value="" disabled selected class="cusInput">Name Title</option>
                            <option value="2" class="cusInput">
                              Doctor
                            </option>
                            <option value="3" class="cusInput">
                              Engineer
                            </option>
                            <option value="4" class="cusInput">
                              Professor
                            </option>
                            <option value="5" class="cusInput">
                              Mr
                            </option>
                            <option value="6" class="cusInput">
                              Mrs
                            </option>
                            <option value="7" class="cusInput">
                              Ms
                            </option>

                          </select>
                          </div>
                          <div class="mdc-line-ripple"></div>
                        </div>

                        <div class="form-group col-md-2" style="margin-right: 0px !important;">
                            <label class="control-label">Date of Birth</label>
                            <div class="cusInput">
                                <input name="bday" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                            </div>
                        </div>

                        <div class="form-group col-md-5">
                            <label class="control-label">Place of Birth</label>
                            <div class="cusInput">
                            <input type="text" rows="2" class="form-control" name="bplace" placeholder="Birth Place">
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                          <label class="control-label">Gender</label>
                          <div class="cusInput">
                          <select class="mdc-select__native-control" name="sex" style="display: inline-block !important;">
                            <option value="" disabled selected class="cusInput">Gender</option>
                            <option value="M" class="cusInput">
                              Male
                            </option>
                            <option value="F" class="cusInput">
                              Female
                            </option>
                          </select>
                          </div>
                          <div class="mdc-line-ripple"></div>
                        </div>

                        <div class="form-group col-md-2">
                          <label class="control-label">Civil Status</label>
                          <div class="cusInput">
                          <select class="mdc-select__native-control" name="civilStatID" style="display: inline-block !important;">
                            <option value="" disabled selected class="cusInput">Civil Status</option>
                            <option value="2" class="cusInput">
                              NOT DEFINED
                            </option>
                            <option value="3" class="cusInput">
                              SINGLE
                            </option>
                            <option value="4" class="cusInput">
                              MARRIED
                            </option>
                            <option value="5" class="cusInput">
                              WIDOW
                            </option>
                            <option value="6" class="cusInput">
                              WIDOWER
                            </option>
                            <option value="7" class="cusInput">
                              DIVORCED
                            </option>
                            <option value="8" class="cusInput">
                              SEPARATED
                            </option>
                          </select>
                            </div>
                          <div class="mdc-line-ripple"></div>
                        </div>


                    </div><!--  end of row -->

                    <div class="row">
                        <div class="form-group col-md-6" style="margin-right:0px !important;">
                            <label class="control-label">Address</label>
                            <div class="cusInput">
                            <textarea class="form-control" rows="3" name="addHome" placeholder="Address"></textarea>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="cusInput">
                            <label class="control-label">Mail Address</label>
                            <textarea class="form-control" rows="3" name="addEmail" placeholder="Mail Address"></textarea>
                            </div>
                        </div>

                    </div><!--  end of row -->

                    <div class="row">

                        <div class="form-group col-md-3">
                            <label class="control-label">Office</label>
                            <div class="cusInput">
                            <select name="officeID" class="mdc-select__native-control" required autocomplete="off" id="officeID">
                              <?php if($offices): ?>
                                <option disabled selected value="0">Choose Office Code</option>
                                <?php foreach($offices as $office): ?>
                                <option value="<?php echo $office['officeID']; ?>" class="cusInput">
                                    <?php echo "(".$office['officeCode'].") ".$office['office']." (".$office['officeAcronym'].")"; ?>
                                </option>
                                <?php endforeach; ?>
                              <?php else: ?>
                                <option value="" class="cusInput">No Data</option>
                              <?php endif; ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">Position</label>
                            <div class="cusInput">
                            <select name="positionID" class="mdc-select__native-control" required autocomplete="off" id="positionID">
                              <?php if($positions): ?>
                                <option disabled selected value="0" class="cusInput">Choose positions</option>
                                <?php foreach($positions as $position): ?>
                                <option value="<?php echo $position['positionID']; ?>" class="cusInput">
                                    <?php echo "(".$position['position'].")"; ?>
                                </option>
                                <?php endforeach; ?>
                              <?php else: ?>
                                <option value="" class="cusInput">No Data</option>
                              <?php endif; ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">Shift</label>
                            <div class="cusInput">
                                <select name="shiftID" class="mdc-select__native-control" required autocomplete="off" id="shiftID">
                                  <?php if($shifts): ?>
                                    <option disabled value="0" class="cusInput">Choose Shift</option>
                                    <?php foreach($shifts as $shift): ?>
                                    <option selected value="<?php echo $shift['shiftID']; ?>" class="cusInput">
                                        <?php echo "(".$shift['shiftDesc'].")"; ?>
                                    </option>
                                    <?php endforeach; ?>
                                  <?php else: ?>
                                    <option value="" class="cusInput">No Data</option>
                                  <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">Appointment</label>
                            <div class="cusInput">
                            <select name="appointID" class="mdc-select__native-control" required autocomplete="off" id="appointID">
                              <?php if($appointments): ?>
                                <option disabled value="0" class="cusInput">Choose Appointment</option>
                                <?php foreach($appointments as $appointment): ?>
                                <option selected value="<?php echo $appointment['appointID']; ?>" class="cusInput">
                                    <?php echo "(".$appointment['appointDesc'].")"; ?>
                                </option>
                                <?php endforeach; ?>
                              <?php else: ?>
                                <option value="" class="cusInput">No Data</option>
                              <?php endif; ?>
                            </select>
                            </div>
                        </div>
                    </div><!--  end of row -->

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


 <footer class="page-footer green darken-4">
    <br>
    <div class="container">
      <div class="row">

          <div class="col s7">
          <div class="left-align">
            <img  src="<?php echo base_url('assets/images/logo/vsulogo.png'); ?>" class="responsive-img" align="center" alt="Visayas State University">
          </div>
          <p class="grey-text text-lighten-4">The Visayas State University (VSU) is a premier university of science and technology in the Visayas. It has earned a Level III Institutional Re-accredited Status by the Accrediting Agency for Chartered Colleges and Universities in the Philippines, Inc. (AACCUP). VSU's mission is to provide excellent instruction, conduct relevant research and foster community engagement that produce highly competent graduates necessary for the development of the country.
          <a href="<?phpecho base_url('/about'); ?>"> Read more.</a>
        </div>


        <div class="col s4">

      <!--     <h5 class="center-align">Have a Question?</h5> -->
          <br>
          <div class="row">
            <div class="col s2 offset-s2">
             <div class="fa fa-2x fa-location-arrow white-text"></div>
            </div>
            <div class="col s8">
              <p class="white-text footer-right-items">Visca, Baybay City, Leyte <br>Philippines 6521 </p>
            </div>
          </div>
          <div class="row">
            <div class="col s2 offset-s2">
              <div class="fa fa-2x fa-phone white-text"></div>
            </div>
            <div class="col s8">
              <p class="white-text footer-right-items">Tel. No: +63 (53) 563 7067 <br>Fax No: +63 (53) 563 7067 </p>
            </div>
          </div>
          <div class="row">
            <div class="col s2 offset-s2">
              <div class="fa fa-2x fa-envelope white-text footer-right-items"></div>
            </div>
            <div class="col s8" >
              <div class="valign-wrapper">
                <a href="mailto:information@vsu.edu.ph"><p class="white-text">
                information@vsu.edu.ph</b></p>
              </div>
            </div>
          </div>
        </div>
  

      </div>
    </div>
    <br>
    <div class="footer-copyright grey darken-3">
      <div class="container">
        <h6>Property Inventory System by <a class="orange-text text-lighten-3" href="<?php echo base_url('about/view'); ?>">PMO</a> <small>v2.0</small></h6>

      </div>
    </div>
  </footer>


</body>
</html>