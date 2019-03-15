





    function projectSelect(id) {
        $.ajax({
    url: '/selectproject',
    type: 'GET',
    dataType: 'json',
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
      
      // $btn.button("reset");
      // var obj = jQuery.parseJSON(data);
      // //alert( obj.status === "success" );
      // console.log(data);


      for (i = 0; i < data.length ; i++) {
                    $(id).prepend(projectTemplate(data[i].project_name,  data[i].project_name_raw));

      
            }
        }
  });



  function projectTemplate(project, project_raw) {
    return '<option value="' + project_raw + '">' + project +'</option>';
  }
    }










    //end of document ready function

