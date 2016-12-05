$(document).ready(function() {

  // if the hash changes, run this code
  $(window).on('hashchange', function() {
    // Get the hash but remove the #
    var pageHash = window.location.hash.substring(1);
    //console.log(pageHash);

    // if no hash is present in the URL then default to home.
    if (pageHash.length == 0) {
      pageHash = 'home';
    }

    // load the page and put it's contents in the main element.
    $('main').load(pageHash + '.php');
  });

  // if a navigation link is clicked load the page
  $("nav a").on('click', function(event) {
    event.preventDefault();
    var page = $(this).attr("href");
    window.location.hash = formatForHash(page);

    // load the page and put it's contents in the main element.
    $('main').load(page);
  });

  $(window).trigger('hashchange');
  
  });


/**
 * Format page filename for hash
 *
 * @param page string the path to the page.
 * @return string
 */
function formatForHash(page) {
  var hash = page.split('.');
  return hash[0];
}

