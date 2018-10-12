

<style>

i.fa.fa-caret-down {
    margin-left: 10px !important;
}


div#myTable_filter {
    /* margin-right: 20px !important; */
    background-color: #333333 !important;
    width: 40% !important;
    margin-top: -9px !important;
    /* padding: 6px; */
    padding-bottom: 0px !important;
    padding-top: 9px !important;
    padding-right: 10px !important;
    margin-bottom: 0px !important;
    height: 50px !important;
    position: absolute !important;
    margin-top: -50px !important;
    float: right !important;
    right: 0px !important;
}

div#myTable_filter>label>input {
    background-color: #e2e2e2 !important;
}

.dropdown-content-wrapper {
    display: inline-block;
    width: 100%;
    padding: 40px;
    height: 170px !important;
}


.dropdown-content-wrapper > .filter_dp {
  width: 20% !important;
  float:left !important;
}

form#form-filter > .filter_dp {
    width: 20%;
    float: left;
}

.navbar {
    overflow: hidden;
    background-color: #333;
    font-family: Arial, Helvetica, sans-serif;
}

.navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.dropdown-menu {
    float: left;
    overflow: hidden;
}

.dropdown-menu .dropbtn {
    font-size: 16px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown-menu:hover .dropbtn {
    background-color: #1b5e20;
}

.dropdown-content-menu {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 90%;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    left: 67px !important;
}

.dropdown-content-menu a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content-menu a:hover {
    background-color: #ddd;
}

.dropdown-menu:hover .dropdown-content-menu {
    display: block;
}



.panel.panel-default {
    margin-top: 70px;
}

#type {
    width: 60px !important;
    padding: 0 !important;
    height: auto !important;
    position: absolute !important;
    top: 63px !important;
    left: 2px !important;
    display: block !important;
}


tbody#show_data >tr >td {
    padding: 0px 0px !important;
}


.btn_icon_recycle {
  font-size: 20px;
  color:green;
}

.btn_icon_waste, .btn_icon_transfer, .btn_icon_view{
  font-size: 20px;
  color:#000;
}


/*.item_transfer, .item_waste {
    width: 90px !important;
    padding: 0px !important;
    text-align: center;
    background-color: #468af5;
    text-transform: uppercase;
    color:#fff;
}
*/

#modal2 {
    padding: 0;
    height: 90% !important;
    max-height: 100% !important;
}

/*.btn_waste, .btn_restore, .item_view {
  width: 73px !important;
  padding: 0px !important;
  text-align: center !important;
  text-transform: capitalize;
}*/

.btn_restore {
  background-color:green !important;
}

.wasted_wrapper {
  background-color:#f44336;
  border-radius: 3px;
  color:#fff;
  text-align: center;
}

.transferred_wrapper {
  background-color:orange;
  border-radius: 3px;
  color:#fff;
  text-align: center;
}
div#waste_Modal {
    width: 50% !important;
    height: 70% !important;
}

.modal .modal-footer {
    bottom: 0px;
    /*position: absolute;*/
}

input[type=text]:disabled {
    background: #dddddd;
}

#propertyNumbers > input {
    width: 31.33% !important;
    color: #696969;
    height: 2rem;
    margin: 0px;
    display: inline-block;
    padding: 5px 5px;
    border-color: #e4e4e4;
    font-size: 14px;
    margin-right: 10px;
}

div#propertyNumbers {
    border: 1px solid #d0d0d0;
    padding: 0px 20px;
}
.pNumberHeader {
    background-color: #cecece;
    padding: 5px 10px;
}

div#modal5 {
    max-height: 98% !important;
    height: 100% !important;
    top: 1% !important;

}

a.remove_button {
    margin-left: -1px !important;
}
a.add_button {
    padding: 7px 10px !important;
    background-color: green !important;
    color: #fff !important;
    border-top-right-radius: 3px !important;
    border-bottom-right-radius: 3px !important;
    margin-left: -5px !important;
}

a.add_button, a.remove_button {
    padding: 7px 10px !important;
    background-color: green !important;
    color: #fff !important;
    border-top-right-radius: 3px !important;
    border-bottom-right-radius: 3px !important;
}

.dynamicField {
  width: 50% !important;
  border: 1px solid #00000047 !important;
  border-radius: 3px !important;
  height: 2rem !important;
}
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 20px 12px;
    border: 1px solid #ccc;
    border-top: none;
}

/*tabs*/


#dropdown1 {
  top: 36px !important;
}

/*buttons*/

.modal {
  width: 90% !important;
}
.btn-danger {
    color: #fff;
    background-color: #f44336 !important;
    border-color: #f44336;
}

.btn-danger:hover {
      background-color: #fd5c51 !important;
}

.btn-secondary:hover {
    color: #fff;
    background-color: #80878e !important;
    border-color: #50565c;
}

.btn-secondary {
    color: #fff !important;
    background-color: #808080 !important;
    border-color: #50565c !important;
}

/* buttons*/
.fa.fa-plus.effectIcon2 {
    z-index: 9999 !important;
    /* background-color: red; */
    padding: 5px;
}

.fwrapper {
    float: left;
    background-color: #1781ef;
    color: #fff;
    padding: 1px 5px;
    border-radius: 5px;
}

.pwrapper {
    background-color: #ffd509;
    padding: 1px 5px;
    border-radius: 5px;
    display: inline-block;
    color: #fff;
}

.cwrapper {
    background-color: #ff3535;
    color: #ffffff;
    padding: 1px 10px 1px 5px;
    float: left;
    border-radius: 5px;
}

.addPersonnelIcon, .addSupplierIcon{
    float: right;
    margin-right: -20px;
    margin-top: -24px;
    z-index: 99 !important;
}

#myTable {
    border: 1px solid #00000017;
    border-radius: 3px !important;
}

input.clearable {
    color: #000 !important;
    border: 1px solid #d2d2d2 !important;
    border-radius: 3px !important;
    height: 2rem !important;
    text-indent: 10px !important;
    width: 250px !important;
}

/*input.clearable::after {
    content:"asdasd";
    width: 20px;
    height:20px;
    background-color:red;
}*/

#wasteParics{
    margin-top: 0;
    background-color: whitesmoke;
    padding: 10px 0 10px 20px;
    background-color: white;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}

