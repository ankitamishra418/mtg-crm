        function new_workplace(){
		"use strict";
            $('#workplace').modal('show');
            $('.edit-title').addClass('hide');
            $('.add-title').removeClass('hide');
        }
        
        
//         function edit_workplace(invoker,id){
// 		"use strict";
//             $('#additional_workplace').append(hidden_input('id',id));
//             $('#workplace input[name="workplace_name"]').val($(invoker).data('name'));
//             $('#workplace').modal('show');
//             $('.add-title').addClass('hide');
//             $('.edit-title').removeClass('hide');
//         }
        
        function edit_workplace(invoker,id){
		"use strict";
            $('#additional_workplace').append(hidden_input('id',id));
            $('#workplace input[name="name"]').val($(invoker).data('name'));
            $('#workplace input[name="workplace_email"]').val($(invoker).data('email'));
            $('#workplace input[name="workplace_phone"]').val($(invoker).data('phone'));
            $('#workplace input[name="workplace_address"]').val($(invoker).data('address'));
            $('#workplace input[name="workplace_description"]').val($(invoker).data('description'));
            $('#workplace input[name="workplace_logo"]').val($(invoker).data('logo'));
            $('#workplace').modal('show');
            $('.add-title').addClass('hide');
            $('.edit-title').removeClass('hide');
        }