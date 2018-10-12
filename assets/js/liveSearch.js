function liveSearch(){
    var searchEmp = $('#searchEmp').val().toUpperCase();

    $("table tbody").find('tr').each(function(index) {
        $row = $(this);

        var date = $row.find("td:nth-child(2)");
        var dateID = date.text().toUpperCase();

        var matchedDate = dateID.indexOf(searchEmp);

        var name = $row.find("td:nth-child(3)");
        var nameID = name.text().toUpperCase();

        var matchedName = nameID.indexOf(searchEmp);

        var office = $row.find("td:nth-child(4)");
        var officeID = office.text().toUpperCase();

        var matchedOffice = officeID.indexOf(searchEmp);

        var status = $row.find("td:nth-child(5)")
        var statusID = status.text().toUpperCase();

        var matchStatus = statusID.indexOf(searchEmp);

        if (matchedName !=0 && matchedOffice!=0 && matchStatus!=0 && matchedDate!=0 ) {
          $row.hide();
        }else {
          $row.show();
        }

    });
}
$("#searchEmp").keyup(liveSearch);
