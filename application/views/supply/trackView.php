<style type="text/css">
	.tab-section{
		border: 1px solid rgba(0, 0, 0, 0.09);
		background-color: rgba(0, 0, 0, 0.05);
		padding: 10px;
		margin-bottom: 20px;
	}

	.searchRadioBtn {
		position: inherit !important;
		opacity: 1 !important;
	}

	._searchBox {
	    background-color: #fff !important;
	    text-indent: 10px !important;
	    border: 1px solid rgba(0, 0, 0, 0.20) !important;
	    height: 35px !important;
	}

.detailsContainer > div> input {
	    margin: 0px !important;
	    width: 75% !important;
	    display: inline-block;
	    text-indent: 10px;
	    height: 2rem !important;
	    padding: 7px 0px 0px !important;
	    font-weight: 500;
	    border-bottom: none !important;
        margin: 0 !important;
}

	.detailsContainer > div > p {
		display: inline-block;
    	margin: 10px 0px 5px !important;
    	color: #797979;
	}

</style>

<section class='header container'>
	<h6>Property Management Office</h6>
	<h4>Property Number History Tracker</h4>
  <hr>
</section>

<div class="container">
  <div class="row">
		<div class="tab-section">
			<div class="row" style="padding:15px 15px 0px !important; margin-bottom: 0px !important;">
				<div class="col s4">
					<input style="padding-bottom: 0px !important;" type="text" name="search_PN" class="_searchBox" id="search_PN" value="" placeholder="Property Number" onkeypress="handleEnter(event)">
				</div> 
				<div class="col s4">
					<input type="text" name="search_WN" class="_searchBox" id="search_WN" placeholder="Waste Number">
				</div> 
				<div class="col s1">
					<button class="btn" id="searchBtn" >Search</button>
					<!-- onclick="_search_by_PN()" -->
				</div> 
			</div>
        </div>

        <div class="tab-section">
        	<div id="content">

        	<div class="col s6">
        	 <div>
			 <div class="col s12" id="_result_PN"><input type="text" name="_result_PNV" id="_result_PNV" readonly></div>
			
			  <ul class="timeline" id="timeline">
			    <!-- <li class="event" data-date="2018">
			      <h3>Official Reciept Given</h3>
			      <p>Sed posuere consectetur est at lobortis. Nullam quis risus eget urna mollis ornare vel eu leo..</p>
			    </li> -->
			  </ul>

			</div>
			</div>
			<div class="col s6">
				<div>
					<div class="col s12" id="_result_Details">Current End User Details:</div>
					<div class="detailsContainer">
						<div>
							<p class="col s3">Family Name:</p>
							<input type="text" id="_result_LName" name="_result_LName" value="" readonly>
						</div>
						<div>
							<p class="col s3">First Name:</p>
							<input type="text" id="_result_FName" name="_result_FName" value="" readonly>
						</div>
						<div>
							<p class="col s3">Middle Name:</p>
							<input type="text" id="_result_MName" name="_result_MName" value="" readonly>
						</div>
						<div>
							<p class="col s3">Office:</p>
							<input type="text" id="_result_Office" name="_result_Office" value="" readonly> 
						</div>
						<div>
							<p class="col s3">Position:</p>
							<input type="text" id="_result_Position" name="_result_Position" value="" readonly>
						</div>
					<!-- 	<p>Middle Name: Day</p>
						<p>Office: SPPMO</p>
						<p>Position: Admin aid I</p> -->
					</div>
				</div>
				<div>
					<div class="col s12" id="_result_Details">PAR/ICS Details:</div>
					<div class="detailsContainer">
						<div>
							<p class="col s3">Parics #:</p>
							<input type="text" id="_result_Parics" name="_result_Parics" value="" readonly>
						</div>
						<div>
							<p class="col s3">Doc Type:</p>
							<input type="text" id="_result_Type" name="_result_Type" value="" readonly>
						</div>
						<div>
							<p class="col s3">PO #:</p>
							<input type="text" id="_result_PO" name="_result_PO" value="" readonly>
						</div>
						<div>
							<p class="col s3">PR #:</p>
							<input type="text" id="_result_PR" name="_result_PR" value="" readonly>
						</div>
						<div>
							<p class="col s3">OR #:</p>
							<input type="text" id="_result_OR" name="_result_OR" value="" readonly>
						</div>
						<div>
							<p class="col s3">Obligation:</p>
							<input type="text" id="_result_obligation" name="_result_obligation" value="" readonly>
						</div>
						<div>
							<p class="col s3">Fund Cluster:</p>
							<input type="text" id="_result_FCluster" name="_result_FCluster" value="" readonly>
						</div>
						<div>
							<p class="col s3">Supplier:</p>
							<input type="text" id="_result_Supplier" name="_result_Supplier" value="" readonly>
						</div>
						<div>
							<p class="col s3">Date OR Given:</p>
							<input type="text" id="_result_Given" name="_result_Given" value="" readonly>
						</div>
						<div>
							<p class="col s3">Date Issued:</p>
							<input type="text" id="_result_DateIssued" name="_result_DateIssued" value="" readonly>
						</div>

						<div>
							<p class="col s3">Date Forwarded:</p>
							<input type="text" id="_result_Forwarded" name="_result_Forwarded" value="" readonly>
						</div>
						<div>
							<p class="col s3">Date Posted:</p>
							<input type="text" id="_result_Posted" name="_result_Posted" value="" readonly>
						</div>
					</div>
				</div>
				<div>
					<div class="col s12" id="_result_Details">Equipment Details:</div>
					<div class="detailsContainer">
						<div>
							<p class="col s3">Description:</p>
							<input type="text" id="_result_Desc" name="_result_Desc" value="" readonly>
						</div>
						<div>
							<p class="col s3">Total Quantity:</p>
							<input type="text" id="_result_Qty" name="_result_Qty" value="" readonly>
						</div>
						<div>
							<p class="col s3">Unit Price:</p>
							<input type="text" id="_result_UPrice" name="_result_UPrice" value="" readonly>
						</div>
					
						<div>
							<p class="col s3">Expense Code:</p>
							<input type="text" id="_result_expense" name="_result_expense" value="" readonly>
						</div>
						<div>
							<p class="col s3">Office:</p>
							<input type="text" id="_result_office" name="_result_office" value="" readonly>
						</div>
					</div>
				</div>
				<div>
					<div class="col s12" id="_result_Details">Transfer History:</div>
					<div class="detailsContainer">
						<table id="_transferHistory">
							<tr>
							    <th>Transfer #:</th>
							    <th>From:</th>
							    <th>To:</th>
							    <th>Date</th>
							
							</tr>
							<tr>
								<td>2018-9-22</td>
								<td>Maria Anders</td>
								<td>John Doe</td>
								<td>2018-10-23</td>
							
							</tr>
							<tr>
								<td>2018-9-33</td>
								<td>John Doe</td>
								<td>Doe John</td>
								<td>2018-10-30</td>
							
							</tr>
						</table>

					</div>
				</div>
				<div>
					<div class="col s12" id="_result_Details">Waste and Restore History:</div>
					<div class="detailsContainer">
						<table id="_wasteHistory">
							<tr>
							    <th>Waste #:</th>
							    <th>Date:</th>
							    <th>Action:</th>
							    <th>By:</th>
							</tr>
							<tr>
								<td>2018-23</td>
								<td>2018-9-23</td>
								<td>Wasted</td>
								<td>John Doe</td>
							</tr>
							<tr>
								<td>2018-23</td>
								<td>2018-9-23</td>
								<td>Restore</td>
								<td>John Doe</td>
							</tr>
						</table>

					</div>
				</div>


			</div>
			</div>
        </div>

	</div>
</div>
