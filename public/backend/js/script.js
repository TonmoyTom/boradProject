$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('keyup', '#old_password', function(){
         var old_password = $("#old_password").val();
        $.ajax({
            type: 'post',
            url: '/admin/update-password',
            data:{old_password:old_password,},
            success:function(resp){
               if(resp == "false"){
                   $("#chkoldpwd").html("<p  > Current Password is InCorrect </p>").css({"color": "red"});
               }else if(resp =="true"){
                    $("#chkoldpwd").html("<p  > Current Password is Correct</p>").css({"color": "green"});
               }
            },error:function(){
                alert("eroor");
            }
        });


    });

    





  
    


  

      $('#order-listing').DataTable( {
        // dom: 'Blfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
    } );

    $('.js-example-basic-multiple').select2();



    // $("#exampleCheck1").click(function(){
    //     if($(this).is(":checked")){
    //         $('input[type=checkbox]').prop('checked',true);        
    //     }else{
    //         $('input[type=checkbox]').prop('checked',false);  
    //     }
    // });

    // function checkPermissionByGroup(className, checkThis){
    //     const groupIdName = $("#"+checkThis.id);
    //     const classCheckBox = $('.'+className+' input');
    //     if(groupIdName.is(':checked')){
    //          classCheckBox.prop('checked', true);
    //      }else{
    //          classCheckBox.prop('checked', false);
    //      }
    //  }


    
    $(".updatesbackgroundstatus").click(function(){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
     //    alert(status);
     //    alert(section_id);
        $.ajax({
            type : 'post',
            url : '/admin/backgroundsupdatestatus',
            data : {status:status, section_id:section_id},
            success:function(resp){
             if(resp['status'] == 0){
                 $("#backgrounds-"+section_id).html("<i class='fas fa-toggle-off toggle' aria-hidden='true' status='Deactive'></i>");
             }else if(resp['status'] == 1){
                 $("#backgrounds-"+section_id).html("<i class='fas fa-toggle-on toggle' aria-hidden='true' status='Active'></i>"); 
             }
            },error:function(resp){
             alert("error");
            }
        })
 
    });

    $(".updatessubjectsstatus").click(function(){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
     //    alert(status);
     //    alert(section_id);
        $.ajax({
            type : 'post',
            url : '/admin/subjectsupdatestatus',
            data : {status:status, section_id:section_id},
            success:function(resp){
             if(resp['status'] == 0){
                 $("#subjects-"+section_id).html("<i class='fas fa-toggle-off toggle' aria-hidden='true' status='Deactive'></i>");
             }else if(resp['status'] == 1){
                 $("#subjects-"+section_id).html("<i class='fas fa-toggle-on toggle' aria-hidden='true' status='Active'></i>"); 
             }
            },error:function(resp){
             alert("error");
            }
        })
 
    });

    $(".updatesboardsstatus").click(function(){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
     //    alert(status);
     //    alert(section_id);
        $.ajax({
            type : 'post',
            url : '/admin/boardsupdatestatus',
            data : {status:status, section_id:section_id},
            success:function(resp){
             if(resp['status'] == 0){
                 $("#boards-"+section_id).html("<i class='fas fa-toggle-off toggle' aria-hidden='true' status='Deactive'></i>");
             }else if(resp['status'] == 1){
                 $("#boards-"+section_id).html("<i class='fas fa-toggle-on toggle' aria-hidden='true' status='Active'></i>"); 
             }
            },error:function(resp){
             alert("error");
            }
        })
 
    });

    $(".updatesqustionsstatus").click(function(){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
     //    alert(status);
     //    alert(section_id);
        $.ajax({
            type : 'post',
            url : '/admin/qustionsupdatestatus',
            data : {status:status, section_id:section_id},
            success:function(resp){
             if(resp['status'] == 0){
                 $("#qustions-"+section_id).html("<i class='fas fa-toggle-off toggle' aria-hidden='true' status='Deactive'></i>");
             }else if(resp['status'] == 1){
                 $("#qustions-"+section_id).html("<i class='fas fa-toggle-on toggle' aria-hidden='true' status='Active'></i>"); 
             }
            },error:function(resp){
             alert("error");
            }
        })
 
    });

    $(".updatesanswersstatus").click(function(){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
     //    alert(status);
     //    alert(section_id);
        $.ajax({
            type : 'post',
            url : '/admin/answersupdatestatus',
            data : {status:status, section_id:section_id},
            success:function(resp){
             if(resp['status'] == 0){
                 $("#answers-"+section_id).html("<i class='fas fa-toggle-off toggle' aria-hidden='true' status='Deactive'></i>");
             }else if(resp['status'] == 1){
                 $("#answers-"+section_id).html("<i class='fas fa-toggle-on toggle' aria-hidden='true' status='Active'></i>"); 
             }
            },error:function(resp){
             alert("error");
            }
        })
 
    });

   
    // var maxField = 40; //Input fields increment limitation
    // var addButton = $('.add_button'); //Add button selector
    // var wrapper = $('.field_wrapper'); //Input field wrapper
    // var fieldHTML = '<div> <input type="text" class="form-control" name="name[]" style="color: #000; margin-bottom: 15px;" value=""/><a href="javascript:void(0);" class="remove_button"><i class="fas fa-trash-alt icone"></i></a></div>'; //New input field html 
    // var x = 1; //Initial field counter is 1
    
    // //Once add button is clicked
    // $(addButton).click(function(){
    //     //Check maximum number of input fields
    //     if(x < maxField){ 
    //         x++; //Increment field counter
    //         $(wrapper).append(fieldHTML); //Add field html
    //     }
    // });
    
    // //Once remove button is clicked
    // $(wrapper).on('click', '.remove_button', function(e){
    //     e.preventDefault();
    //     $(this).parent('div').remove(); //Remove field html
    //     x--; //Decrement field counter
    // });

    


    $("#datepicker").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });
    

    
});