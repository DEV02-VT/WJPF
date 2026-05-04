// jquery extend function
$.extend(
{
    redirectPost: function(location, args)
    {
        var form = '';
        $.each( args, function( key, value ) {
            if (typeof value === 'string')
            {
                value = value.split('"').join('\"');
            }
            form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        });
        $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo($(document.body)).submit();
    }
});

function ShowOverlay(msg = '')
{
    var overlay = document.getElementById("overlay"); 
	document.getElementById('overlay_message').innerHTML = '<h3>' + msg + '</h3>';	
    overlay.style.display = "block";
}

function HideOverlay()
{
    var overlay = document.getElementById("overlay");    
    overlay.style.display = "none";    
}

$("body").on("submit", "form", function() {
    ShowOverlay("Sending data");
    $(this).submit(function() {
        HideOverlay();
        return false;
    });
//    HideOverlay();
    return true;
} );

