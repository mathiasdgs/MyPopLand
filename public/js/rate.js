
// rating

const allStars = document.querySelectorAll(".fa-star");
console.log("allStars", allStars);
const highlightedStars = [];
const rating = document.querySelector(".rating");

init();

function init() {
  allStars.forEach((star) => {
    star.addEventListener("click", saveRating);
    star.addEventListener("mouseover", addCSS);
    star.addEventListener("mouseleave", removeCSS);
  });
}

function saveRating(e) {
  console.log(e, e.target, e.target.nodeName, e.target.nodeType);
  console.dir(e.target);
  console.log(e.target.dataset);
  removeEventListenersToAllStars();
  rating.innerText = e.target.dataset.star;
  // document.getElementById("rate_input").setAttribute("value", e.target.dataset.star);
  const idpop = $('#idPop').attr('data-popId');
  
  $.post("/front/rate/" + idpop, {note: e.target.dataset.star, idpop:idpop},(data) =>{
    $('#star').html(data + "/5 ★");
    console.log(data);
  });
 
  
}


function removeEventListenersToAllStars() {
  allStars.forEach((star) => {
    star.removeEventListener("click", saveRating);
    star.removeEventListener("mouseover", addCSS);
    star.removeEventListener("mouseleave", removeCSS);
  });
}

function addCSS(e, css = "checked") {
  const overedStar = e.target;
  overedStar.classList.add(css);
  const previousSiblings = getPreviousSiblings(overedStar);
  console.log("previousSiblings", previousSiblings);
  previousSiblings.forEach((elem) => elem.classList.add(css));
}

function removeCSS(e, css = "checked") {
  const overedStar = e.target;
  overedStar.classList.remove(css);
  const previousSiblings = getPreviousSiblings(overedStar);
  previousSiblings.forEach((elem) => elem.classList.remove(css));
}

function getPreviousSiblings(elem) {
  console.log("elem.previousSibling", elem.previousSibling);
  let sibs = [];
  const spanNodeType = 1;
  while ((elem = elem.previousSibling)) {
    if (elem.nodeType === spanNodeType) {
      sibs = [elem, ...sibs];
    }
  }
  return sibs;
}





// $(function() {
//   $('#input_search').on('keyup', function(){
//       let value = $(this).val().toLowerCase();
//       $.get('/front/article/search?terms=' + value, function (articles){
//           $('#results').html('');
//           console.log(articles);
//           articles.forEach((article) => {
//               $('#results').append("<li>" + article.title + "</li>");
//           })
//       });
//   });
// });
// console.log('coucou');
