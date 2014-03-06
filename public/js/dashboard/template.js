var Template = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        console.log('Template Created');        
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
        output += '<a data-id="'+ obj.todo_id +'" data-completed="' + data_completed + '" class="update_todo" href="api/update_todo/">' + data_completed_status + '</a>'

        output += '<a data-id="'+ obj.todo_id +'" class="delete_todo" href="api/delete_todo/"><i class="icon-remove"></i></a>'
    	output += '</div>';
    	return output;
    };

    // ------------------------------------------------------------------------

    this.note = function(obj) {
    	var output = '';
    	output += '<div id="note_'+ obj.note_id +'">';
    	output += '<span>' + obj.title + '</span>';
    	output += '<span>' + obj.content + '</span>';
    	output += '</div>';
    	return output;
    };

    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
