<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
input#Username, input#Password {
    border: 1px solid rgba(0, 0, 0, 0.32);
    padding: 6px 12px;
    border-radius: 5px;
    height: 2rem !important;
}

.bot {
	/*background-color: red;*/
    border: none !important;
    border-radius: 0px !important;
    width: 100% !important;
    margin: 0 auto !important;
    box-shadow: none !important;
}

div#regLeftSection {
width: 0;
    height: 0;
    border-top: 20px solid transparent;
    border-left: 30px solid #eaeaea;
    border-bottom: 20px solid transparent;
    content: " ";
    position: absolute;
    right: -29px;
}



</style>



<div class="row" style="padding-bottom: 0px !important; display: flex; margin-bottom: 0px;">


	<div class="col s4" style="background-color: #eaeaea; padding: 50px; position: relative;" >
		<div id="regLeftSection"></div>
			<h4>Sign Up</h4>
			<br/>

			<p><strong>Sign Up with your simple details. it will be cross checked by the administration.</strong></p>




	</div>

	<div class="col s8">
		<div class="col s8" style="margin: 0 auto !important; float:none !important;">
			 <div class="col s4 offset-s4 bot" style="margin-top:35px;margin-bottom:15px;border-radius:15px;padding:100px 40px 0px 40px">
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
			<div class="col-md-12">
				<div class="page-header">
					<!-- <h5><strong>Register New User</strong></h5> -->
				</div>
				<?= form_open() ?>
					<div class="form-group">
						<!-- <label for="username">Username</label> -->
						<input type="text" class="form-control" id="Username" name="Username" placeholder="Enter a username">
				
					</div>

					<div class="form-group">
						<!-- <label for="password">Password</label> -->
						<input type="password" class="form-control" id="Password" name="Password" placeholder="Enter password">
					
					</div>

					<div class="form-group">
					<label class="mdc-floating-label mdc-floating-label--float-above">Access Level</label>
					  <select class="mdc-select__native-control" name="AccessLvl" id="AccessLvl" style="display: inline-block !important;">
					  	<option value="" disabled selected>Account Type</option>
					    <option value="Administrator">
					      Administrator
					    </option>
					    <option value="Accounting">
					      Accounting
					    </option>
					    <option value="OfficeRep">
					      Office Rep
					    </option>
					  </select>
					 
					  <div class="mdc-line-ripple"></div>
					</div>


					<br/>
					<br/>

					<div class="form-group">
						<input type="submit" class="btn btn-default green darken-4" value="Register">
					</div>
					<br/>
					<br/>
				</form>
			</div>
		</div>
		</div>
</div>
</div><!-- .row -->

