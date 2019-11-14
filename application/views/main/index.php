<div class="card" style="width: 600px; text-align: center; margin: 0 auto">

    <h5 class="card-header info-color white-text text-center" style="margin-bottom: 5px">
        <strong>Добавить задачу</strong>
    </h5>

    <div class="card-body px-lg-5 pt-0">

        <form action="/add" method="post" class="md-form" style="color: #757575;">
            <input name="fio" type="text" id="materialContactFormName" class="form-control" required>
            <label for="materialContactFormName">ФИО</label>

            <input name="email" type="email" id="materialContactFormEmail" class="form-control" required>
            <label for="materialContactFormEmail">E-mail</label>

            <input name="name" type="text" id="materialContactFormText" class="form-control" required>
            <label for="materialContactFormText">Название</label>

            <input name="date" type="date" id="materialContactFormDate" class="form-control" required>
            <label for="materialContactFormDate">Дата</label>

            <textarea name="description" id="materialContactFormMessage" class="form-control md-textarea" rows="3" required></textarea>
            <label for="materialContactFormMessage">Описание</label>

            <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" id="submit" type="submit">Send</button>

        </form>
    </div>
</div>
<div class = "container" style="margin-top: 50px">
    <button id="remove">delete selected row</button>
    <table id="tasks" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>id</th>
            <th>fio</th>
            <th>email</th>
            <th>name</th>
            <th>date</th>
            <th>dateadd</th>
            <th>description</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script>

    var table = $('#tasks').DataTable( {


        // serverSide: true,
        processing: true,
        ajax: {
            ajax: true,
            url: '/json',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'fio' },
            { data: 'email' },
            { data: 'name' },
            { data: 'date' },
            { data: 'dateadd' },
            { data: 'description' }
        ]
    } );

    $('#tasks tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#remove').click( function () {

        $.ajax({
            success : function(data){
                //delete the row
                var selected = $('table > tbody > tr.selected > td:first').text();
                $.post("remove", {id: selected} );
                table.row('.selected').remove().draw( false );
                setTimeout( function () {
                    table.ajax.reload();
                }, 2000 );
            },
            error: function(xhr){
                //error handling
            }});

    } );


    $( "#submit" ).click(function() {
        setTimeout( function () {
            table.ajax.reload();
        }, 2000 );
    });
</script>


