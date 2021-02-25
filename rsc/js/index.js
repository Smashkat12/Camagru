/* Check if a string is in lowercase */
function isLowerCase($str) {
    return $str === $str.toLowerCase();
}
/* End Check if a string is in lowercase */
/* User Logout */
function userLogout() {
    function functionResults(xmlhttp) {
        window.location.assign("index.php");
    }
    globalPhpAjax("GET", "controller/account.controller.php?action=logout", functionResults);
}
/* End User Logout */
/* Ajax Request To PHPFile Functions */
function globalPhpAjax($method, $url, functionCaller) {
    //Create an object
    var xmlhttp = new XMLHttpRequest();
    //To be called when we server response is ready
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            functionCaller(this.responseText);
        }
    };
    //Sending request to a php file
    xmlhttp.open("POST", $url, true);
    xmlhttp.send();
}
/* End Ajax Request To PHPFile Functions */