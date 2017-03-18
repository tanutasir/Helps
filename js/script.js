var my_json
$('#menuEditBtn1').click(function(){

    $.get("http://helps/modal", function(res) {
        var my_json = res;

    });
    alert(my_json);
})
var path = $(location).attr('hostname');
$('#menuEditBtn').click(function(){
    $('#overlay').show(0,function(){

        $('#modal-tree').jstree({
            'core' : {

                'data' : {
                    'url' : "//" + path + "/modal",
                     /*/tree/data?op=get_node'*/
                  //   'data' : result,
                //
                     'dataType':'json'
                 },
                'check_callback' : true,
                'themes' : {
                    'responsive' : false
                }
            },
            'types' : {
                '#' : {
                    //     "valid_children":["folder","file"],
                    /* 'icon' : "iiicns"*/
                },
                'default' : {
                    /* "icon" : " glyphicon-folder-close"*/
                },
                "folder" : {
                    "valid_children":["folder","file"],
                    "icon" : "glyphicon glyphicon-folder-close yellow"

                },
                "file" : {
                    "valid_children":null,
                    "icon" : "glyphicon glyphicon-leaf green"
                },
                "ext" : {

                }
            },

            'force_text' : false,
            'plugins' : ['state','dnd','types']//,'contextmenu','wholerow'
        }).on('create_node.jstree', function (e, data) {
            $.get('//' + path + '/tree/data?op=create_node', { 'id' : data.node.parent, 'position' : data.position, 'type' : data.node.type })
                .done(function (id) {
                    data.instance.set_id(data.node, id);
                    $("#modal-tree").jstree(true).edit(id);
                })
                .fail(function () {
                    data.instance.refresh();
                });
        }).on('rename_node.jstree', function (e, data) {
            $.get('//' + path + '/tree/data?op=rename_node', { 'id' : data.node.id, 'text' : data.text })
                .fail(function () {
                    data.instance.refresh();
                });
        }).on('delete_node.jstree', function (e, data) {

            $.get('//' + path + '/tree/data?op=delete_node', { 'id' : data.node.id })
                .fail(function () {
                    data.instance.refresh();
                });
        }).on('move_node.jstree', function (e, data) {
            $.get('//' + path + '/tree/data?op=move_node', { 'id' : data.node.id, 'parent' : data.parent, 'position' : data.position })
                .fail(function () {
                    data.instance.refresh();
                });
        }).on('open_node.jstree', function (e, data) {
            // data.instance.set_icon(data.node, "glyphicon glyphicon-folder-open blue");
        }).on('close_node.jstree', function (e, data) {
            // data.instance.set_icon(data.node, "glyphicon glyphicon-folder-close blue");
        }).on('changed.jstree', function (e, data) {
            if(typeof data.node != "undefined"){
                if(data.node.type == "file"){
                    //location.href = data.instance.get_node(data.node, true).children('a').attr('href');

                }else{

                }

            }
        }).on("contextmenu", ".jstree-anchor", function (e) {
            e.preventDefault();
            $("#modal-tree").jstree(true).activate_node(this);
        }).on('click', '.jstree-anchor', function (e) {
            //$(this).jstree(true).toggle_node(e.target);
        }).on('click', '.jstree-leaf .jstree-anchor', function (e) {
           // window.location = "http://" + window.location.hostname + window.location.pathname.slice(0,6) + $(this).attr('id');
        }).on('loaded.jstree', function(e, data) {
            $( "#overlayBody" ).slideDown( "slow")
        });

    });
});

$.contextMenu({
    selector: "#overlayNewButton",
    trigger:'left',
    autoHide: true,
    zIndex: 1000,
    items: {
        createFile: {
            name: "New File",
            icon: "add",

            callback: function(key, opt){
                var node = $("#modal-tree").jstree(true).get_selected(true);
                $("#modal-tree").jstree('create_node', '#', { 'text' : 'New file', 'type': 'file'}, 'last');
            }
        },
        createFolder: {
            name: "New Folder",
            icon: "add",

            callback: function(key, opt){
                var node = $("#modal-tree").jstree(true).get_selected(true);
                $("#modal-tree").jstree('create_node', '#', { 'text' : 'New folder', 'type': 'folder'}, 'last');

            }
        }
    }
});