#wasteEquipment > form >.modal-header {
    position: fixed;
    width: 100%;
    z-index: 10;
}

#wasteEquipment > form > .modal-content {
    padding-top: 80px;
}

.wasteNum, .dateWaste, .wasteQty {
    border: 1px solid #c3c3c3 !important;
    height: 2rem !important;
    border-radius: 3px !important;
    text-indent: 10px !important;
}

</style>



<section class='header container'>
  <h6>Property Management Office</h6>
  <h4>PAR/ICS</h4>
  <hr>
</section>

<div class="container">
  <div class="row">
    <div class="col s12 m12 l12 xl12">
      <div class="section">

        <!-- <div class="row"> --> <!-- upper options -->
<!--           <div class="col s12 m2 l2" style="padding-bottom: 30px">
            <a class='green darken-4 btn waves-effect waves-light transmitBtn' href='#'>Transmittal <div class="fa fa-print"></div></a>
          </div> -->
<!--           <div class="col s12 m2 l2">
            <?php echo form_open('printparics/transmittal','target="_blank" class="transmitForm"'); ?>
              <select class="select3" name="transmitID[]" multiple required>
                <?php if($docs): ?>
                  <option disabled selected value="">Choose what to print</option>
                  <?php foreach($docs as $doc): ?>
                    <option value="<?php echo $doc['paricsID']; ?>"><?php echo $doc['parics']; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>
          </div> -->
<!--           <div class="col 12 m2 l2">
            <button class="green darken-4 btn waves-effect waves-green transmitSend" type="submit">Preview</button>
            <?php echo form_close(); ?>
          </div> -->
<!--           
          <?php echo form_open('property/printProp','target="_blank" '); ?>
          <div class="col 12 m2 l2">
            <button class="green darken-4 btn waves-effect waves-green propSend" type="submit">Preview</button>
          </div> -->
<!-- 
         <div class="col s12 m2 l2">
            <div class="propForm">
              <select class="select3" name="year" class="yearProp" required>
                <?php if($years): ?>
                  <option disabled selected value="">Choose year</option>
                  <?php foreach($years as $year): ?>
                    <option value="<?php echo $year['year']; ?>"><?php echo $year['year']; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>
              <?php echo form_close(); ?>
            </div>
          </div> -->

<!--           <div class="col s12 m2 l2">
            <a class='green darken-4 btn waves-effect waves-ligh propBtn' href='#'>Property Card 
            <div class="fa fa-print"></div></a>
          </div>

        </div>
 -->
<!--         <div class="col s12 m2 l2" style="position: absolute; margin-top:-40px;">
          
            <a class='dropdown-button green darken-4 btn waves-effect waves-light' href='#' data-activates='dropdown1'>New Acquisition <div class="fa fa-plus"></div></a>

            <ul id='dropdown1' class='dropdown-content '>
              <li><a href="#modal3" class="green-text text-darken-4"><div class="fa fa-cogs"></div> PAR</a></li>
              <li><a href="#modal4" class="green-text text-darken-4"><div class="fa fa-archive"></div> ICS</a></li>
            </ul>
          </div> -->


<div class="navbar">
  <div class="dropdown-menu">
    <button class="dropbtn">New Acquisition
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content-menu">
      <a href="#modal3">PAR</a>
      <a href="#modal4">ICS</a>
    </div>
  </div> 
  
  <div class="dropdown-menu">
    <button class="dropbtn">Transmital
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content-menu">
      <div class="dropdown-content-wrapper">
          <div class="filter_dp">
            <p>Select Array Number(s):</p>
          </div>
          <div class="filter_dp" style="width: 40% !important; float:left;">
            <?php echo form_open('printparics/transmittal','target="_blank" class="transmitForms"'); ?>
          
              <select class="select3" name="transmitID[]" multiple required>
                <?php if($docs): ?>
                  <option disabled selected value="">Choose what to print</option>
                  <?php foreach($docs as $doc): ?>
                    <option value="<?php echo $doc['paricsID']; ?>"><?php echo $doc['parics']; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>
          </div> 
          <div class="filter_dp" style="padding: 10px 0px 0px 40px;">
            <button class="green darken-4 btn waves-effect waves-green transmitSend" type="submit" style="display:block !important; ;">Preview</button>
          </div>
            <?php echo form_close(); ?>
      </div>
    </div>
  </div> 
  <div class="dropdown-menu">
    <button class="dropbtn">Property Card
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content-menu">
      <div class="dropdown-content-wrapper">
          <div class="filter_dp">
            <p>Choose Year:</p>
          </div>

      <div class="filter_dp" style="width: 40%; float:left;">
         <?php echo form_open('property/printProp','target="_blank" '); ?>
     
   
              <select class="select3" name="year" class="yearProp" required>
                <?php if($years): ?>
                  <!-- <option disabled selected value="">Choose year</option> -->
                  <?php foreach($years as $year): ?>
                    <option value="<?php echo $year['year']; ?>"><?php echo $year['year']; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>
              <?php echo form_close(); ?>
      </div>
 

          <div class="filter_dp" style="padding: 10px 0px 0px 40px;">
             <button class="green darken-4 btn waves-effect waves-green propSend" type="submit">Preview</button>
          </div>


      </div>
    </div>
  </div> 

</div>


        <!-- upper options -->

<!-- 
        <div class="tab">
          <button class="tablinks active" id="stbutton" onclick="openTabs(event, 'All')">All</button>
          <button class="tablinks" onclick="openTabs(event, 'Transfer')">Transfer</button>
          <button class="tablinks" onclick="openTabs(event, 'Waste')">Waste Management</button>
        </div> -->

 <!--        <div id="All" class="tabcontent"> -->

 
   
            <table class="bordered highlight responsive-table" id='myTable'>
              <thead>
                <tr style="background-color: #e6e6e6;">
                  <th>Type</th>
                  <th>Code</th>
                  <th>Date Issued</th>
                  <th>End User</th>
                  <th>Purchase Order</th>
                  <th>Document Status</th>
                  <th class="center">Control</th>

                </tr>
              </thead>
              <tbody>
                <!-- data here -->
              </tbody>
            </table>
     <!--    </div> -->

        </div>
        <br> <!-- section -->
      </div> <!-- section -->
    </div> <!-- row -->
