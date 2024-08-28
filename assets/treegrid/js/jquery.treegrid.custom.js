jQuery(function($) 
{   
    var globalCounter = 0;
    var saveStateName = 'state-save-4';
    $("#tree-1").treegrid({initialState: 'collapsed'});
    $("#tree-2").treegrid({treeColumn: 1, initialState: 'expanded', 'saveState': true, 'saveStateName': saveStateName});
    $("#tree-3").treegrid({initialState: 'collapsed'});
    $("#tree-4").treegrid({onChange: function() {
            globalCounter++;
        }, onCollapse: function() {
            globalCounter++;
        }, onExpand: function() {
            globalCounter++;
    }});
})