$.contextMenu({
    selector: "#modal-tree .jstree-anchor",
    autoHide: true,
    zIndex: 1000,
    items: {
        createFile: {
            name: "New File",
            icon: "add",
            visible: function(){
                var node = $("#modal-tree").jstree(true).get_selected(true);
                return (node[0].type == "folder") ? true : false;
            },
            callback: function(key, opt){
                var node = $("#modal-tree").jstree(true).get_selected(true);
                $("#modal-tree").jstree('create_node', node[0].id, { 'text' : 'New file', 'type': 'file'}, 'last');
            }
        },
        createFolder: {
            name: "New Folder",
            icon: "add",
            visible: function(){
                var node = $("#modal-tree").jstree(true).get_selected(true);
                return (node[0].type == "folder") ? true : false;
            },
            callback: function(key, opt){
                var node = $("#modal-tree").jstree(true).get_selected(true);
                $("#modal-tree").jstree('create_node', node[0].id, { 'text' : 'New folder', 'type': 'folder'}, 'last');

            }
        },
        "sep1": {
            "type": "cm_seperator",
            visible: function(){
                var node = $("#modal-tree").jstree(true).get_selected(true);
                return (node[0].type == "folder") ? true : false;
            },
        },
        rename: {
            name: "Rename",
            icon: "edit",
            callback: function(key, opt){
                var node = $("#modal-tree").jstree(true).get_selected(true);
                $("#modal-tree").jstree(true).edit(node[0].id);
            }
        },

        delete: {
            name: "Delete",
            icon: "delete",
            callback: function(key, opt){
                var node = $("#modal-tree").jstree(true).get_selected(true);
                $("#modal-tree").jstree(true).delete_node(node[0].id);
            }
        }

    }
});

$('#overlay').click(function(e){
    if ($(e.target).closest("#overlayBody").length === 0) {
        reloadPage()
    }

})

$('#overlayOkBtn').click(function(){
    reloadPage()
})

function reloadPage(){
    $( "#overlayBody" ).slideUp( function(){
        $( "#overlay" ).hide(function(){
            location.reload();
        });
    })
}



$('#slave-tree').jstree({
    'core' : {

        'data' : {
            'url' : "http://helps/slave",
            /*/tree/data?op=get_node'*/
            //   'data' : result,
            //
            'dataType':'json'
        },
        'check_callback' : true,
        'themes' : {
            'responsive' : false
        }
    },
    'types' : {
        '#' : {
            //     "valid_children":["folder","file"],
            /* 'icon' : "iiicns"*/
        },
        'default' : {
            /* "icon" : " glyphicon-folder-close"*/
        },
        "folder" : {
            "valid_children":["folder","file"],
            "icon" : "glyphicon glyphicon-folder-close yellow"

        },
        "file" : {
            "valid_children":null,
            "icon" : "glyphicon glyphicon-leaf green"
        },
        "ext" : {

        }
    },

    'force_text' : false,
    'plugins' : ['state','dnd','types']//,'contextmenu','wholerow'
}).on('create_node.jstree', function (e, data) {
    $.get('//' + path + '/tree/data?op=create_node', { 'id' : data.node.parent, 'position' : data.position, 'type' : data.node.type })
        .done(function (id) {
            data.instance.set_id(data.node, id);
            $("#slave-tree").jstree(true).edit(id);
        })
        .fail(function () {
            data.instance.refresh();
        });
}).on('rename_node.jstree', function (e, data) {
    $.get('//' + path + '/tree/data?op=rename_node', { 'id' : data.node.id, 'text' : data.text })
        .fail(function () {
            data.instance.refresh();
        });
}).on('delete_node.jstree', function (e, data) {

    $.get('//' + path + '/tree/data?op=delete_node', { 'id' : data.node.id })
        .fail(function () {
            data.instance.refresh();
        });
}).on('move_node.jstree', function (e, data) {
    $.get('//' + path + '/tree/data?op=move_node', { 'id' : data.node.id, 'parent' : data.parent, 'position' : data.position })
        .fail(function () {
            data.instance.refresh();
        });
}).on('open_node.jstree', function (e, data) {
    // data.instance.set_icon(data.node, "glyphicon glyphicon-folder-open blue");
}).on('close_node.jstree', function (e, data) {
    // data.instance.set_icon(data.node, "glyphicon glyphicon-folder-close blue");
}).on('changed.jstree', function (e, data) {
    if(typeof data.node != "undefined"){
        if(data.node.type == "file"){
            //location.href = data.instance.get_node(data.node, true).children('a').attr('href');

        }else{

        }

    }
}).on("contextmenu", ".jstree-anchor", function (e) {
    e.preventDefault();
    $("#slave-tree").jstree(true).activate_node(this);
}).on('click', '.jstree-anchor', function (e) {
    e.preventDefault();
    $("#slave-tree").jstree(true).activate_node(this);
}).on('click', '.jstree-leaf .jstree-anchor', function (e) {
     window.location = $(this).attr('href');
}).on('loaded.jstree', function(e, data) {

})