</div> <!-- container -->
<!-- MODAL AREA -->
<div id="modal1" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class="center green darken-4 white-text padTitle"><div id="paricstext"></div></h4>
    <div class="divider"></div>
    <div class="content">
      <div class="section">
        <input type="text" hidden class="are tblareid">
        <input type="text" id="lastSeq" value="">
        <div class="row"> <!-- First Row -->
          <div class="col s2">
            <h6 class="right inlineBlock"><b><div id="paricsacronym"></div></b></h6>
          </div>
          <div class="col s4">
            <div class="d1">
              <h6 class="inlineBlock" id="paricsnumber"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input type="text" id='parics' style="width:200px" value= "" class="form-control tbl1">
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Date Issued:</b></h6>
          </div>
          <div class="col s4">
            <div class="d1">
              <h6 id="dateIssued2" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input type="text" id='dateIssued' style="width:100px" value= "" class="form-control tbl1 datepicker2">
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right inlineBlock"><b>End User:</b></h6>
          </div>
          <div class="col s3">
            <div class="d1">
              <h6 id="name" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <select name="user" id="personID" class="select2 form-control tbl1 user2" style="width:100px">
                <?php if($users): ?>
                  <option disabled selected value="0">Choose End User</option>
                  <?php foreach($users as $user): ?>
                    <option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName'].' '.$user["suffixName"]; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
          <div class="col s2 offset-s1">
            <h6 class="right inlineBlock"><b>Obligation:</b></h6>
          </div>
          <div class="col s4">
            <div class="d1">
              <h6 id="obligation2" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input type="text" id='obligation' style="width:200px" value= "" class="form-control tbl1">
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Position:</b></h6>
          </div>
          <div class="col s4">
            <h6 id="position" class="inlineBlock"></h6>
          </div>
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Purchase Order</b></h6>
          </div>
          <div class="col s4">
            <div class="d1">
              <h6 id="po2" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input type="text" id='poNumber' style="width:200px" value= "" class="form-control tbl1">
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Office:</b></h6>
          </div>
          <div class="col s4">
            <h6 id="office" class="inlineBlock"></h6>
          </div>
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Purchase Request:</b></h6>
          </div>
          <div class="col s4">
            <div class="d1">
              <h6 id="pr2" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input type="text" id='prNumber' style="width:200px" value= "" class="form-control tbl1">
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Fund Cluster:</b></h6>
          </div>
          <div class="col s3">
            <div class="d1">
              <h6 id="eqpticsfund" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <select name="fundCode" id="fundID" class="select2 fundCode2 tbl1 form-control" required autocomplete="off">
                <?php if($funds): ?>
                  <option disabled selected value="0">Choose Fund Cluster</option>
                  <?php foreach($funds as $fund): ?>
                    <option value="<?php echo $fund['fundID']; ?>"><?php echo "(".$fund['fundCode'].") ".$fund['fundDesc']; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
          <div class="col s2 offset-s1">
            <h6 class="right inlineBlock"><b>Official Receipt (OR):</b></h6>
          </div>
          <div class="col s4">
            <div class="d1">
              <h6 id="eqpticsor" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input type="text" id='orNumber' style="width:100px" value= "" class="form-control tbl1">
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Supplier:</b></h6>
          </div>
          <div class="col s4">
            <div class="d1">
              <h6 id="eqpticssupp" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <select name="suppCode" id="supplierID" class="select2 suppCode2 tbl1 form-control" required autocomplete="off">
                <?php if($suppliers): ?>
                  <option disabled selected value="0">Choose Supplier</option>
                  <?php foreach($suppliers as $supplier): ?>
                    <option value="<?php echo $supplier['supplierID']; ?>"><?php echo $supplier['supplier']; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Date OR Given:</b></h6>
          </div>
          <div class="col s4">
            <div class="d1">
              <h6 id="eqpticsordate" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input type="text" id='dateGiven' style="width:100px" value= "" class="form-control tbl1 datepicker2">
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <div class="divider"></div>
            <h4 class="center green darken-4 white-text padTitle"><div id="eqptinv"></div></h4>
            <b id="datePosted2" class="inlineBlock right"></b>
            <br>
            <div class="divider"></div>
            <br>

            <a class='postedStat green darken-4 btn waves-effect waves-light' href='#modal5'>
              <div class="new"></div>
            </a>
            <input id="docType" type="text" class="inlineBlock" readonly>
            
            <input id="isPosted" class="inlineBlock" readonly >

            <a class='postedStat green darken-4 btn waves-effect waves-light right' href='#postModal'>POST </a>

            <table id="mainTable" class="bordered highlight responsive-table eqpt">
              <thead>
                <tr>
                  <th>ID</th>
                  <th><div class="paricscode"></div></th>
                  <th>Qty</th>
                  <th>Unit</th>
                  <th>Description</th>
                  <th>Unit Price</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Control</th>
                  <!-- <th>notes</th> -->
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div> <!-- section end div -->
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <div class="">
    <a class="waves-effect waves-green btn-flat prints btn btn-raised btn-secondary" target="_blank" style="visibility:hidden"><div class="fa fa-print"></div> View (Temporary Form)</a>
    <a class="waves-effect waves-green btn-flat print btn btn-raised btn-secondary" target="_blank"><div class="fa fa-print"></div> View (SPPMO Form)</a>
    <a class="waves-effect waves-green btn-flat print2 btn btn-raised btn-secondary" target="_blank"><div class="fa fa-print"></div> View (GAM Form)</a>&nbsp
    <!-- <button class="modal-action modal-close waves-effect waves-ref btn">Close</button> -->
    <button type="button" class="modal-action modal-close waves-effect btn btn-raised btn-danger">Close</button>
    </div>

  </div>
</div>


