function getLastSeq(){
  var pathArray = window.location.pathname.split( '/' );
  var pathName;
  if(pathArray[1]!="sppmo"){
    pathName=pathArray[1]+"/sppmo";
  }else{
    pathName="sppmo";
  }

  var d = new Date();
  var n = d.getFullYear();

  var base_url = window.location.origin + "/" + pathName + "/";
  $.ajax({
      type:"POST",
      url: base_url + "supply/viewLastSeq",
      dataType: "json",
      success: function(result){
          lastSeq=result.curSeqs[0].wasteNumber;
          res = parseFloat(lastSeq.split("-").pop());
          $("#lastSeq").val(res + 1);
          res_val = $("#lastSeq").val();
          _seqNumber = n + "-" + res_val;
          // alert (_seqNumber);
      }
  });
}


function refresh_equipment(){
    var pathArray = window.location.pathname.split( '/' );
    var pathName;

    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }

    var base_url = window.location.origin + "/" + pathName + "/";
    EID = $(".eq").val();
    $.ajax({
        type:"POST",
        data:{EID: EID},
        url: base_url + "supply/viewEqpt",

        dataType: "JSON",

        success: function(result){
            var html="";
            var i;
            var tempPosted = $("#isPosted").val();

            for(i=0; i<result.specificProp.length; i++){
            var _propNumber = result.specificProp[i].propertyNumber;

              if(tempPosted==1){

                  if(result.specificProp[i].isWasted==1){
                    status="<div class='wasted_wrapper'>wasted</div>";
                    action_btn="<div class=''>Restore</div>";
                  }else{
                    status="";
                    action_btn="<a href='#waste_Modal' class='item-waste' data-id='"+result.specificProp[i].id+"' data-equipment_id='"+result.specificProp[i].equipmentID+"' data-property_number='"+_propNumber+"' data-is_wasted='"+result.specificProp[i].isWasted+"' data-is_transferred='"+result.specificProp[i].isTransferred+"' data-w_notes='"+result.specificProp[i].notes+"' data-last_seq='"+_seqNumber+"'>Waste</a>";
                  }

                  if(result.specificProp[i].isTransferred!=0){
                    statusT="<div class='transferred_wrapper'>Transferred</div>";
                  }else{
                    statusT="";
                  }

              }else{
                  action_btn="<a href='#waste_Modal' disabled='disabled' class='item-waste' data-id='"+result.specificProp[i].id+"' data-equipment_id='"+result.specificProp[i].equipmentID+"' data-property_number='"+_propNumber+"' data-is_wasted='"+result.specificProp[i].isWasted+"' data-is_transferred='"+result.specificProp[i].isTransferred+"' data-w_notes='"+result.specificProp[i].notes+"' data-last_seq='"+_seqNumber+"'>Waste</a>";
                  statusT="";
              }
              codeContainer = "<svg class='barcodes' jsbarcode-format='code128' jsbarcode-value='"+result.specificProp[i].propertyNumber+"' jsbarcode-fontoptions='' jsbarcode-textmargin='0' jsbarcode-width='1' jsbarcode-height='30' jsbarcode-fontSize='12' jsbarcode-background='rgba(255, 255, 255, 0);'></svg>";

              // not yet set              
              transfer_btn = "<a href='javascript:void(0);'' class='item_transfer' data-id='"+result.specificProp[i].id+"'>Transfer</a>";
              view_btn = "<a href='' class='' data-id='"+result.specificProp[i].id+"'>View</a>";
              // not yet set

                html += '<tr>' +
                        '<td hidden>'+result.specificProp[i].id+'</td>'+
                        '<td hidden>'+result.specificProp[i].equipmentID+'</td>'+
                        '<td hidden>'+result.specificProp[i].propertyNumber+'</td>'+
                        '<td>'+codeContainer+'</td>'+
                        '<td>'+status+'</td>'+
                        '<td>'+statusT+'</td>'+
                        '<td><label class="dropdown">'+
                             '<div class="dd-button">Action</div>'+
                             '<input type="checkbox" class="dd-input" id="test">' +
                                '<ul class="dd-menu">'+
                                  '<li>'+action_btn+'</li>'+
                                  '<li>'+transfer_btn+'</li>' +
                                  '<li>'+view_btn+'</li>'+
                                '</ul>'+
                              '</label>' +
                        '</td>' +

                        // '<td style="text-align:center;">'+ action_btn+' '+
                        //   '<a href="javascript:void(0);" class="btn item_transfer" data-id="'+result.specificProp[i].id+'">Transfer</a>'+ ' '+
                        //   '<a href="" class="btn item_view" data-id="'+result.specificProp[i].id+'">View</a>'+
                        // '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);

            JsBarcode(".barcodes").init();

            if(tempPosted==0){
                  document.getElementById('_printAllBarcode').className += " hidden";
                  document.getElementById('_wasteBulkItem').className += " hidden";
                  document.getElementById('_transBulkItem').className += " hidden";                
            }else{
                  document.getElementById('_printAllBarcode').className -= " hidden";
                  document.getElementById('_wasteBulkItem').className -= " hidden";
                  document.getElementById('_transBulkItem').className -= " hidden";                
            }

              d = new Date();
              $(".barcode").attr("src",base_url+"assets/images/bc.png?"+d.getTime());

            var amt,qty,price,str,year;
            if(result.specificEqpt.length>0){
              qty=parseFloat(result.specificEqpt[0].qty);
              price=parseFloat(result.specificEqpt[0].unitPrice);
              
              // get the 2 digit year for propertyNumber generation
              str=result.specificEqpt[0].dateIssued;
              res=str.replace(/-/g, "");
 
              year=res.charAt(2) + res.charAt(3) + res.charAt(4) + res.charAt(5) + res.charAt(6) + res.charAt(7);
              // get the 2 digit year for propertyNumber generation

              amt=qty*price;
              if(result.specificEqpt[0].subCode==null)
                sub="";
              else {
                sub=result.specificEqpt[0].subCode;
              }
              $("#eqpticscode").text(checker(result.specificEqpt[0].code+sub));
              $("#eqpticsspec").text(checker(result.specificEqpt[0].equipmentDesc));
              $("#eqpticslife").text(checker(result.specificEqpt[0].life));
              $("#eqpticsqty").text(checker(result.specificEqpt[0].qty));
              $("#eqpticsunit").text(checker(result.specificEqpt[0].unit));
              $("#eqpticsseq").text(checker(result.specificEqpt[0].seq));
              $("#eqpticsoff").text(checker(result.specificEqpt[0].office+" - "+result.specificEqpt[0].officeCode));
              $("#eqpticsprice").text(thousandSeparator(((price*100)/100).toFixed(2)));
              $("#eqpticsamt").text(thousandSeparator(((amt*100)/100).toFixed(2)));
              $("#officeID").val(result.specificEqpt[0].officeID).trigger("change");
              $("#propertyID").val(result.specificEqpt[0].propertyID).trigger("change");
              $("#equipmentDesc").val(result.specificEqpt[0].equipmentDesc);
              $("#dateGiven").val(result.specificEqpt[0].dateGiven);
              $("#life").val(result.specificEqpt[0].life);
              $("#qty").val(result.specificEqpt[0].qty);
              $("#unit").val(result.specificEqpt[0].unit);
              //$("#Fund").val(result.specificEqpt[0].fundID).trigger("change");
              $("#seq").val(result.specificEqpt[0].seq);
              $("#unitPrice").val(thousandSeparator(((price*100)/100).toFixed(2)));
              $("#last_seq").val(_seqNumber);

            }

        }
    });

}


