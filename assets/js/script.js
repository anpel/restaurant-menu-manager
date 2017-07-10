$(function () {
    $('#table')
        .bootstrapTable()
        .on('check.bs.table',
            function (e, row) {
                plateAvailabilityUpdate(row.id, row.available);
            }
        ).on('uncheck.bs.table',
            function (e, row) {
                plateAvailabilityUpdate(row.id, row.available);
            }
        ).on('editable-save.bs.table',
            function (e, field, row) {
                plateUpdate(
                    row.id, row.price, row.name_en, row.name_gr, row.name_it
                );
            }
        ).on('dbl-click-cell.bs.table', 
            function(field, value, row, element) {
                plateDelete(value, element.id);
            }
        );
    $('#cat_table')
        .bootstrapTable()
        .on('editable-save.bs.table',
            function (e, field, row) {
                categoryUpdate(
                    row.id, row.position, row.name_en, row.name_gr, row.name_it
                );
            }
        );
});


function plateDelete(value, id)
{
    if(value == "removalUrl")
    {
        if(window.confirm("Are you sure you want to delete this plate?"))
        {
            $.ajax({
                method: "POST",
                url: "/index.php",
                data: {
                    action: "plate_delete",
                    id: id
                }
            }).done(
                function() {
                    location.reload();
                }
            ).fail(
                function(jqXHR, textStatus) {
                    alert("There was a problem deleting the plate, please try "
                    + "again.");
                }
            );
        }
    }
}


function categoryUpdate(id, position, name_en, name_gr, name_it)
{
    $.ajax({
        method: "POST",
        url: "/index.php",
        data: { 
            action: "category_update", 
            id: id,
            position: position,
            name_en: name_en,
            name_gr: name_gr,
            name_it: name_it
        }
    }).done(
        function() {
            location.reload();
        }
    ).fail(
        function(jqXHR, textStatus) {
            alert("There was a problem updating the category, please "
                + "try again.");
        }
    );
}


function plateUpdate(id, price, name_en, name_gr, name_it)
{
    $.ajax({
        method: "POST",
        url: "/index.php",
        data: { 
            action: "plate_update",
            id: id,
            price: price,
            name_en: name_en,
            name_gr: name_gr,
            name_it: name_it
        }
    }).fail(
        function(jqXHR, textStatus) {
            alert("There was a problem updating the plate, please try again.");
        }
    );
}


function plateAvailabilityUpdate(id, state)
{
    $.ajax({
        method: "POST",
        url: "/index.php",
        data: {
            action: "plate_avaialability_update",
            id: id,
            available: state
        }
    }).fail(
        function(jqXHR, textStatus) {
            alert("There was a problem updating the avaialability, please "
                + "try again.");
        }
    );
}
