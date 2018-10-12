$(".editData,.d2").css("display","none");


$(document).on('click',".editData",function(e){
    e.preventDefault();
    var pathArray = window.location.pathname.split( '/' );
    var pathName;
    if(pathArray[1]!="sppmo"){
      pathName=pathArray[1]+"/sppmo";
    }else{
      pathName="sppmo";
    }
    var base_url = window.location.origin + "/" + pathName + "/";
    if($(this).hasClass('specialElem')){
      dataField=$(this).parent().parent().parent();
    }else{
      dataField=$(this).parent().parent();
    }
    dataField.find(".d1").toggle(500);
    dataField.find(".d2").toggle(500);
});

$(document).on('click',".cancelData",function(e){
    e.preventDefault();
    if($(this).hasClass('specialElem')){
      dataField=$(this).parent().parent().parent();

    }else{
      dataField=$(this).parent().parent();
    }
    dataField.find(".d1").toggle(500);
    dataField.find(".d2").toggle(500);
});

$(document).on('click','.confirmData',function(e){
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
  var dataField,d1,d2="";
  if($(this).hasClass('specialElem')){
    dataField=$(this).parent().parent().parent();
  }else{
    dataField=$(this).parent().parent();
    d1=dataField.find(".d1");
    d2=dataField.find(".d2");
  }
  var data={};
  if(d2.find("input").hasClass("tbl1") || d2.find("select").hasClass("tbl1")){
    data["table"]="tblparics";
    data["idcolumn"]="paricsID";
    data["id"]=$(".tblareid").val();
  }else if(d2.find("input").hasClass("tbl3") || d2.find("select").hasClass("tbl3") || d2.find("textarea").hasClass("tbl3")){
    data["table"]="tblequipment";
    data["idcolumn"]="equipmentID";
    data["id"]=$(".tbleqid").val();
  }else if(d2.find("input").hasClass("tbl4") || d2.find("select").hasClass("tbl4")){
    data["table"]="tblor";
    data["idcolumn"]="orID";
    data["id"]=$(".tblorid").val();
  }else{
    data["table"]="";
    data["idcolumn"]="";
  }
  if(d2.find("select").hasClass("tbl1") || d2.find("select").hasClass("tbl4")){
    data["column"]=d2.find("select").attr("id");
    data["value"]=d2.find("select").val();
  }else if(d2.find("textarea").hasClass("tbl3")||d2.find("select").hasClass("tbl3")){
    if(d2.find("select").hasClass("tbl3")){
      data["column"]=d2.find("select").attr("id");
      data["value"]=d2.find("select").val();
    }
    if(d2.find("textarea").hasClass("tbl3")){
      data["column"]=d2.find("textarea").attr("id");
      data["value"]=d2.find("textarea").val();
    }
  }else{
    data["column"]=d2.find("input").attr("id");
    data["value"]=d2.find("input").val();
  }

  $.ajax({
    type:"POST",
    data:{data: data},
    url: base_url + "supply/setData",
    dataType: "json",
    success: function(result){
      //dataField.find(".inputData").text(result.replace(/"/g, ""));
      $( "#load" ).hide();
      Materialize.toast('<b><div class="fa fa-check fa-lg" style="color:green"></div> Data Edited!</b>', 2000, 'rounded white black-text flow-text');
      if(d2.find("select").hasClass("tbl1")){
        if(d2.find("select").hasClass("func")){
          d1.find("h6").text($(".user2 option[value='"+d2.find("select").val()+"']").text());
        }else if(d2.find("select").hasClass("user2")){
          d1.find("h6").text($(".user2 option[value='"+d2.find("select").val()+"']").text());
        }
        d1.toggle();
        d2.toggle();
      }else if(d2.find("textarea").hasClass("tbl3") || d2.find("select").hasClass("tbl3")) {
        if(d2.find("select").hasClass("offCode2")){
          d1.find("h6").text($(".offCode2 option[value='"+d2.find("select").val()+"']").text());
          d1.toggle();
          d2.toggle();
        }
        if(d2.find("textarea").hasClass("tbl3")){
          d1.find("h6").text(d2.find("textarea").val());
          d1.toggle();
          d2.toggle();
        }
      }else{
        d1.find("h6").text(d2.find("input").val());
        d1.toggle();
        d2.toggle();
      }
      if(data["column"]=="personID"){
        $("#position").text(result.position);
        $("#office").text(result.office);
      }
      if(d2.find("input").attr("id")=="unitPrice" || d2.find("input").attr("id")=="qty"){
        qty=parseFloat($("#eqpticsqty").text());
        price=parseFloat($("#eqpticsprice").text());
        amt=qty*price;
        $("eqpticsprice").text(thousandSeparator(((price*100)/100).toFixed(2)))
        $("#eqpticsamt").text(thousandSeparator(((amt*100)/100).toFixed(2)));
      }
      var dataTable = $('#myTable').DataTable();
      dataTable.ajax.reload();
    }
  });
});
