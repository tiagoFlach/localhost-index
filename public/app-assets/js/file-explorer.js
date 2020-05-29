// $.ajax({
//     url: '/',
//     context: document.body
// }).done(function (data) {
//     var allLinks = $(data).find('a');  
//     var goodLinks = $.grep(allLinks, function (el) {
//         return (el.pathname != '/'); 
//     });
//     var arrayFinal = [];
//     $(goodLinks).each(function (i) {
//         var object = {
//             name: this.pathname.split('.')[0],
//             extension: this.pathname.split('.')[1] || ''
//         }
//         arrayFinal.push(object);
//     });
//     console.log(goodLinks);
//     console.log(arrayFinal[0]);
// });

const listDirectories = require('list-directories');



function showAvailableDrives()
{
    document.write( getDriveList() );
}

function getDriveList()
{ 
    var fso, s, n, e, x;
    fso = new ActiveXObject('Scripting.FileSystemObject');
    e = new Enumerator( fso.Drives );
    s = '';
    do
    { 
        x = e.item();
        s = s + x.DriveLetter;
        s += ':- ';
        if ( x.DriveType == 3 ) n = x.ShareName;
        else if ( x.IsReady ) 
            n = x.VolumeName;
        else n = '[Drive not ready]';
            s += n + '<br>';
            e.moveNext();
    } 
    while ( !e.atEnd() );
    return( s );
} 


showAvailableDrives(); 