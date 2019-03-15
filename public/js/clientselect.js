

    //Select a client from the database

    function clientSelect(id) {
        

        $.ajax({
            url : '/settings/allclients',
            type: 'GET',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
               
                $(id).append('<option value="empty">-- Select a Client --</option>');
                
                    for (i = 0; i < data.length ; i++) {
                    
                    $(id).append(clientSelectTemplate(data[i].client,  data[i].id));
                    }
                
            }


});

}


function clientSelectTemplate(client, id) {
   
   return '<option value="' + id + '">' + client +'</option>';

}

