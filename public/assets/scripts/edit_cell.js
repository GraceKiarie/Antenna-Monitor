$(document).ready(function() {

    $('table.display').DataTable({
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
    });

    Chart.defaults.global.defaultFontFamily = 'Varela Round', 'sans-serif';
    Chart.defaults.global.defaultFontColor = 'black';

    Chart.defaults.global.animation.duration = 700;
    Chart.defaults.global.animation.easing = 'linear';

    // TITLE CONFIGURTAION
    Chart.defaults.global.title.fontSize = 16;
    Chart.defaults.global.title.fontStyle = 'normal';
    Chart.defaults.global.title.fontColor = 'rgb(65, 65, 65)';

    Chart.defaults.global.legend.labels.fontSize = 12;
    Chart.defaults.global.legend.labels.fontStyle = 'normal';
    
    // https://webdesign.tutsplus.com/tutorials/how-to-add-deep-linking-to-the-bootstrap-4-tabs-component--cms-31180
    let url = location.href.replace(/\/$/, "");
   
    if (location.hash) {
      const hash = url.split("#");
      $('#cellsTab a[href="#'+hash[1]+'"]').tab("show");
      url = location.href.replace(/\/#/, "#");
      history.replaceState(null, null, url);
      setTimeout(() => {
        $(window).scrollTop(0);
      }, 400);
    } 
     
    $('a[data-toggle="tab"]').on("click", function() {
      let newUrl;
      const hash = $(this).attr("href");
      if(hash == "#overview") {
        newUrl = url.split("#")[0];
      } else {
        newUrl = url.split("#")[0] + hash;
      }
      newUrl += "/";
      history.replaceState(null, null, newUrl);
    });

});