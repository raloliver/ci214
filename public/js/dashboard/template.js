var Template = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {            
    };
    
    // ------------------------------------------------------------------------

    this.todo = function(obj) {
    	var output = '';
        if (obj.completed == 1) {
            output += '<div id="todo_'+ obj.todo_id +'" class="completed_todo">';
        } else {
            output += '<div id="todo_'+ obj.todo_id +'">';
        }    	  
    	output += '<span>' + obj.content + '</span>';

        var data_completed = (obj.completed == 1) ? 0 : 1;
        var data_completed_status = (obj.completed == 1) ? '<i class="icon-retweet"></i>' : '<i class="icon-ok"></i>';
        output += '<a class="update_todo" data-id="'+ obj.todo_id +'" data-completed="' + data_completed + '" href="api/update_todo/">' + data_completed_status + '</a>'

        output += '<a data-id="'+ obj.todo_id +'" class="delete_todo" href="api/delete_todo/"><i class="icon-remove"></i></a>'
    	output += '</div>';
    	return output;
    };

    // ------------------------------------------------------------------------

    this.note = function(obj) {
    	var output = '';
    	output += '<div id="note_'+ obj.note_id +'">';
    	output += '<span><a id="note_title_'+ obj.note_id +'" class="toggle_note" data-id="'+ obj.note_id +'" href="#">' + obj.title + '</a></span> ';
        output += '<a class="update_note_display" data-id="'+ obj.note_id +'" href="#"><i class="icon-edit"></i></a>';
        output += '<a data-id="'+ obj.note_id +'" class="delete_note" href="api/delete_note/"><i class="icon-remove"></i></a>';
        output += '<div id="edit_note_content_' + obj.note_id + '" class="edit_note_content"></div>';
        output += '<div id="note_content_'+ obj.note_id +'" class="note_content hide">'+ obj.content +'</div>';
    	output += '</div>';
    	return output;
    };

    // ------------------------------------------------------------------------

    this.note_edit = function(note_id) {
        var output = '';

        output += '<form class="edit_note_form" method="post" action="api/update_note">';
        output += '<input class="title" type="text" name="title" />';
        output += '<input class="note_id" type="hidden" name="note_id" value="'+note_id+'" />';
        output += '<textarea class="content" name="content"></textarea>';
        output += '<input type="submit" class="btn btn btn-success" value="Salvar" />';
        output += '<input type="submit" class="edit_note_cancel btn" value="Cancelar" />';
        output += '</form>';
        return output;
    };

    // ------------------------------------------------------------------------

    
    this.__construct();
    
};
