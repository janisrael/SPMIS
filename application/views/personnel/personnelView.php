
<script>
$(document).ready(function() {
    $('#personnelTbl').DataTable( {
        "order": [[ 0, "desc" ]],
        columnDefs: [ {
            targets: [ 0 ],
            orderData: [ 1, 1 ]
        }, {
            targets: [ 1 ],
            orderData: [ 1, 0 ]
        }, {
            targets: [ 4 ],
            orderData: [ 4, 0 ]
        } ]
    } );
} );
</script>




<style>

.modal {

    max-height: 80% !important;
}

.modal.modal-fixed-footer {
    height: 80% !important;
}

select {
    display: inline-block !important;
    /* width: 60px !important; */
    /* margin: -6px 10px !important; */
    height: 35px !important;
    padding: 5px 12px !important;
}


textarea#addHome, textarea#addEmail {
    resize: none !important;
    background: white !important;
    border-radius: 5px !important;
    padding: 6px 12px;
    border: 1px solid #0000003d !important;
}
.cusInput {
    width: 100% !important;
}

th {
    /* border: 1px solid black; */
    border-right: 1px solid rgba(255, 255, 255, 0.5686274509803921) !important;
}

tr.personnelTblHeader > th {
    background-color: #e0dede !important;
}

label {
    font-size: .8rem !important;
    color: #737373 !important;
    float: left !important;
    display: inline-flex !important;
    padding: 11px !important;
    margin-top: 30px !important;
}

.row .col.l2 {
    width: 100% !important;
}



input.form-control {
    border: 1px solid #0000003d !important;
    padding: 6px 12px !important;
    height: 20px !important;
    background-color: white !important;
    border-radius: 3px !important;
    width: 87% !important;
}

/*.form-group {
    display: inline-block !important;
    width: 90% !important;
}*/



</style>


<!-- Add new record -->


<div class="container">
  <section class='header'>
  	<h6>Property Management Office</h6>
  	<h4>Personnel List</h4>
    <hr>
  </section>

  <div class="row">

       
<?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        <?php endif; ?>


        <?php if ($this->session->flashdata('flashSuccess')) { ?>
        <div class="col-md-12">
            <div class="alert alert-success"> <? $this->session->flashdata('flashSuccess') ?>
            </div>
        </div>
        <?php } ?>
        <div class="btn-group">
           <a href="#modal_addPersonnel">
            <button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-plus" title="edit"></i> Add New Personnel </button> </a>
        </div>



    <table id="personnelTbl" class="display" style="width:100%;">

        <thead>
            <tr class="personnelTblHeader">
        <!--         <th>personID#</th> -->
                <th>ID Number</th>
                <th>Employee Number</th>
                <th>Name</th>
                <th>Suffix</th>
                <th>Name Title</th>
                <th>Office</th>
                <th>Position</th>
              <!--   <th>Gender</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($personnel_list as $personnel){ 
            $edit = base_url().'personnel/view/edit/';
            $delete = base_url().'personnel/view/delete/';

            ?>
            <tr>
                <td><?php echo $personnel->IDNum; ?></td>
                <td><?php echo $personnel->EmpNo; ?></td>
                <td><?php echo $personnel->surName .", ". $personnel->firstName ." ". $personnel->middleName; ?></td>
              
                <td><?php echo $personnel->suffixName; ?></td>
                <td><?php echo $personnel->nameTitle; ?></td>
                

                <td><?php echo $personnel->officeAcronym; ?></td>
                <td><?php echo $personnel->position; ?></td>
             <!--    <td><?php echo $personnel->sex; ?></td> -->
                <td>
                    <a href='http://localhost/sppmo/personnel/view/edit/' data-id='http://localhost/sppmo/personnel/view/edit/' class='btnedit' title='edit'>
                    <div class="fa fa-eye"></div>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href='$delete' data-id='$personnel->personID' class='btndelete' title='delete'>
                     <div class="fa fa-close"></div>
                    </a>
                </td> 
            </tr>
            <?php }?>
        </tbody>
      
    </table>