$(document).on('click','.viewData',function (e) {
    e.preventDefault();
    // var socket = io.connect( 'http://'+window.location.hostname+':3000' );
    // socket.emit('open', {

    // });

    $( "#load" ).show();
    var preserve="";
    var areID=$(this).parent().find('.AREID').text();
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";
    var doc="";
    $(".are").val(areID);
    preserve=areID.match(/\d+/).toString();
    //alert(preserve)
    $.ajax({
        type:"POST",
        data:{areID: preserve},
        url: base_url + "supply/viewSupply",
        dataType: "json",
        success: function(result){
        
            //console.log(result);
            doc=result.supplyDetails[0].docType;
            lastSeq=result.curSeqs[0].wasteNumber;
            var res = parseFloat(lastSeq.split("-").pop());
            $("#lastSeq").val(res + 1);
            
       

            if(result.supplyDetails.length>0){
              if (doc==2) {
                // $('#whenIcs').addClass('showBtn');
                // $('#whenPar').attr("href", "#modalPar");
                temp="Property Acknowledgement Receipt";
                temp2="PAR Number:";
                temp3="Equipment";
                temp4="Equipment Code";
                temp5="Equipment Details";
                temp6="New Equipment";
           
                
                $('#lifespan2').val("");
              }else if(doc==1){
                // $('#whenPar').addClass('showBtn');
                 // $('#whenPar').attr("href", "#modal5");
                temp="Inventory Custodian Slip";
                temp2="ICS Number:";
                temp3="Inventory Item";
                temp4="Expense Code";
                temp5="Inventory Item Details";
                temp6="New Inventory";

                // $('#whenIcs').addClass('hidden');
                $('#lifespan2').val("5");
              }
              $('.paricsIDhidden').val(result.supplyDetails[0].paricsID);
              $('.p_ID').val(result.supplyDetails[0].equipmentID);
              $('.fundCode').val(result.supplyDetails[0].fundCode);
              $('#paricstext').text(checker(temp));
              $('#paricsacronym').text(checker(temp2));
              $('#eqptinv').text(checker(temp3));
              $('.paricscode').text(checker(temp4));
              $('#eqpticsdetails').text(checker(temp5));
              $('#paricsnumber').text(checker(result.supplyDetails[0].parics));
              $('#parics').val(result.supplyDetails[0].parics);
              $('#docType').val(result.supplyDetails[0].docType);
              $('#dateIssued2').text(checker(result.supplyDetails[0].dateIssued));
              $('#dateIssued').val(result.supplyDetails[0].dateIssued);
              $('.new').text(checker(temp6));
              $(".are").val(preserve);
              $(".eqptics").text(temp4);
              $("#Code").val(result.supplyDetails[0].parics);
              $("#personID").val(result.supplyDetails[0].personID).trigger("change");
              $('#obligation2').text(checker(result.supplyDetails[0].obligation));
              $('#obligation').val(result.supplyDetails[0].obligation);
              $('#po2').text(checker(result.supplyDetails[0].poNumber));
              $('#poNumber').val(result.supplyDetails[0].poNumber);
              $('#pr2').text(checker(result.supplyDetails[0].prNumber));
              $('#prNumber').val(result.supplyDetails[0].prNumber);
              $('#eqpticsor').text(checker(result.supplyDetails[0].orNumber));
              $('#orNumber').val(result.supplyDetails[0].orNumber);
              $('#eqpticssupp').text(checker(result.supplyDetails[0].supplier));
              $('#supplierID').val(result.supplyDetails[0].supplierID).trigger("change");
              $('#eqpticsordate').text(checker(result.supplyDetails[0].dateGiven));
              $('#dateGiven').val(result.supplyDetails[0].dateGiven);
              $('#isPosted').val(result.supplyDetails[0].isPosted);
              $('#eqpticsfund').text(checker(result.supplyDetails[0].fundCode));
              $('#fundID').val(result.supplyDetails[0].fundID).trigger("change");
              $('.postDateDoc').text(checker(result.supplyDetails[0].dateIssued));
              $('.paricsID2').val(result.supplyDetails[0].paricsID);
              $('.postPar').text(checker(result.supplyDetails[0].parics));

            }else{
              $('#parics').text("--");
              $('#paricsacronym').text("--");
              $('#paricsnumber').text("--");
              $('#dateIssued2').text("--");
              $('#obligation2').text("--");
              $('#po2').text("--");
              $('#pr2').text("--");
            }


              if(result.personDetails.length>0){
                var lName,fName,mName,sName;
                lName=checker(result.personDetails[0].surName);
                fName=checker(result.personDetails[0].firstName);
                mName=checker(result.personDetails[0].middleName);
                sName=checker(result.personDetails[0].suffixName);
                if(sName=="--"){
                  sName="";
                }
                if(mName=="--"){
                  mName="";
                }
                if(fName=="--"){
                  fName="";
                }
                if(lName=="--"){
                  lName="";
                }
                $('#name').text(lName+", "+fName+" "+mName+" "+sName);
                $('#position').text(checker(result.personDetails[0].position));
                $('#office').text(checker(result.personDetails[0].office));
                $('.postUserDoc').text(lName+", "+fName+" "+mName+" "+sName);
              }else{
                $('#name').text("--");
                $('#position').text("--");
                $('#office').text("--");
              }

            $('.eqpt > tbody').empty();
            if(result.equipments.length>0){

              var amt,qty,price,code, wqty;
              for(var i=0;i<result.equipments.length;i++){
                qty=parseFloat(result.equipments[i].qty);
                wqty=parseFloat(result.equipments[i].wastedQty);
                price=parseFloat(result.equipments[i].unitPrice);
                amt=qty*price;

                if(doc==2){
                  code=result.equipments[i].code+result.equipments[i].subCode;
                }else if(doc==1){
                  code=result.equipments[i].code;
                }
                icons="";
                if(result.equipments[i].isPosted==1){
                  // icons=`
                  // <a class="tooltipped controlIcon waste" data-position="top" data-delay="1" data-tooltip="Waste" href="#wasteEquipment"><div class="fa fa-recycle effectIcon"></div></a></a>&nbsp;&nbsp;
                  // <a class="tooltipped controlIcon trans" data-position="top" data-delay="1" data-tooltip="Transfer" href="#transferEquipment"><div class="fa fa-share effectIcon"></div></a>&nbsp;&nbsp;`;
                  icons=``;
                }else{
                  icons=`<a class="tooltipped controlIcon eqptdelete" data-position="top" data-delay="1"
                  data-tooltip="Delete" href="#delEqpt"><div class="fa fa-times effectIcon"></div></a>`;
                }
                var status,color="";
                  //console.log(result)
                if(result.equipments[i].isWasted==1){
                  if(qty==wqty){
                  status="<div style='background-color: #ff3535; color: #ffffff; border-radius: 5px; padding: 1px 10px 1px 5px'><i class='fa fa-trash' aria-hidden='true'></i> • "+result.equipments[i].wastedQty+"</div>";
                  color="style='background-color: rgb(242, 222, 222)'";
                  icons=``;  
                  }else{
                  status="<div style='background-color: #f79b3d; color: #ffffff; border-radius: 5px; padding: 1px 10px 1px 5px'><i class='fa fa-trash' aria-hidden='true'></i> • "+result.equipments[i].wastedQty+"</div>";
                  color="style='background-color: rgb(242, 222, 222);'";
                  // icons=`<a class="tooltipped controlIcon waste" data-position="top" data-delay="1" data-tooltip="Waste" href="#wasteEquipment"><div class="fa fa-recycle effectIcon"></div></a></a>&nbsp;&nbsp;
                  // <a class="tooltipped controlIcon trans" data-position="top" data-delay="1" data-tooltip="Transfer" href="#transferEquipment"><div class="fa fa-share effectIcon"></div></a>&nbsp;&nbsp;`;
                  }
                  
                }else if(result.equipments[i].isTransferred==1){
                  status="T ("+result.equipments[i].tsur+", "+result.equipments[i].tfirst+" "+result.equipments[i].tmiddle+" "+result.equipments[i].tsuffix+")";
                  color="style='background-color: #a5ff95'";
                }else{
                  status="No Changes"
                }
                $(`<tr `+color+`>
                    <td>`+result.equipments[i].equipmentID+`</td>
                    <td>`+code+`</td>
                    <td>`+result.equipments[i].qty+`</td>
                    <td>`+result.equipments[i].unit+`</td>
                    
                    <td style="width:30em">`+result.equipments[i].equipmentDesc+`</td>
                    <td>`+thousandSeparator(((price*100)/100).toFixed(2))+`</td>
                    <td>`+thousandSeparator(((amt*100)/100).toFixed(2))+`</td>
                    <td>`+status+`</td>
                    <td>
                    <a class="tooltipped viewEqpt controlIcon" data-position="top" data-delay="1" data-tooltip="View" href="#modal2">
                    <div class="fa fa-eye effectIcon"></div>
                    </a>&nbsp;&nbsp;`+icons+`
                    </td>
                    <td hidden>`+result.equipments[i].wastedQty+`</td>
                    
                    </tr>`).appendTo('.eqpt > tbody');
                }
              }


              if(doc==2){
                $(".prints").css('visibility', 'visible').attr("href", base_url+"printparics/pdfprintS/"+preserve);
                $(".print").attr("href", base_url+"printparics/pdfprint/"+preserve);
                $(".print2").attr("href", base_url+"printparics/gamPar/"+preserve);
              }else if(doc==1){
                $(".prints").css('visibility', 'hidden')
                $(".print").attr("href", base_url+"printparics/pdfprint2/"+preserve);
                $(".print2").attr("href", base_url+"printparics/gamIcs/"+preserve);
              }
              $(".tooltipped").tooltip();
              $(document).off('mouseover mouseout','.d1');
              if(result.supplyDetails[0].isPosted==1){
                $('.postedStat').css("display","none");
                $("#datePosted2").text("Date Posted: "+result.supplyDetails[0].datePosted);
                $('#datePosted2').css("display","");
              }else{
                /*$(document).on('mouseover mouseout','.d1',function(){
                  $(this).find('.editData').toggle();
                });*/
                $('#datePosted2').css("display","none");
                $('.postedStat').css("display","");
              }

              $(document).on('mouseover mouseout','.d1',function(){
                $(this).find('.editData').toggle();
              }); //temp
              $( "#load" ).hide();



        }
    });
});