<!-- viewEqpt -->
<div id="modal2" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class="center green darken-4 white-text padTitle"><div id="eqpticsdetails"></div></h4>
    <div class="divider"></div>
    <input type="text" class="eq tbleqid">

    <input type="text" hidden class="or tblorid">
    <div class="content">
      <div class="section">
        <div class="row">
          <div class="col s2">
            <h6 class="right inlineBlock"><b class="paricscode"></b><b>:</b></h6>
          </div>
          <div class="col s3">
            <div class="d1">
              <h6 id="eqpticscode" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <select name="funcCode"  id='propertyID' class="select2 form-control tbl3 func" required autocomplete="off">
                <?php if($codes): ?>
                  <option disabled selected value="0">Choose Account Code</option>
                  <?php foreach($codes as $code): ?>
                    <option value="<?php echo $code['propertyID']; ?>"><?php echo $code['code'].$code['subCode']." - ".$code['subDesc']; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Office:</b></h6>
          </div>
          <div class="col s3">
            <div class="d1">
              <h6 id="eqpticsoff" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <select name="office" id="officeID" class="select2 offCode2 tbl3 form-control" required autocomplete="off">
                <?php if($offices): ?>
                  <option disabled selected value="0">Choose Office Code</option>
                  <?php foreach($offices as $office): ?>
                    <option value="<?php echo $office['officeID']; ?>"><?php echo "(".$office['officeCode'].") ".$office['office']." (".$office['officeAcronym'].")"; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Seq:</b></h6>
          </div>
          <div class="col s2">
            <div class="d1">
              <h6 id="eqpticsseq" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input type="text" id='seq' style="width:30px" value= "" class="form-control tbl3" autocomplete="off">
              <a href='#' class='confirmData' ><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Life Span:</b></h6>
          </div>
            <div class="col s2">
              <div class="d1">
                <h6 id="eqpticslife" class="inlineBlock"></h6>
                <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
              </div>
              <div class="d2">
                <input type="text" id='life' style="width:30px" value= "" class="form-control tbl3" autocomplete="off">
                <a href='#' class='confirmData'><div class='fa fa-check editIcon'></div></a>
                <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right inlineBlock"><b>Description:</b></h6>
          </div>
          <div class="col s8 rcorner">
            <div class="d1">
              <h6 id="eqpticsspec" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <textarea id="equipmentDesc" style="width:800px" value= "" class="materialize-textarea tbl3" autocomplete="off"></textarea>
              <a href='#' class='confirmData'><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s2 ">
            <h6 class="right inlineBlock"><b>Quantity:</b></h6>
          </div>
          <div class="col s1">
            <div class="d1">
              <h6 id="eqpticsqty" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input id="qty" value= "" style="width:45px" class="form-control tbl3" autocomplete="off">
              <a href='#' class='confirmData'><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
          <div class="col s1">
            <h6 class="right inlineBlock"><b>Unit:</b></h6>
          </div>
          <div class="col s1">
            <div class="d1">
              <h6 id="eqpticsunit" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input id="unit" value= "" style="width:45px" class="form-control tbl3" autocomplete="off">
              <a href='#' class='confirmData'><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
          <div class="col s1">
            <h6 class="right inlineBlock"><b>Unit Price:</b></h6>
          </div>
          <div class="col s2">
            <div class="d1">
              <h6 id="eqpticsprice" class="inlineBlock"></h6>
              <a href='#' class='editData'><i class="fa fa-pencil editIcon"></i></a>
            </div>
            <div class="d2">
              <input id="unitPrice" value= "" style="width:150px" class="form-control tbl3" autocomplete="off">
              <a href='#' class='confirmData'><div class='fa fa-check editIcon'></div></a>
              <a href='#' class='cancelData'><div class='fa fa-times editIcon'></div></a>
            </div>
          </div>
          <div class="col s1">
            <h6 class="right inlineBlock"><b>Amount:</b></h6>
          </div>

          <div class="col s2">
            <h6 id="eqpticsamt" class="inlineBlock"></h6>
          </div>
        </div>

<!-- ********************  new data ********************************************** -->
<!-- if equipment id exist in tblpropertynumber -->
        <div class="row">
          <div class="col s12 my_div">
          <form>
            <!-- <input id="pCode" value=""> -->
            <input type="text" hidden class="eq tbleqid">

            <input type="text" hidden id="last_seq" name="last_seq">

            <!-- <div id="pCode" class="form-control tbl3" autocomplete="off"> -->
            <table class="bordered highlight responsive-table show_data" id="equipTable">
              <thead>
                <tr style="background-color: #e6e6e6;">

                  <th hidden>id</th>
                  <th hidden>equipmentID</th>
                  <th hidden>Property Number</th>
                  <th>Property Number</th>
                  <th style="width:70px;">Status</th>
                  <th style="width:100px;"></th>
                  <th style="width:100px" class="center">Control</th>
                </tr>
              </thead>
              <tbody id="show_data">
                <!-- data here -->
              </tbody>
            </table>
          </form>
          </div>
        </div>
<!-- ******************** end new data ********************************************** -->

      <div class="row">
        <div class="col s12">
          <h5>Old record barcode</h5>
          <img class="barcode" src="" alt="testing" />
        </div>
      </div>

      </div> <!-- section end div -->
    </div> <!-- content end div -->
  </div> <!-- modal-content end -->
  <div class="modal-footer">
    <button class="modal-action waves-effect waves-green">Print All Barcodes</button>
    <!-- <button class="modal-action waves-effect waves-green" onclick="refresh_equipment();">refresh</button> -->
    <a href="#waste_Modal_Bulk" class="btn" id="_wasteBulkItem" type="button" class="modal-action waves-effect waves-green btn-flat item_waste">Waste All</a>
    <button id="_transBulkItem" type="button" class="modal-action waves-effect waves-green btn-flat item_transfer">Transfer All</button>
    <button type="button" class="modal-action modal-close waves-effect btn btn-raised btn-danger">Close</button>
  </div>
</div>
<!-- viewEqpt -->