</div>


<div id="modal_addPersonnel" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class="">Add New Personnel</h4>
    <div class="divider"></div>
    <?php echo form_open('personnel/setPersonnel'); ?>
    <!-- <input type="text" name="par" class="par" hidden value="2"> -->
    <div class="content">
      <div class="section">
            <br/>
            <br/>

            <div class="row">
                    <div class="form-group col s4">
                        <input type="text" class="form-control  cusInput" id="IDNum" name="IDNum" placeholder="ID Number">
                    </div>
             

               
                    <div class="form-group col s4">
                        <input type="text" class="form-control cusInput" id="EmpNo" name="EmpNo" placeholder="Employee Number">
                    </div>
               
            </div>

            <div class="row">
                
                    <div class="form-group col s3">
                        <input type="text" class="form-control  cusInput" id="surName" name="surName" placeholder="Family Name">
                    </div>
                
                    <div class="form-group col s3">
                        <input type="text" class="form-control cusInput" id="firstName" name="firstName" placeholder="First Name">
                    </div>
                    <div class="form-group col s3">
                        <input type="text" class="form-control cusInput" id="middleName" name="middleName" placeholder="Middle Name">
                    </div>
             
                    <div class="form-group col s1">
                        <input type="text" class="form-control cusInput" id="suffixName" name="suffixName" placeholder="Suffix">
                    </div>

                    <div class="form-group col s2">
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
                      <div class="mdc-line-ripple"></div>
                    </div>

 
            </div>

            <div class="row">
                    <div class="form-group col s3">
                        <input type="text" class="form-control cusInput datepicker2" id="bday" name="bday" placeholder="Birth Date">
                    </div>
                    <div class="form-group col s4">
                        <input type="text" class="form-control cusInput" id="bplace" name="bplace" placeholder="Birth Place">
                    </div>

                    <div class="form-group col s2">
                      <select class="mdc-select__native-control" name="sex" id="sex" style="display: inline-block !important;">
                        <option value="" disabled selected class="cusInput">Gender</option>
                        <option value="M" class="cusInput">
                          Male
                        </option>
                        <option value="F" class="cusInput">
                          Female
                        </option>
                      </select>
                      <div class="mdc-line-ripple"></div>
                    </div>

                    <div class="form-group col s3">
                      <select class="mdc-select__native-control" name="civilStatID" id="civilStatID" style="display: inline-block !important;">
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
                      <div class="mdc-line-ripple"></div>
                    </div>
            </div>

            <div class="row">
                <div class="form-group col s6">
              <!--       <input type="text" class="form-control cusInput" id="addHome" name="addHome" placeholder="Address"> -->
                    <textarea class="form-control" rows="5" id="addHome" name="addHome" placeholder="Address"></textarea>
                </div>

                <div class="form-group col s6">
                    <textarea class="form-control" rows="5" id="addEmail" name="addEmail" placeholder="Mail Address"></textarea>
                </div>
            </div>

            <div class="row">
                 <div class="col s3">
                <select name="officeID" class="select2 offCode mdc-select__native-control" required autocomplete="off" id="officeID">
                  <?php if($offices): ?>
                    <option disabled selected value="0" class="cusInput">Choose Office Code</option>
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

                <div class="col s3">
                <select name="positionID" class="select2 offCode" required autocomplete="off" id="positionID">
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

                <div class="col s3">
                <select name="shiftID" class="select2 offCode" required autocomplete="off" id="shiftID">
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

                <div class="col s3">
                <select name="appointID" class="select2 offCode" required autocomplete="off" id="appointID">
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

                        <br/>
            <br/>
     
      </div> <!-- section end div -->
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->

  <div class="modal-footer">
    <button class="waves-effect waves-green btn btn-success" type="submit">Add</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn btn-outline-primary">Close</button>
  </div>

</div>