$(document).on('click','.item_transfer', function(e){

  

});


$(document).on('click','.viewEqpt',function(e) {

    e.preventDefault();
    $( "#load" ).show();
    var EID=$('td:first', $(this).parents('tr')).text();
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";
    $(".eq").val(EID); //get the mother of propertyNumbers


// if($data['specificProp'].length==0){
//   alert ("walay sud");
// }

    $.ajax({
        type:"POST",
        data:{EID: EID},
        url: base_url + "supply/viewEqpt",
        dataType: "json",
        success: function(result){
            //console.log(result);
            var html="";
            var i;
           
            // var res = parseFloat(lastSeq.split("-").pop());
            // var seQ = (res + 1);
            // $("#lastSeq").val(res + 1);
            var tempPosted = $("#isPosted").val();
            // alert (result.specificEqpt[i].isPosted);


            for(i=0; i<result.specificProp.length; i++){
    
              var _propNumber = result.specificProp[i].propertyNumber;
              // alert (result.specificProp[i].isWasted);
              if(tempPosted==1){
                  if(result.specificProp[i].isWasted==1){
                    status="<div class='wasted_wrapper'>wasted</div>";
                    action_btn="<div class=''>Restore</div>";
                  }else{
                    status="";
                    action_btn="<a href='#waste_Modal' class='item-waste' data-id='"+result.specificProp[i].id+"' data-equipment_id='"+result.specificProp[i].equipmentID+"' data-property_number='"+_propNumber+"' data-is_wasted='"+result.specificProp[i].isWasted+"' data-is_transferred='"+result.specificProp[i].isTransferred+"' data-w_notes='"+result.specificProp[i].notes+"' data-last_seq='"+_seqNumber+"'>Waste</a>";
                  }

                  if(result.specificProp[i].isTransferred!=0){
                    statusT="<div class='transferred_wrapper'>Transferred</div>";
                  }else{
                    statusT="";
                  }

                  transfer_btn = "<a href='#transfer_Modal' class='item_transfer' data-id='"+result.specificProp[i].id+"'>Transfer</a>";
                  view_btn = "<a href='' class='' data-id='"+result.specificProp[i].id+"'>View</a>";

                  var opt_btn_wrapper='<label class="dropdown" id="opt_btn"><div class="dd-button">Action</div><input type="checkbox" class="dd-input" id="chk_btn">' +
                  '<ul class="dd-menu">' +
                  '<li>'+action_btn+'</li>' +
                  '<li>'+transfer_btn+'</li>' +
                  '<li>'+view_btn+'</li>' +
                  '</ul>' +
                  '</label>';

              }else{
                  // action_btn="<a href='#waste_Modal' disabled='disabled' class='item-waste' data-id='"+result.specificProp[i].id+"' data-equipment_id='"+result.specificProp[i].equipmentID+"' data-property_number='"+_propNumber+"' data-is_wasted='"+result.specificProp[i].isWasted+"' data-is_transferred='"+result.specificProp[i].isTransferred+"' data-w_notes='"+result.specificProp[i].notes+"' data-last_seq='"+seQ+"'>Waste</a>";
              
                  // action_btn="<a disabled='disabled' class='item-waste' data-id='"+result.specificProp[i].id+"' data-equipment_id='"+result.specificProp[i].equipmentID+"' data-property_number='"+_propNumber+"' data-is_wasted='"+result.specificProp[i].isWasted+"' data-is_transferred='"+result.specificProp[i].isTransferred+"' data-w_notes='"+result.specificProp[i].notes+"' data-last_seq='"+_seqNumber+"' onclick='return false;'>Waste</a>";
                  statusT="";

                  var opt_btn_wrapper="<label class='dropdown' id='opt_btn'><div class='dd-button'>Action</div>"+
                  "<input type='checkbox' disabled='disabled' class='dd-input' id='chk_btn'>" +
                  "</label>";

              }

                // new barcode
                codeContainer = "<svg class='barcodes' jsbarcode-format='code128' jsbarcode-value='"+result.specificProp[i].propertyNumber+"' jsbarcode-fontoptions='' jsbarcode-textmargin='0' jsbarcode-width='1' jsbarcode-height='30' jsbarcode-fontSize='12' jsbarcode-background='rgba(255, 255, 255, 0);'></svg>";
                // new barcode

                html += '<tr>' +
                        '<td hidden>'+result.specificProp[i].id+'</td>'+
                        '<td hidden>'+result.specificProp[i].equipmentID+'</td>'+
                        '<td hidden>'+result.specificProp[i].propertyNumber+'</td>'+
                        '<td>'+codeContainer+'</td>'+
                        '<td>'+status+'</td>'+
                        '<td>'+statusT+'</td>'+
                        '<td>'+opt_btn_wrapper+'</td>' +
                        '</tr>';
             }
            // } end for
              $('#show_data').html(html);

              // hide footer buttons when equipment is not posted
              if(tempPosted==0){
                  document.getElementById('_printAllBarcode').className += " hidden";
                  document.getElementById('_wasteBulkItem').className += " hidden";
                  document.getElementById('_transBulkItem').className += " hidden";                
              }else{
                  document.getElementById('_printAllBarcode').className -= " hidden";
                  document.getElementById('_wasteBulkItem').className -= " hidden";
                  document.getElementById('_transBulkItem').className -= " hidden";                

              }
              //


              JsBarcode(".barcodes").init();

            

            var amt,qty,price,str,year;
            if(result.specificEqpt.length>0){
              qty=parseFloat(result.specificEqpt[0].qty);
              price=parseFloat(result.specificEqpt[0].unitPrice);
              
              // get the 2 digit year for propertyNumber generation
              str=result.specificEqpt[0].dateIssued;
              res=str.replace(/-/g, "");
 
              year=res.charAt(2) + res.charAt(3) + res.charAt(4) + res.charAt(5) + res.charAt(6) + res.charAt(7);
              // get the 2 digit year for propertyNumber generation

              amt=qty*price;
              if(result.specificEqpt[0].subCode==null){
                sub="";
              }else {
                sub=result.specificEqpt[0].subCode;
              }
              $("#eqpticscode").text(checker(result.specificEqpt[0].code+sub));
              $("#eqpticsspec").text(checker(result.specificEqpt[0].equipmentDesc));
              $("#eqpticslife").text(checker(result.specificEqpt[0].life));
              $("#eqpticsqty").text(checker(result.specificEqpt[0].qty));
              $("#eqpticsunit").text(checker(result.specificEqpt[0].unit));
              $("#eqpticsseq").text(checker(result.specificEqpt[0].seq));
              $("#eqpticsoff").text(checker(result.specificEqpt[0].office+" - "+result.specificEqpt[0].officeCode));
              $("#eqpticsprice").text(thousandSeparator(((price*100)/100).toFixed(2)));
              $("#eqpticsamt").text(thousandSeparator(((amt*100)/100).toFixed(2)));
              $("#officeID").val(result.specificEqpt[0].officeID).trigger("change");
              $("#propertyID").val(result.specificEqpt[0].propertyID).trigger("change");
              $("#equipmentDesc").val(result.specificEqpt[0].equipmentDesc);
              $("#dateGiven").val(result.specificEqpt[0].dateGiven);
              $("#life").val(result.specificEqpt[0].life);
              $("#qty").val(result.specificEqpt[0].qty);
              $("#unit").val(result.specificEqpt[0].unit);
              //$("#Fund").val(result.specificEqpt[0].fundID).trigger("change");
              $("#seq").val(result.specificEqpt[0].seq);
              $("#unitPrice").val(thousandSeparator(((price*100)/100).toFixed(2)));
              $("#last_seq").val(_seqNumber);
              //alert(base_url+"assets/images/barcode/1.png")
              
              // var pQty = document.getElementById('eqpticsqty').innerHTML;
              // var i;
              // var propCode = "";

             // for (i =1; i <=pQty; i++) {  

             // propCode += "<input class='p-number data-pnumber" + i +"' value='" +result.specificEqpt[0].code+sub + "-" + result.specificEqpt[0].fundCode + "-" + year + "-" + result.specificEqpt[0].officeCode + "-" + i + "'/>";

             // }

             // document.getElementById("pCode").innerHTML = propCode;

            d = new Date();
              $(".barcode").attr("src",base_url+"assets/images/bc.png?"+d.getTime());
            }
            $( "#load" ).hide();
        }
    });

// ************************************** if old data ******************************* //

// ************************************** end of old data *************************** //
});




