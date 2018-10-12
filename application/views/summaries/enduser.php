<style>
.collapsible-header > .fa {
    position: absolute;
    background-color: rgba(185, 185, 185, 0.2784313725490196);
    padding: 15px;
    margin-left: -15px;
    color: #1b1b1b !important;
}

.collapsible-header >  span {
    text-indent: 40px !important;
    display: inline-block;
}

.collection.with-header .collection-header {
    background-color: #ececec !important;
    border-bottom: 1px solid #e0e0e0 !important;
    padding: 5px 20px !important; 
}

.hidden {
  display: none;
}

</style>
<section class='header container'>
	<h6>Property Management Office</h6>
	<h4>Summary</h4>
  <hr>
</section>
<div class="container">
  <div class="section">
    <div class="row">
      <div class="col s5">
        <ul class="collapsible popout" data-collapsible="accordion">
        


         <li><!--  user by date -->
           <div class="collapsible-header">
              <div class="fa fa-calendar"></div> <span><strong>User by Date</strong></span>
           </div>
           <div class="collapsible-body"><span>
            <form class="euser">
              <div class="form-group">
              <div class='input-group date' >                                                
                <label>Year:</label> 
                <select class="yrselectdesc form-control by_date" style="display: inline-block;"></select>
              </div>
              </div>   
             <br><br>
             <select class="select2 opt" name="opt" required>
               <option value="0" selected disabled>Choose PAR/ICS *</option>
               <option value="2">PAR</option>
							 <option value="1">ICS</option>
               <option value="3">All</option>
             </select><br><br>
             <button class="btn green darken-4" type="submit"><div class="fa fa-search"></div> Show</button>
           </form>
           </span></div>
         </li><!--  user by date -->


         <li> <!--  user by name -->
           <div class="collapsible-header"><div class="fa fa-address-book"></div><span><strong> User by Name</span></strong></div>
           <div class="collapsible-body"><span>
            <form class="euser">
             <select name="user3" class="select2 user3" required autocomplete="off">
               <?php if($users): ?>
                 <option disabled selected value="0">Choose End User *</option>
                 <?php foreach($users as $user): ?>
                   <option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName'].' '.$user['suffixName']; ?></option>
                 <?php endforeach; ?>
               <?php else: ?>
                 <option value="">No Data</option>
               <?php endif; ?>
             </select>
             <br><br>
             <select class="select2 opt" name="opt" required>
               <option value="0" selected disabled>Choose PAR/ICS *</option>
               <option value="2">PAR</option>
               <option value="1">ICS</option>
               <option value="3">All</option>
             </select><br><br>
             <button class="btn green darken-4" type="submit"><div class="fa fa-search"></div> Show</button>
           </form>
           </span></div>
         </li> <!--  user by name -->
         <li> <!--  user by office -->
           <div class="collapsible-header"><div class="fa fa-home"></div> <span><strong>User by Office</strong></span></div>
           <div class="collapsible-body"><span>
             <form class="euser">
               <select name="offCode3" class="select2 offCode3" required>
                 <?php if($offices): ?>
                   <option disabled selected value="0">Choose Office *</option>
                   <?php foreach($offices as $office): ?>
                     <option value="<?php echo $office['officeID']; ?>"><?php echo $office['office']." (".$office['officeAcronym'].")"; ?></option>
                   <?php endforeach; ?>
                 <?php else: ?>
                   <option value="">No Data</option>
                 <?php endif; ?>
               </select><br><br>

               <select class="select2 opt" name="opt" required>
                 <option value="0" selected disabled>Choose PAR/ICS *</option>
                 <option value="2">PAR</option>
                 <option value="1">ICS</option>
	               <option value="3">All</option>
               </select><br><br>
             <button class="btn green darken-4" type="submit"><div class="fa fa-search"></div> Show</button>
           </form>
           </span></div>
         </li>  <!--  user by office -->
         <li>  <!--  user by accountcode -->
           <div class="collapsible-header"><div class="fa fa-file-text"></div><span><strong> Equipment by Account Code</strong></span></div>
           <div class="collapsible-body"><span>
             <?php echo form_open('printparics/byEquip','target="_blank"'); ?>
               <select name="Code" class="select2 funcCode3" required autocomplete="off">
                 <?php if($codes): ?>
                   <option disabled selected value="0">Choose Account Code *</option>
                   <?php foreach($codes as $code): ?>
                     <option value="<?php echo $code['propertyID']; ?>"><?php echo $code['code'].$code['subCode']." - ".$code['subDesc']; ?></option>
                   <?php endforeach; ?>
                 <?php else: ?>
                   <option value="">No Data</option>
                 <?php endif; ?>
               </select><br><br>
             <button class="btn green darken-4" type="submit"><div class="fa fa-search"></div> Show</button>
           <?php echo form_close(); ?>
           </span></div>
         </li>
         <li>
           <div class="collapsible-header"><div class="fa fa-building"></div><span><strong> Property by Office</strong></span></div>
           <div class="collapsible-body"><span>
             <?php echo form_open('printparics/byOffice','target="_blank"'); ?>
               <select name="offCode4" class="select2 offCode4" required>
                 <?php if($offices): ?>
                   <option disabled selected value="0">Choose Office *</option>
                   <?php foreach($offices as $office): ?>
                     <option value="<?php echo $office['officeID']; ?>"><?php echo $office['office']." (".$office['officeAcronym'].")"; ?></option>
                   <?php endforeach; ?>
                 <?php else: ?>
                   <option value="">No Data</option>
                 <?php endif; ?>
               </select><br><br>
               <select class="select2 opt" name="opt" required>
                 <option value="0" selected disabled>Choose PAR/ICS *</option>
                 <option value="2">PAR</option>
                 <option value="1">ICS</option>
	               <option value="3">All</option>
               </select><br><br>
             <button class="btn green darken-4" type="submit"><div class="fa fa-search"></div> Show</button>
           <?php echo form_close(); ?>
           </span></div>
         </li>  <!--  user by accountcode -->

          <li>
           <div class="collapsible-header"><div class="fa fa-building"></div><span><strong> Array By Year</strong></span></div>
           <div class="collapsible-body">
            <span>

              <div>
                  <div class="md-radio">
                    Select Format:
                  </div>
                  <div class="md-radio">
                    <input id="1" type="radio" name="g" onclick="show_1();" checked>
                    <label for="1">EXCEL/CSV</label>
                  </div>
                  <div class="md-radio">
                    <input id="2" type="radio" onclick="show_2();" name="g">
                    <label for="2">PDF</label>
                  </div>
              </div>
              <br><br>
              <div id="_opt_1">
                <?php echo form_open('printparics/array_by_year_csv','target="_blank"'); ?>
                <select name="filter_year_csv" class="yrselectdesc form-control by_date" style="display: inline-block;"></select><br><br>

                 <select class="select2 opt" name="opt_csv" required>
                   <option value="0" selected disabled>Choose PAR/ICS *</option>
                   <option value="2">PAR</option>
                   <option value="1">ICS</option>
                   <option value="3">All</option>
                 </select><br><br>
                <button class="btn green darken-4" type="submit"><div class="fa fa-search"></div> Download</button>
                <?php echo form_close(); ?>
               

                
              </div>

               <div id="_opt_2"  class="hidden">
                <?php echo form_open('printparics/array_by_year','target="_blank"'); ?>
                <select name="filter_year" class="yrselectdesc form-control by_date" style="display: inline-block;"></select><br><br>

                 <select class="select2 opt" name="opt" required>
                   <option value="0" selected disabled>Choose PAR/ICS *</option>
                   <option value="2">PAR</option>
                   <option value="1">ICS</option>
                   <option value="3">All</option>
                 </select><br><br>
                <button class="btn green darken-4" type="submit"><div class="fa fa-search"></div> Show</button>
                <?php echo form_close(); ?>
              </div>
             
           </span>
         </div>
         </li>  <!--  user by accountcode -->
       </ul>
      </div>
      <div class="col s7">
        <ul class="collection with-header enduser">
          <li class="collection-header"><h5>End Users</h5>
          </li>
          <li class="collection-item">No data to show!</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script>
function show_1(){
  document.getElementById('_opt_1').style.display ='block';
  document.getElementById('_opt_2').style.display='none';
}
function show_2(){
  document.getElementById('_opt_1').style.display = 'none';
  document.getElementById('_opt_2').style.display = 'block';
}

</script>