<div id="modal3" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class="">New Acquisition (Property Acknowledgement Receipt)</h4>
    <div class="divider"></div>
    <?php echo form_open('supply/setAcquisition'); ?>
    <input type="text" name="par" class="par" hidden value="2">
    <div class="content">
      <div class="section">
        <div class="row">
          <div class="col s2">
            <h6 class="right"><b>End User:</b></h6>
          </div>
          <div class="col s3">
            <select name="user" class="select2 user" required autocomplete="off">
              <?php if($users): ?>
                <option disabled selected value="0">Choose End User</option>
                <?php foreach($users as $user): ?>
                  <option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName'].' '.$user['suffixName']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>

            <!-- add icon -->
            <a href="<?php echo base_url('person/view'); ?>" class="tooltipped controlIcon addPersonnelIcon" data-position="top" data-delay="1" data-tooltip="Add Personnel">
              <div class="fa fa-plus effectIcon2"></div>
             </a>
            <!-- add icon -->

          </div>
          <div class="col s2">
            <h6 class="right"><b>Property Head:</b></h6>
          </div>
          <div class="col s3">
            <select name="head" class='select2 head' required autocomplete="off">
              <?php if($users): ?>
                <option disabled>Choose Property Head</option>
                <?php foreach($users as $user): ?>
                  <option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName'].' '.$user['suffixName']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right"><b>Fund Cluster:</b></h6>
          </div>
          <div class="col s3">
            <select name="fundCode" class="select2 fundCode" required autocomplete="off">
              <?php if($funds): ?>
                <option disabled selected value="0">Choose Fund Cluster</option>
                <?php foreach($funds as $fund): ?>
                  <option value="<?php echo $fund['fundID']; ?>"><?php echo "(".$fund['fundCode'].") ".$fund['fundDesc']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col s2">
            <h6 class="right"><b> Supplier:</b></h6>
          </div>
          <div class="col s3">
            <select name="supplierPAR" class="select2 supplierPAR" required autocomplete="off">
              <?php if($suppliers): ?>
                <option disabled selected value="0">Choose Supplier</option>
                <?php foreach($suppliers as $supplier): ?>
                  <option value="<?php echo $supplier['supplierID']; ?>"><?php echo $supplier['supplier']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
            <a href="#modal6" class="tooltipped controlIcon addSupplierIcon" data-position="top" data-delay="1" data-tooltip="Add Supplier">
                <div class="fa fa-plus effectIcon2"></div>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
            <div class="fa fa-file-text-o prefix"></div>
              <input name="codeNew" id="codeNew2" type="text" required autocomplete="off">
              <label for="codeNew2">PAR No:</label>
          </div>
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-calendar prefix"></div>
              <input name="dateNew" id="dateNew2" type="text" class="datepicker" required>
              <label for="dateNew2">Date Issued:</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-tasks prefix"></div>
              <input name="obNew" id="obNew2" type="text" required autocomplete="off">
              <label for="obNew2">Obligation:</label>
          </div>
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-file-text-o prefix"></div>
              <input name="orNew" id="orNew2" type="text" required autocomplete="off">
              <label for="orNew2">Official Receipt (OR):</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-pencil prefix"></div>
              <input name="poNew" id="poNew2" type="text" required autocomplete="off">
              <label for="poNew2">Purchase Order (PO):</label>
          </div>
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-calendar prefix"></div>
              <input name="dateGivenOR" id="dateGivenOR2" type="text" class="datepicker" required autocomplete="off">
              <label for="dateGivenOR2">Date OR Given:</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-pencil prefix"></div>
              <input name="prNew" id="prNew2" type="text" required autocomplete="off">
              <label for="prNew2">Purchase Request (PR):</label>
          </div>
        </div>
      </div> <!-- section end div -->
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Add</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Close</button>
  </div>
</div>

<div id="modal4" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class="">New Acquisition (Inventory Custodian Slip)</h4>
    <div class="divider"></div>
    <?php echo form_open('supply/setAcquisition'); ?>
    <input type="text" name="par" class="par" hidden value="1">
    <div class="content">
      <div class="section">
        <div class="row">
          <div class="col s2">
            <h6 class="right"><b>End User:</b></h6>
          </div>
          <div class="col s3">
            <select name="user" class="select2 user" required autocomplete="off">
              <?php if($users): ?>
                <option disabled selected value="0">Choose End User</option>
                <?php foreach($users as $user): ?>
                  <option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName'].' '.$user['suffixName']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col s2">
            <h6 class="right"><b>Property Head:</b></h6>
          </div>
          <div class="col s3">
            <select name="head" class='select2 head' required autocomplete="off">
              <?php if($users): ?>
                <option disabled>Choose Property Head</option>
                <?php foreach($users as $user): ?>
                  <option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName'].' '.$user['suffixName']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right"><b>Fund Cluster:</b></h6>
          </div>
          <div class="col s3">
            <select name="fundCode" class="select2 fundCode" required autocomplete="off">
              <?php if($funds): ?>
                <option disabled selected value="0">Choose Fund Cluster</option>
                <?php foreach($funds as $fund): ?>
                  <option value="<?php echo $fund['fundID']; ?>"><?php echo "(".$fund['fundCode'].") ".$fund['fundDesc']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col s2">
            <h6 class="right"><b> Supplier:</b></h6>
          </div>
          <div class="col s3">
            <select name="supplierPAR" class="select2 supplierPAR" required autocomplete="off">
              <?php if($suppliers): ?>
                <option disabled selected value="0">Choose Supplier</option>
                <?php foreach($suppliers as $supplier): ?>
                  <option value="<?php echo $supplier['supplierID']; ?>"><?php echo $supplier['supplier']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
            <a href="#modal6" class="tooltipped controlIcon" data-position="top" data-delay="1" data-tooltip="Add Supplier">
                <div class="fa fa-plus effectIcon2"></div>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
            <div class="fa fa-file-text-o prefix"></div>
              <input name="codeNew" id="codeNew" type="text" required autocomplete="off">
              <label for="codeNew">PAR No:</label>
          </div>
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-calendar prefix"></div>
              <input name="dateNew" id="dateNew" type="text" class="datepicker" required>
              <label for="dateNew">Date Issued:</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-pencil prefix"></div>
              <input name="obNew" id="obNew" type="text" required autocomplete="off">
              <label for="obNew">Obligation:</label>
          </div>
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-file-text-o prefix"></div>
              <input name="orNew" id="orNew" type="text" required autocomplete="off">
              <label for="orNew">Official Receipt (OR):</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-pencil prefix"></div>
              <input name="poNew" id="poNew" type="text" required autocomplete="off">
              <label for="poNew">Purchase Order (PO):</label>
          </div>
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-calendar prefix"></div>
              <input name="dateGivenOR" id="dateGivenOR" type="text" class="datepicker" required autocomplete="off">
              <label for="dateGivenOR">Date OR Given:</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-pencil prefix"></div>
              <input name="prNew" id="prNew" type="text" required autocomplete="off">
              <label for="prNew">Purchase Request (PR):</label>
          </div>
        </div>
      </div> <!-- section end div -->
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Add</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Close</button>
  </div>