//get data for waste record
$('#show_data').on('click','.item-waste',function (e) {

    var property_id = $(this).data('id');
    var equipment_id = $(this).data('equipment_id');
    var d = new Date();
    var n = d.getFullYear(); 
    var seq = $(this).data('last_seq');
    var w_n = seq ;

    var property_number = $(this).data('property_number');
    var is_wasted = $(this).data('is_wasted');
    var is_transferred = $(this).data('is_transferred');
    var w_notes = $(this).data('w_notes');
    
    $('[name="id_waste"]').val(property_id);
    $('[name="equipmentid_waste"]').val(equipment_id);
    $('[name="propertynumber_waste"]').val(property_number);
    $('[name="waste_number"]').val(w_n);
    $('[name="iswasted_waste"]').val(is_wasted);
    $('[name="istransferred_waste"]').val(is_transferred);
    $('[name="notes_waste"]').val(w_notes);
});


$('#searchBtn').on('click',function(){
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";
   // var waste_id = $('#id_waste').val();
     var to_search = $('#search_PN').val();
     // alert (to_search);

    $.ajax({
      type:"POST",
      url: base_url + "supply/get_searchResult",
      data:{to_search:to_search},
      dataType: "JSON",
      success: function(result){
       if(result.searchresults.length>0){

        $('#_result_LName').val(result.searchresults[0].surName);
        $('#_result_FName').val(result.searchresults[0].firstName);
        $('#_result_MName').val(result.searchresults[0].middleName);
        $('#_result_Office').val(result.searchresults[0].office);
        $('#_result_Position').val(result.searchresults[0].position);

        $('#_result_Parics').val(result.searchresults[0].parics);
        if(result.searchresults[0].docType==1){
          $('#_result_Type').val("PAR");  
        }else{
          $('#_result_Type').val("ICS");  
        }

        $('#_result_PO').val(result.searchresults[0].poNumber);
        $('#_result_PR').val(result.searchresults[0].prNumber);
        $('#_result_OR').val(result.searchresults[0].orNumber);
        $('#_result_obligation').val(result.searchresults[0].obligation);
        $('#_result_FCluster').val(result.searchresults[0].fundCode);
        $('#_result_Supplier').val(result.searchresults[0].supplier);
        $('#_result_DateIssued').val(result.searchresults[0].dateIssued);
        $('#_result_Given').val(result.searchresults[0].dateGiven);
        $('#_result_Forwarded').val(result.searchresults[0].forwardDate);
        $('#_result_Posted').val(result.searchresults[0].datePosted);

        $('#_result_Desc').val(result.searchresults[0].equipmentDesc);
        $('#_result_Qty').val(result.searchresults[0].qty);
        $('#_result_UPrice').val(result.searchresults[0].unitPrice);
         $('#_result_office').val(result.searchresults[0].office);
        $('#_result_expense').val(result.searchresults[0].code);


        $('#_result_PNV').val(result.searchresults[0].propertyNumber);
        
        // for(i=0; i<result.specificProp.length; i++){
    
        var d_given = result.searchresults[0].dateGiven;
        var d_issued = result.searchresults[0].dateIssued;

        var d_forward = result.searchresults[0].forwardDate;
        var d_post = result.searchresults[0].datePosted;

        $('<li class="event" data-date="'+d_given+'">' +
            '<h3>Official Reciept Given</h3>' +
            '<p>Sed posuere consectetur est at lobortis.</p>' +
          '</li>' +
          '<li class="event" data-date="'+d_issued+'">' +
            '<h3>Date Issued</h3>' +
            '<p>Sed posuere consectetur est at lobortis.</p>' +
          '</li>' +
          '<li class="event" data-date="'+d_forward+'">' +
            '<h3>Date Forwarded</h3>' +
            '<p>Sed posuere consectetur est at lobortis.</p>' +
          '</li>' +
          '<li class="event" data-date="'+d_post+'">' +
            '<h3>Date Posted</h3>' +
            '<p>Sed posuere consectetur est at lobortis.</p>' +
          '</li>').appendTo('#timeline');
           


       } 

      }
    });
});



