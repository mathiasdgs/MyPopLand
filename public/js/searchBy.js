
var tab=new Array("1", "2", "3", "4", "5");
document.write("Tableau d'origine : " + tab.join(", ") + "<BR>");
tab.sort()
document.write("Tri croissant : " + tab.join(", ") + "<BR>");
tab.reverse()
document.write("Tri décroissant : " + tab.join(", "));



let searchBy = document.getElementById('search-By');
searchBy.addEventListener('click',searchArticle);
function searchArticle() {
    console.log(searchBy);
}