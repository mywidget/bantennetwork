$(document).ready(function(){
	$('.input1').iconpicker(".input1");
});
var click = false;

function callFunction(el) {
    if (!click) {
        $('#kolapse').addClass('btn-info');
        $('.dd').nestable('expandAll');
        $('#kolapse').html('<i class="fa fa-minus"></i> Collapse');
        click = true;
        } else {
        $('.dd').nestable('collapseAll');
        $('#kolapse').removeClass('btn-info');
        $('#kolapse').addClass('btn-success');
        $('#kolapse').html('<i class="fa fa-plus"></i> Expand');
        click = false;
        console.log('collapseAll');
    }
}
$(document).ready(function() {
    
    $('#kolapse').html('<i class="fa fa-plus"></i> Expand');
    var updateOutput = function(e) {
        var list = e.length ? e : $(e.target),
        output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    
    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    }).on('change', updateOutput);
    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    $("#nestable").nestable({
        maxDepth: 10,
        collapsedClass: 'dd-collapsed',
    }).nestable('collapseAll'); //Add this line
    
});

$(document).ready(function() {
    $(".loadingcrud").hide();
    $('#save').prop('disabled', true);
    $("#submit-form").validate({
        rules: {
            link: {
                required: true,
            },
        },
        submitHandler: CekForm
    });
    /* login submit */
    
    function CekForm() {
        var label = $("#label").val();
        var aktif = $("#aktif").val();
        var eclass = $("#eclass").val();
        if (label == "") {
            showNotif('bottom-right','Input Data','Nama menu harus diisi','warning');
            $("#label").focus();
            } else if (aktif == "") {
            showNotif('bottom-right','Input Data','Aktif harus dipilih','warning');
            // notif('Aktif harus dipilih', 'warning');
            $("#aktif").focus();
            } else {
            SubmitForm();
        }
    }
    
    function SubmitForm() {
        var level = [];
		$('.get_value').each(function(){
			if($(this).is(":checked"))
			{
				level.push($(this).val());
            }
        });
		level = level.toString();
        var dataString = {
            type: $("#type").val(),
            label: $("#label").val(),
            link: $("#link").val(),
            eclass: $("#eclass").val(),
            aktif: $("#aktif").val(),
            submenu: $("#submenu").val(),
            level : level,
            id: $("#id").val()
        };
        $.ajax({
            type: 'GET',
            url: base_url + "berita/save_menu",
            data: dataString,
            beforeSend: function() {
                $(".loadingcrud").show();
                $("#submits").html('Proses...');
            },
            dataType: "json",
            cache: false,
            success: function(data) {
                if (data.type == 'add') {
                    if (data.ok == 'ok') {
                        // notif('Data di simpan ' +data.msg, 'info');
                        showNotif('bottom-right','Simpan Data',data.msg,'info');
                        $("#menu-id").append(data.menu);
                        $("#submits").html('Submit');
						$("#main-menu-navigation").load(location.href + " #main-menu-navigation");
                        } else {
                        // notif('Data GAGAL di simpan', 'danger');
                        showNotif('bottom-right','Simpan Data','Data GAGAL di simpan','danger');
                        $("#submits").html('Submit');
                    }
                    } else if (data.type == 'edit') {
                    showNotif('bottom-right','Updated Data','Data berhasil di update','success');
                    // notif('Data di Updated ' +data.msg, 'success');
                    $("#submits").html('Submit');
                    $('#label_show' + data.id).html(data.label);
                    $('#link_show' + data.id).html(data.link);
                    $('#eclass_show' + data.id).html(data.eclass);
                    $("#showicon").removeClass(data.eclass);
                    $("#showicon").addClass('fa-bars');
                }
                $('#label').val('');
                $('#link').val('');
                $('#eclass').val('');
                $('#aktif').val('');
                $('#submenu').val('N');
                $('#id').val('');
                $(".loadingcrud").hide();
                $('.get_value').prop('checked', false);
            },
            error: function(xhr, status, error) {
                alert(error);
            },
        });
        return false;
    }
    $('.dd').on('change', function() {
        $('#save').prop('disabled', this.value == "" ? true : false);
    });
    $("#save").click(function() {
        $(".loadingcrud").show();
        // var dataString = {
        // data : $("#nestable-output").val(),
        // };
        var dataString = {
            type: $("#type").val(),
            data: $("#nestable-output").val()
        };
        $.ajax({
            type: "GET",
            url: base_url + "berita/crud",
            data: dataString,
            cache: false,
            beforeSend: function() {
                $(".loadingcrud").show();
            },
            success: function(data) {
                if(data.ok=='ok'){
                    showNotif('bottom-right',data.judul,data.ok,'success');
                    // notif(data.judul+' '+data.ok, 'success');
                }
                $(".loadingcrud").hide();
                $('#save').prop('disabled', true);
                $("#showicon").removeClass(eclass);
                $("#showicon").addClass('fa-bars');
                $('.hide-txt').hide('slow');
            },
            error: function(xhr, status, error) {
                alert(error);
            },
        });
    });
    
    
    $(document).on("click", ".edit-button", function() {
        var id = $(this).attr('id');
        $('.get_value').prop('checked', false);
        $.ajax({
            type: "GET",
            url: base_url + "berita/crud",
            dataType: 'json',
            data: { id: id, type: "get" },
            cache: false,
            beforeSend: function() {
                $(".loadingcrud").show();
            },
            success: function(data) {
                $(".loadingcrud").hide();
                $("#submits").html('Update');
                $("#showicon").addClass(data.eclass);
                $("#showicon").removeClass('fa-bars');
                $("#id").val(data.id);
                $("#label").val(data.label).focus();
                $("#link").val(data.link);
                $("#eclass").val(data.eclass);
                $("#aktif").val(data.aktif);
                $("#submenu").val(data.submenu);
                
            },
            error: function(xhr, status, error) {
                alert(error);
            },
        });
        
    });
    
    $(document).on("click", "#reset", function() {
        $('.get_value').prop('checked', false);
        var eclass = $("#eclass").val();
        $('#label').val('');
        $('#link').val('');
        $('#eclass').val('');
        $("#showicon").removeClass(eclass);
        $("#showicon").addClass('fa-bars');
        $('#aktif').val('');
        $('#submenu').val('N');
        $('#id').val('');
        $('.hide-txt').hide('slow');
    });
    
});

function show_selected() {
    var selector = document.getElementById('icon');
    var values = selector[selector.selectedIndex].value;
    document.getElementById("eclass").value = values;
    $("#showicon").addClass(values);
    $('#myModal').modal('hide');
}
$('#myModalDel').on('show', function() {
    var id = $(this).data('id'),
    removeBtn = $(this).find('.danger');
    
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#myModalDel').data('id', id).modal('show');
});

$(document).on("click", "#btnYes", function() {
    var id = $('#myModalDel').data('id');
    $(".loadingcrud").show();
    $.ajax({
        type: "GET",
        url: base_url + "berita/crud",
        data: { type: "hapus", id: id },
        cache: false,
        dataType: 'json',
        success: function(data) {
            if (data.ok == 'ok') {
                showNotif('bottom-right','Hapus menu','Menu berhasil dihapus','success');
                $("li[data-id='" + id + "']").remove();
                } else {
                showNotif('bottom-right','Hapus menu',"Menu gagal dihapus",'error');
                // notif('Data gagal di hapus', 'danger');
            }
            $('#myModalDel').modal('hide');
            $(".loadingcrud").hide();
        },
        error: function(xhr, status, error) {
            alert(error);
        },
    });
});