var Result = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        console.log('Result Created');        
    };

    // ------------------------------------------------------------------------

    this.success = function() {
        console.log('Sucesso!');
    };

    // ------------------------------------------------------------------------

    this.error = function() {
        console.log('Erro!');
    };

    this.__construct();
    
};
