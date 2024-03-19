const log = document.getElementById('search_id');
log.addEventListener('keyup', autocomplete);

function autocomplete(e) {
    console.log(e.target.value);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "http://localhost/2PHPD_project/private/scripts/search_products/products_searched.php?q="+e.target.value, true);
    xmlhttp.send();
}