</div>

<div id="modal5" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class=""><div class="new"></div></h4>
    <div class="divider"></div>
    <form action="" method="POST" class="neweqpt">
    <input type="text" name="orID" hidden  class="paricsIDhidden">
    <input type="text" name="propertyID" hidden class="p_ID">
    <div class="content">
      <div class="section">
        <div class="row">
          <div class="col s2">
            <h6 class="right"><b class="eqptics"></b></h6>
          </div>
          <div class="col s4">
            <select name="funcCode" class="select2 funcCode" id="newFuncCode" required autocomplete="off" onchange="myFunction(event)">
              <?php if($codes): ?>
                <option disabled selected value="0">Choose Account Code</option>
                <?php foreach($codes as $code): ?>
                  <option value="<?php echo $code['propertyID']; ?>" class="<?php echo $code['code'].$code['subCode'] ?>">
                    <?php echo $code['code'].$code['subCode']." - ".$code['subDesc']; ?>
                  </option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col s2">
            <h6 class="right"><b>Office Code:</b></h6>
          </div>
          <div class="col s3">
            <select name="offCode" id="newoffCode" class="select2 offCode" required autocomplete="off" onchange="myFunctions(event)">
              <?php if($offices): ?>
                <option disabled selected value="0">Choose Office Code</option>
                <?php foreach($offices as $office): ?>
                <option value="<?php echo $office['officeID']; ?>" class="<?php echo $office['officeCode'] ?>">
                    <?php echo "(".$office['officeCode'].") ".$office['office']." (".$office['officeAcronym'].")"; ?>
                    </option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s2 offset-s1">
              <!-- <div class="fa fa-question prefix"></div> -->
              <input name="qty" id="qty2" type="text" required autocomplete="off" oninput="genPropNumber()">
              <label for="qty2">Qty:</label>
          </div>
          <div class="input-field col s1">
              <!-- <div class="fa fa-folder-o prefix"></div> -->
              <input name="unit" id="unit2" type="text" required autocomplete="off">
              <label for="unit2">Unit:</label>
          </div>
          <div class="input-field col s2">
              <!-- <div class="prefix">P</div> -->
              <input name="price" id="price2" type="text" required autocomplete="off">
              <label for="price2">Price:</label>
          </div>
          <div class="input-field col s2 offset-s1">
              <!-- <div class="fa fa-list-ol prefix"></div> -->
              <input name="seq" id="seq2" type="text" required autocomplete="off">
              <label for="seq2">Sequence:</label>
          </div>
          <div class="input-field col s2" hidden>
              <div class="fa fa-heart-o prefix"></div>
              <input name="lifespan" id="lifespan2" type="text" autocomplete="off">
              <label for="lifespan2">Lifespan:</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s9 offset-s1">
            <!-- <div class="fa fa-clipboard prefix"></div> -->
            <textarea id="desc2" class="materialize-textarea" required  autocomplete="off"></textarea>
            <label for="desc2">Specification</label>
          </div>
        </div>
        <div class="row">
          <div class="pNumberHeader">
          <h6><strong>Property numbers:</strong></h6>
          </div>
          <div id="propertyNumbers"></div>
        </div>
        <div class="row hidden">
          <div class="input-field col s2 offset-s1">
            <input id="parNumberEC" hidden name="p_EC" type="text">
          </div>
          <div class="input-field col s2 offset-s1">
          <input type="text" name="" hidden name="p_FCode"  class="fundCode" id="fundCodePn">
          </div>
          <div class="input-field col s2 offset-s1">
            <input id="thisDate" hidden name="p_Date"  value="<?php echo date("ymd"); ?>" >
          </div>
          <div class="input-field col s2 offset-1">
            <input id="parNumberOC" hidden  name="p_OC" type="text" value="">
          </div>
        </div>
      </div> <!-- section end div -->
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green green darken-4 btn addEqpt" type="submit">Add</button>
    </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat btn-danger">Close</button>
  </div>
</div>