// update to waste record
$('#btnUpdate').on('click', function(){
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";
    // var data={};
    // data['waste_id']=$('#id_waste').val();
    // data['equipment_id']=$('#equipmentid_waste').val();
    // data['property_number']=$('#epropertynumber_waste').val();
    // data['is_wasted']= 1;
    // data['is_transferred']=$('#istransferred_waste').val();
    // data['notes']=$('#notes_waste').val();
    // data['waste_number']=$('#waste_number').val();
    // data['date_wasted']=$('#date_wasted').val();


    // tblpropertynumber
    var waste_id = $('#id_waste').val();
    var equipment_id = $('#equipmentid_waste').val();
    var property_number = $('#propertynumber_waste').val();
    var is_wasted = 1;
    var is_transferred = $('#istransferred_waste').val();
    // tblwaste
    var waste_number = $('#waste_number').val();
    var date_wasted = $('#date_wasted').val();
    var notes = $('#notes_waste').val();

    $.ajax({
        type:"POST",
        // data:{EID: EID},
        url: base_url + "supply/updateWaste",
        dataType: "JSON",
        data: { waste_id:waste_id,
         equipment_id:equipment_id,
         property_number:property_number,
          is_wasted:is_wasted,
           is_transferred:is_transferred, 
            notes:notes, 
             waste_number:waste_number, 
              date_wasted:date_wasted},
        success: function(result){
          $('[name="equipmentid_waste"]').val("");
          $('[name="property_waste"]').val("");
          $('[name="iswasted_waste"]').val("");
          $('[name="istransferred_waste"]').val("");
          $('[name="notes_waste"]').val("");
          $('#waste_Modal').modal('close');
          Materialize.toast('<b><div class="fa fa-plus fa-lg" style="color:blue"></div> Item Wasted!</b>', 2000, 'rounded white black-text flow-text');
          getLastSeq();
          refresh_equipment();
        }
    });


getLastSeq();

});




$('#_wasteBulkItem').on('click', function(){


  _equipID=$('.eq').val();
  // var d = new Date();
  // var n = d.getFullYear();
  // var pSeq = parseFloat($('#lastSeq').val());
  // var w_n = n + "-" +pSeq ;
// alert (_seqNumber);
  $('#equip_id_B').val(_equipID);
  $('#waste_number_B').val(_seqNumber);

  var equipment_id_B = $('#equip_id_B').val();
  var waste_number_B = $('#waste_number_B').val();
  var date_wasted_B = $('#date_wasted_B').val();
  var is_wasted_B = 1;

  var is_transferred_B = 0;
  var notes_B = $('#notes_waste_B').val();



  $('#btnWaste_B').on('click', function() {

  var pathArray = window.location.pathname.split( '/' );
  var pathName;
  if(pathArray[1]!="sppmo"){
    pathName=pathArray[1]+"/sppmo";
  }else{
    pathName="sppmo";
  }
  var base_url = window.location.origin + "/" + pathName + "/";

    $.ajax({
        type:"POST",
        url: base_url + "supply/waste_bulk",
        dataType: "JSON",
        data: { equipmentID:equipment_id_B, wasteNumber:waste_number_B, isWasted:is_wasted_B, dateWasted: date_wasted_B, isTransferred:is_transferred_B, notes:notes_B },
        success: function(result){
         $('#waste_Modal_Bulk').modal('close');
    Materialize.toast('<b><div class="fa fa-plus fa-lg" style="color:blue"></div> Item Wasted!</b>', 2000, 'rounded white black-text flow-text');
    getLastSeq();
    refresh_equipment();
        }

    });
    $('#waste_Modal_Bulk').modal('close');
    Materialize.toast('<b><div class="fa fa-plus fa-lg" style="color:blue"></div> Item Wasted!</b>', 2000, 'rounded white black-text flow-text');
    getLastSeq();
    refresh_equipment();
  });
});




$(document).on('submit','.newSupplier',function (e) {
    e.preventDefault();
    $( "#load" ).show();
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    var data={};
    data["supplier"]=$("#supplier").val();
    data["address"]=$("#addr").val();
    data["contactNum"]=$("#contact").val();
    if($("#supplier").val()!="" && $("#supplier").val()!=null){
      $.ajax({
          type:"POST",
          data:{data:data},
          url: base_url + "supply/addSupp",
          dataType: "json",
          success: function(result){
              //console.log(result);
              $( "#load" ).hide();
              var option = new Option(result.supp,result.id);
              option.selected = true;
              $(".supplierPAR").append(option);
              $(".supplierPAR").trigger("change");
              $('#modal6').modal('close');
              $("#supplier").val("");
              $("#addr").val("");
              $("#contact").val("");
              Materialize.toast('<b><div class="fa fa-plus fa-lg" style="color:blue"></div> Supplier Added!</b>', 2000, 'rounded white black-text flow-text');
          }
      });
    }
});

$(document).on('submit','.newPr',function (e) {
    e.preventDefault();
    $( "#load" ).show();
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    var data={};
    data["prNo"]=$("#pr").val();
    if($("#pr").val()!="" && $("#pr").val()!=null){
      $.ajax({
          type:"POST",
          data:{data:data},
          url: base_url + "supply/addPr",
          dataType: "json",
          success: function(result){
              //console.log(result);
              $( "#load" ).hide();
              var option = new Option(result.prNo,result.id);
              option.selected = true;
              $(".prNew").append(option);
              $(".prNew").trigger("change");
              $('#PRAdd').modal('close');
              $("#pr").val("");
              Materialize.toast('<b><div class="fa fa-plus fa-lg" style="color:blue"></div> PR Added!</b>', 2000, 'rounded white black-text flow-text');
          }
      });
    }
});

