<div class="row">
    
    <div id="dashboard-side" class="span4">
        <form id="create_todo" class="form-horizontal" method="post" action="<?=site_url('api/create_todo')?>">
            <div class="input-append">
                <input type="text" name="content" placeholder="Título da Tarefa" />
                <input type="submit" class="btn btn-success" value="Add" />
            </div>
        </form>
        
        <div id="list_todo">
            <span class="ajax-loader-gray"></span>
        </div>
    </div>
    
    <div id="dashboard-main" class="span8">
        <form id="create_note" class="form-horizontal" method="post" action="<?=site_url('api/create_note')?>">
            <div class="input-append">
                <input tabindex="1" type="text" name="title" placeholder="Título do Lembrete" />
                <input tabindex="3" type="submit" class="btn btn-success" value="Add" />
            </div>
            
            <div class="clearfix"></div>
            
            <textarea tabindex="2" name="content"></textarea>
            
        </form>
        
        <div id="list_note">
            <span class="ajax-loader-gray"></span>
        </div>
    </div>
    
    
</div>