<div id="modalAddPersonnel" class="modal modal-fixed-footer" style="height:500px !important;width:100% !important">
  <div class="modal-content">
    <div class="content">
      <h4 class="">Add Personnel</h4>
      <div class="divider"></div>
      <br>
        <div class="content">
          <div class="section">
            <div class="row">
              <form action="" method="POST" class="newSupplier">
              <div class="input-group col s2">
          
                  <input name="idnum" id="idNum" class="cusInput" type="text" required autocomplete="off" placeholder="ID #">
                  
              </div>

              <div class="input-group col s2">
                  <input name="empnim" id="empNo" class="cusInput" type="text" required autocomplete="off" placeholder="Employee #">
              </div>

              <div class="input-group col s4">
                  <input name="faname" id="familyName" class="cusInput" type="text" required autocomplete="off" placeholder="Family Name">
              </div>

              <div class="input-group col s4">
                  <input name="finame" id="firstName" class="cusInput" type="text" required autocomplete="off" placeholder="First Name">
              </div>
            </div>
            <div class="row">
              <div class="input-group col s3">
                    <input name="mname" id="middleName" class="cusInput" type="text" required autocomplete="off" placeholder="Middle Name">
              </div>
              <div class="input-group col s3">
                    <input name="suffix" id="suffixName" class="cusInput" type="text" required autocomplete="off" placeholder="Suffix Name">
              </div>
              <div class="input-group col s3">
                    <input name="nametitle" id="nameTitle" class="cusInput" type="text" required autocomplete="off" placeholder="Name Title">
              </div>
              <div class="input-group col s3">
                    <input name="bday" id="bDay" class="cusInput" type="text" required autocomplete="off" placeholder="Birth Date">
              </div>
            </div>
            <div class="row">
              <div class="input-group col s3">
                    <input name="bplace" id="bPlace" class="cusInput" type="text" required autocomplete="off" placeholder="Birth Place">
              </div>

              <div class="input-group col s3">
                    <input name="sex" id="sex" class="cusInput" type="text" required autocomplete="off" placeholder="Gender">
              </div>

              <div class="input-group col s3">
                    <input name="civilstat" id="civilStatus" class="cusInput" type="text" required autocomplete="off" placeholder="Civil Status">
              </div>

              <div class="input-group col s3">
                    <input name="addhome" id="addressHome" class="cusInput" type="text" required autocomplete="off" placeholder="Address">
              </div>
            </div>
            <div class="row">
              <div class="input-group col s3">
                    <input name="addmail" id="addressMail" class="cusInput" type="text" required autocomplete="off" placeholder="Mail Address">
              </div>

              <div class="input-group col s3">
                    <input name="ofc" id="office" class="cusInput" type="text" required autocomplete="off" placeholder="Office">
              </div>

              <div class="input-group col s3">
                    <input name="pos" id="suffixName" class="cusInput" type="text" required autocomplete="off" placeholder="Possition">
              </div>

              <div class="input-group col s3">
                    <input name="shft" id="shift" class="cusInput" type="text" required autocomplete="off" placeholder="Shift">
              </div>
            </div>
            <div class="row">
              <div class="input-group col s3">
                    <input name="appt" id="appoint" class="cusInput" type="text" required autocomplete="off" placeholder="Appoint">
              </div>
            </div>

            </div>
          </div>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat addSupp" type="submit">Add</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<div id="modal6" class="modal modal-fixed-footer" style="height:500px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
      <h4 class="">Add Supplier</h4>
      <div class="divider"></div>
      <br>
        <div class="content">
          <div class="section">
            <div class="row">
              <form action="" method="POST" class="newSupplier">
              <div class="input-field col s3 offset-s1">
                  <div class="fa fa-industry prefix"></div>
                  <input name="supp" id="supplier" type="text" required autocomplete="off">
                  <label for="supplier">Supplier:</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s10 offset-s1">
                  <div class="fa fa-address-card-o prefix"></div>
                  <input name="addr" id="addr" type="text" autocomplete="off">
                  <label for="addr">Address:</label>
                </div>
            </div>
            <div class="row">
              <div class="input-field col s4 offset-s1">
                  <div class="fa fa-mobile prefix"></div>
                  <input name="contact" id="contact" type="text" autocomplete="off">
                  <label for="contact">Contact No:</label>
              </div>
            </div>
            </div>
          </div>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat addSupp" type="submit">Add</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<div id="delDoc" class="modal modal-fixed-footer" style="height:350px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
        <?php echo form_open('supply/deleteDoc'); ?>
        <input type="text" hidden name="paricsID" class="are">
        <p class="flow-text" style="margin-top:0">Are you sure you want to delete <b class="delPar"></b>
          <br><br> - Date Issued: <b class="delDate"></b>
          <br> - End User: <b class="delUser"></b>
          <br><br><small style="font-size:19px"><i> *Deleting of data is only intended for unintentional data entry. <br>This action is irreversible please proceed with caution and review the details above.</i></small>
        </p>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Delete</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<div id="delEqpt" class="modal modal-fixed-footer" style="height:350px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
        <form action="" method="POST" class="equipment">
        <input type="text" hidden name="ID" class="ID">
        <p class="flow-text" style="margin-top:0">Are you sure you want to delete this equipment from <b class="delPar"></b>
          <br><br> - Description: <b class="desc"></b>
          <br><br><small style="font-size:19px"><i> *Deleting of data is only intended for unintentional data entry. <br>This action is irreversible please proceed with caution and review the details above.</i></small>
        </p>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Delete</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<div id="postModal" class="modal modal-fixed-footer" style="height:500px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
        <form action="" method="POST" class="postData">
        <input type="text" hidden name="paricsID2" class="paricsID2">
        <p class="flow-text" style="margin-top:0">Posting this document: <b class="postPar"></b>
          <br><br> - Date Issued: <b class="postDateDoc"></b>
          <br> - End User: <b class="postUserDoc"></b>
          <br> - Date Posted: <input type="text" name="datePosted" id='datePosted' style="width:100px" class="datePosted form-control datepicker2" required="required">
          <br><br><small style="font-size:19px"><i> *Editing of the document is not available after posting.</i></small>
        </p>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Post</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<div id="forward" class="modal modal-fixed-footer" style="height:500px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
        <form action="" method="POST" class="forwardData">
        <input type="text" hidden name="paricsIDForward" class="paricsIDForward">
        <p class="flow-text" style="margin-top:0">Forward this document: <b class="paricsForward"></b>
          <br><br> - Date Issued: <b class="dateIssuedForward"></b>
          <br> - End User: <b class="userForward"></b>
          <br> - Date Forwarded: <input type="text" name="dateForward" id='dateForward' style="width:100px" class="datePosted form-control datepicker2" required="required">
        </p>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Proceed</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<div id="cancel" class="modal modal-fixed-footer" style="height:500px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
        <form action="" method="POST" class="cancelData">
        <input type="text" hidden name="paricsIDCancel" class="paricsIDCancel">
        <p class="flow-text" style="margin-top:0">Cancel this document: <b class="paricsCancel"></b>
          <br><br> - Date Issued: <b class="dateIssuedCancel"></b>
          <br> - End User: <b class="userCancel"></b>
          <br> - Date Cancelled: <input type="text" name="dateCancel" id='dateCancel' style="width:100px" class="datePosted form-control datepicker2" required="required">
        </p>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Proceed</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<!-- waste modal -->
<div id="wasteEquipment" class="modal modal-fixed-footer" style="height:550px !important;width:800px !important">
  

  <div class="modal-content">
    <div class="content">
        <form action="" method="POST" class="wasteEquip">

            <div class="modal-header">
    <div class="row">
       <p class="flow-text" id="wasteParics">Parics Number:  <b class="delPar"></b></p>
    </div>
  </div>

     
 
          <div class="row" >
            <div class="col s2 l2 m2">
              <p class="right">Description:</p>
            </div>
            <div class="col s9 l9 m9">
              <p><b class="desc"></b></p>
            </div>
          </div>

          <div class="row">
            <div class="col s2 l2 m2">
              <p class="right">Item to waste:</p>
            </div>
            <div class="col s3 l3 m3">
              <input type="text" name="unitWasted" id='unitWasted'  class="wasteQty unitWasted form-control" required="required" readonly>
            </div>
          
            <div class="col s2 l2 m2">
              <p class="right">Waste #:</p>
            </div>
            <div class="col s3 l4 m4">
              <input type="text" name="wasteNum" id='wasteNum'  class="wasteNum form-control" required="required" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col s2 l2 m2">
              <p class="right">Date Wasted:</p>
            </div>
            <div class="col s3 l4 m4">
              <input type="text" name="dateWaste" id='dateWaste' class="dateWaste form-control datepicker2" required="required" value="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>

          <input type="text" name="equipmentID" class="ID" id="equipmentID">

    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Waste</button>
    </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>