$(document).on('submit','.newPo',function (e) {
    e.preventDefault();
    $( "#load" ).show();
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    var data={};
    data["poNo"]=$("#po").val();
    if($("#po").val()!="" && $("#po").val()!=null){
      $.ajax({
          type:"POST",
          data:{data:data},
          url: base_url + "supply/addPr",
          dataType: "json",
          success: function(result){
              //console.log(result);
              $( "#load" ).hide();
              var option = new Option(result.poNo,result.id);
              option.selected = true;
              $(".poNew").append(option);
              $(".poNew").trigger("change");
              $('#PRAdd').modal('close');
              $("#po").val("");
              Materialize.toast('<b><div class="fa fa-plus fa-lg" style="color:blue"></div> PO Added!</b>', 2000, 'rounded white black-text flow-text');
          }
      });
    }
});

$(document).on('submit','.euser',function (e) {
    e.preventDefault();
    $( "#load" ).show();

    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    var data={};
    var sub=$(this);
    data["DocType"]=sub.find(".opt").val();
    if(sub.find(".offCode3").val()){
      data["Office"]=sub.find(".offCode3").val();
      data["User"]="0";
      data["Date"]="0";
    }
    else if(sub.find(".user3").val()){
      data["User"]=sub.find(".user3").val();
      data["Office"]="0";
      data["Date"]="0";
    }
    else if(sub.find(".by_date").val()){
      data["Date"]=sub.find(".by_date").val();
      data["User"]="0";
      data["Office"]="0";
    }
    $.ajax({
      type:"POST",
      data:{data:data},
      url: base_url + "summaries/filterPipz",
      dataType: "json",
        success: function(result){
          //console.log(result);
          $( "#load" ).hide();
          $("ul.enduser").empty();
          var temp="";
          var s="";
          if(data["DocType"]==1){
            temp="ICS";
          }else if(data["DocType"]==2){
            temp="PAR";
          }else{
            temp="All"
          }
          if(result.length>1){
            s="s";
          }
          if(result.length>0){
            $(`<li class="collection-header"><h4>End User`+s+` (`+temp+`)</h4></li>`).hide().appendTo("ul.enduser").fadeIn('medium');
            for(var i=0;i<result.length;i++){
              $(`
                <li class="collection-item" style="display: none;">
                <div>`+result[i].firstName+` `+result[i].middleName+` `+result[i].surName+` `+result[i].suffixName+
                `<a href="`+base_url+`printparics/summaryPrint`+temp+`/`+result[i].personID+`" target="_blank" class="secondary-content">
                <div class="fa fa-print"></div> View
                </a>
                </div>
                </li>
              `).appendTo("ul.enduser").slideDown("medium");
            }if(sub.find(".offCode3").val()){
              Materialize.toast('<b><div class="fa fa-user fa-lg" style="color:green"></div> User'+s+' Founds!: '+result.length+'</b>', 2000, 'rounded white black-text flow-text');
            }else if(sub.find(".user3").val()){
              Materialize.toast('<b><div class="fa fa-file-text-o fa-lg" style="color:green"></div> '+temp+' Foundz!</b>', 2000, 'rounded white black-text flow-text');
            }

          }else{
            $(`<li class="collection-header"><h4>End User`+s+` (`+temp+`)</h4></li>`).hide().appendTo("ul.enduser").fadeIn('medium');
            $(`<li class="collection-item">No data to show!</li>`).hide().appendTo("ul.enduser").fadeIn('medium');
            if(sub.find(".offCode3").val()){
              Materialize.toast('<b><div class="fa fa-user-times fa-lg" style="color:red"></div> No User Found!</b>', 2000, 'rounded white black-text flow-text');
            }else if(sub.find(".user3").val()){
              Materialize.toast('<b><div class="fa fa-file-o fa-lg" style="color:red"></div> No '+temp+' Found!</b>', 2000, 'rounded white black-text flow-text');
            }
          }
        }
    });
});

$(document).on('submit','.equipList',function (e) {
    e.preventDefault();
    $( "#load" ).show();

    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    var data={};
    var sub=$(this);
    if(sub.find(".funcCode3").val()){
      data["Code"]=sub.find(".funcCode3").val();
      data["officeID"]="0";
    }
    else if(sub.find(".offCode4").val()){
      data["officeID"]=sub.find(".offCode4").val();
      data["DocType"]=sub.find(".opt").val();
      data["Code"]="0";
    }
    $.ajax({
      type:"POST",
      data:{data:data},
      url: base_url + "summaries/equipOffice",
      dataType: "json",
        success: function(result){
          //console.log(result);
          $( "#load" ).hide();
          $("ul.enduser").empty();
          var temp="";
          var s="";
          if(data["DocType"]==1){
            temp="ICS";
          }else if(data["DocType"]==2){
            temp="PAR";
          }else{
            temp="All"
          }
          if(result.length>1){
            s="s";
          }
          if(result.length>0){
            $(`<li class="collection-header"><h4>Equipment`+s+` (`+temp+`)</h4></li>`).hide().appendTo("ul.enduser").fadeIn('medium');
            for(var i=0;i<result.length;i++){
              $(`
                <li class="collection-item" style="display: none;">
                <div>`+result[i].firstName+` `+result[i].middleName+` `+result[i].surName+` `+result[i].suffixName+`</div><br>
                <div>`+result[i].equipmentDesc+`</div><br>
                <div>`+result[i].office+`</div><br>
                <div>`+result[i].parics+`</div>
                </li>
              `).appendTo("ul.enduser").slideDown("medium");
            }

            Materialize.toast('<b><div class="fa fa-user fa-lg" style="color:green"></div> Equipment'+s+' Found!: '+result.length+'</b>', 2000, 'rounded white black-text flow-text');
          }else{
            $(`<li class="collection-header"><h4>Equipment`+s+` (`+temp+`)</h4></li>`).hide().appendTo("ul.enduser").fadeIn('medium');
            $(`<li class="collection-item">No data to show!</li>`).hide().appendTo("ul.enduser").fadeIn('medium');
            Materialize.toast('<b><div class="fa fa-user-times fa-lg" style="color:red"></div> No Equipment Found!</b>', 2000, 'rounded white black-text flow-text');
          }
        }
    });
});

// add property numbers
// $(document.on('submit','.newPropNumber' ,function (e) {


// }));


// add property numbers