$.contextMenu({
    selector: "#slaveNewBtn",
    trigger:'left',
    autoHide: true,
    zIndex: 1000,
    items: {
        createFile: {
            name: "New File",
            icon: "add",

            callback: function(key, opt){
                var node = $("#slave-tree").jstree(true).get_selected(true);
                $("#slave-tree").jstree('create_node', '#', { 'text' : 'New file', 'type': 'file'}, 'last');
            }
        },
        createFolder: {
            name: "New Folder",
            icon: "add",

            callback: function(key, opt){
                var node = $("#slave-tree").jstree(true).get_selected(true);
                $("#slave-tree").jstree('create_node', '#', { 'text' : 'New folder', 'type': 'folder'}, 'last');

            }
        }
    }
});

$.contextMenu({
    selector: "#slave-tree .jstree-anchor",
    autoHide: true,
    zIndex: 1000,
    items: {
        createFile: {
            name: "New File",
            icon: "add",
            visible: function(){
                var node = $("#slave-tree").jstree(true).get_selected(true);
                return (node[0].type == "folder") ? true : false;
            },
            callback: function(key, opt){
                var node = $("#slave-tree").jstree(true).get_selected(true);
                $("#slave-tree").jstree('create_node', node[0].id, { 'text' : 'New file', 'type': 'file'}, 'last');
            }
        },
        createFolder: {
            name: "New Folder",
            icon: "add",
            visible: function(){
                var node = $("#slave-tree").jstree(true).get_selected(true);
                return (node[0].type == "folder") ? true : false;
            },
            callback: function(key, opt){
                var node = $("#slave-tree").jstree(true).get_selected(true);
                $("#slave-tree").jstree('create_node', node[0].id, { 'text' : 'New folder', 'type': 'folder'}, 'last');

            }
        },
        "sep1": {
            "type": "cm_seperator",
            visible: function(){
                var node = $("#slave-tree").jstree(true).get_selected(true);
                return (node[0].type == "folder") ? true : false;
            },
        },
        rename: {
            name: "Rename",
            icon: "edit",
            callback: function(key, opt){
                var node = $("#slave-tree").jstree(true).get_selected(true);
                $("#slave-tree").jstree(true).edit(node[0].id);
            }
        },

        delete: {
            name: "Delete",
            icon: "delete",
            callback: function(key, opt){
                var node = $("#slave-tree").jstree(true).get_selected(true);
                $("#slave-tree").jstree(true).delete_node(node[0].id);
            }
        }

    }
});