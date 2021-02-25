/* Like Recoder */
function userLike($img_id, $un) {
    function functionResults(xmlhttp) {
        if (xmlhttp == "success") {
            alert("Image successfully liked.");
            window.location.assign("dashboard.php");
        } else {
            alert(xmlhttp);
        }
    }
    globalPhpAjax("GET", "controller/core.controller.php?action=imglike&imgid=" + $img_id + "&un=" + $un, functionResults);
}
/* End Like Recoder */