<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>

.form-group {
    width: 30% !important;
    display: inline-block !important;
    margin: 0 0 20px 0 !important;
}

.cusInput {

    border: 1px solid #0000002e !important;
    padding: 6px 12px!important;
    height: 1rem !important;
    border-radius: 5px !important;
    /* margin-right: 16px !important; */
    /* display: inline-block; */
    width: 90% !important;
    margin: 0 0 20px 0 !important;

}


</style>



<div class="container">
	<div class="row">

		<div class="col-md-12">
			<div class="page-header">
				<h3>Add new personnel</h3>
			</div>
			<?= form_open() ?>
				<div class="form-group">
					<input type="text" class="form-control  cusInput" id="IDNum" name="IDNum" placeholder="ID Number">
				</div>
				<div class="form-group">
					<input type="text" class="form-control cusInput" id="EmpNo" name="EmpNo" placeholder="Employee Number">
				
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control  cusInput" id="surName" name="surName" placeholder="Family Name">
				</div>

				<div class="form-group">
					<input type="text" class="form-control cusInput" id="firstName" name="firstName" placeholder="First Name">
				</div>

				<div class="form-group">
					<input type="text" class="form-control cusInput" id="middleName" name="middleName" placeholder="Middle Name">
				</div>

				<div class="form-group">
					<input type="text" class="form-control cusInput" id="suffixName" name="suffixName" placeholder="Suffix Name">
				</div>

<!-- 				<div class="form-group">
					<input type="text" class="form-control cusInput" id="nameTitleID" name="nameTitleID" placeholder="Name Title">
				</div>
 -->

				<div class="form-group">
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


				<div class="form-group">
					<input type="text" class="form-control cusInput datepicker2" id="bday" name="bday" placeholder="Birth Date">
				</div>


				<div class="form-group">
					<input type="text" class="form-control cusInput" id="bplace" name="bplace" placeholder="Birth Place">
				</div>


				<div class="form-group">
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


				<div class="form-group">
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



				<div class="form-group">
					<input type="text" class="form-control cusInput" id="addHome" name="addHome" placeholder="Address">
				</div>

				<div class="form-group">
					<input type="text" class="form-control cusInput" id="addEmail" name="addEmail" placeholder="Mail Address">
				</div>


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
                <select name="positionID" class="select2 offCode mdc-select__native-control" required autocomplete="off" id="positionID">
                  <?php if($positions): ?>
                    <option disabled selected value="0" class="cusInput">Choose Positon</option>
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

	

				<div class="form-group">
					<input type="text" class="form-control cusInput" id="shiftID" name="shiftID" placeholder="Shift">
				</div>

				<div class="form-group">
					<input type="text" class="form-control cusInput" id="appointID" name="appointID" placeholder="Appoint">
				</div>




				<br/>
				<br/>

				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Register">
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->