$(document).on('submit','.neweqpt',function (e) {
    e.preventDefault();
    $( "#load" ).show();

    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";
    var d = new Date();
    var n = d.getTime();
    var data={};
    data["AREID"]=$(".paricsIDhidden").val();
    data["PropNo"]=$(".funcCode").val();
    data["Office"]=$(".offCode").val();
    data["Seq"]=$("#seq2").val();
    data["Qty"]=$("#qty2").val();

    data["Unit"]=$("#unit2").val();
    data["UnitPrice"]=$("#price2").val();
    data["Life"]=$("#lifespan2").val();
    data["Specification"]=$("#desc2").val();
    data["PropertyNumberID"]=$("#fundCodePn").val() + $("#thisDate").val() + n + $("#parNumberOC").val();
    data["PropertyNumbers"]=$("#parNumberEC").val() + "-" + $("#fundCodePn").val() + "-" +$("#thisDate").val() + "-" + $("#parNumberOC").val() + "-";
    var code=$(".funcCode option[value='"+data["PropNo"]+"']").text();
 doc=$("#docType").val();

// res = parseFloat(lastSeq.split("-").pop());





// if(str.includes("")
// var str_code = "Hello world, (welcome to the universe.";
// var n = str.includes(")");


 // alert (code);
 // alert (data["PropNo"]);
 // alert (data["Office"]);

    var amt;
    amt=parseFloat(data["Qty"])*parseFloat(data["UnitPrice"]);
      $.ajax({
          type:"POST",
          data:{data:data},
          url: base_url + "supply/addEqpt",
          dataType: "json",
          success: function(result){
              //console.log(result);
              

                if(doc==2){
                  // code_r=result.equipments[i].code+result.equipments[i].subCode;
                  // if(code.includes("(") == true) {
                  //   str_code = code.split("(")[0];

                  // }else{
                    str_code = code.split("-")[0];
                   
                  // }
                }else if(doc==1){
                  // code_r=result.equipments[i].code;
                  if(code.includes("(") == true) {
                    str_code = code.split("(")[0];
                  }else{
                    str_code = code.split("-")[0];
                  }
                }
              $('#modal5').modal('close');
              Materialize.toast('<b><div class="fa fa-plus fa-lg" style="color:blue"></div> Equipment Added!</b>', 2000, 'rounded white black-text flow-text');
              // just add hidden attribute to result below to hide equipmentID
              $(`<tr>
                  <td>`+result+`</td>
                  <td>`+str_code+`</td>
                  <td>`+data["Qty"]+`</td>
                  <td>`+data["Unit"]+`</td>
                  <td style="width:40em">`+  data["Specification"]+`</td>
                  <td>`+thousandSeparator(((parseFloat(data["UnitPrice"])*100)/100).toFixed(2))+`</td>
                  <td>`+thousandSeparator(((amt*100)/100).toFixed(2))+`</td>
                  <td>No Changes</td>
                  <td><a class="tooltipped viewEqpt controlIcon" id="viewEqpt"
                  data-position="top" data-delay="1" data-tooltip="View" href="#modal2">
                  <div class="fa fa-eye effectIcon "></div></a>&nbsp;&nbsp;
                  <a class="tooltipped controlIcon eqptdelete" data-position="top" data-delay="1"
                  data-tooltip="Delete" href="#delEqpt"><div class="fa fa-times effectIcon"></div></a></td>
              </tr>`).appendTo('.eqpt > tbody');

              $("#seq").val("");
              $("#qty").val("");

              $("#unit").val("");
              $("#price").val("");
              $("#lifespan").val("");
              $("#desc").val("");
              $(".funcCode").val("0").trigger('change');
              $(".offCode").val("0").trigger('change');

              $("#qty2").val("");
              $("#unit2").val("");
              $("#price2").val("");
              $("#lifespan2").val("");
              $("#desc2").val("");

              $( "#load" ).hide();
          }
      });
});

$(document).on('click','.eqptdelete',function (e) {
  e.preventDefault();
  $( "#load" ).show();
  var row=$(this).parent().parent();
  $('.delPar').text($("#paricsnumber").text() +"?");
  $('.ID').val(row.find('td:first').text());
  $('.desc').text(row.find('td:nth-child(5)').text());
  $( "#load" ).hide();
  $(document).on('submit','.equipment',function (e) {
      e.preventDefault();
      $( "#load" ).show();
      var pathArray = window.location.pathname.split( '/' );
      var pathName;
      if(pathArray[1]!="sppmo"){
        pathName=pathArray[1]+"/sppmo";
      }else{
        pathName="sppmo";
      }
      var base_url = window.location.origin + "/" + pathName + "/";

      var ID=$(".ID").val();
      $.ajax({
        type:"POST",
        data:{ID:ID},
        url:base_url+"supply/deleteEqpt",
        dataType: "json",
        success:function(result){
          $( "#load" ).hide();
          row.remove();
          $('#delEqpt').modal('close');
          Materialize.toast('<b><div class="fa fa-times fa-lg" style="color:red"></div> Removed Equipment!</b>', 2000, 'rounded white black-text flow-text');
        }
      });
  });
});

$(document).on('click','.waste',function (e) {
  e.preventDefault();
  var row=$(this).parent().parent();
  var tempTotalQty;
  var tempWasteQty;
  var tempSumQty;
  var compQty;
  $('.delPar').text($("#paricsnumber").text());
    $('.ID').val(row.find('td:first').text());
  $('.desc').text(row.find('td:nth-child(5)').text());

    // allQty=$('.totalQty')-;
  tempTotalQty=row.find('td:nth-child(3)').text();
  tempWasteQty=parseInt(row.find('td:nth-child(10)').text());
  tempSumQty=tempTotalQty - tempWasteQty;
  // $('.totalQty').text(tempSumQty);
  $('.wasteQty').val(tempSumQty);
  var pSeq = parseFloat($('#lastSeq').val());
  


    // var property_id = $(this).data('id');
    // var equipment_id = $(this).data('equipment_id');
    var d = new Date();
    var n = d.getFullYear();

    var w_n = n + "-" + pSeq ;

    
    $('[name="wasteNum"]').val(w_n);




  $(document).on('submit','.wasteEquip',function (e) {
      e.preventDefault();

      var pathArray = window.location.pathname.split( '/' );
      var pathName;
      if(pathArray[1]!="sppmo"){
        pathName=pathArray[1]+"/sppmo";
      }else{
        pathName="sppmo";
      }
      var base_url = window.location.origin + "/" + pathName + "/";

      var data={};
      data["wasteNum"]=$("#wasteNum").val();
      data["dateWasted"]=$("#dateWaste").val();
      data["equipmentID"]=$(".ID").val();

      var unit_data;
      unit_data = $("#unitWasted").val();
      compQty=tempWasteQty + parseInt($("#unitWasted").val()); 
      data["unitWasted"]= compQty;

      $.ajax({
        type:"POST",
        data:{data:data},
        url:base_url+"supply/wasteEqpt",
        dataType: "json",
        success:function(result){

        }
      });
      row.css('background-color', '#ffdc95')
      Materialize.toast('<b><div class="fa fa-recycle fa-lg" style="color:#ffdc95"></div> Equipment Wasted!</b>', 2000, 'rounded white black-text flow-text');
      $('#wasteEquipment').modal('close');
  });
});

$(document).on('click','.trans',function (e) {
  e.preventDefault();
  var row=$(this).parent().parent();
  $('.delPar').text($("#paricsnumber").text() +"?");
  $('.ID').val(row.find('td:first').text());
  $('.desc').text(row.find('td:nth-child(5)').text());
  $(document).on('submit','.transferEquip',function (e) {
      e.preventDefault();

      var pathArray = window.location.pathname.split( '/' );
      var pathName;
      if(pathArray[1]!="sppmo"){
        pathName=pathArray[1]+"/sppmo";
      }else{
        pathName="sppmo";
      }
      var base_url = window.location.origin + "/" + pathName + "/";

      var data={};
      data["transNum"]=$("#transNum").val();
      data["transferDate"]=$("#dateTrans").val();
      data["transferTo"]=$(".user5").val();
      data["equipmentID"]=$(".ID").val();
      $.ajax({
        type:"POST",
        data:{data:data},
        url:base_url+"supply/transEqpt",
        dataType: "json",
        success:function(result){
          row.css('background-color', '#a5ff95')
          $('#transferEquipment').modal('close');
          Materialize.toast('<b><div class="fa fa-share fa-lg" style="color:#a5ff95"></div> Equipment Transferred!</b>', 2000, 'rounded white black-text flow-text');
        }
      });
  });
});

