<div class="well">
    <div class="errorresponse">
        
    </div>
    <form class="form" id="frmupdate" role="form" action="<?php echo base_url() ?>personnel/view/update" method="POST">
    <?php foreach($query->result() as $row):?>
                        
                          <div class="form-group">
                            <label for="exampleInputEmail2">ID #</label>
                            <input type="text" name="IDNum" class="form-control" value="<?php echo $row->IDNum?>">
                          </div>
                          
                          <div class="form-group">
                            <label for="exampleInputEmail2">Emp #</label>
                            <input class="form-control" name="EmpNo" type="text" value="<?php echo $row->EmpNo?>">
                          </div>
                          
                          <div class="form-group">
                            <label for="exampleInputPassword2">Family Name</label>
                            <input type="text" class="form-control" name="surName" value="<?php echo $row->surName?>">
                          </div>
                          
                          <div class="form-group">
                            <label for="exampleInputPassword2">First Name</label>
                            <input type="text" name="firstName" class="form-control" value="<?php echo $row->firstName?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Middle Name</label>
                            <input type="text" name="middleName" class="form-control" value="<?php echo $row->middleName?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">suffix</label>
                            <input type="text" name="suffixName" class="form-control" value="<?php echo $row->suffixName?>">
                          </div>


                          <div class="form-group">
                            <label for="exampleInputPassword2">Name Title</label>
                            <input type="text" name="nameTitleID" class="form-control" value="<?php echo $row->nameTitleID?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Birth Date</label>
                            <input type="text" name="bday" class="form-control" value="<?php echo $row->bday?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Birth Place</label>
                            <input type="text" name="bplace" class="form-control" value="<?php echo $row->bplace?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Gender</label>
                            <input type="text" name="sex" class="form-control" value="<?php echo $row->sex?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Civil Status</label>
                            <input type="text" name="civilStatID" class="form-control" value="<?php echo $row->civilStatID?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Address</label>
                            <input type="text" name="addHome" class="form-control" value="<?php echo $row->addHome?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Mail Address</label>
                            <input type="text" name="addEmail" class="form-control" value="<?php echo $row->addEmail?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Office</label>
                            <input type="text" name="officeID" class="form-control" value="<?php echo $row->officeID?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Position</label>
                            <input type="text" name="positionID" class="form-control" value="<?php echo $row->positionID?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Shift</label>
                            <input type="text" name="shiftID" class="form-control" value="<?php echo $row->shiftID?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword2">Appoint</label>
                            <input type="text" name="appointID" class="form-control" value="<?php echo $row->appointID?>">
                          </div>

                          <div class="form-group">
                            <input type="hidden" name="hidden" value="<?php echo $personID ?>"/>
                            <input type="submit" class="btn btn-success" id="exampleInputPassword2" value="update">
                          </div>
        <?php endforeach;?>
                        </form>
                    </div>
</div>

<script>
$(document).ready(function (){
    $("#frmupdate").submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'<?php echo base_url() ?>home/update',
            type:'POST',
            dataType:'json',
            data: $("#frmupdate").serialize()
        }).done(function (data){
            window.mydata = data;
                if(mydata['error'] !=""){
                    $(".errorresponse").html(mydata['error']);
                }
                else{
                $(".errorresponse").text('');
                $('#frmupdate')[0].reset();
                $("#response").html(mydata['success']);
                
                $.colorbox.close();
                $("#response").html(mydata['success']);
                }
        });
    });    
});

    
</script>