</div>

<!-- new transfer modal -->
<div id="transfer_Modal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                   <form>

                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transfers this Item?</h5>
         
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <div class="col s3">
                              <input type="text" name="id_tr" id="id_tr" class="form-control" placeholder="id">
                            </div>
                            <div class="col S3">
                              <input type="text" name="transferNumber_tr" id="transferNumber_tr" class="form-control" placeholder="transfer number">
                            </div>
                            <div class="col s3">
                              <input type="text" name="equipmentID_tr" id="equipmentID_tr" class="form-control" placeholder="equipmentID">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div 

                            class="col s6">
                              <input type="text" name="personID_tr" id="personID_tr" value="" placeholder="personID">
                              <input type="text" name="propertyNumber_tr" id="propertyNumber_tr" class="form-control" value="" placeholder="property Number">

                            </div>
                            <div class="col s6">
                              <input type="text" name="amount_tr" id="amount_tr" class="form-control" value="" placeholder="amount">

                              <input type="text" name="trDate_tr" id='trDate_tr' class="dateWaste form-control datepicker2" required value="<?php echo date('Y/m/d') ?>">

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col s12">
                              <label class="col-md-2 col-form-label">Notes</label>
                              <textarea name="notes_waste" id="notes_waste" class="form-control" value=""></textarea>
                            </div>
                        </div>

                        <div class="form-group row" style="display:none;">
                            <div class="col s12">
                              <input type="text" name="istransferred_waste" id="istransferred_waste" class="form-control">
                            </div>
                        </div>  

                  </div>
     
                </div>
      <div class="modal-footer">
        <button type="button" type="submit" id="btnUpdate" class="btn btn-primary">OK</button>
           </form>
        <button type="button" class="btn btn-secondary  modal-action modal-close" data-dismiss="modal">Cancel</button>
      </div>
   </div>
</div>

<!-- new transfer modal -->




<!-- waste modal bulk -->

<div id="waste_Modal_Bulk" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                   <form>

                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Waste All Items?</h5>
         
                  </div>
                  <div class="modal-body">
                        <div class="form-group row" >
                            <div class="col s12">
                              <input type="text" name="equip_id_B" id="equip_id_B" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col s6">
                              <label class="col-md-2 col-form-label">Waste Number</label>
                              <input name="waste_number_B" id="waste_number_B" value="" readonly>
                              <!-- <input name="waste_number_C" id="waste_number_C" value="" readonly> -->
                              <input type="text" name="iswasted_waste" id="iswasted_waste" class="form-control" value="1" readonly hidden>
                            </div>
                            <div class="col s6">
                              <label class="col-md-2 col-form-label">Date Wasted</label>
                              <input type="text" name="date_wasted_B" id='date_wasted_B' class="dateWaste form-control datepicker2" required value="<?php echo date('Y/m/d') ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col s12">
                              <label class="col-md-2 col-form-label">Notes</label>
                              <textarea name="notes_waste_B" id="notes_waste_B" class="form-control" value=""></textarea>
                            </div>
                        </div>

                        <div class="form-group row" style="display:none;">
                            <div class="col s12">
                              <input type="text" name="istransferred_waste" id="istransferred_waste" class="form-control">
                            </div>
                        </div>  



                  </div>
     
                </div>
      <div class="modal-footer">
        <button type="button" type="submit" id="btnWaste_B" class="btn btn-primary">OK</button>
           </form>
        <button type="button" class="btn btn-secondary  modal-action modal-close" data-dismiss="modal">Cancel</button>
      </div>
   </div>
</div>

<!-- waste modal bulk -->


<div id="transferEquipment" class="modal modal-fixed-footer" style="height:550px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
        <form action="" method="POST" class="transferEquip">
        <input type="text" hidden name="ID" class="ID">
        <p class="flow-text" style="margin-top:0">Transfer this equipment from <b class="delPar"></b></p>
          <div class="row" >
            <div class="col s3 l3 m3">
              <p class="right">Description:</p>
            </div>
            <div class="col s3 l3 m3">
              <b class="desc"></b>
            </div>
          </div>
          <div class="row">
            <div class="col s3 l3 m3">
              <p class="right">Transfer To:</p>
            </div>
            <div class="col 3 l4 m4">
              <select name="user" class="select2 user5" required autocomplete="off">
                <?php if($users): ?>
                  <option disabled selected value="0">Choose End User</option>
                  <?php foreach($users as $user): ?>
                    <option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName'].' '.$user['suffixName']; ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No Data</option>
                <?php endif; ?>
              </select>

            </div>
          </div>
          <div class="row">
            <div class="col s3 l3 m3">
              <p class="right">Transfer Number:</p>
            </div>
            <div class="col s3 l4 m4">
              <input type="text" name="transNum" id='transNum'  class="transNum form-control" required="required">
            </div>
          </div>
          <div class="row">
            <div class="col s3 l3 m3">
              <p class="right">Date of transfer:</p>
            </div>
            <div class="col s3 l4 m4">
              <input type="text" name="dateTrans" id='dateTrans'  class="dateTrans form-control datepicker2" required="required">
            </div>
          </div>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Transfer</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<!-- <script>
  var socket = io.connect( 'http://'+window.location.hostname+':3000' );

  socket.on('open', function( data ) {
    
  });
</script>
 -->


<script>
function openTabs(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    // evt.currentTarget.className += " active";
}

$(document).ready(function(){


    $("#qty2, #qty, #price2, #price").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });



 var maxField = 300; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="field_name[]" value="" class="dynamicField"/><a href="javascript:void(0);" class="remove_button"><div class="fa fa-minus"></div></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });


  $("#stbutton").click();

  });




</script>