$(document).on('submit','.postData',function (e) {
    e.preventDefault();
    $( "#load" ).show();

    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    var data={};
    data["paricsID"]=$(".paricsID2").val();
    data["datePosted"]=$(".datePosted").val();
    if(data["datePosted"]!=""){
      $.ajax({
        type:"POST",
        data:{data:data},
        url:base_url+"supply/postDoc",
        dataType: "json",
        success:function(result){
          $( "#load" ).hide();
          $('#postModal').modal('close');
          $('#modal1').modal('close');
          Materialize.toast('<b><div class="fa fa-folder-open fa-lg" style="color:green"></div> Document Posted!</b>', 2000, 'rounded white black-text flow-text');
          // dataTable.ajax.reload();
          refresh_equipment();
        }
      });
    }
});

$(document).on('submit','.forwardData',function (e) {
    e.preventDefault();
    $( "#load" ).show();

    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    var data={};
    data["paricsID"]=$(".paricsIDForward").val();
    data["forwardDate"]=$("#dateForward").val();
    if(data["forwardDate"]!=""){
      $.ajax({
        type:"POST",
        data:{data:data},
        url:base_url+"supply/forwardDoc",
        dataType: "json",
        success:function(result){
          $( "#load" ).hide();
          $('#forward').modal('close');
          Materialize.toast('<b><div class="fa fa-share fa-lg" style="color:green"></div> Document Forwarded!</b>', 2000, 'rounded white black-text flow-text');
          var dataTable = $('#myTable').DataTable();
          dataTable.ajax.reload();
        }
      });
    }
});

$(document).on('submit','.cancelData',function (e) {
    e.preventDefault();
    $( "#load" ).show();

    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    var data={};
    data["paricsID"]=$(".paricsIDCancel").val();
    data["cancelDate"]=$("#dateCancel").val();
    if(data["cancelDate"]!=""){
      $.ajax({
        type:"POST",
        data:{data:data},
        url:base_url+"supply/cancelDoc",
        dataType: "json",
        success:function(result){
          $( "#load" ).hide();
          $('#cancel').modal('close');
          Materialize.toast('<b><div class="fa fa-minus-circle fa-lg" style="color:red"></div> Document Cancelled!</b>', 2000, 'rounded white black-text flow-text');
          var dataTable = $('#myTable').DataTable();
          dataTable.ajax.reload();
        }
      });
    }
});

$(document).on('change','#newFuncCode',function(e){
  var pathArray = window.location.pathname.split( '/' );
  var pathName;
  if(pathArray[1]!="sppmo"){
    pathName=pathArray[1]+"/sppmo";
  }else{
    pathName="sppmo";
  }
  var base_url = window.location.origin + "/" + pathName + "/";
  data={};
  data["propertyID"]=$(this).val();
  data["paricsID"]=$(".paricsIDhidden").val();
  $.ajax({
    type:"POST",
    data:{data:data},
    url:base_url+"supply/sequence",
    dataType: "json",
    success:function(result){
      $('#seq2').val(result).focus();
      $('#seq2').focusout();
    }
  });

});

$(document).on('change','#transUser',function(e){
  e.preventDefault();
  var pathArray = window.location.pathname.split( '/' );
  var pathName;
  if(pathArray[1]!="sppmo"){
    pathName=pathArray[1]+"/sppmo";
  }else{
    pathName="sppmo";
  }
  var base_url = window.location.origin + "/" + pathName + "/";
  if($(".transDoc").select2())
    $(".transDoc").select2("destroy");
  data={};
  data["personID"]=$('.transUser').val();
  $.ajax({
    type:"POST",
    data:{data:data},
    url:base_url+"supply/getUserYears",
    dataType: "json",
    success:function(result){
      $('.transYear').empty();
      var newState="";

      newState= new Option("Choose Year",0, true, true);
      $(".transYear").append(newState).trigger('change');
      $(".transYear option[value='0']:selected").attr('disabled',"disabled");
      for(i=0;i<result.length;i++){
        newState+= `<option value="`+result[i].year+`">`+result[i].year+`</option>`
      }
      $(".transYear").append(newState).trigger('change');
      $(".transYear").select2();
    }
  });
});

$(document).on('change','.transYear',function(e){
  e.preventDefault();
  if($('.transYear').val()!=0 && $('.transYear').val()!=null){
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    data={};
    data["year"]=$('.transYear').val();
    data["personID"]=$('.transUser').val();
    $.ajax({
      type:"POST",
      data:{data:data},
      url:base_url+"supply/getUserDocs",
      dataType: "json",
      success:function(result){
        $('.transDoc').empty();
        var newState="";
        newState= new Option("Choose Doc",0, true, true);
        $(".transDoc").append(newState).trigger('change');
        $(".transDoc option[value='0']:selected").attr('disabled',"disabled");
        for(i=0;i<result.length;i++){
           //newState= new Option(result[i].parics,result[i].paricsID, false, false);
           newState+= `<option value="`+result[i].paricsID+`">`+result[i].parics+`</option>`
        }
        $(".transDoc").append(newState).trigger('change');
        $(".transDoc").select2();
      }
    });
  }
});

$(document).on('change','.transDoc',function(e){
  e.preventDefault();
  if($('.transDoc').val()!=0 && $('.transDoc').val()!=null){
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";

    data={};
    data["doc"]=$('.transDoc').val();
    var string="";

    $.ajax({
      type:"POST",
      data:{data:data},
      url:base_url+"supply/getUserEquip",
      dataType: "json",
      success:function(result){
        $('.transFromTable > tbody').empty();
        var blank="";
        for(i=0;i<result.length;i++){
          yr= $('.transYear').val().slice(-2);
          if(result[i].subCode!=null){
            blank=result[i].subCode;
          }
          propNo=result[i].code+blank+"-"+result[i].fundCode+"-";
          propNo+=yr+"-"+result[i].officeCode+"-"+result[i].seq;
          string+=`<tr>
              <td width="5%">`+result[i].qty+`</td>
              <td width="5%">`+result[i].unit+`</td>
              <td width="30%">`+result[i].equipmentDesc+`</td>
              <td width="25%">`+propNo+`</td>
              <td width="10%">`+thousandSeparator(((result[i].unitPrice*100)/100).toFixed(2))+`</td>
              <td width="10%">`+thousandSeparator((((result[i].unitPrice*result[i].qty)*100)/100).toFixed(2))+`</td>
              <td width="10%">`+result[i].parics+`</td>
              <td width="5%">+</td>
              </tr>`;
        }
        $(string).appendTo('.transFromTable > tbody');
      }
    });
  }
});

function checker(data){
    if(data!="" && data!=null){
        return data;
    }else{
        return "--";
    }
}

function thousandSeparator(x){
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


