// $(document).ready(function() {
//     $('dataTable').DataTable();
// });

// Find the appropriate folder id and determine its state.
// If it is not showing, show it and if it is showing hide it.
// function showSubs(topicid) {
//     var subs = document.getElementById("folder" + topicid);
    
//     // In the if statement below you can also add statements to change icons for each element
//     // Just remember to give the icon a unique id that matches the folder's id.
//     if (subs.style.display == "none") {
//         subs.style.display = "block";
//     }
//     else {
//         subs.style.display = "none";
//     }
// }


function listDir(url, dir)
{
    console.log(url, dir);
    $.post("testeP.php",
    {
        directory: dir
    },
    function(data){
        $("#result").append('<p>' + data + '</p>');
    })
}