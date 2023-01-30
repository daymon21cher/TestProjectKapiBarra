<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <title>Persons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col mt-1">
            <button class="btn btn-success mb-1" data-toggle="modal" data-target="#Modal"><i
                        class="fa fa-user-plus"></i></button>
            <table class="table shadow " id="employee_table">
                <thead class="thead-dark">
                <tr>
                    <th>№</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>ID адреса</th>
                    <th>Адрес</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="Modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Добавить пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="first_name" id="first_name" value=""
                               placeholder="Имя">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="last_name" id="last_name" value=""
                               placeholder="Фамилия">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" id="phone" value=""
                               placeholder="Телефон">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address_id" id="address_id" value=""
                               placeholder="Адрес">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button name="submit" class="btn btn-primary" onclick='

    $.post("/api/person/",{
        "lastname": $("#last_name").val(),
        "firstname": $("#first_name").val(),
        "phone": $("#phone").val(),
        "addresid": $("#address_id").val(),
        }, function(data){
    });
'>Добавить</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $.getJSON("/api/person/", function (data) {
            let employee_data = '';
            let edit_modal = '';
            let delete_modal = '';
            let idd = '';
            let iddd = '';
            $.each(data.People, function (key, value) {
                idd = "'api/person/"+value.id + "'";
                employee_data += '<tr>';
                employee_data += '<td>' + value.id + '</td>';
                employee_data += '<td>' + value.last_name + '</td>';
                employee_data += '<td>' + value.first_name + '</td>';
                employee_data += '<td>' + value.phone + '</td>';
                employee_data += '<td>' + value.address_id + '</td>';
                employee_data += '<td>' + value['Region.name'] + " "
                    + value['Region_type.value'] + " "
                    + value['City_type.value'] + " "
                    + value['City.name'] + " "
                    + value['Street_type.value'] + " "
                    + value['Street.name'] + " "
                    + value['Building_type.value'] + " "
                    + value['Address.building_number'] + " кв "
                    + value['Address.number'] + '</td>';
                employee_data += '<td><a href="?edit=' + value.id + '" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal' + value.id + '"><i class="fa fa-edit"></i></a><a href="?delete=' + value.id + '" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal' + value.id + '"><i class="fa fa-trash"></i></a></td>';
                employee_data += '</tr>';
                edit_modal += '<div class="modal fade" id="editModal' + value.id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content shadow"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Редактировать запись №' + value.id + '</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><form action=""><div class="form-group"><input type="text" class="form-control" id="edit_first_name" value="' + value.first_name + '" placeholder="Имя"></div><div class="form-group"><input type="text" class="form-control" id="edit_last_name" value="' + value.last_name + '" placeholder="Фамилия"></div><div class="form-group"><input type="text" class="form-control" id="edit_phone" value="' + value.phone + '" placeholder="Телефон"></div><div class="form-group"><input type="text" class="form-control" id="edit_address" value="' + value.address_id + '" placeholder="Телефон"></div><div class="modal-footer"><button type="submit" name="edit-submit" class="btn btn-primary" onclick=\"$.ajax({url:' +idd + ', data: { \'lastname\': $(\'#edit_last_name\').val(), \'firstname\': $(\'#edit_first_name\').val(), \'phone\': $(\'#edit_phone\').val(),\'addresid\': $(\'#edit_address\').val()} , type: \'PUT\', success: function(result) {}});\">Обновить</button></div></form></div></div></div></div>';
                delete_modal += '<div class="modal fade" id="deleteModal' + value.id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content shadow"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Удалить запись № ' + value.id + '</h5><button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button><form action=""><button class="btn btn-danger" onclick=\"console.log(' + value.id + ');$.ajax({url:' +idd + ', type: \'DELETE\', success: function(result) {}});\">Удалить</button><form></div></div></div></div>';
            });

            $('#edit_person').append(edit_modal);
            $('#delete_person').append(delete_modal);
            $('#employee_table').append(employee_data);
        });
    });



</script>



<div id="edit_person"></div>
<div id="delete_person"></div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>
</html>