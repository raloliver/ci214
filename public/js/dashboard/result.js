var Result = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        console.log('Result Created');        
    };

    // ------------------------------------------------------------------------

    this.success = function(msg) {     
        var dom = $("#success")   
        if (typeof msg === 'undefined') {
            dom.html('Salvo com Sucesso!').fadeIn();
        }
        dom.html(msg).fadeIn();

        setTimeout(function(){
            dom.fadeOut();
        }, 2500);
    };

    // ------------------------------------------------------------------------

    this.error = function(msg) {
        var dom = $("#error");

        if (typeof msg === 'undefined') {
            dom.html('Ocorreu um erro.').fadeIn();
        }

        if (typeof msg === 'object') {
            var output = '<ul>';
            for (var key in msg) {
                output += '<li>' + msg[key] + '</li>';                
            }
            output += '</ul>';

            dom.html(output).fadeIn();

        } else {
            dom.html(msg).fadeIn();
        }

        setTimeout(function(){
            dom.fadeOut();
        }, 2500);
    };

    this.__construct();
    
};
